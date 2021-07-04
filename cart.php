<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Carrito de compras</title>
	<link rel="stylesheet" type="text/css" href="style/style_cart.css">
</head>
<?php
	include('clases/cartClass.php');
	require_once('clases/customer.php');
	require_once('clases/pago.php');
	require_once('clases/pedido.php');
	require_once('clases/detallePedido.php');
	require_once('clases/gameClass.php');
	require_once('clases/action.php');
	require_once('clases/user.php');
	require_once('clases/actionCustomer.php');
	session_start();
	if(isset($_GET['delete'])){
		foreach ($_SESSION['elemtosCarrito'] as $key => $value) {
			if($value->getGameId() == $_GET['delete']){
				unset($_SESSION['elemtosCarrito'][$key]);
			}
		}
		if(empty($_SESSION['elemtosCarrito'])){
			unset($_SESSION['elemtosCarrito']);
		}
		header('location: cart.php?view');
	}

	if(isset($_POST['checkout']) && $_SESSION['user']->getrole()=='cus'){
		$total = 0;
		foreach ($_SESSION['elemtosCarrito'] as $key => $cart) {
			$total = $total + $cart->getGameTotal() ;
		}
		$pago = new pago();
		$pedido = new pedido();
		$actionGame = new actionCustomer();
		//pago
		$pago->setIdPago($actionGame->getcantidadPagos()+1);
		$pago->setFecha(date("Y-m-d"));
		$pago->setTotal($total);
		$pago->setEstadoPago('ACEPTADO');
		$actionGame->insertPago($pago);
		//pedido
		$pedido->setIdPedido($actionGame->getcantidadPedidos()+1);
		$pedido->setIdCliente($_SESSION['role']->getIdCliente());
		$pedido->setFechaPedido(date("Y-m-d"));
		$actionGame->insertPedido($pedido);
		//detalle del pedido
		foreach ($_SESSION['elemtosCarrito'] as $key => $cart) {
			$detallePedido = new detallePedido();
			$detallePedido->setIdDetallePedido($actionGame->getcantidadDPedidos()+1);
			$detallePedido->setEstadoPedido('ACEPTADO');
			$detallePedido->setIdGame($cart->getGameId());
			$detallePedido->setFechaDetallePedido(date("Y-m-d"));
			$detallePedido->setIdPago($pago->getIdPago());
			$detallePedido->setIdPedido($pedido->getIdPedido());
			$actionGame->insertDetalle($detallePedido);
		}
		unset($_SESSION['elemtosCarrito']);
		header('location: games/viewPurchasedGames.php');
	}

	if(isset($_GET['view']) && isset($_SESSION['elemtosCarrito'])){
?>
<body>
	<!--MENU-->

	<div class="cabecera">
		<div class="nav">
			<a href="index.php" class="logo">Indie World</a>
			<ul class="nav-menu">
				<li><a href="index.php" class="nav-menu-item">Inicio</a></li>
				<li><a href="games/viewCatalog.php" class="nav-menu-item">Catalogo</a></li>
				<li><a href="cart.php?view" class="nav-menu-item">Carrito</a></li>
			</ul>
			
		</div>
	</div>
	<!--Carrito-->
	<h2>Carrito de compra</h2>
	<table>
		<thead>
			<th>Juego</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>total</th>
			<th>Eliminar</th>
		</thead>
		<tbody>
			<?php foreach ($_SESSION['elemtosCarrito'] as $key => $cart) {?>			
			<tr>
				<td><?php echo $cart->getGameName() ;?></td>
				<td><?php echo $cart->getGamePrice() ;?></td>
				<td><?php echo $cart->getGameQuantity() ;?></td>
				<td><?php echo $cart->getGameTotal() ;?></td>
				<td><a href="?delete=<?php echo $cart->getGameId(); ?>"><img src="icons/delete.png" height = "26"></a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<form action="" method="post">
		
		<input  type="submit" value="Comprar" name="checkout" class="boton1">
	
	</form>

	<form action="index.php">
		<br>
		<input type="submit" name="" value="Volver" class="button">
	</form>
</body>
</html>
<?php
	}else{
?>
<body>
	<br>
	<h2 id="carritoVacio">Tu carrito esta vacio</h2>
	<form action="index.php">
		<input type="submit" name="" value="Volver" class="button">
	</form>
</body>
</html>
<?php		
	}
?>
