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
       <div class="panel-heading"><h3>Search</h3></div>
       <div class="panel-body">
        <form>
          <div class="form-group">
            <input type="search" name="search" class="form-control">
          </div>
          <div class="radio">
            <label><input type="radio" name="filter" value="title" checked> Find in Post Title</label><br/>
            <lable> <input type="radio" name="filter" value="content"> Find in Post Content</label><br/>
            </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
          </form>
        </div>
      </div>  
      <!-- Search results go HERE -->
        <div class="panel panel-danger spaceabove">           
         <div class="panel-heading"><h4>Search results</h4></div>
         <div class="panel-body">

          <!-- Show the posts found in the search using this panel (one panel for each result) -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4><a href="post_single.php?id=1">Post Title</a></h4>
            </div>
            <div class="panel-body">
              Post content
            </div>
          </div>

          <!-- If no results where found show this instead -->
          <p>No results for search term <strong> SEARCH TERM </strong></p>

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