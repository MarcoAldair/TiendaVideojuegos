<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tienda</title>
	<link rel="stylesheet" href="style/style_main_page.css">
</head>
<?php
	include 'clases/user.php';
	require_once('clases/action.php');
	require_once('clases/gameClass.php');
	require_once('clases/actionGames.php');
	session_start();
	$action = new Action();
	$gameList = actionGame::showGameListAc();

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
					
					<!--SUBMENU-->
					<?php if($_SESSION['user']->getrole() == 'dev'){ ?>
					<ul class="nav-menu">
						<li class="nav-menu-item"><a href="userDetails.php" class="submenu-item">Editar Usuario</a></li>
						<li class="nav-menu-item"><a href="games/viewDevGames.php" class="submenu-item">Juegos Subidos</a></li>
						<li class="nav-menu-item"><a href="#" class="submenu-item">---</a></li>
					</ul>
					<?php } ?>
					<?php if($_SESSION['user']->getrole() == 'cus'){ ?>
					<ul class="nav-menu">
						<li class="nav-menu-item"><a href="userDetails.php" class="submenu-item">Editar Perfil</a></li>
						<li class="nav-menu-item"><a href="games/viewPurchasedGames.php" class="submenu-item">Juegos Adquiridos</a></li>
						<li class="nav-menu-item"><a href="#" class="submenu-item">---</a></li>
					</ul>
					<?php } ?>
					<?php if($_SESSION['user']->getrole() == 'admin'){ ?>
					<ul class="nav-menu">
						<li class="nav-menu-item"><a href="#" class="submenu-item">Editar Perfil</a></li>
						<li class="nav-menu-item"><a href="#" class="submenu-item">Juegos Subidos</a></li>
						<li class="nav-menu-item"><a href="#" class="submenu-item">---</a></li>
					</ul>
					<?php } ?>
				</li>
				<li>
					<a href="?close" class="nav-menu-item">
						<img src="icons/out.png" alt="Log Out" width="50px" height="50px" id="imagenSalir">
					</a>
				</li>
				<?php if($_SESSION['user']->getrole() == 'cus'){ ?>
				<li><a href="games/viewCatalog.php" class="nav-menu-item">Catalogo</a></li>
				<li><a href="cart.php?view" class="nav-menu-item">Carrito</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>

			<?php } else { ?>
				<!--*****************-->
			<ul class="nav-menu">
				<li><a href="index.php" class="nav-menu-item">Inicio</a></li>
				<li><a href="logins/login.php" class="nav-menu-item">Iniciar sesión</a></li>
				<li><a href="games/viewCatalog.php" class="nav-menu-item">Catalogo</a></li>
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
				<td><a href="games/selectGame.php?idGame=<?php echo $game->getidGame();?>&action=a"><?php echo $game->getGameName(); ?></a></td>
				<td><?php echo $game->getgenero(); ?></td>
				<td>$<?php echo $game->getprecio(); ?> Dólares</td>
				<td>
					<a href="games/selectGame.php?idGame=<?php echo $game->getidGame();?>&action=a">
						<?php echo '<img width="200" src="data:image;base64,'.base64_encode($game->getportada() ).' "/>'; ?>
					</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php if(isset($_SESSION['user']) && $_SESSION['user']->getrole() == 'dev' ){ ?>
		<form action="games/uploadGame.php" class="newgame">
			<input type="submit" name="" value="Subir Nuevo Juego" class="button">
		</form>
	<?php } ?>
</body>
</html>
