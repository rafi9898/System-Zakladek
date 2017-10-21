<?php

session_start();
	
if (!isset($_SESSION['zalogowany']))
{
		header('Location: index.html');
		exit();
}

//Reportowanie błędów

ini_set( 'display_errors', 'Off' ); 
error_reporting( E_ALL );

require 'connect.php';

$name = $_POST["name"];
$link = $_POST["link"];
$iduser = $_SESSION['id'];

if (empty($name))
    {
    echo "Pole Name nie moze byc puste!";
    echo "<br>";
}

else if (empty($link))
    {
    echo "Pole Link nie moze byc puste!";
}

else {

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO bookmarks (ID, idklienta, nazwa, link)
    VALUES (NULL, '$iduser', '$name', '$link')";
	$sql2 = "UPDATE uzytkownicy SET punkty = punkty + 50 WHERE id=$iduser";
    // use exec() because no results are returned
	$conn->exec($sql2);
    $conn->exec($sql);
    header('Location: index.php');
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
	echo $sql2 . "<br>" . $e->getMessage();
    }
}
$conn = null;
?>