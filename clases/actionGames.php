<?php
    require_once('conn.php');
    class actionGame{
        public function viewPurchasedGames($idUser)
        {
            $db=Db::conectar();
            $gameList=[];
            $select = $db->prepare('SELECT
                                        idGame
                                    FROM
                                        detallepedido
                                    WHERE
                                        idPedido IN (
                                        SELECT
                                            idPedido
                                        FROM
                                            pedido
                                        WHERE
                                            idCliente = (
                                            SELECT
                                                idCliente
                                            FROM
                                                cliente
                                            WHERE
                                                idUser =:idUser
                                        ))');
            $select->bindValue('idUser',$idUser);
            $select->execute();
            foreach($select->fetchAll() as $game){
                $gameList[] = $game['idGame'];
            }
            return $gameList;
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

        public function showGameListAc()
		{
			$db=Db::conectar();
			$gameList=[];
			$select=$db->query("SELECT
                                    *
                                FROM
                                    videojuegos
                                WHERE
                                    idGame IN (
                                    SELECT
                                        idGame
                                    FROM
                                        estadovideojuego
                                    WHERE
                                        estado = 'ACEPTADO'
                                )");
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

		public function showGameListNp()
		{
			$db=Db::conectar();
			$gameList=[];
			$select=$db->query("SELECT
                                    *
                                FROM
                                    videojuegos
                                WHERE
                                    idGame IN (
                                    SELECT
                                        idGame
                                    FROM
                                        estadovideojuego
                                    WHERE
                                        estado != 'ACEPTADO'
                                )");
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
    }
?>