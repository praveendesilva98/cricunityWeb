<?php
include("init.php");
include("logged_in.php");
include("User.php");
include("Post.php");

$LIMIT_GLOBAL = 10;

// var_dump(count($_GET)>0 && isset($_GET["offset"]));
if (count($_GET)>0 && isset($_GET["offset"])) {
	$offset = $_GET["offset"]+$LIMIT_GLOBAL;
	$id=$_SESSION['email'];
	$posts = new Post($con, $id);
	echo $posts->loadPostsFriends($LIMIT_GLOBAL,$offset,true);
	
}


?>