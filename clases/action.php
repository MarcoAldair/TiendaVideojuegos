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
			try{
				$insert->execute();
				return true;
			}catch(Exception $e){
				return false;
			}
		}

		public function getcantidad()
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

		public function userLogin($userName,$password,$role)
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
				if($role == 'admin'){
					$sel = $db->prepare('SELECT * FROM encargadoverificacion WHERE idUser = :idUser');
					$sel->bindValue('idUser',$tmpUser['idUser']);
					$sel->execute();
					$tmpRole = $sel->fetch();
					if($tmpRole){$valido = true;}else{$valido = false;}
				}
				if($role == 'cus'){
					$sel = $db->prepare('SELECT * FROM cliente WHERE idUser = :idUser');
					$sel->bindValue('idUser',$tmpUser['idUser']);
					$sel->execute();
					$tmpRole = $sel->fetch();
					if($tmpRole){$valido = true;}else{$valido = false;}
				}
				if($role == 'dev'){
					$sel = $db->prepare('SELECT * FROM desarrollador WHERE idUser = :idUser');
					$sel->bindValue('idUser',$tmpUser['idUser']);
					$sel->execute();
					$tmpRole = $sel->fetch();
					if($tmpRole){$valido = true;}else{$valido = false;}
				}
				if($valido){
					$user = new User();
					$user->setidUser($tmpUser['idUser']);
					$user->setuserName($tmpUser['userName']);
					$user->setpassword($tmpUser['password']);
					$user->setemail($tmpUser['email']);
					$user->setprofilePic($tmpUser['profilePic']);
					$user->setrole($role);
					return $user;
				}else{
					return false;
				}
			}else{
				return false;
			}
			
		}
		public function editUser($user)
		{
			$db = Db::conectar();
			$update = $db->prepare('UPDATE
										user
									SET
										userName =:userName,
										password =:password,
										email =:email,
										profilePic =:profilePic
									WHERE
										idUser =:idUser');
			$update->bindValue('userName',$user->getuserName());
			$update->bindValue('password',$user->getpassword());
			$update->bindValue('email',$user->getemail());
			$update->bindValue('profilePic',$user->getprofilePic());
			$update->bindValue('idUser',$user->getidUser());
			try{
				$update->execute();
				return true;
			}catch(Exception $e){
				return false;
			}							
		}
		public function getUser($id,$role)
		{
			$db = Db::conectar();
			$select = $db->prepare('SELECT * 
									FROM user 
									WHERE idUser=:id');
			$select->bindValue('id',$id);
			$select->execute();
			$tmpUser = $select->fetch();
			$user = new User();
			$user->setidUser($tmpUser['idUser']);
			$user->setuserName($tmpUser['userName']);
			$user->setpassword($tmpUser['password']);
			$user->setemail($tmpUser['email']);
			$user->setprofilePic($tmpUser['profilePic']);
			$user->setrole($role);
			return $user;
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
			header('location:../ index.php');
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
		
		//MODIFICAR JUEGO//
		public function modifyGame($game)
		{
			$db = Db::conectar();
			$update = $db->prepare('UPDATE
										videojuegos
									SET
										idGame =:idGame,
										nombre =:nombre,
										genero =:genero,
										precio =:precio,
										idDev =:idDev,
										icon =:icon,
										trailer =:trailer,
										imagenes =:imagenes,
										Descripcion =:Descripcion
									WHERE
										idGame =:idGame');
			$update->bindValue('idGame',$game->getidGame());
			$update->bindValue('nombre',$game->getGameName());
			$update->bindValue('genero',$game->getgenero());
			$update->bindValue('precio',$game->getprecio());
			$update->bindValue('idDev',$game->getidDev());
			$update->bindValue('icon',$game->getportada());
			$update->bindValue('trailer',$game->gettrailer());
			$update->bindValue('imagenes',$game->getimagenes());
			$update->bindValue('Descripcion',$game->getdescripcion());
			try{
				$update->execute();
				return true;
			}catch(Exception $e){
				return false;
			}						
		}

		//Acciones Generales
		public function alert($msg)
		{
			echo "<script type='text/javascript'>alert('$msg');</script>";
		}
	}
?>
