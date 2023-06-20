<?php

class Tarjeta
{

	private $conection;

	/* Set conection */
	public function getConection(): void
	{
		$dbObj = new conexiondb();
		$this->conection = $dbObj->initConex();
		
	}

	/* Get user */
	public function login($param)
	{
		$this->getConection();
		$idTarjeta = isset($param["idTarjeta"]) ? $param["idTarjeta"] : $_SESSION['idTarjeta'];

		$query = $this->conection->query("SELECT idUsuario FROM usuarios_tarjetas WHERE idTarjeta=" . $idTarjeta);
		if ($query->num_rows === 0) throw new Exception("No se ha encontrado esta tarjeta");

		$_SESSION['idTarjeta'] = $idTarjeta;

		$array = $query->fetch_assoc();

		if (count($array) > 0) {
			$query = $this->conection->query("SELECT idUsuario, email, nie, idPerfil FROM usuarios WHERE idUsuario=" . $array["idUsuario"]);
			if ($query->num_rows === 0) throw new Exception("No se ha podido recuperar los datos del usuario asociado a la tarjeta");
			$user = $query->fetch_assoc();
			$_SESSION['user'] = $user;
		}

		return $user;
	}


	public function permiso_salida_tiempo($idTarjeta){
                $this->getConection();
                $query = $this->conection->query("SELECT u.last_present FROM usuarios u JOIN usuarios_tarjetas ut ON u.idUsuario = ut.idUsuario WHERE ut.idTarjeta = ".$idTarjeta);
                $tiempo = $query->fetch_row();

                if ($tiempo) {
                        return $tiempo[0];
                } else {
                        return null; // O algún valor predeterminado si no se encuentra ningún resultado
                }
        }


        public function permiso_salida_update($idTarjeta){
                $this->getConection();
                $queryupdate = $this->conection->query("UPDATE usuarios u JOIN usuarios_tarjetas ut ON u.idUsuario = ut.idUsuario SET u.last_present = NOW() WHERE ut.idTarjeta =  ".$idTarjeta);

                    if ($queryupdate) {
                        return true; // Actualización exitosa
                    } else {
                        return false; // Actualización fallida
                    }
        }


