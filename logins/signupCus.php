<?php
	require_once('../clases/user.php');
	require_once('../clases/action.php');
    require_once('../clases/customer.php');
	require_once('../clases/actionCustomer.php');
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
			//Cliente
			$actionCus = new actionCustomer();
			$nombre = $_POST['nombre'];
			$apellido1 = $_POST['apellido1'];
			$apellido2 = $_POST['apellido2'];
			$telefono = $_POST['telefono'];
			$customer = new customer();
			$customer->setIdCliente($actionCus->getcantidadClientes()+1);
			$customer->setNombre($nombre);
			$customer->setApellido1($apellido1);
			$customer->setApellido2($apellido2);
			$customer->setTelefono($telefono);
			$customer->setIdUser($user->getidUser());
			$customer->setUserName($userName);
			$valueCliente = false;
			$actionCus->insertCus($customer);
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
	<title>Registro Cliente</title>
	<link rel="stylesheet" href="../style/style_login.css">
</head>
<body>
	<div class="center" id="formRegistro">
		<h1>Registro Cliente</h1>
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