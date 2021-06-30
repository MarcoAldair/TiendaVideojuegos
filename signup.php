<?php
	require_once('clases/user.php');
	require_once('clases/action.php');
	if(isset($_POST['signup'])){
		$user = new User();
		$action = new Action();
		$role = $_POST['role'];
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$profilePic = file_get_contents($_FILES['profilePic']['tmp_name']);
		$user->setidUser($action->getcantidad()+1);
		$user->setuserName($userName);
		$user->setpassword($password);
		$user->setemail($email);
		$user->setprofilePic($profilePic);
		$action->insert($user);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" href="style/style_login.css">
</head>
<body>
	<div class="center" id="formRegistro">
		<h1>Registro</h1>
		<form action="" method="post" enctype='multipart/form-data'>
			<div class="txt_field">
				<input type="text" name="userName" required>
				<span></span>
				<label for="">Nombre de usuario</label>				
			</div>
			<div class="txt_field">
				<input type="password" name="password" required>
				<span></span>
				<label for="">Contraseña</label>
			</div>
			<div class="corr">
				<input type="email" name="email" required>
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
			<div class="registro">
			<input  type="submit" value="Registrar" name="signup">
			</div>
		</form>
	</div>
</body>
</html>