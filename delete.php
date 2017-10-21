<?php
session_start();
	
if (!isset($_SESSION['zalogowany']))
{
		header('Location: index.html');
		exit();
}

ini_set( 'display_errors', 'Off' ); 
error_reporting( E_ALL );

require 'connect.php';

$iduser = $_SESSION['id'];
$idDelete = $_POST["id_delete"];

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to delete a record
$sql = "DELETE FROM bookmarks WHERE id=$idDelete AND idklienta=$iduser";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
} else {
    echo "ADDED ID OF REMOVAL IS NOT EXISTING! ";
}

$conn->close();
?>