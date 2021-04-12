<?php include("headers/header_profile.php"); 
	?><title>Australia Videos</title>
	<?php?>



	<div class="title"><h4>AUSTRALIA VIDEOS</h4></div>

	<div id="content">
	<?php
		$country = "Australia";
		$type = "video";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html><?php include("init.php"); ?>
<?php include("User.php");  ?>
<?php include("Post.php");  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
	integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
	crossorigin="anonymous"> 	
	<link rel="stylesheet" href="header1.css">
	<link rel="stylesheet" href="menu1.css">	
	<link rel="stylesheet" href="profile4.css"> 


</head>
    
    <body>
	
	<?php include("header.php");  ?>
	<?php include("menu.php");  ?>
	<?php include("logged_in.php");  ?>



	<div class="title"><h4>AUSTRALIA VIDEOS</h4></div>

	<?php
	$posts = new Post($con, $email);
	$posts->loadVideosAustralia(); 

	?>


</body>

</html>