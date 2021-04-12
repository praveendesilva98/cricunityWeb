<?php include("init.php"); ?>
<?php include("User.php");  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
	integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
	crossorigin="anonymous"> 	
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="nav.css">	
	<link rel="stylesheet" href="profile.css"> 

</head>
    
    <body>
        <?php include("logged_in.php");     
        
        include("header.php"); 
        include("nav.php");  
        
        if(isset($_POST['cancel']))
        {
            header("Location: profile-settings.php");
        }

        if(isset($_POST['close_account']))
        {
            $close_query = mysqli_query($con, "UPDATE user SET active = '0' WHERE email = '$email'");
            session_destroy();
            header("Location: login.php");

            $activate_query = mysqli_query($con, "UPDATE user SET active = '1' WHERE email = '$email'");

                       
        }    

        
        ?>

        

        <?php display_message(); ?>

        <h3>Deactivate Account</h3>

        <h2>Are you sure, you want to deactivate the account ?<br><br>
        Deactivating your account will hide your profile and all your activity from other users.
        You can reactivate your account at any time by simply logging in</h2>

        <form action="close_account.php" method="POST">
            <input type="submit" name="close_account" id="close_account" value="Deactivate">
            <input type="submit" name="cancel" id="update_details" value="Cancel">
        </form>

        




    </body>

</html>