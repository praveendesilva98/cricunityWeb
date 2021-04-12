<?php

include("init.php");
include("logged_in.php");
include("User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ", $query);

if(strpos($query,'_') !== false)
{
    $usersReturnedQuery = mysqli_query($con, "SELECT * FROM user WHERE username LIKE '$query%' AND user_closed = 'no' LIMIT 8");
}
else if(count($names) == 2)
{
    $usersReturnedQuery = mysqli_query($con, "SELECT * FROM user WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed = 'no' LIMIT 8");
}
else
{
    $usersReturnedQuery = mysqli_query($con, "SELECT * FROM user WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[0]%') AND user_closed = 'no' LIMIT 8");
}




?>