<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Carrito de compras</title>
</head>
<?php
	include('cartClass.php');
	require_once('gameClass.php');
	require_once('action.php');
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
	<table border="1">
		<thead>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>total</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($_SESSION['elemtosCarrito'] as $key => $cart) {?>			
			<tr>
				<td><?php echo $cart->getGameName() ;?></td>
				<td><?php echo $cart->getGamePrice() ;?></td>
				<td><?php echo $cart->getGameQuantity() ;?></td>
				<td><?php echo $cart->getGameTotal() ;?></td>
				<td><a href="?delete=<?php echo $cart->getGameId(); ?>">Eliminar</a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</body>
</html>
<?php
	}else{
?>
<body>
	<h1>Tu carrito esta vacio</h1>
	<a href="index.php">volver</a>
</body>
</html>
<?php		
	}
?>