<?php include("headers/header_profile.php"); 
	?><title>Settings</title>
	<?php?>

        <?php display_message(); ?>

        <div class="text"><h4>Account Settings</h4></div>

        <?php
        echo "<img src='" . $user['profile_pic']."' id='small_profile_pics'>";
        ?>
        <br><br>
        <div class="photo_form">
            <form class="settings_form" action="upload.php" method="POST">
                <input type="submit" class="settings_button" name="update_photo" id="update_photo" value="Upload new Profile Picture"><br><br>
            </form>
        </div>
        <br>
        <div class="text">
        <h2>Modify the values and click 'Update Details'</h2><br>
        </div>

        <?php  
        $user_data_query = mysqli_query($con, "SELECT first_name, last_name, username FROM user WHERE email='$email'");
        $row = mysqli_fetch_array($user_data_query);

        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $username = $row['username'];
        ?>

        <form class="settings_form" action="profile-settings.php" method="POST">
            <h3>First Name: <input type="text" name="first_name" value="<?php echo $first_name;  ?>"></h3><br>
            <h3>Last Name: <input type="text" name="last_name" value="<?php echo $last_name;  ?>"></h3><br>
            <input type="submit" class="settings_button" name="update_details" id="save_details" value="Update Details">
        </form><br>

        <div class="text"><h2>Change Your Password</h2><br><br></div>
        <form class="settings_form" action="profile-settings.php" method="POST">
            <h3>Old Password: <input type="password" name="old_password"></h3><br>
            <h3>New Password: <input type="password" name="new_password_1"></h3><br>
            <h3>Confirm New Password: <input type="password" name="new_password_2"></h3>><br>
            <input type="submit" class="settings_button" name="update_password" id="save_details" value="Update Password">
        </form><br>

        <div class="text"><h2>Deactivate Your Account</h2><br></div>
        <form class="settings_form" action="profile-settings.php" method="POST">
            <input type="submit" class="settings_button" name="close_account" id="close_account" value="Deactivate Account"><br><br>
        </form>

        




    </body>

</html>