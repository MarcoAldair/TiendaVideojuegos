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
}
?>