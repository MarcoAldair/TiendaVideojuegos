<?php
	require_once('action.php');
	require_once('gameClass.php');

	$action = new Action();
	$game = new Game();

	$game=$action->obtenerJuego($_GET['idGame']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Juegos</title>
	<link rel="stylesheet" href="style/style_selected_game.css">
</head>
<body>

	<!--MENU-->
	
	<h1 id="titulo">Indie World</h1>
		<ul id="menu">
			<li><a href="index.php">Inicio</a></li>
			<li><a href="">Iniciar sesión</a></li>
			<li><a href="">Carrito</a></li>
		</ul>
	<!---->
	<div id="personal">
	<div id="tituloGame">
		<h1><?php echo $game->getGameName(); ?></h1></div>
	<div id="vistazo">
		<?php echo '<img width="850" src="data:image;base64,'.base64_encode($game->getimagenes() ).' "/>'; ?>
	</div>

	<div id="icon">
		<?php echo '<img width="350" src="data:image;base64,'.base64_encode($game->getportada() ).' "/>'; ?>
	</div>

	<div id="infor">
		<p><strong>Precio: </strong>$<?php echo $game->getprecio(); ?> Dólares</p>
		<input type="submit" name="" value="Añadir al carrito" class="button">
	</div>

	<div id="descripcion">
		<h3>Acerca de este Juego...</h3>
		<p><td><?php echo $game->getdescripcion(); ?></td></p></div>
	</div>

	<!--
	<table border="1">
		<thead>
			<th>Juego</th>
			<th>Descripcion</th>
			<th>Precio</th>
			<th>Portada</th>
		</thead>
		<tbody>
				<tr>
					<td><?php //echo $game->getGameName(); ?></td>
					<td><?php //echo $game->getdescripcion(); ?></td>
					<td><?php //echo $game->getprecio(); ?></td>
					<td><?php //echo '<img width="600" src="data:image;base64,'.base64_encode($game->getimagenes() ).' "/>'; ?></td>
				</tr>
			
		</tbody>
	</table>-->
	<a href="index.php">Volver</a>
</body>
</html>