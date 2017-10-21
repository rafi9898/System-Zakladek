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
		<title>MyBookMarks.Eu - Rewards</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<meta name="author" content="Rafał Podraza">
		<meta name="description" content="Pick up the prize!">
		<meta name="keywords" content="Get rewards, pick up, prize">
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
                    <li><a href="profile.php">Your Profile</a></li>
                    <li class="active"><a href="rewards.php">Rewards</a></li>
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
                                      
                        <div class="container">
	<div class="row">
                        <p class="points">Your Points: <?php echo "<span class='pointsnumber'>". $_SESSION['punkty']. "</span>" ?></p>
		<h2 class="text-center">Rewards</h2>
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="box">
                        <div class="box-content">
                            <h1 class="tag-title">VIP RANK</h1>
                            <div class="img-rewards">
                            <img src="img/vip.png">
                            </div>
                            <hr />
                            <p><span class="priceRewards sizeRewards">Points: </span><span class="pointsnumber sizeRewards">500</span></p>
                            <hr />
                            <p>Golden Nick</p>
                            <p>More Points (24h)</p>
                            <p>Faster response from Support</p>
                            <p>More bookmarks</p>
                            <br />
                            <a href="getvip.php" class="btn btn-block btn-success">Get Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="box">
                        <div class="box-content">
                            <h1 class="tag-title">Earphones</h1>
                            <div class="img-rewardsEar">
                            <img src="img/Earphones.png">
                            </div>
                            <hr />
                            <p><span class="priceRewards sizeRewards">Points: </span><span class="pointsnumber sizeRewards">50000</span></p>
                            <hr />
                            <p>40mm driver units fine tuned for quality sound output in enclosed ear cups</p>
                            <p>Ergonomic fit with around the ear design, comfortable soft leather earmuffs for prolonged wearing</p>
                            <p>Leather headrests with steel reinforced headband for flexibility and durability</p>
                            <p>Extremely durable and flexible - 1 year warranty</p>
                            <p>3.5mm gold-plated audio plug, High performance and durable stereo headphone</p>
                            <br />
                            <a href="getearphones.php" class="btn btn-block btn-success">Get Now</a>
                        </div>
                    </div>
                </div>
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