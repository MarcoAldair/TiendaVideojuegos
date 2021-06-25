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
	<!--MENU DE NAVEGACION PRUEBA 2-->

	<div class="cabecera">
		<div class="nav">
			<a href="#" class="logo">Indie World</a>
			

			<?php if(isset($_SESSION['user'])){ ?>
			<ul class="nav-menu">

				<li><a href="index.php" class="nav-menu-item">Inicio</a></li>
				<li>
					<a href="userDetails.php" class="nav-menu-item">
						<?php echo $_SESSION['user']->getuserName() ; ?>
					</a>
				</li>
				<li><a href="?close" class="nav-menu-item"><img src="icons/out.png" alt="Log Out" width ="50px" height="50px"></a></li>
				<li><a href="viewCatalog.php" class="nav-menu-item">Catalogo</a></li>
				<li><a href="cart.php?view" class="nav-menu-item">Carrito</a></li>
			</ul>
		</div>
	</div>

			<?php } else { ?>
				<!--*****************-->
						<ul class="nav-menu">
							<li><a href="index.php" class="nav-menu-item">Inicio</a></li>
							<li><a href="login.php" class="nav-menu-item">Iniciar sesión</a></li>
							<li><a href="viewCatalog.php" class="nav-menu-item">Catalogo</a></li>
							<li><a href="cart.php?view" class="nav-menu-item">Carrito</a></li>
						</ul>
					</div>
				</div>

			<?php } ?>

	<!--TABLA DE VIDEOJUEGOS-->
	<table id="juegos" align="center">
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
	<form action="uploadGame.php" class="newgame">
		<input type="submit" name="" value="Subir Nuevo Juego" class="button">
	</form>
</body>
</html>
