<?php

$user = 'phpuser';
$pass = '1234';
$conn = 'mysql:host=localhost;dbname=travels';
	
session_start();



function outputPost() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	try {
		$pdo = new PDO($conn,$user,$pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);$pdo = new PDO($conn,$user,$pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);$pdo = new PDO($conn,$user,$pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = "SELECT PostID, TravelPost.UID, Title, TravelUserDetails.FirstName, TravelUserDetails.LastName, Message, PostTime FROM TravelPost INNER JOIN TravelUserDetails ON TravelPost.UID = TravelUserDetails.UID";
		
		

		if ($_GET['sort'] == 'PostTimeDown')
		{
			$sql .= " ORDER BY TravelPost.PostTime DESC";
			
		}
		elseif ($_GET['sort'] == 'PostTitleDown')
		{
			$sql .= " ORDER BY TravelPost.Title DESC";
			
		}
		elseif ($_GET['sort'] == 'PostTimeUP')
		{
			$sql .= " ORDER BY TravelPost.PostTime ASC";
			
		}
		elseif ($_GET['sort'] == 'PostTitleUP')
		{
			$sql .= " ORDER BY TravelPost.Title ASC";
			
		}
		else
		{
			$sql .= " ORDER BY TravelPost.PostTime DESC";
			
		}
		
		$result = $pdo->query($sql);
		while( $row = $result->fetch() ) {
			
			$date = new DateTime($row['PostTime']);
			echo "<a href='post_single.php?id=" . $row['PostID'] . "'class='list-group-item'>" 
		  . $row['Title'] . "<span class='label label-primary pull-right'>" .$date->format('n/j/Y'). "</span></a>";
		}
		$pdo = null;
	}
	catch (PDOException $e) {
		die( $e->getMessage() );
	}
}
function getPostImage($postID) {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	$pdo = new PDO($conn,$user,$pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "SELECT Path, Title FROM TravelImage INNER JOIN TravelImageDetails ON TravelImage.ImageID = TravelImageDetails.ImageID INNER JOIN TravelPostImages ON TravelImage.ImageID = TravelPostImages.ImageID WHERE PostID = " . $postID . " GROUP BY PostID";
	$result = $pdo->query($sql);
	while( $row = $result->fetch() ) {
		echo "<div class='postThumbnail'><img src='travel-images/medium/" . $row['Path'] . "' alt='" . $row['Title'] . "' class='img-thumbnail'/></div>";
	}
	$pdo = null;
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
       <div class="panel-heading"><h3>Post List</h3></div>
      <div class="well">
        <div class="text-right">
          <strong><span class="glyphicon glyphicon-sort"></span> Sort by: </strong>
		  
          <a href="post_list.php?sort=PostTimeDown"class="btn btn-info" role="button"><span class="glyphicon glyphicon-sort-by-attributes"></span> Post Date Descending</a>
		  <a href="post_list.php?sort=PostTimeUP"class="btn btn-info" role="button"><span class="glyphicon glyphicon-sort-by-attributes"></span> Post Date  Ascending</a>
          <a href="post_list.php?sort=PostTitleDown" class="btn btn-info" role="button"><span class="glyphicon glyphicon-sort-by-attributes"></span> Post Title Descending</a>
		  <a href="post_list.php?sort=PostTitleUP" class="btn btn-info" role="button"><span class="glyphicon glyphicon-sort-by-attributes"></span> Post Title Ascending</a>
		  
		  
        </div>
      </div>
      <div class="panel-body">

        <div class="list-group">
          
		    <?php outputPost(); ?>
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