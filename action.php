<?php
require_once('conn.php');
	/**
	 * Clase para las acciones a realizar
	 */
	class Action
	{
		
		public function insert($user)
		{
			$db=Db::conectar();
			$insert=$db->prepare('INSERT INTO user VALUES (:idUser, :userName, :password, :email, :profilePic)');
			$insert->bindValue('idUser',$user->getidUser());
			$insert->bindValue('userName',$user->getuserName());
			$insert->bindValue('password',$user->getpassword());
			$insert->bindValue('email',$user->getemail());
			$insert->bindValue('profilePic',$user->getprofilePic());
			$insert->execute();
			header('location: index.php');
		}

		function getcantidad()
		{
			$db=Db::conectar();
		    $q = $db->prepare('SELECT count(*) FROM user');
		    $q->execute();
		    return $q->fetchColumn();
		}

		public function showUser()
		{
			$db=Db::conectar();
			$userList=[];
			$select=$db->query('SELECT * FROM user');
			foreach($select->fetchAll() as $user){
				$tmpUser = new User();
				$tmpUser->setidUser($user['idUser']);
				$tmpUser->setuserName($user['userName']);
				$tmpUser->setpassword($user['password']);
				$tmpUser->setemail($user['email']);
				$tmpUser->setprofilePic($user['profilePic']);
				$userList[] = $tmpUser;
			}
			return $userList;
		}

		public function userLogin($userName,$password)
		{
			$db = Db::conectar();
			$select = $db->prepare('SELECT * 
									FROM user 
									WHERE userName=:userName AND password=:password');

			$select->bindValue('userName',$userName);
			$select->bindValue('password',$password);
			$select->execute();
			$tmpUser = $select->fetch();
			if($tmpUser){
				$user = new User();
				$user->setidUser($tmpUser['idUser']);
				$user->setuserName($tmpUser['userName']);
				$user->setpassword($tmpUser['password']);
				$user->setemail($tmpUser['email']);
				$user->setprofilePic($tmpUser['profilePic']);
				return $user;
			}else{
				return false;
			}
			
		}

		//***************AÑADIDO****************
		public function showGameList()
		{
			$db=Db::conectar();
			$gameList=[];
			$select=$db->query('SELECT * FROM videojuegos');
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

		function getcantidadGames()
		{
			$db=Db::conectar();
		    $q = $db->prepare('SELECT count(*) FROM videojuegos');
		    $q->execute();
		    return $q->fetchColumn();
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
			header('location: index.php');
		}

		public function obtenerJuego($idGame)
		{
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM videojuegos WHERE idGame=:idGame');
			$select->bindValue('idGame',$idGame);
			$select->execute();
			$game=$select->fetch();
			
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
			return $tmpGame;
		}
		//Carro

		//Acciones Generales
		public function alert($msg)
		{
			echo "<script type='text/javascript'>alert('$msg');</script>";
		}
	}
?>