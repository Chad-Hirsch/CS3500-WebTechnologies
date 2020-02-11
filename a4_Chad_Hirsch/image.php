<?php
if( !isset($_GET['id']) || !is_numeric($_GET['id']) ) { header('Location: error.php'); }

function imageDetails() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT AsciiName,  CountryName,TravelImageDetails.Latitude,TravelImageDetails.Longitude, TravelImageDetails.Description, TravelImageDetails.CountryCodeISO FROM TravelImageDetails LEFT JOIN GeoCities ON GeoNameID = CityCode LEFT JOIN GeoCountries ON TravelImageDetails.CountryCodeISO = ISO WHERE ImageID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ) {
				echo "<div class='panel panel-primary'>";
				  echo "<div class='panel-heading'><h4>Image Details</h4></div>";
					
					   echo "<ul class='list-group'>";
						getUserName();
						echo "<li class='list-group-item'><strong>Country: </strong>" . utf8_encode( $row['CountryName'] ). "</li>";
						getCity();
						echo "<li class='list-group-item'><strong>Latitude: </strong>" . $row['Latitude'] .  "</li>";
						echo "<li class='list-group-item'><strong>Longitude: </strong>" . $row['Longitude'] . "</li>";
					  echo "</ul>
					</div>";
				
				
				
				
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}

function getDescription() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$sql = "SELECT Path, Description, Title FROM TravelImage INNER JOIN TravelImageDetails ON TravelImage.ImageID = TravelImageDetails.ImageID WHERE TravelImage.ImageID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ) {
				
							echo "<li class='list-group-item'><strong>Description: </strong>" . $row['Description'] . "</li>";
				
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}

function getCity() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$sql = "SELECT City FROM TravelUserDetails INNER JOIN TravelImageDetails ON TravelUserDetails.UID = TravelImageDetails.ImageID WHERE TravelUserDetails.UID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ) {
				
			echo "<li class='list-group-item'><strong>City: </strong>" . utf8_encode( $row['City'] ).  "</li>";
				
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}

function outputTitle() {
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
				     
					 echo "<div class='panel-heading'><h3>". utf8_encode($row['Title']) ."</h3></div>";
					 
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}

function fullSizeImage() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$sql = "SELECT Path, Description, Title FROM TravelImage INNER JOIN TravelImageDetails ON TravelImage.ImageID = TravelImageDetails.ImageID WHERE TravelImage.ImageID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ) {
				echo "<div class='col-md-9 text-center'>";
					echo "<img src='images/medium/" . $row['Path'] . "'alt=\"...\" data-toggle='modal' data-target='#myModal'>";
					echo "<div class='modal fade' id='myModal' role='dialog'>";
					  echo "<div class='modal-dialog'>";
						echo "<div class='modal-content'>";
						  echo "<div class='modal-header'>";
							echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
							echo "<h4 class='modal-title'>" . $row['Title'] . "</h4>";
						  echo "</div>";
						  echo "<div class='modal-body text-center'>";
							echo "<img src='images/medium/" . $row['Path'] . "'alt=\"...\"  class='img-thumbnail'>";
							echo "<br><br>";
							echo "<p><strong>" . $row['Description'] . "</strong></p>";
						  echo "</div>
						</div>
					  </div>
					</div>
					<br/> <br/>";
					echo "<div class='well'>". $row['Description'] ."</div>";

				  echo "</div>";
				
				
				
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}

function getUserName() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT TravelImage.UID, FirstName, LastName FROM TravelImage INNER JOIN TravelUserDetails ON TravelImage.UID = TravelUserDetails.UID WHERE ImageID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ){
				echo "<li class='list-group-item'><strong> Taken By: </strong>" . utf8_encode( $row['FirstName'] . " " . $row['LastName'] ). "</li>";
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}

function getCountry() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT TravelImage.UID, FirstName, LastName FROM TravelImage INNER JOIN TravelUserDetails ON TravelImage.UID = TravelUserDetails.UID WHERE ImageID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ){
				echo "<li class='list-group-item'><strong> Taken By: </strong>" . utf8_encode( $row['FirstName'] . " " . $row['LastName'] ). "</li>";
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}

