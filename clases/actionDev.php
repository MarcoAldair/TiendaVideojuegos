<?php
require_once('conn.php');
class actionDev{
    public function getcantidadDev()
    {
        $db=Db::conectar();
        $q = $db->prepare('SELECT count(*) FROM desarrollador');
        $q->execute();
        return $q->fetchColumn();
    }
    public function insertDev($dev)
    {
        $db=Db::conectar();
        $insert = $db->prepare('INSERT INTO desarrollador 
                                VALUES (
                                    :idDev, 
                                    :nombre, 
                                    :apellido1, 
                                    :apellido2, 
                                    :telefono, 
                                    :idUser, 
                                    :userName
                                )');
        $insert->bindValue('idDev',$dev->getIdDev());
        $insert->bindValue('nombre',$dev->getNombre());
        $insert->bindValue('apellido1',$dev->getApellido1());
        $insert->bindValue('apellido2',$dev->getApellido2());
        $insert->bindValue('telefono',$dev->getTelefono());
        $insert->bindValue('idUser',$dev->getIdUser());
        $insert->bindValue('userName',$dev->getUserName());
        $insert->execute();
    }

    public function getDev($id)
    {
        $db=Db::conectar();
        $select = $db->prepare('SELECT * 
                                FROM desarrollador 
                                WHERE idUser = :idUser');
        $select->bindValue('idUser',$id);
        $select->execute();
        $datos = $select->fetch();
        $dev = new developer();
        $dev->setIdDev($datos['idDev']);
        $dev->setNombre($datos['nombre']);
        $dev->setApellido1($datos['apellido1']);
        $dev->setApellido2($datos['apellido2']);
        $dev->setTelefono($datos['telefono']);
        $dev->setIdUser($datos['idUser']);
        $dev->setUserName($datos['userName']);

        return $dev;
    }

    public function showDevGames($id)
    {
        $db=Db::conectar();
        $gameList=[];
        $select=$db->prepare('SELECT * 
                            FROM videojuegos
                            WHERE idDev = :idDev');
        $select->bindValue('idDev',$id);
        $select->execute();
        foreach($select->fetchAll() as $game){
            $tmpGame = new Game();
            $tmpGame->setidGame($game['idGame']);
            $tmpGame->setGameName($game['nombre']);
            $tmpGame->setgenero($game['genero']);
            $tmpGame->setprecio($game['precio']);
            $tmpGame->setidDev($game['idDev']);
            $tmpGame->setdescripcion($game['Descripcion']);
            $tmpGame->setportada($game['icon']);
            $tmpGame->settrailer($game['trailer']);
            $tmpGame->setimagenes($game['imagenes']);
            $gameList[] = $tmpGame;
        }
        return $gameList;
    }

    public function uploadGame($game)
    {
        $db=Db::conectar();
        $insert=$db->prepare('INSERT INTO videojuegos VALUES (:idGame, :nombre, :genero, :precio, :idDev, :icon, :trailer, :imagenes, :descripcion)');
        $insert->bindValue('idGame',$game->getidGame());
        $insert->bindValue('nombre',$game->getGameName());
        $insert->bindValue('genero',$game->getgenero());
        $insert->bindValue('precio',$game->getprecio());
        $insert->bindValue('idDev',$game->getidDev());

        $insert->bindValue('icon',$game->getportada());
        $insert->bindValue('trailer',$game->gettrailer());
        $insert->bindValue('imagenes',$game->getimagenes());

        $insert->bindValue('descripcion',$game->getdescripcion());
        $insert->execute();
        header('location:../ index.php');
    }
}
?>