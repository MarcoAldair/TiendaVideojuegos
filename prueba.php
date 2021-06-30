<?php
	require_once('action.php');
	require_once('user.php');
	$action = new Action();
	$userList = $action->showUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista Usuarios</title>
</head>
<body>
	<table border="1">
		<thead>
			<th>ID Usuario</th>
			<th>Nombre Usuario</th>
			<th>Password</th>
			<th>Email</th>
			<th>Imagen de Perfil</th>
		</thead>
		<tbody>
			<?php foreach ($userList as $user) { ?>
			<tr>
				<td><?php echo $user->getidUser(); ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php echo '<img width="200" height="200" src="data:image;base64,'.base64_encode($user->getprofilePic() ).' "/>'; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>