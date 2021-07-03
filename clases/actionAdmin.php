<?php 
    require_once('conn.php');
    class actionAdmin{
        public function getcantidadadmin()
	    {
            $db=Db::conectar();
            $q = $db->prepare('SELECT count(*) FROM encargadoverificacion');
            $q->execute();
            return $q->fetchColumn();
	    }
        public function insertAdmin($admin)
        {
            $db=Db::conectar();
            $insert = $db->prepare('INSERT INTO encargadoverificacion 
                                    VALUES (
                                        :idEncargado, 
                                        :nombre, 
                                        :apellido1, 
                                        :apellido2, 
                                        :telefono, 
                                        :idUser, 
                                        :userName
                                    )');
            $insert->bindValue('idEncargado',$admin->getIdEncargado());
            $insert->bindValue('nombre',$admin->getNombre());
            $insert->bindValue('apellido1',$admin->getApellido1());
            $insert->bindValue('apellido2',$admin->getApellido2());
            $insert->bindValue('telefono',$admin->getTelefono());
            $insert->bindValue('idUser',$admin->getIdUser());
            $insert->bindValue('userName',$admin->getUserName());
            $insert->execute();
        }
    }
?>