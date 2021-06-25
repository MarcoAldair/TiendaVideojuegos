<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tienda</title>
	<link rel="stylesheet" href="style/style_main_page.css">
</head>
<?php
	include 'user.php';
	require_once('action.php');
	require_once('gameClass.php');
	session_start();
	$action = new Action();
	$gameList = $action->showGameList();

	if(isset($_GET['close'])){
		if(isset($_SESSION['user'])){
			session_unset();
			session_destroy();
			header('location: index.php');
		}
	}
?>
<body>
	<!--MENU DE NAVEGACION-->

	<h1 id="titulo">Indie World</h1>
		<ul id="menu">
			<?php if(isset($_SESSION['user'])){ ?>
				<li><a href="index.php">Inicio</a></li>
				<li>
					<a href="userDetails.php">
						<?php echo $_SESSION['user']->getuserName() ; ?>
					</a>
				</li>
				<li><a href="?close"><img src="icons/out.png" alt="Log Out" width ="50px" height="50px"></a></li>
				<li><a href="viewCatalog.php">Catalogo</a></li>
				<li><a href="cart.php?view">Carrito</a></li>
			<?php } else { ?>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="login.php">Iniciar sesión</a></li>
				<li><a href="viewCatalog.php">Catalogo</a></li>
				<li><a href="cart.php?view">Carrito</a></li>
			<?php } ?>
		</ul>

	<!--TABLA DE VIDEOJUEGOS-->
	<table border="1" id="juegos" align="center">
		<thead>
			<th>Nombre Juego</th>
			<th>Genero</th>
			<th>Precio</th>
			<th>Portada</th>
		</thead>
		<tbody>
			<?php foreach ($gameList as $game) { ?>
			<tr>
				<!--<td><?php //echo $game->getidGame(); ?></td>-->
				<td><a href="selectGame.php?idGame=<?php echo $game->getidGame();?>&action=a"><?php echo $game->getGameName(); ?></a></td>
				<td><?php echo $game->getgenero(); ?></td>
				<td>$<?php echo $game->getprecio(); ?> Dólares</td>
				<td>
					<a href="selectGame.php?idGame=<?php echo $game->getidGame();?>&action=a">
						<?php echo '<img width="200" src="data:image;base64,'.base64_encode($game->getportada() ).' "/>'; ?>
					</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<a href="uploadGame.php">Subir Nuevo Juego</a>
</body>
</html>
