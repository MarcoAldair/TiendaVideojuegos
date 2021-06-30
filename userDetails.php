<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Detalles del Usuario</title>
	<link rel="stylesheet" href="style/style_upload.css">
</head>
<?php
	include 'clases/action.php';
	include 'clases/user.php';
	session_start();

	if(isset($_SESSION['user'])){
?>
<body>
	<div class="center" id="formRegistro">
		<h1>Datos del usuario <?php echo $_SESSION['user']->getuserName(); ?> </h1>
		<form action="" method="post" enctype='multipart/form-data'>
			<div class="txt_field">
				<input type="text" name="userName" 
				value="<?php echo $_SESSION['user']->getuserName(); ?>" required>
				<span></span>
				<label for="">Nombre de usuario</label>				
			</div>
			<div class="txt_field">
				<input type="password" name="password" 
				value="<?php echo $_SESSION['user']->getpassword(); ?>" required>
				<span></span>
				<label for="">Contraseña</label>
			</div>
			<div class="txt_field">
				<input type="email" name="email" 
				value="<?php echo $_SESSION['user']->getemail(); ?>" required>
				<span></span>
				<label for="">Correo Electronico</label>		
			</div>
			<label for="">Imagen de perfil</label>
			<br>
			<br>
			<div class="archivo">
				<input type="file" accept="image/*" name="profilePic" required>
			</div>
			<br>
			<br>
			<div class="sesion">
				<input  type="submit" value="Modificar" name="signup">
			</div>
		</form>
	</div>
	<a href="index.php">volver</a>
</body>
<?php } else {  ?>
<body>
<h1>Necesitar haber iniciado sesion</h1>

<a href="index.php"> volver</a>	

</body>
<?php }  ?>

</html>