<?php include('./include/server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - Sorteos v1.0</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>

	<div class="header">
		<h2>Login</h2>
	</div>
	
	<form method="post" action="login.php">
		<?php include('./include/errors.php'); ?>

		<div class="input-group">
			<label>Correo</label>
			<input type="text" name="email" >
		</div>
		<div class="input-group">
			<label>Contraseña</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p>
			¿Aún no te has registrado? <a href="register.php">Registrarse</a>
		</p>
	</form>


</body>
</html>