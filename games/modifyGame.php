<?php
	require_once('../clases/action.php');
	require_once('../clases/gameClass.php');
	$action= new Action();
	$game=new Game();
	//busca el juego utilizando el id, que es enviado por GET desde la vista viewDevGames.php
	$game=$action->obtenerJuego($_GET['idGame']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Modificar Juego</title>
</head>
<body>
	

	<a href="viewDevGames.php">Regresar</a>
</body>
</html>