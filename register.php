<?php include('./include/server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro - Sorteos v1.0</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<div class="header">
		<h2>Registro</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('./include/errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>" required>
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>" required>
		</div>
		<div class="input-group">
			<label>Contraseña</label>
			<input type="password" name="password_1" required>
		</div>
		<div class="input-group">
			<label>Confirmar contraseña</label>
			<input type="password" name="password_2" required>
		</div>
		<div class="input-group">
			<label>Cedula</label>
			<input type="text" name="cedula" required>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Registrar</button>
		</div>
		<p>
			¿Ya te encuentras registrado? <a href="login.php">Iniciar sesión</a>
		</p>
	</form>
</body>
</html>