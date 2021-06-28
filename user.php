<?php
	/**
	 * Clase Usuario
	 */
	class User
	{
		private $idUser;
		private $userName;
		private $password;
		private $email;
		private $profilePic;
		private $role;

		public function setidUser($idUser){
			$this->idUser=$idUser;
		}
		public function getidUser()
		{
			return $this->idUser;
		}

		public function setuserName($userName){
			$this->userName = $userName;
		}
		public function getuserName(){
			return $this->userName;
		}

		public function setpassword($password){
			$this->password = $password;
		}
		public function getpassword(){
			return $this->password;
		}

		public function setemail($email){
			$this->email = $email;
		}
		public function getemail(){
			return $this->email;
		}

		public function setprofilePic($profilePic){
			$this->profilePic = $profilePic;
		}
		public function getprofilePic(){
			return $this->profilePic;
		}

		public function setrole($role)
		{
			$this->role = $role;
		}

		public function getrole()
		{
			return $this->role;
		}
	}

?>