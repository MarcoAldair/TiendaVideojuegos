<?php
	require_once('../clases/user.php');
	require_once('../clases/action.php');
    require_once('../clases/admin.php');
	require_once('../clases/actionAdmin.php');
	if(isset($_POST['signup'])){
		$user = new User();
		$action = new Action();
        //usuario
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$profilePic = file_get_contents($_FILES['profilePic']['tmp_name']);
		$user->setidUser($action->getcantidad()+1);
		$user->setuserName($userName);
		$user->setpassword($password);
		$user->setemail($email);
		$user->setprofilePic($profilePic);
        $valueUser = false;
		$estado = $action->insert($user);
		if($estado){
			//Desarrollador
			$actionAdmin = new actionAdmin();
			$nombre = $_POST['nombre'];
			$apellido1 = $_POST['apellido1'];
			$apellido2 = $_POST['apellido2'];
			$telefono = $_POST['telefono'];
			$admin = new admin();
			$admin->setIdEncargado($actionAdmin->getcantidadadmin()+1);
			$admin->setNombre($nombre);
			$admin->setApellido1($apellido1);
			$admin->setApellido2($apellido2);
			$admin->setTelefono($telefono);
			$admin->setIdUser($user->getidUser());
			$admin->setUserName($userName);
			$actionAdmin->insertAdmin($admin);
			header('Location:login.php'); 
		}else{
			$action->alert('Hubo un error con los datos ingresados');
		}
        
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro Encargado de verificacion</title>
	<link rel="stylesheet" href="../style/style_login.css">
</head>
<body>
	<div class="center" id="formRegistro">
		<h1>Registro Encargado de verificacion</h1>
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
            <div class="txt_field">
                <input type="text" maxlength="30" required name="nombre">
                <span></span>
                <label for=""> Nombre(s)</label>
            </div>
            <div class="txt_field">
                <input type="text" maxlength="30" required name="apellido1">
                <span></span>
                <label for=""> Apellido 1</label>
            </div>
            <div class="txt_field">
                <input type="text" maxlength="30" required name="apellido2">
                <span></span>
                <label for=""> Apellido 2</label>
            </div>
            <div class="txt_field">
                <input type="text" maxlength="10" required name="telefono">
                <span></span>
                <label for=""> Telefono</label>
            </div>
			<div class="registro">
			    <input  type="submit" value="Registrar" name="signup">
			</div>
		</form>
	</div>
</body>
</html>