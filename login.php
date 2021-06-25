<?php
	include 'action.php';
	include 'user.php';
	$action = new Action();
	if(isset($_POST['login'])){
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$user = $action->userLogin($userName,$password);
		if($user){
			session_start();
			$_SESSION['user'] = $user;
			header('location: index.php');
		}else{
			$action->alert('Datos Erroneos');
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio Sesion</title>
	<link rel="stylesheet" href="style/style_login.css">
</head>
<body>
	<div class="center">
		<h1>Inicio de sesion</h1>
		<form action="" method="post">
			<div class="txt_field">
				<input type="text" name="userName" required>
				<span></span>
				<label for="">Usuario</label>
			</div>
			<div class="txt_field">
				<input type="password" name="password" required>
				<span></span>
				<label for="">Contraseña</label>
				
			</div>
			<div class="sesion">
			<input  type="submit" value="Inicar sesion" name="login">
			</div>
			<div class="registro">
			<input  type="submit" value="Registrarse" >
			</div>
		</form>
	</div>
</body>
</html>