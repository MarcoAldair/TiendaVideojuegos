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

	public function getcantidadPagos()
	{
		$db=Db::conectar();
		$q = $db->prepare('SELECT count(*) FROM pago');
		$q->execute();
		return $q->fetchColumn();
	}

	public function getcantidadPedidos()
	{
		$db=Db::conectar();
		$q = $db->prepare('SELECT count(*) FROM pedido');
		$q->execute();
		return $q->fetchColumn();
	}

	public function getcantidadDPedidos()
	{
		$db=Db::conectar();
		$q = $db->prepare('SELECT count(*) FROM detallepedido');
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

	public function getCus($id)
	{
		$db=Db::conectar();
        $select = $db->prepare('SELECT * 
                                FROM cliente 
                                WHERE idUser = :idUser');
        $select->bindValue('idUser',$id);
		$select->execute();
        $datos = $select->fetch();
		$cus = new customer();
		$cus->setIdCliente($datos['idCliente']);
        $cus->setNombre($datos['nombre']);
        $cus->setApellido1($datos['apellido1']);
        $cus->setApellido2($datos['apellido2']);
        $cus->setTelefono($datos['telefono']);
        $cus->setIdUser($datos['idUser']);
        $cus->setUserName($datos['userName']);
		return $cus;
	}

	public function insertPago($pago)
	{
		$db = Db::conectar();
		$insert = $db->prepare('INSERT INTO pago
								VALUES(:IdPago,:Fecha,:Total,:EstadoPago)');
		$insert->bindValue('IdPago',$pago->getIdPago());
		$insert->bindValue('Fecha',$pago->getFecha());
		$insert->bindValue('Total',$pago->getTotal());
		$insert->bindValue('EstadoPago',$pago->getEstadoPago());
		$insert->execute();
	}

	public function insertPedido($pedido)
	{
		$db = Db::conectar();
		$insert = $db->prepare('INSERT INTO pedido
								VALUES(:idPedido,:idCliente,:fechaPedido)');
		$insert->bindValue('idPedido',$pedido->getIdPedido());
		$insert->bindValue('idCliente',$pedido->getIdCliente());
		$insert->bindValue('fechaPedido',$pedido->getFechaPedido());
		$insert->execute();
	}

	public function insertDetalle($detallePedido)
	{
		$db = Db::conectar();
		$insert = $db->prepare('INSERT INTO detallepedido 
								VALUES (:idDetallePedido,:estadoPedido,:idGame,:fechaDetallePedido,:idPago,:idPedido)');
		$insert->bindValue('idDetallePedido',$detallePedido->getIdDetallePedido());
		$insert->bindValue('estadoPedido',$detallePedido->getEstadoPedido());
		$insert->bindValue('idGame',$detallePedido->getIdGame());
		$insert->bindValue('fechaDetallePedido',$detallePedido->getFechaDetallePedido());
		$insert->bindValue('idPago',$detallePedido->getIdPago());
		$insert->bindValue('idPedido',$detallePedido->getIdPedido());
		$insert->execute();
	}
}

?>