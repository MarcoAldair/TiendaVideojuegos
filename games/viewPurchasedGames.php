<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juegos Comprados</title>
    <link rel="stylesheet" href="../style/style_main_page.css">
</head>
<body>
    <table id="juegos" align="center">
		<thead>
			<th>Nombre Juego</th>
			<th>Genero</th>
			<th>Precio</th>
			<th>Portada</th>
		</thead>
		<tbody>
<?php
    require_once('../clases/user.php');
    require_once('../clases/gameClass.php');
    require_once('../clases/actionGames.php');
    session_start();
    if(isset($_SESSION['user'])){
        $ag = new actionGame();
        $gamesId = $ag->viewPurchasedGames($_SESSION['user']->getidUser());

        foreach ($gamesId as $id) {
            $game = $ag->obtenerJuego($id);
?>
    
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
<?php
        }
    }
?>
        </tbody>
    </table>
    <a href="../index.php">Volver</a>
</body>
</html>
