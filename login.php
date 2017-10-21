<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: index.php');
		exit();
	}

?>


<!DOCTYPE html>

<html lang="en">
	<head>
		<title>MyBookMarks.Eu - Login</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<meta name="author" content="Rafał Podraza">
		<meta name="description" content="Login to your account!">
		<meta name="keywords" content="Login, your account, profile">
		<link rel="icon" href="img/favicon.ico">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab&amp;subset=latin-ext" rel="stylesheet">
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
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
                    <li><a href="register.php">Sign Up <i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
                    <li class="active"><a href="login.php">Login <i class="fa fa-user" aria-hidden="true"></i></a></li>
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

		<div class="span12">
			<form class="form-horizontal" action='zaloguj.php' method="POST">
			  <fieldset>
			    <div id="legend">
			      <legend class="">Login</legend>
			    </div>
			    <div class="control-group">
			      <!-- Username -->
			      <label class="control-label"  for="username"><div class="userColor">Username</div></label>
			      <div class="controls">
			        <input type="text" id="username" name="login" placeholder="Login" class="input-xlarge">
			      </div>
			    </div>
			    <div class="control-group">
			      <!-- Password-->
                    <label class="control-label" for="password"><div class="userColor">Password</div></label>
			      <div class="controls">
			        <input type="password" id="password" name="haslo" placeholder="Password" class="input-xlarge">
			      </div>
			    </div>
			    <div class="control-group">
			      <!-- Button -->
                    <label><input type="checkbox" required> <div class="userColor">I accept the terms and conditions</div></label>
			      <div class="controls">
			        <button type="submit" class="btn btn-success">Login</button>
			      </div>
			    </div>
			  </fieldset>
			</form>
			     <?php
                   if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
                  echo "<br>";
                ?>
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