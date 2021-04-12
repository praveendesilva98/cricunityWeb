<?php

include("headers/header_profile.php");
?>
<title>Profile</title>
<?php
	
	if(isset($_GET['profile_username']))
	{
		$username = $_GET['profile_username'];
		$user_details_query = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
		$user_array = mysqli_fetch_array($user_details_query);
		$profile_pic = $user_array['profile_pic'];
		$first_name = $user_array['first_name'];
		$last_name = $user_array['last_name'];
		?>

		<center><div class="profile_info">
			<div class="profile_photo">
				<img src="<?php echo $profile_pic;   ?>" class="profile_photo">
			</div>
			<div class="profile_name">
				<h2><?php echo $first_name ." ". $last_name ?></h2></a>
			</div><br><br>

		
		</div></center>
		<div id="content">	 
		<?php

		$posts = new Post($con, $email);
		$posts->loadPostsProfile($username);?> </div><?php
	}
	else
	{
		?>
		<div class="profile_info">
			<div class="profile_photo">
				<img src="<?php echo $user['profile_pic'];   ?>" class="profile_photo">
			</div>
			<div class="profile_name">
				<h3><?php echo $user['first_name'] ." ". $user['last_name'] ?></h3></a>
			</div><br><br><br><br><br><br><br><br><br><br><br><br>

		
		</div>
		<div id="content">
		<?php
			$posts = new Post($con, $email);
			$posts->loadPostsProfile($user['username']); 
	}
	?> </div>
		




	
<script type="text/javascript" src="indexjs.js"></script>

</body>

</html>