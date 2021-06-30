<?php
	require_once('clases/cartClass.php');
	require_once('clases/action.php');
	require_once('clases/gameClass.php');
	session_start();
	$action = new Action();
	$game = new Game();
	$cart = new Cart();
	$game=$action->obtenerJuego($_GET['idGame']);

	if(isset($_GET['add']) && isset($_SESSION['user'])){
		$gameId = $_GET['idGame'];
		$gameName = $_GET['gameName'];
		$gameQuantity = 1;
		$gamePrice = $_GET['gamePrice'];
		$gameTotal = $gameQuantity * $gamePrice;
		$cart->setGameId($gameId);
		$cart->setGameName($gameName);
		$cart->setGameQuantity($gameQuantity);
		$cart->setGamePrice($gamePrice);
		$cart->setGameTotal($gameTotal);
		if(isset($_SESSION['elemtosCarrito'])){
			$esta = false;
			foreach ($_SESSION['elemtosCarrito'] as $key => $value) {
				if ($value->getGameId()==$cart->getGameId()) {
					$esta=true;				
				}
			}
			if($esta){
				$action->alert('ya esta en el carro ese juego');
			}else{
				$_SESSION['elemtosCarrito'][] = $cart;
			}
		}else{
			$_SESSION['elemtosCarrito'][] = $cart;
		}
	}
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
	<div class="cabecera">
		<div class="nav">
			<a href="index.php" class="logo">Indie World</a>
			<ul class="nav-menu">
				<li><a href="index.php" class="nav-menu-item">Inicio</a></li>
				<li><a href="viewCatalog.php" class="nav-menu-item">Catalogo</a></li>
				<li><a href="cart.php?view" class="nav-menu-item">Carrito</a></li>
			</ul>
			
		</div>
	</div>
	<!---->
	<div id="tituloGame">
		<h1><?php echo $game->getGameName(); ?></h1></div>


	<div class="acerca-de"><h2>Mira como se ve...</h2></div>


	<div id="vistazo">
		<?php echo '<img width="850" src="data:image;base64,'.base64_encode($game->getimagenes() ).' "/>'; ?>
	</div>


	<div class="acerca-de"><h2>Acerca de este Juego...</h2></div>


	<div class="descripcion">
		<div class="image"><?php echo '<img width="350" src="data:image;base64,'.base64_encode($game->getportada() ).' "/>'; ?></div>
		<div class="texto"><?php echo $game->getdescripcion(); ?></div>
	</div>


	<!--AÑADIR AL CARRITO-->
	<?php if(isset($_SESSION['user'])){ ?>
	<div class="precio">
		<p><strong>Precio: </strong>$<?php echo $game->getprecio(); ?> Dólares</p>
		<a href="?add&idGame=<?php echo $game->getidGame();?>&
				gameName=<?php echo $game->getGameName(); ?>&gamePrice=<?php echo $game->getprecio(); ?>" class="button">
			Add to cart
		</a>
	</div>
	<?php }else{ ?>
		<div class="precio">
		<p><strong>Precio: </strong>$<?php echo $game->getprecio(); ?> Dólares</p>
	</div>
	<?php }?>

	<!--BOTON PARA VOLVER-->
	<form action="index.php" class="">
		<input type="submit" name="" value="Volver" class="button">
	</form>
</body>
</html>