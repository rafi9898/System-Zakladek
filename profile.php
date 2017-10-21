<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: login.php');
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
		<title>MyBookMarks.Eu - Your Profile</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<meta name="author" content="Rafał Podraza">
		<meta name="description" content="Your profile on this page!">
		<meta name="keywords" content="Your, profile, page, edit, data">
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
                  <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="Logo"></a>
                  <a class="navbar-brand logo2" href="index.php">Save BookMark's</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="profile.php">Your Profile</a></li>
                    <li><a href="rewards.php">Rewards</a></li>
                    <li><a href="myrewards.php">My Rewards</a></li>

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
                                      
                <div class="jumbotron">
                  <div class="row">
                      <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                          <img src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png" alt="stack photo" class="img">
                      </div>
                      <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                          <div class="container" style="border-bottom:1px solid black">
                            <h2><?php echo $_SESSION['user'] ?></h2>
                          </div>
                            <hr>
                          <ul class="container details">
                            <li><p><span class="glyphicon glyphicon-star one" style="width:50px;"></span>Points : <?php echo "<span class='pointsnumber'>". $_SESSION['punkty']. "</span>" ?></p></li>
                            <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo $_SESSION['email'] ?> </p>
                             

                              <form action='changeprofile.php' method="POST">
                                <input type="text" required placeholder="New Email" name="changeEmail"><button class="btn btn-success btn-sm">Change</button>
                                </form>

                            
                            </li>
                            <li><p><span class="glyphicon glyphicon-flag one" style="width:50px;"></span>Ranga : <?php echo $_SESSION['ranga'] ?></p></li>
                            <li><p><span class="glyphicon glyphicon-lock one" style="width:50px;"></span>ID : <?php echo $_SESSION['id'] ?> </p>
                            <li><p>New data is visible after logout</p></li>
                          </ul>
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