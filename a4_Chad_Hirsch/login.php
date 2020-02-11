<?php
session_start();

$user = 'phpuser';
$pass = '1234';
$conn = 'mysql:host=localhost;dbname=travels';

try{
	$pdo = new PDO($conn,$user, $pass);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} 
catch(PDOException $e){
  	die($e->getMessage());
}

if (isset($_GET['log'])) {
	unset($_SESSION['UID']);
}

if (isset($_GET['title']) && isset($_GET['content'])) {
	$sql_insert = "INSERT INTO TravelPost (UID, Title, Message) VALUES(?,?,?)";

	$query = $pdo->prepare($sql_insert);
	$query->bindValue(1, $_SESSION['UID']);
	$query->bindValue(2, $_GET['title']);
	$query->bindValue(3, $_GET['content']);
	$query->execute();

}

if (isset($_POST['user']) && isset($_POST['pass'])) {
	
	try{
		$sql = "SELECT * FROM TravelUser WHERE UserName = ? AND Pass = ?";

		$query = $pdo->prepare($sql);
		$query->bindValue(1, $_POST['user']);
		$query->bindValue(2, $_POST['pass']);
		$query->execute();

		while ($row = $query->fetch()) {
			$results = $row;
			$_SESSION['UID'] = $row['UID'];
		}

	} 
	catch(PDOException $e){
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
     <div class="col-md-12">  <!-- start main content column -->
      <div class="panel panel-danger spaceabove">           
       <div class="panel-heading"><h3>User Login</h3></div>
       <div class="panel-body">
        <div class="row">
          <div class=col-md-12>
            <!-- IF THERE IS AN ERROR for the user or password information, then display this -->
            <div class="alert alert-warning alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Error: </strong> E-mail or password did not match our records.
            </div>
            <!-- END disp;ay error -->

            <form action="login.php" method="post">
              <div class="form-group">
			    <?php 
                            #Checks of there are errors being sent in via cookies
                            if(isset($_COOKIE['error']) && $_COOKIE['error'] == 'user') {
                                echo '<div class="alert alert-danger fade in" role="alert">';
                                echo 'User not found</div>';
                            } else if(isset($_COOKIE['error']) && $_COOKIE['error'] == 'login') {
                                echo '<div class="alert alert-warning fade in" role="alert">';
                                echo 'Please login to access your account</div>';
                            }
                ?>
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
              </div>
              <div class="form-group">
				<?php
                            #Checks if there is a password error
                            if(isset($_COOKIE['error']) && $_COOKIE['error'] == 'password') {
                                echo '<div class="alert alert-danger fade in" role="alert">';
                                echo 'Incorrect Password</div>';
                            }
                ?>
				<script type='text/javascript'>
                            /* Fades out the alert status */
                            setTimeout(function() {
                                $('.alert').fadeOut(400)
                            }, 3000 );
                 </script>
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>

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