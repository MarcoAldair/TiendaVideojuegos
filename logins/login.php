<?php
	include '../clases/action.php';
	include '../clases/actionDev.php';
	include '../clases/actionCustomer.php';
	include '../clases/actionAdmin.php';
	include '../clases/user.php';
	include '../clases/dev.php';
	include '../clases/admin.php';
	$action = new Action();
	if(isset($_POST['login'])){
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$role = $_POST['role'];
		$user = $action->userLogin($userName,$password,$role);
		if($user){
			session_start();
			$_SESSION['user'] = $user;
			if($_SESSION['user']->getrole()=='cus'){
				$_SESSION['role'] = actionCustomer::getCus($_SESSION['user']->getidUser());
			}
			if($_SESSION['user']->getrole()=='admin'){
				$_SESSION['role'] = actionAdmin::getAdmin($_SESSION['user']->getidUser());
			}
			if($_SESSION['user']->getrole()=='dev'){
				$_SESSION['role'] = actionDev::getDev($_SESSION['user']->getidUser());
			}
			header('location: ../index.php');
		}else{
			$action->alert('Datos Erroneos o tipo equivocado');
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio Sesion</title>
	<link rel="stylesheet" href="../style/style_login.css">
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
			<div class="txt_field">
				<select name="role">
					<option value="admin">Admin</option>
					<option value="cus" selected>Cliente</option>
					<option value="dev">Desarrollador</option>
				</select>
				<span></span>
				<label for=""></label>
			</div>
			<div class="sesion">
				<input type="submit" value="Iniciar sesion" name="login">
			</div>

			<div class="NuevoUsuario">
				<a href="signupS.php" class="registro1">Registrarse</a>
			</div>
		</form>
	</div>
</body>
</html>