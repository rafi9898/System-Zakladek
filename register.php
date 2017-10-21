<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność nickname'a
		$nick = $_POST['nick'];
		
		//Sprawdzenie długości nicka
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick must have 3 to 20 characters!";
		}
		
		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick can only consist of letters and numbers!";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Please enter a valid email address!";
		}
		
		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Password must be between 8 and 20 characters!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="The passwords are not identical!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		//Czy zaakceptowano regulamin?
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Confirm your acceptance of the rules!";
		}				
		
		//Bot or not? Oto jest pytanie!
		$sekret = "6Ld8cjQUAAAAAIEy7li-ApoTQGHvFPou1G4gPyef";
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if ($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_bot']="Confirm that you are not a bot!";
		}		
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="An account has already been assigned to this email address!";
				}		

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="There is already a user with such nickname! Choose another.";
				}
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email', 500, 0)"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: welcome.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error! We apologize for the inconvenience and please register for another date!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	
	
?>


<!DOCTYPE html>

<html lang="en">
	<head>
		<title>MyBookMarks.Eu - Register</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<meta name="author" content="Rafał Podraza">
		<meta name="description" content="Sign up for MyBookMarks.Eu">
		<meta name="keywords" content="Sign up, on, your, account">
		<link rel="icon" href="img/favicon.ico">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab&amp;subset=latin-ext" rel="stylesheet">
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>

	<body>
        <!--Navbar-->
           
            <nav class="navbar navbar-inverse navbar-fixed-top">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.html"><img src="img/logo.png" alt="Logo"></a>
                  <a class="navbar-brand logo2" href="index.html">Save BookMark's</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="index.html">Home</a></li>

                  </ul>

                  <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="register.php">Sign Up <i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
                    <li><a href="login.php">Login <i class="fa fa-user" aria-hidden="true"></i></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
            
            <!--NavBar END-->
            
            <!--Section 1-->
            <section class="login">
               <div class="container sizebox paddingS1">
                   <div class="row">
                       <div class="col-lg-12">
                        <div class="container">
    <div class="row">
		<div class="span12">
			<form class="form-horizontal" action='' method="POST">
			  <fieldset>
			    <div id="legend">
			      <legend class="">Sign Up</legend>
			    </div>
			    <div class="control-group">
			      <!-- Username -->
			      <label class="control-label"  for="username"><div class="userColor">Login</div></label>
			      <div class="controls">
			        <input type="text" value="<?php
                    if (isset($_SESSION['fr_nick']))
                    {
                        echo $_SESSION['fr_nick'];
                        unset($_SESSION['fr_nick']);
                    }
                ?>" id="username" name="nick" placeholder="Login" class="input-xlarge">
                		<?php
                    if (isset($_SESSION['e_nick']))
                    {
                        echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                        unset($_SESSION['e_nick']);
                    }
                    ?>
			      </div>
			    </div>
			    
			    <div class="control-group">
			      <!-- Username -->
			      <label class="control-label"  for="email"><div class="userColor">Email</div></label>
			      <div class="controls">
			        <input type="text" value="<?php
                    if (isset($_SESSION['fr_email']))
                    {
                        echo $_SESSION['fr_email'];
                        unset($_SESSION['fr_email']);
                    }
                ?>" id="email" name="email" placeholder="Email" class="input-xlarge">
                <?php
                if (isset($_SESSION['e_email']))
                {
                    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                    unset($_SESSION['e_email']);
                }
                ?>
			      </div>
			    </div>
			    
			    <div class="control-group">
			      <!-- Password-->
                    <label class="control-label" for="password"><div class="userColor">Password</div></label>
			      <div class="controls">
                        <input type="password" value="<?php
                if (isset($_SESSION['fr_haslo1']))
                {
                    echo $_SESSION['fr_haslo1'];
                    unset($_SESSION['fr_haslo1']);
                }
            ?>" id="password" name="haslo1" placeholder="Password" class="input-xlarge">
            <?php
                if (isset($_SESSION['e_haslo']))
                {
                    echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                    unset($_SESSION['e_haslo']);
                }
            ?>	            
			      </div>
			    </div>
			    
			    <div class="control-group">
			      <!-- Password-->
                    <label class="control-label" for="password2"><div class="userColor">Repeat Password</div></label>
			      <div class="controls">
                <input type="password" value="<?php
                if (isset($_SESSION['fr_haslo2']))
                {
                    echo $_SESSION['fr_haslo2'];
                    unset($_SESSION['fr_haslo2']);
                }
                ?>" id="password2" name="haslo2" placeholder="Repeat Password" class="input-xlarge">
			      </div>
			      <br>
			      <label>
			<input type="checkbox" name="regulamin" <?php
			if (isset($_SESSION['fr_regulamin']))
			{
				echo "checked";
				unset($_SESSION['fr_regulamin']);
			}
				?>/> <div class="regulaminC">I accept the terms and conditions</div>
		</label>
		
		<?php
			if (isset($_SESSION['e_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
				unset($_SESSION['e_regulamin']);
			}
		?>	
		
		<center><div class="g-recaptcha" data-sitekey="6Ld8cjQUAAAAABVYtMODLRMnJcMBFu5NmWztXbvH"></div></center>

		
		<?php
			if (isset($_SESSION['e_bot']))
			{
				echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
				unset($_SESSION['e_bot']);
			}
		?>	
			      
			    </div>			    
			    <div class="control-group">
			      <!-- Button -->
			      <div class="controls">
			        <button class="btn btn-danger">Register</button>
			      </div>
			    </div>
			  </fieldset>
			</form>
		</div>
	</div>
</div>
                           
                       </div>
                   </div>
               </div>
            </section>
            
            <!--Section 1 END-->
            
            

        
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.viewportchecker.js"></script>
        <script src="js/main.js"></script>
        
	</body>
</html>