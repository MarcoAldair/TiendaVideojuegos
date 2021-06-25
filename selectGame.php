<?php
	require_once('cartClass.php');
	require_once('action.php');
	require_once('gameClass.php');
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
	
	<h1 id="titulo">Indie World</h1>
		<ul id="menu">
			<li><a href="index.php">Inicio</a></li>
			<li><a href="">Iniciar sesión</a></li>
			<li><a href="cart.php">Carrito</a></li>
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
	<?php if(isset($_SESSION['user'])){ ?>
	<div id="infor">
		<p><strong>Precio: </strong>$<?php echo $game->getprecio(); ?> Dólares</p>
		<a href="?add&idGame=<?php echo $game->getidGame();?>&
				gameName=<?php echo $game->getGameName(); ?>&gamePrice=<?php echo $game->getprecio(); ?>" class="button">
			Add to cart
		</a>
	</div>
	<?php }else{ ?>
		<div id="infor">
		<p><strong>Precio: </strong>$<?php echo $game->getprecio(); ?> Dólares</p>
	</div>
	<?php }?>
	<div id="descripcion">
		<h3>Acerca de este Juego...</h3>
		<p><td><?php echo $game->getdescripcion(); ?></td></p></div>
	</div>
	<a href="index.php">Volver</a>
</body>
</html>