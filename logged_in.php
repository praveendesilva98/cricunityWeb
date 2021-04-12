<?php

$email = $_SESSION['email'];

$query = "SELECT active FROM user WHERE email='$email'";
$result1 = query($query);
$user1 = fetch_array($result1);

$active = $user1['active'];

$user_details_query = mysqli_query($con, "SELECT username FROM user WHERE email = '$email'");
$user_row = mysqli_fetch_array($user_details_query);
$userLoggedIn = $user_row['username'];




if(logged_in() && $active == '1')
{
	//userLoggedIn = $_SESSION['username'];
	
	$sql = "SELECT * FROM user WHERE email='$email'";
	$result = query($sql);
	$user = fetch_array($result);
}
else
{
	redirect("logout.php");
}


    

?>