        public function permiso_salida_date($idTarjeta){
                $this->getConection();
                $querydate = $this->conection->query("SELECT u.fecha_nacimiento FROM usuarios u 
													  JOIN usuarios_tarjetas ut ON u.idUsuario = ut.idUsuario 
													  WHERE ut.idTarjeta = ".$idTarjeta);
                $date = $querydate->fetch_assoc();
                return $date['fecha_nacimiento'];
       }


	public function updaterecogida($relacion_familiar, $otro_familiar, $nombre_padre, $dni_padre, $alumno, $curso, $fecha_salida, $motivo_salida, $otro_motivo, $opciones, $otra_opcion) {
		$this->getConection();
		$otro_familiar = !empty($otro_familiar) ? $otro_familiar : NULL;
	    $otro_motivo = !empty($otro_motivo) ? $otro_motivo : NULL;
	    $otra_opcion = !empty($otra_opcion) ? $otra_opcion : NULL;
	    $query = $this->conection->query("INSERT INTO recogidas (relacion_familiar, otro_familiar, nombre_padre, dni_padre, alumno, curso, fecha_salida, motivo_salida, otro_motivo, opciones, otra_opcion) VALUES ('".$relacion_familiar."', '".$otro_familiar."','".$nombre_padre."', '".$dni_padre."', '".$alumno."', '".$curso."', '".$fecha_salida."', '".$motivo_salida."', '".$otro_motivo."', '".$opciones."', '".$otra_opcion."')");
		if ($query) {
	        return true; // Actualización exitosa
	    } else {
	        return false; // Actualización fallida
	    }
	}

	public function comprobarmayoredad($idTarjeta){
		$this->getConection();
		$querymayoredad = $this->conection->query("SELECT u.mayor_edad FROM usuarios u JOIN usuarios_tarjetas ut ON u.idUsuario = ut.idUsuario WHERE ut.idTarjeta = ".$idTarjeta);

		$mayoredad = $querymayoredad->fetch_row();

		if ($mayoredad) {
				return $mayoredad[0];
		} else {
				return null; // O algún valor predeterminado si no se encuentra ningún resultado
		}
	}

	public function mayoredadsi($idTarjeta) {
		$this->getConection();
	    $querymayorsi = $this->conection->query("UPDATE usuarios u
											JOIN usuarios_tarjetas ut ON u.idUsuario = ut.idUsuario
											SET u.mayor_edad = 'si'
											WHERE ut.idTarjeta = " .$idTarjeta);
		if ($querymayorsi) {
	        return true; // Actualización exitosa
	    } else {
	        return false; // Actualización fallida
	    }
	}


	public function mayoredadno($idTarjeta) {
		$this->getConection();
	    $querymayorno = $this->conection->query("UPDATE usuarios u
											JOIN usuarios_tarjetas ut ON u.idUsuario = ut.idUsuario
											SET u.mayor_edad = 'no'
											WHERE ut.idTarjeta = " .$idTarjeta);
		if ($querymayorno) {
	        return true; // Actualización exitosa
	    } else {
	        return false; // Actualización fallida
	    }
	}

	public function getTarjetaUsuario($type, $value)
	{
		$this->getConection();

		$query = $this->conection->query(
			"SELECT usuarios.idUsuario, usuarios.email, usuarios.nie, tarjetas.idTarjeta, usuarios.idPerfil
			FROM usuarios
			LEFT JOIN usuarios_tarjetas ON usuarios_tarjetas.idUsuario = usuarios.idUsuario
			LEFT JOIN tarjetas ON tarjetas.idTarjeta = usuarios_tarjetas.idTarjeta
			WHERE " . $type . " = '" . $value . "';"
		);
		$array = $query->fetch_all();

		return $array;
	}

	public function getTarjetaUsuarioRecogida($type, $value)
        {
                $this->getConection();

                $query = $this->conection->query(
                        "SELECT usuarios.idUsuario, usuarios.nombre, usuarios.email, usuarios.nie, tarjetas.idTarjeta, usuarios.idPerfil
                        FROM usuarios
                        LEFT JOIN usuarios_tarjetas ON usuarios_tarjetas.idUsuario = usuarios.idUsuario
                        LEFT JOIN tarjetas ON tarjetas.idTarjeta = usuarios_tarjetas.idTarjeta
                        WHERE " . $type . " = '" . $value . "';"
                );
                $array = $query->fetch_all();

                return $array;
        }


	public function getTarjetainformerecogida($fecha_ini, $fecha_fin)
        {
                $this->getConection();

                $query = $this->conection->query("SELECT * FROM recogidas WHERE fecha_salida > '".$fecha_ini."' AND fecha_salida <= '".$fecha_fin."';");
                $array = $query->fetch_all();

                return $array;
        }


	public function getTarjetainformerecogidauser($usuario)
        {
                $this->getConection();

                $query = $this->conection->query("SELECT * FROM recogidas WHERE alumno = '".$usuario."';");
                $array = $query->fetch_all();

                return $array;
        }



	public function setUserTarjeta($idUsuario, $idTarjeta){
		$this->getConection();

		$estadoTarjeta = $this->comprobarEstadoTarjeta($idTarjeta);
		if (null == $estadoTarjeta) {
			$query = $this->conection->query("INSERT INTO tarjetas(idTarjeta, activo) VALUES ('".$idTarjeta."', 1)");
			$query2 = $this->conection->query("INSERT INTO usuarios_tarjetas(idUsuario, idTarjeta) VALUES ('".$idUsuario."', '".$idTarjeta."')");
			if ($query && $query2){
				return TRUE;
			} else{
				return FALSE;
			}
		}
	} 

	/* 
	**Comprobar el estado de la tarjeta en la tabla tarjetas
	 */
	public function comprobarEstadoTarjeta($idTarjeta){
		$this->getConection();
		$query = $this->conection->query("SELECT activo FROM tarjetas WHERE idTarjeta=".$idTarjeta);
		return $query->fetch_assoc();
	} 

	public function comprobarEstado($idTarjeta){
		$this->getConection();

		$query = $this->conection->query("SELECT * FROM fechabajatarjetas WHERE idTarjeta=".$idTarjeta);
		$array = $query->fetch_assoc();
		return $array;
	} 

	public function comprobarUserBano($idTarjeta){
		$this->getConection();
		$query = $this->conection->query("SELECT idUsuario FROM usuarios_tarjetas WHERE idTarjeta=  ".$idTarjeta);
		$usuario = $query->fetch_assoc();
		
		if (null === $usuario) {
			return false;
		}

		$nie = $this->conection->query("SELECT `nie` FROM `usuarios` WHERE `idUsuario` = ".$usuario['idUsuario']);

		return $nie->fetch_assoc();
	}

	public function borradoAsociacion($usuarios, $motivo){
		$this->getConection();
		$now = date('Y-m-d');
		foreach ($usuarios as $idUsuario) {
			$query = $this->conection->query("SELECT idTarjeta FROM usuarios_tarjetas WHERE idUsuario=  ".$idUsuario);
			$tarjeta = $query->fetch_assoc();
			$idTarjeta = $tarjeta['idTarjeta'];
			$this->conection->query("INSERT INTO fechabajatarjetas(idTarjeta, Causa, Fecha) VALUES ('$idTarjeta', '$motivo', '$now')");
			$this->conection->query("DELETE FROM `usuarios_tarjetas` WHERE `idTarjeta`=". $idTarjeta);
			$this->conection->query("UPDATE `tarjetas` SET `activo`= 0 WHERE `idTarjeta` =" . $idTarjeta);
		}
	}
}
