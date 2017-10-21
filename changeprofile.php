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
$EmailChange = $_POST["changeEmail"];

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to update a record
$sql = "UPDATE uzytkownicy SET email='$EmailChange' WHERE id=$iduser";

if ($conn->query($sql) === TRUE) {
    header('Location: profile.php');
} else {
    header('Location: profile.php');
}

$conn->close();
?>