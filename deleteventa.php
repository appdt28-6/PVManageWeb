<?php 
$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "pvmanager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id=$_GET['id'];
$ti=$_GET['ti'];
// sql to delete a record
$sql = "DELETE FROM ventasticket WHERE idVenta='$id' and idTicket='$ti'";

if ($conn->query($sql) === TRUE) {
    echo "Cancelado con exito";
	echo '<a href="detalleticket.php?ticket='.$ti.'">Continuar</a>';
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
