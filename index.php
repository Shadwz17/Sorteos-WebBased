<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "Debes iniciar sesión primero!!";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

	include('./include/funcSorteo.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title>Indice</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>	
	<div class="header">
		<h2>Inicio</h2>
	</div>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php  if ($_SESSION['username'] && $_SESSION['grupo'] == 'usuario') : ?>
			<p>Bienvenido, ahora te encuentras registrado para el sorteo.</strong></p>
			<p>Se te avisará mediante tú correo electrónico cuando el sorteo sea realizado.</p>
			<p>Si eres un administrador, por favor, inicia sesión nuevamente</p>
			<p> <a href="index.php?logout='1'" style="color: red;">Salir</a> </p>
		<?php endif ?>
		<?php if ($_SESSION['grupo'] == 'admin'): ?>
			<p>Bienvenido administrador, puedes realizar el sorteo cuando estes listo.</p>
			<p>Se dará a conocer el ganador mediante un correo electrónico (WIP)</p>
			<p> <a href="index.php?logout='1'" style="color: red;">Salir</a> </p>
			<form method="post">
			<div class="input-group">
			<button type="submit" class="btn" name="sorteo">Sortear</button>
			</div>
			</form>
		<?php endif ?>
	</div>
</body>
</html>