function getImageDetails() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT AsciiName, CountryName, TravelImageDetails.CountryCodeISO FROM TravelImageDetails LEFT JOIN GeoCities ON GeoNameID = CityCode LEFT JOIN GeoCountries ON TravelImageDetails.CountryCodeISO = ISO WHERE ImageID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			while( $row = $statement->fetch() ) {
				if( !is_null($row['AsciiName']) ) { //if city not available, display only the country
						echo $row['AsciiName'] . ", ";
						echo "<a href='single-country.php?iso=" . $row['CountryCodeISO'] . "'>" . $row['CountryName'] . "</a>";
				}
				else if( !is_null($row['CountryName']) ) {
					echo "<a href='single-country.php?iso=" . $row['CountryCodeISO'] . "'>" . $row['CountryName'] . "</a>";
				}
			}
			$pdo = null;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}
}

function getImageTitle() {
	$user = 'phpuser';
	$pass = '1234';
	$conn = 'mysql:host=localhost;dbname=travels';
	if( isset($_GET['id']) ) {
		try {
			$pdo = new PDO($conn,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT Title FROM TravelImageDetails WHERE ImageID = ?";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1, $_GET['id']);
			$statement->execute();
			$result = $statement->fetch();
			echo $result['Title'];
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
     <div class="panel panel-danger spaceabove">           
       <?php outputTitle(); ?>
       <div class="panel-body">

        <div class="row">
          
		  
		  <?php fullSizeImage(); ?> 
		  
		  
          <div class="col-md-3">
            <div class="panel panel-primary">
              <div class="panel-heading"><h4>Rating</h4></div>
              <ul class="list-group">
			  
			  <?php 
				$user = 'phpuser';
				$pass = '1234';
				$conn = 'mysql:host=localhost;dbname=travels';
		
				$pdo = new PDO($conn,$user,$pass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
			
			  
			  
			  
			  
			    function getImageRating() {
					$user = 'phpuser';
					$pass = '1234';
					$conn = 'mysql:host=localhost;dbname=travels';
					
					if( isset($_GET['id']) ) {
						try {
							$pdo = new PDO($conn,$user,$pass);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
							$sql = "SELECT AVG(Rating) as RatingAvg, COUNT(Rating) as Votes FROM TravelImageRating WHERE ImageID = ?";
							$statement = $pdo->prepare($sql);
							$statement->bindValue(1, $_GET['id']);
							$statement->execute();
							$result = $statement->fetch();
							$results = number_format($result['RatingAvg'], 2, '.', '');
							
							echo "<li class='list-group-item'><strong class='text-primary'>" . $results ."/5</strong> " . $result['Votes'] . " votes </li>";
							$pdo = null; 
							
							$pdo = null;
						}
						catch (PDOException $e) {
							die( $e->getMessage() );
						}
					}
				}
				
			
				if (isset($_GET['id']) && isset($_GET['points'])) {
					$sql_insert = "INSERT INTO TravelImageRating (ImageID, Rating) VALUES(?,?)";

					$query = $pdo->prepare($sql_insert);
					$query->bindValue(1, $_GET['ImageID']);
					$query->bindValue(2, $_GET['Rating']);
					$query->execute();

				}
			
			  ?>
			  
			  
			  
			  
                 <?php getImageRating(); ?>
                <li class="list-group-item">

				
				
				
                  <form action="image.php" method="get" >
                    <div class="form-group text-center">
			
                      <output id="x" for="rng"> 2.5 </output> <span class="glyphicon glyphicon-thumbs-up"></span> <br>
                      <input type="range" id="rng" name="points" min="1" max="5" step="1">
                      <!-- The value of the hiddem input field is the ImageID -->
                      <input type="hidden" name="id" value="ImageID">
                    </div>
                    <div class="form-group text-center">
                      <input type="submit" value="Post" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span> Vote!</button>

                    </div>
                  </form>
                </li>
              </ul>
            </div>
			
            <?php imageDetails(); ?>
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