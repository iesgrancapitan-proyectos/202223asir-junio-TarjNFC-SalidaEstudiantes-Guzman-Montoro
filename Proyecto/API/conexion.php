
<?php
$servername = "localhost";
$username = "user";
$password = "user";
$bd= "convivencia2";
// Create connection
$conn = new mysqli($servername, $username, $password,$bd);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Conexi  n falla " . $conn->connect_error);
}

?>
