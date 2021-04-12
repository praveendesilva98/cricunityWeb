<?php

if(isset($_POST['update_details']))
{
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    

    $username_check = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
    $added_by_check = mysqli_query($con, "SELECT added_by FROM posts");
    $row = mysqli_fetch_array($username_check);
    $row1 = mysqli_fetch_array($added_by_check);
    $matched_user = $row['email'];
    $added_by = $row1['added_by'];

    if($matched_user == "" || $matched_user == $email)
    {
        set_message("<p><h4>Details Updated</h4></p><br><br>");

        $sql2 = mysqli_query($con, "UPDATE user SET first_name = '$first_name', last_name = '$last_name' WHERE email='$email'");
    }
    else
    {
        set_message("<p><h4>That Username is already in use</h4></p><br><br>");
    }
}
else
{
    set_message("<p><h4></p><br><br>");
}

if(isset($_POST['update_password']))
{
    $old_password = $_POST['old_password'];
    $new_password_1 = $_POST['new_password_1'];
    $new_password_2 = $_POST['new_password_2'];

    $password_query = mysqli_query($con, "SELECT password FROM user WHERE email = '$email'");
    $row = mysqli_fetch_array($password_query);
    $db_password = $row['password'];

    if(md5($old_password) == $db_password)
    {
        if($new_password_1 = $new_password_2)
        {
            if(strlen($new_password_1) < 5)
            {
                set_message("<p><h4>Sorry, your password must contain at least 5 characters</h4></p><br><br>");
            }
            else
            {
                $new_password_md5 = md5($new_password_1);
                $password_query = mysqli_query($con, "UPDATE user SET password = '$new_password_md5' WHERE email = '$email'");
                set_message("<p><h4>Password has been changed!</h4></p><br><br>");
            }
        }
        else
        {
            set_message("<p><h4>Your two new Passwords need to match!</h4></p><br><br>");
        }
    }
    else
    {
        set_message("<p><h4>The old Password is incorrect</h4></p><br><br>");
    }
    
}
else
{
    set_message("<p><h4></h4></p><br><br>");
}

if(isset($_POST['close_account']))
{
    header("Location: close_account.php");
}





?>