<?php

require_once('conn.php');

class actionCustomer{
    //Clientes
		public function getcantidadClientes()
		{
			$db=Db::conectar();
		    $q = $db->prepare('SELECT count(*) FROM cliente');
		    $q->execute();
		    return $q->fetchColumn();
		}

		public function insertCus($customer)
		{
			$db=Db::conectar();
			$insert = $db->prepare('INSERT INTO cliente 
									VALUES (
										:idCliente, 
										:nombre, 
										:apellido1, 
										:apellido2, 
										:telefono, 
										:idUser, 
										:userName
									)');
			$insert->bindValue('idCliente',$customer->getIdCliente());
			$insert->bindValue('nombre',$customer->getNombre());
			$insert->bindValue('apellido1',$customer->getApellido1());
			$insert->bindValue('apellido2',$customer->getApellido2());
			$insert->bindValue('telefono',$customer->getTelefono());
			$insert->bindValue('idUser',$customer->getIdUser());
			$insert->bindValue('userName',$customer->getUserName());
			$insert->execute();
		}
}

?>