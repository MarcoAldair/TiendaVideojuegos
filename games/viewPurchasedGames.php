<?php
    include '../clases/user.php';
    require_once('../clases/user.php');
    session_start();
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juegos Comprados</title>
    <link rel="stylesheet" href="../style/style_purch.css">
</head>
<body>
    
    <div class="cabecera">
    <div class="nav">
    <h1 class="logo" id="titulo">Videojuegos adquiridos</h1>
        <ul id="menu"class="nav-menu">
            <li><a class="nav-menu-item" href="../index.php">Inicio</a></li>
            <li>
                <a class="nav-menu-item" href="../userDetails.php">
                    <?php echo $_SESSION['user']->getuserName() ; ?>
                </a>
            </li>
           
        </ul>
    </div>
    </div>
    

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
    <a class="registro1" href="../index.php">Volver</a>
</body>
</html>
