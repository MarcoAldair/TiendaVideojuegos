<?php

class customer{
    private $idCliente;
    private $nombre;
    private $apellido1 ;
    private $apellido2;
    private $telefono;
    private $idUser;
    private $userName;
    
    public function getIdCliente(){
		return $this->idCliente;
	}

	public function setIdCliente($idCliente){
		$this->idCliente = $idCliente;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getApellido1(){
		return $this->apellido1;
	}

	public function setApellido1($apellido1){
		$this->apellido1 = $apellido1;
	}

	public function getApellido2(){
		return $this->apellido2;
	}

	public function setApellido2($apellido2){
		$this->apellido2 = $apellido2;
	}

	public function getTelefono(){
		return $this->telefono;
	}

	public function setTelefono($telefono){
		$this->telefono = $telefono;
	}

	public function getIdUser(){
		return $this->idUser;
	}

	public function setIdUser($idUser){
		$this->idUser = $idUser;
	}

	public function getUserName(){
		return $this->userName;
	}

	public function setUserName($userName){
		$this->userName = $userName;
	}

}

?>