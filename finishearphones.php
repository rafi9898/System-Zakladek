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
$username = $_SESSION['user'];
$emailrewards = $_POST["emailrewards"];
$rewards = "Earphones (inactive)";
$points = $_SESSION['punkty'];

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to delete a record
$sql = "INSERT INTO rewards (ID, username, rewards, email, userid)
    VALUES (NULL, '$username', '$rewards', '$emailrewards', $iduser)";

$sql2 = "UPDATE uzytkownicy SET punkty = punkty - 50000 WHERE id = $iduser";

if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
    header('Location: logout.php');
} else {
    echo "Please try later";
}

$conn->close();
?>