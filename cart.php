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
	require_once('clases/gameClass.php');
	require_once('clases/action.php');
	$action = new Action();
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
	if(isset($_GET['view']) && isset($_SESSION['elemtosCarrito'])){
?>
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
	<form action="index.php">
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
