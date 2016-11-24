<?php 
$servername = "localhost";
$username = "root";
$password = "@ppdt";
$dbname = "pvmanager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id=$_GET['id'];
// sql to delete a record
$sql = "DELETE FROM tickets WHERE idTicket='$id' ";

if ($conn->query($sql) === TRUE) {
    echo "Cancelado con exito";
	echo '<a href="ventas.php">Continuar</a>';
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
