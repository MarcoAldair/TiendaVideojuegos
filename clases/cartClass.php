<?php
	class Cart{
		private $gameId;
		private $gameName;
		private $gameQuantity;
		private $gamePrice;
		private $gameTotal;

		public function getGameId(){
			return $this->gameId;
		}

		public function setGameId($gameId){
			$this->gameId = $gameId;
		}

		public function getGameName(){
			return $this->gameName;
		}

		public function setGameName($gameName){
			$this->gameName = $gameName;
		}

		public function getGameQuantity(){
			return $this->gameQuantity;
		}

		public function setGameQuantity($gameQuantity){
			$this->gameQuantity = $gameQuantity;
		}

		public function getGamePrice(){
			return $this->gamePrice;
		}

		public function setGamePrice($gamePrice){
			$this->gamePrice = $gamePrice;
		}

		public function getGameTotal(){
			return $this->gameTotal;
		}

		public function setGameTotal($gameTotal){
			$this->gameTotal = $gameTotal;
		}
	}
?>