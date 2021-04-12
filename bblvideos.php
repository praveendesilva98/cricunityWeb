<?php include("headers/header_profile.php"); 
	?><title>BBL Videos</title>
	<?php?>



	<div class="title"><h4>BIG BASH LEAGUE 	VIDEOS</h4></div>

	<div id="content">
	<?php
		$country = "BBL";
		$type = "video";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>