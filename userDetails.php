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
	if(isset($_POST['edit'])){
		$user = new User();
		$action = new Action();
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$profilePic = file_get_contents($_FILES['profilePic']['tmp_name']);
		$user->setidUser($_SESSION['user']->getidUser());
		$user->setuserName($userName);
		$user->setpassword($password);
		$user->setemail($email);
		$user->setprofilePic($profilePic);
		if($action->editUser($user)){
			$id = $_SESSION['user']->getidUser();
			$role = $_SESSION['user']->getrole();
			$_SESSION['user'] = $action->getUser($id,$role);
		}else{
			$action->alert('Error');
		}
	}
	if(isset($_SESSION['user'])){
?>
<body>
	<br>
	<br>
	<a href="index.php" class="registro1">Volver</a>
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
			<div class="image"><?php echo '<img width="200" src="data:image;base64,'.base64_encode($_SESSION['user']->getprofilePic() ).' "/>'; ?></div>
			<br>
			<br>
			<div class="archivo">
				<input type="file" accept="image/*" name="profilePic" required>
			</div>
			<br>
			<br>
			<div class="sesion">
				<input  type="submit" value="Modificar" name="edit">
				
			</div>
		</form>
	</div>
	<a href="index.php">volver</a>
</body>
<?php } else {  ?>
<body>
<h1>Necesitar haber iniciado sesion</h1>



</body>
<?php }  ?>

</html>
