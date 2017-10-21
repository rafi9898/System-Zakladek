<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?>


<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>Dodaj Mnie</title>
        <meta charset="utf-8">
    </head>
    
    <body>
        <form action="odczyt.php" method="post"> 
        Nazwa:<br /> 
        <input type="text" name="name" /><br /> 
        Adres:<br /> 
        <input type="text" name="link" /><br /> 
        <input type="submit" value="dodaj" /> 
        </form>
    </body>
    
</html>