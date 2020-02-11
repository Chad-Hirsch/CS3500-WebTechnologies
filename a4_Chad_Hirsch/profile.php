<?php
session_start();
$user = 'phpuser';
$pass = '1234';
$conn = 'mysql:host=localhost;dbname=travels';
if(isset($_SESSION['UID'])){
	echo '<h1>Welcome, UID = '.$_SESSION['UID'].' (<a href="login.php?log=0">Logout</a>)</h1>';
	$sql = "SELECT * FROM TravelUser WHERE UserName = ? AND Pass = ?";
}
	if(isset($_POST['user']) || isset($_POST['pass'])){

	try{
	$pdo = new PDO($conn, $user, $pass);
	$sql = "SELECT * FROM TravelUser WHERE UserName = ? AND Pass = ?";
	$query = $pdo->prepare($spq);
	$query->bindValue(1, $_POST['user']);
	$query->bindValue(2, $_POST['pass']);
	$query->execute();
								
	while($row = $query->fetch()){
		$results = $row;
	}
		
	
	}catch(PDOException $e){
		die($e->getMessage());
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; 
 charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="">
 <meta name="author" content="">
 <title>Travel Journal</title>

 <link rel="shortcut icon" href="../../assets/ico/favicon.png">

 <!-- Google fonts used in this theme  -->
 <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
 <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>  

 <!-- Bootstrap core CSS -->
 <link href="bootstrap3_bookTheme/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Bootstrap theme CSS -->
 <!-- <link href="bootstrap3_bookTheme/theme.css" rel="stylesheet"> -->


 <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_bookTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_bookTheme/assets/js/respond.min.js"></script>
 <![endif]-->
</head>

<body>

  <?php include 'header.php'; ?>

  <div class="container">
   <div class="row">  <!-- start main content row -->

    <div class="col-md-2">  <!-- start left navigation rail column -->
     <?php include 'side.php'; ?>
   </div>  <!-- end left navigation rail --> 

   <div class="col-md-10">  <!-- start main content column -->

     <!-- Customer panel  -->
     <div class="panel panel-danger spaceabove">           
       <div class="panel-heading"><h4>User User Name's Profile Page</h4></div>
      
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading"><h4>Login Details</h4></div>
              <ul class="list-group">
                <li class="list-group-item"><strong class="text-primary">Username</strong><br> username@email.com </li>
                <li class="list-group-item"><strong class="text-primary">Password</strong> 
                  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">
                    <span class="glyphicon glyphicon-eye-open"></span> Show
                  </button>
                  <div id="demo" class="d-inline collapse">
                    passwordabcd1234
                  </div> </li>
                  <li class="list-group-item"><strong class="text-primary">User Since</strong><br> Date</li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-primary">
                <div class="panel-heading"><h4>User Information</h4></div>
                <ul class="list-group">
                  <li class="list-group-item"><strong class="text-primary">Name</strong><br> first name last name </li>
                  <li class="list-group-item"><strong class="text-primary">Address</strong><br> address</li>
                  <li class="list-group-item"><strong class="text-primary">City, Country</strong><br> city, country</li>
                  <li class="list-group-item"><strong class="text-primary">Phone</strong><br> phone </li>
                  <li class="list-group-item"><strong class="text-primary">E-Mail</strong><br> email</li>
                  <li class="list-group-item"><strong class="text-primary">Privacy Setting</strong><br> 1</li>
                </ul>
              </div>
            </div>

            <div class="col-md-4">
              <div class="panel panel-primary">
                <div class="panel-heading"><h4>User Activity</h4></div>
                <ul class="list-group">
                  <li class="list-group-item"><strong class="text-primary">Posts</strong><br> 2 posts </li>
                  <li class="list-group-item"><strong class="text-primary">Images</strong><br> 3 images</li>
                  <li class="list-group-item"><strong class="text-primary">Following</strong><br> 5 users</li>
                  <li class="list-group-item"><strong class="text-primary">Followed By</strong><br> 35 users </li>
                </ul>
              </div>
            </div>
          </div>
        </div>           


      </div>


    </div>  <!-- end main content column -->
  </div>  <!-- end main content row -->
</div>   <!-- end container -->





 <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="bootstrap3_bookTheme/assets/js/jquery.js"></script>
   <script src="bootstrap3_bookTheme/dist/js/bootstrap.min.js"></script>
   <script src="bootstrap3_bookTheme/assets/js/holder.js"></script>
 </body>
 </html>