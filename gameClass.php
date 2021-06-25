<?php
	/**
	 * Clase Videojuegos
	 */
	class Game
	{
		private $idGame;
		private $gameName;
		private $genero;
		private $precio;
		private $idDev;
		private $descripcion;
		private $portada;
		private $trailer;
		private $imagenes;

		public function setidGame($idGame){
			$this->idGame=$idGame;
		}
		public function getidGame()
		{
			return $this->idGame;
		}

		public function setGameName($gameName){
			$this->gameName = $gameName;
		}
		public function getGameName(){
			return $this->gameName;
		}

		public function setgenero($genero){
			$this->genero = $genero;
		}
		public function getgenero(){
			return $this->genero;
		}

		public function setprecio($precio){
			$this->precio = $precio;
		}
		public function getprecio(){
			return $this->precio;
		}

		public function setidDev($idDev){
			$this->idDev = $idDev;
		}
		public function getidDev(){
			return $this->idDev;
		}

		public function setdescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function getdescripcion(){
			return $this->descripcion;
		}

		public function setportada($portada){
			$this->portada = $portada;
		}
		public function getportada(){
			return $this->portada;
		}

		public function settrailer($trailer){
			$this->trailer = $trailer;
		}
		public function gettrailer(){
			return $this->trailer;
		}

		public function setimagenes($imagenes){
			$this->imagenes = $imagenes;
		}
		public function getimagenes(){
			return $this->imagenes;
		}
	}

?>