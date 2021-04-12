<?php 

include("headers/header_profile.php");

	display_message(); 

	$sql = "SELECT photo_status FROM user WHERE email = '$email'";
	$result = query($sql);


	if($user['photo_status'] == 0)
	{
        echo "<img src='" . $user['profile_pic']."' id='small_profile_pics'>";
	}
	else
	{
		echo "<img src='uploads/profile_random.png'>";
	}
	

    echo "<form class='settings_form' action='uploadprofile.php' method='POST' enctype='multipart/form-data'>
        <input type='file' name='file'>
        <button type='submit' name='submit'>UPLOAD</button>
	</form><br><hr><br>";
	
    echo "<form class='settings_form'  action='deleteprofile.php' method='POST'>
        <button type='submit' name='delete'>Delete Profile Photo</button>
    </form>";


?>

</form>
	
	</body>

</html>