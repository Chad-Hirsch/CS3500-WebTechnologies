<?php
if( !isset($_GET['id']) || !is_numeric($_GET['id']) ) { header('Location: error.php'); }

//outputs the post's title and message
function outputPost() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT PostID, PostTime, Title, Message FROM TravelPost WHERE PostID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ) {
				$date = new DateTime($row['PostTime']);				
				echo "<div class='panel panel-danger spaceabove'>";           
					 echo "<div class='panel-heading'><h3>". utf8_encode($row['Title']) ."</h3></div>";
					 echo "<div class='panel-body'>";
					  echo "<div class='row'>";
						echo "<div class='col-md-9'>" . utf8_encode($row['Message']) . "</div>";
						
						echo "<div class='col-md-3'>";
						 echo "<div class='panel panel-primary'>";
						   echo "<ul class='list-group'>";
						    echo "<div class='panel-heading'><h4>POST DETAILS</h4></div>";
							echo "<li class='list-group-item'><strong> Date: </strong>" .$date->format('n/j/Y'). "</li>";
							echo getPostUserLink();
						  echo "</ul>
						</div>

					  </div>
					</div>
				  </div>
				</div>";   
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}


//gets the user's name and a link to their page
function getPostUserLink() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT TravelPost.UID, TravelUserDetails.FirstName, TravelUserDetails.LastName FROM TravelPost INNER JOIN TravelUserDetails ON TravelPost.UID = TravelUserDetails.UID WHERE PostID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ){
				echo "<li href='single-user.php?id=" . $row['UID'] . "'class='list-group-item'><strong>Posted By: " . utf8_encode( $row['FirstName'] . " " . $row['LastName'] ). "</strong></li>";
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}
//gets the title of the post
function getPostName() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT Title FROM TravelPost WHERE PostID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ){
				echo $row['Title'];
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}
//gets the user's id
function getUserID() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT DISTINCT UID FROM TravelPost WHERE PostID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			$result = $statement->fetch();
			return $result['UID'];
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}
//gets the user's other related posts
function getUserPosts() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	try {
		$pdo = new PDO($conn,$user,$pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = "SELECT PostID, Title FROM TravelPost WHERE UID = " . getUserID();
		$result = $pdo->query($sql);
		while( $row = $result->fetch() ) {
			echo "<p><a href='single-post.php?id=" . $row['PostID'] . "'>" . $row['Title'] . "</a></p>";
		}
		$pdo = null;
	}
	catch (PDOException $e) {
		die( $e->getMessage() );
	}
}
//gets related images for the post
function getPostImages() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT TravelPostImages.ImageID, Path, Title FROM TravelPostImages INNER JOIN TravelImage ON TravelPostImages.ImageID = TravelImage.ImageID INNER JOIN TravelImageDetails ON TravelPostImages.ImageID = TravelImageDetails.ImageID WHERE PostID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			echo "<div class='well'>";
			echo "<h4>Images From Post</h4>";
			echo "<div class='row'>";
			while( $row = $statement->fetch() ){
				echo "<div class='col-md-3 text-center'>";
					echo "<div class='thumbnail'>";
					  echo "<a href= 'image.php?id=" . $row['ImageID'] . "'><img src='images/square-medium/" . $row['Path'] . "' alt='" . $row['Title'] . "' class='img-thumbnail' /></a>";
					  echo "<div class='caption'>";
						echo "<p><a href='image.php?id=1>" . utf8_encode($row['Title']) . "'</a></p>";
						echo "<p><a href='image.php?id=" . $row['ImageID'] . "'class='btn btn-info' role='button'>";
							echo "<span class='glyphicon glyphicon-info-sign'></span> view
						  </a>
						</p>
					  </div>
					</div>
				  </div>";
			}
			
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
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
		<?php outputPost();           ?>

<div class="panel panel-danger spaceabove">           
 <div class="panel-heading"><h4>Travel images for this post</h4></div>
 <div class="panel-body">
  <div class="row">
  
  
 <?php getPostImages(); ?>
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