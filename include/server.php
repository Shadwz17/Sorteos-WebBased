<?php 
	session_start();
	error_reporting (E_ALL ^ E_NOTICE);

	//Declarando la disponibilidad para verificar las cedulas uruguayas - código por Leewayweb
	require_once 'vendor/autoload.php';

	use Leewayweb\CiValidator\CiValidator;

	$validator = new CiValidator();

	// Declaración de unas variables importantes
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	$db = mysqli_connect('localhost', 'root', '', 'premios');

	// Al presionar el boton de registrar
	if (isset($_POST['reg_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);

		// Protección contra XSS básica
		$username = htmlspecialchars($username);
		// Ej: Vuelve <script>location.href="google.com"</script> a &lt;script&gt;location.href=&quot;google.com&quot;&lt;/script&gt; 
		// Volviendo el código malicioso inservible en caso de que la variable, en este caso $username sea usada.
		
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$cedula = mysqli_real_escape_string($db, $_POST['cedula']);

		// Validar que se completó el formulario correctamente
		if (empty($username)) { array_push($errors, "Un nombre es necesario"); }
		if (empty($email)) { array_push($errors, "Un correo electrónico es necesario"); }
		if (empty($password_1)) { array_push($errors, "Una contraseña es necesaria"); }

		if ($password_1 != $password_2) {
			array_push($errors, "Las contraseñas no se parecen");
		}
		if (empty($cedula)) { array_push($errors, "Una cedula es necesaria"); }

		$verifcedula = ($validator->validate_ci( $cedula ) ? 'true' : 'false').PHP_EOL;

        if (($verifcedula = $validator->validate_ci( $cedula ))) {
            /* No haga nada */ 
        } else {
            array_push($errors, "La cedula digitada no es valida");
        }
		// Verifica que no haya un usuario registrado con el mismo correo o cedula
		$user_check_query = "SELECT * FROM usuarios WHERE cedula='$cedula' OR email='$email' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if ($user) {
		  if ($user['cedula'] === $cedula) {
			array_push($errors, "Esa cedula se encuentra en uso");
		  }
	  
		  if ($user['email'] === $email) {
			array_push($errors, "Ese correo se encuentra en uso");
		  }
		}
		// Si todo pasa correctamente
		if (count($errors) == 0) {
			$password = md5($password_1); //Encripta la contraseña usando la función  de php llamada md5
			$query = "INSERT INTO usuarios (nombre, email, pswd, cedula) 
					  VALUES('$username', '$email', '$password', '$cedula')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['grupo'] = 'usuario';
			$_SESSION['success'] = "Registrado correctamente!";
			header('location: index.php');
		}

	} 

	// Boton de login
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Un correo es necesario");
		}
		if (empty($password)) {
			array_push($errors, "Una contraseña es necesaria");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM usuarios WHERE email='$username' AND pswd='$password'";
			$results = mysqli_query($db, $query);
			$datosg = $results->fetch_assoc();

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['grupo'] = $datosg['grupos'];
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "Logeado correctamente";
				header('location: index.php');
			}else {
				array_push($errors, "El correo o contraseña es erroneo");
			}
		}
	}

?>