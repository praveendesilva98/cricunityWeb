<?php include("init.php");
include("logged_in.php");
include("User.php"); 
include("Post.php"); 



if(isset($_GET['post_id']))
{
    $id = $_GET['post_id'];
}


$sql = mysqli_query($con, "SELECT * FROM posts WHERE id='$id'");
$row = mysqli_fetch_array($sql);

$description = $row['description'];
$title = $row['title'];
$image = $row['image'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

<meta property="og:type" content="article" /> 
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:description" content="<?php echo $description; ?>" />
    <meta property="og:image" content="https://www.cricunity.com/<?php echo $image; ?>" />
    <meta property="og:url" content="content.php?post_id=<?php echo $id; ?>" />
    <meta property="og:site_name" content="CricUnity" />
    
    <meta name="twitter:title" content="<?php echo $title; ?>">
    <meta name="twitter:description" content="<?php echo $description; ?>">
    <meta name="twitter:image" content="https://www.cricunity.com/<?php echo $image; ?>">
    <meta name="twitter:site" content="@cricunity">
    <meta name="twitter:creator" content="@cricunity">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="photos/icon.png" type="image/icon type">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
	integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
	crossorigin="anonymous"> 	

<!-- jquery before js script -->
<!-- SCR -> SRC -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<script src="bootstrap.js"></script> 
	<script src="bootbox.min.js"></script> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/header_main3.css">
	<link rel="stylesheet" type="text/css" href="css/feed8.css">




</head>
    
    <body>
	
	<?php include("functions_profile.php"); ?>
	<?php include("nav_main.php");  ?>

</header>	

<div id="fb-root">
<img src="phtos/angelo.jpg" alt="">
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v4.0"></script>
</div>




<div id="content">
<?php
$posts = new Post($con, $email);
$posts->loadContentNews($id, $description);
?>
</div>
<?php
    echo "<a href='https://www.facebook.com/dialog/feed?app_id={app_id}&link={https://cricunity.com/content.php?post_id=$id}&picture={https://cricunity.com/$image}
    &name={$title}&description={$description}&redirect_uri={https://cricunity.com/content.php?post_id=$id}'>
    <img src='https://simplesharebuttons.com/images/somacro/facebook.png' alt='Facebook' />
</a></div>";

    echo " <a href='https://twitter.com/share?url=https://cricunity.com/content.php?post_id=$id&amp;text=$description&amp' target='_blank'>
    <img src='https://simplesharebuttons.com/images/somacro/twitter.png' alt='Twitter' />
</a>";

?><br><br>
<script type="text/javascript" src="indexjs.js"></script>



</body>
</html>