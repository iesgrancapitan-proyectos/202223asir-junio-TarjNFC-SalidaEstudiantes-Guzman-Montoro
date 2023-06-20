<?php

class Usuario
{

	private $conection;

	/* Set conection */
	public function getConection()
	{
		$dbObj = new conexiondb();
		$this->conection = $dbObj->initConex();
	}

	/* Save note */
	public function isAdmin(int $idUsuario): bool
	{
		$this->getConection();

		$query = $this->conection->query("SELECT * FROM administracion WHERE idUsuario=" . $idUsuario . ";");

		return $query->num_rows === 1;
	}

	public function getFilterUser($type, $value)
	{
		$this->getConection();
		$query = $this->conection->query(
			"SELECT usuarios.idUsuario, usuarios.email, usuarios.nie, tarjetas.idTarjeta, usuarios.idPerfil
			FROM usuarios
			LEFT JOIN usuarios_tarjetas ON usuarios_tarjetas.idUsuario = usuarios.idUsuario
			LEFT JOIN tarjetas ON tarjetas.idTarjeta = usuarios_tarjetas.idTarjeta
			WHERE usuarios.idPerfil != 1 AND " . "$type" . " = '" . "$value" . "';"
		);
		$array = $query->fetch_all();

		return $array;
	}

	public function getDepartamentos()
	{
		$this->getConection();

		$query = $this->conection->query("SELECT DISTINCT departamento FROM usuarios WHERE departamento is NOT NULL AND idPerfil != 1;");
		$array = $query->fetch_all();

		return $array;
	}

	public function getUnidades()
	{
		$this->getConection();

		$query = $this->conection->query("SELECT DISTINCT unidad FROM usuarios WHERE unidad is NOT NULL;");
		$array = $query->fetch_all();

		return $array;
	}

	public function delete($users)
	{
		$this->getConection();

		foreach ($users as $user) {
			if ($user > 1) {
				$this->conection->query("DELETE FROM usuarios_tarjetas WHERE idUsuario=$user;");
			}
		}
	}

	public function insertUsuariosAlumnos($dato)
	{
		$this->getConection();
		$query = $this->conection->query("SELECT * FROM usuarios WHERE nie = '$dato[1]';");
		$usuario = $query->fetch_all();
		if(empty($usuario)) {
			$dato2 =str_replace(' ', '', $dato[2]);
			$query = $this->conection->query("INSERT INTO `usuarios`(`nombre`,`nie`,`unidad`,`idPerfil`)
			 VALUES ('$dato[0]','$dato[1]','$dato2','3');");
		}
	}

	function insertUsuariosProfesores($dato)
	{
		$this->getConection();
		$query = $this->conection->query("SELECT * FROM usuarios WHERE email = '$dato[0]';");
		$usuario = $query->fetch_all();
		if(empty($usuario)) {
			$query = $this->conection->query("INSERT INTO `usuarios`(`email`, `departamento`, `idPerfil`) VALUES ('$dato[0]','$dato[1]','2');");
		}
	}

	function borradoInicioCurso()
	{
		$this->getConection();

		$query = $this->conection->query("DELETE usuarios_tarjetas FROM usuarios_tarjetas LEFT JOIN usuarios ON usuarios_tarjetas.idUsuario = usuarios.idUsuario WHERE usuarios.idPerfil != 1;");
		$query = $this->conection->query("ALTER TABLE `usuarios` AUTO_INCREMENT 1;");
		$query = $this->conection->query("DELETE FROM `usuarios` WHERE `idPerfil`!='1';");
		$query = $this->conection->query("ALTER TABLE `usuarios_tarjetas` AUTO_INCREMENT 1;");
	}

	/*public function getBaja(){
	$this->getConection();
	$query = $this->conection->query("SELECT Causa FROM fechabajatarjetas;");
	return $query;
	}*/

	public function nieUser($idUsuario)
	{
		$this->getConection();

		$query = $this->conection->query("SELECT nie FROM usuarios WHERE idUsuario =" . $idUsuario);

		$array = $query->fetch_all();
		if (mysqli_num_rows($array) > 0) {
			$row = mysqli_fetch_assoc($array);
		}
	}
}
