<?php

$sql1 = "SELECT email_nimda FROM admin";
$result1 = query($sql1);
$user1 = fetch_array($result1);

$email_nimda = $user1['email_nimda'];

if(logged_in())
{
    redirect("home.php");
}
else
{
    if(logged_in_nimda())
    {        
        $sql = "SELECT * FROM admin WHERE email_nimda='$email_nimda'";
        $result = query($sql);
        $user = fetch_array($result);
    }
    else
    {
        redirect("logoutnimda.php");
    }
}




    

?>