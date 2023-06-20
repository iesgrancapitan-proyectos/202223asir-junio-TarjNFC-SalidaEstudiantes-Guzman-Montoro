<?php
//para conectar una BBDD
class conexiondb
{
    public function initConex()
    {
       // AWS
       //$servername = "grancapitan.czlzrvrqiicb.us-east-1.rds.amazonaws.com";
       // $username = "root";
        //$password = "Root1234$";
        $servername = "localhost";
        $username = "proyectonfc";
        $password = "Root1234$";
        $bd = "grancapitan";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $bd);
        $conn->set_charset("utf8");
        // Check connection
        if ($conn->connect_error) {
            die("Conexion falla " . $conn->connect_error);
        }
        return $conn;
    }
}
