<?php
    require_once('../clases/user.php');
    require_once('../clases/dev.php');
    require_once('../clases/gameClass.php');
    require_once('../clases/actionDev.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juegos Subidos</title>
    <link rel="stylesheet" href="../style/style_main_page.css">
</head>
<body>
    <h1 align="center">Mis Juegos</h1><br>
    <?php 
        if(isset($_SESSION['user']) && $_SESSION['user']->getrole()=='dev'){ 
        $actDev = new actionDev();
        $gameList = $actDev->showDevGames($_SESSION['role']->getIdDev());
    ?>
    <table id="juegos" align="center">
        <thead>
            <th>Nombre Juego</th>
            <th>Genero</th>
            <th>Precio</th>
            <th>Portada</th>
            <th>Modificar</th>
        </thead>
        <tbody>
            <?php foreach ($gameList as $game) { ?>
            <tr>
                <td><a href="selectGame.php?idGame=<?php echo $game->getidGame();?>&action=a"><?php echo $game->getGameName(); ?></a></td>
                <td><?php echo $game->getgenero(); ?></td>
                <td>$<?php echo $game->getprecio(); ?> Dólares</td>
                <td>
                    <a href="selectGame.php?idGame=<?php echo $game->getidGame();?>&action=a">
                        <?php echo '<img width="200" src="data:image;base64,'.base64_encode($game->getportada() ).' "/>'; ?>
                    </a>
                </td>
                <td> <a href="modifyGame.php?idGame=<?php echo $game->getidGame();?>&action=a">Modificar</a> </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
    <div class="volver">
        <a href="../index.php" class="registro1">Volver al incio</a>
    </div>
</body>
</html>
