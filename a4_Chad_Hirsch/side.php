<?php

?>
<div class="rail">

   <div class="alert alert-danger">
   
   <strong><span class="glyphicon glyphicon-user"></span> User Name </strong><br/>
   CS3500 Student<br/>
   <span class="member-box-links"><a href="profile.php">Profile</a> | <a href="login.php?logout=1">Logout</a></span>
  <hr>
   <ul class="nav nav-stacked">
   <li class="nav-header"> <strong><span class="glyphicon glyphicon-globe"></span>  My Travels</strong></li> 
     <li><a href="post_list.php"><span class="glyphicon glyphicon-th-list"></span> Post List</a></li>
     <!-- Substitute post_single.php?id=1 for a random PostID from the database -->
			<?php
				srand ((double) microtime( )*1000000);
				$random_number = rand(1,31);
				echo "<li><a href='post_single.php?id=". $random_number ."'><span class='glyphicon glyphicon-file'></span> Single Post</a></li>";
			?>
			
			<?php
				srand ((double) microtime( )*1000000);
				$random_number = rand(1,31);
				echo "<li><a href='image.php?id=". $random_number ."'><span class='glyphicon glyphicon-file'></span> Single Image</a></li>";
			?>
     <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li> 
   </ul>
 </div>
</div>
