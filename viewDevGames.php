<?php
    require_once('clases/user.php');
    require_once('clases/dev.php');
    require_once('clases/gameClass.php');
    require_once('clases/actionDev.php');
    session_start();
    $actDev = new actionDev();
    $dev = $actDev->getDev($_SESSION['user']->getidUser());
    $gameList = $actDev->showDevGames($dev->getIdDev());
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juegos Subidos</title>
    <link rel="stylesheet" href="style/style_main_page.css">
</head>
<body>
    <?php if(isset($_SESSION['user']) && $_SESSION['user']->getrole()=='dev'){ ?>
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
                <td> <a href="">Modificar</a> </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
</body>
</html>