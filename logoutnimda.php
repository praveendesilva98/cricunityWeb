<?php include("init.php");

session_destroy();

if(isset($_COOKIE['email_nimda']))
{
    unset($_COOKIE['email_nimda']);
    setcookie('email_nimda', '', time() - 60);
}


redirect("loginnimda.php");

















?>