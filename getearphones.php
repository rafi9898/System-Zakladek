<?php

	session_start();

	
	if (!isset($_SESSION['zalogowany']) || $_SESSION['punkty']<50000)
	{
		header('Location: rewards.php');
		exit();
	}

    require 'connect.php';

    $iduser = $_SESSION['id'];

    // Create connection
    $conn = new mysqli($host, $db_user, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT nazwa, link, ID FROM bookmarks WHERE idklienta = $iduser";
    $result = $conn->query($sql);
	
?>


<!DOCTYPE html>

<html lang="en">
	<head>
		<title>Save BookMarks - Get Earphones</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<meta name="author" content="Rafał Podraza">
		<meta name="description" content="Add bookmark page in an easier way.">
		<meta name="keywords" content="Add,page,bookmark,easy">
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
                  <a class="navbar-brand" href="index.php"><img src="img/logo.png"></a>
                  <a class="navbar-brand logo2" href="index.php">Save BookMark's</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="profile.php">Your Profile</a></li>
                    <li class="active"><a href="rewards.php">Rewards</a></li>

                  </ul>

                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Hi <?php echo $_SESSION['user'] ?></a></li>
                    <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
            
            <!--NavBar END-->
            
            <!--Section 1-->
            <section class="profile">
               <div class="container paddingS1">
                   <div class="row">
                       <div class="col-lg-12 sec1">
                        
                    <h1>Get Earphones</h1>
                    <p>After the purchase will log out</p>
                                      
                        <form class="form-horizontal" action='finishearphones.php' method="POST">
			  <fieldset>
			    <div id="legend">
			      <legend class=""></legend>
			    </div>
			    <div class="control-group">
			      <!-- Username -->
			      <label class="control-label"  for="username"><div class="userColor">Your Email</div></label>
			      <div class="controls">
			        <input type="text" id="username" name="emailrewards" required placeholder="Login" class="input-xlarge">
			      </div>
			    </div>

			    <div class="control-group">
			      <!-- Button -->
                    <label><input type="checkbox" required> <div class="userColor">Akceptuje Regulamin</div></label>
			      <div class="controls">
			        <button type="submit" class="btn btn-success">Login</button>
			      </div>
			    </div>
			  </fieldset>
			</form>
                               
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