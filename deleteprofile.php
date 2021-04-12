<?php

include("init.php");
include("logged_in.php");


$filename = "uploads/profile".$email."*";
$fileinfo = glob($filename);
$fileext = explode(".", $fileinfo[0]);
$fileactualext = $fileext[1];

$file = "uploads/profile".$email.".".$fileactualext;

if(!unlink($file))
{
    echo "File was not deleted!";
}
else
{
    echo "File was deleted!";
}

$photo_profile = "uploads/profile_random.png";

$sql2 = "UPDATE user SET profile_pic = '$photo_profile' WHERE email = '$email'";
mysqli_query($con, $sql2);

$sql1 = "UPDATE user SET photo_status = 1 WHERE email = '$email'";
mysqli_query($con, $sql1);

header("Location: home.php");




?>