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
		<title>MyBookMarks.Eu - Add Your BookMark</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<meta name="author" content="Rafał Podraza">
		<meta name="description" content="MyBookMarks.Eu - Make your bookmarks easy and fun! Win prizes. Everything at your fingertips.">
		<meta name="keywords" content="Add,page,bookmark,bookmarks,easy, mybookmarks">
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
            <section class="login">
               <div class="container sizebox paddingS1">
                   <div class="row">
                       <div class="col-lg-12 sec1">

                        <h1>Hello <?php echo $_SESSION['user'] ?> ;)</h1>
                        <p class="points">Your Points: <?php echo "<span class='pointsnumber'>". $_SESSION['punkty']. "</span>" ?> <button class="btn btn-primary btn-sm" id="btninfopoints">Info</button></p>
                       </div>
                       
                       <div class="col-xs-6">
                           <button id="btnadd" class="btn btn-md btn-success">ADD LINK</button>
                       </div>
                       
                       <div class="col-xs-6">
                           <button id="btndelete" class="btn btn-md btn-danger">DELETE LINK</button>
                       </div>
                       
                       <div class="col-sm-6 col-xs-12 addnone">
                          <div class="addlink">
                           <form action="odczyt.php" method="post"> 
                            <span class="colorlabel">Name:</span><br /> 
                            <input type="text" placeholder="Google" name="name" /><br /> 
                               <span class="colorlabel">URL with http (http://yoursite.com):</span><br /> 
                            <input type="text" placeholder="http://google.com" name="link" /><br /> 
                            <input type="submit" value="dodaj" /> 
                            </form>
                         </div>
                         </div>
                         
                        <div class="col-sm-6 col-xs-12 deletenone">
                        <div class="deletelink">
                            <form action="delete.php" method="post"> 
                            <span class="colorlabel">ID Delete:</span><br /> 
                            <input type="text" placeholder="13" name="id_delete" /><br /> 
                            <input type="submit" value="Usuń" /> 
                            </form>
                        </div>
                        </div>
                        
                        <div class="col-xs-12 tableurl">
                <h1>Click the filter icon <small>(<i class="glyphicon glyphicon-filter"></i>)</small></h1>
    	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Developers</h3>
						<div class="pull-right">
							<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
								<i class="glyphicon glyphicon-filter"></i>
							</span>
						</div>
					</div>
					<div class="panel-body">
						<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
					</div>
					
					<?php echo "
					<table class='table table-hover' id='dev-table'>
						<thead>
							<tr>
								
								<th><center>Name</center></th>
								<th><center>Url</center></th>
								<th><center>ID Delete</center></th>
							</tr>
						</thead>";
                        if ($result->num_rows > 0) {
            
                        while($row = $result->fetch_assoc()) {
                        echo 
						"<tbody>
							<tr>
								<td>". $row["nazwa"]."</td>
								<td><a target='_blank' href=".$row["link"].">".$row["link"]."</a></td>
								<td>". $row["ID"]."</td>
							</tr>
						</tbody>";
                            
                         }
                    } else {
                        echo "0 results";
                    }
                            
					echo "</table>";
                    $conn->close();
    ?>
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