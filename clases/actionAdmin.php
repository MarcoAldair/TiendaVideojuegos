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

        public function getAdmin($id)
        {
            $db=Db::conectar();
            $select = $db->prepare('SELECT * 
                                    FROM encargadoverificacion 
                                    WHERE idUser = :idUser');
            $select->bindValue('idUser',$id);
            $select->execute();
            $datos = $select->fetch();
            $admin = new admin();
            $admin->setIdEncargado($datos['idEncargado']);
            $admin->setNombre($datos['nombre']);
            $admin->setApellido1($datos['apellido1']);
            $admin->setApellido2($datos['apellido2']);
            $admin->setTelefono($datos['telefono']);
            $admin->setIdUser($datos['idUser']);
            $admin->setUserName($datos['userName']);

            return $admin;
        }
    }
?>