<?php include("headers/header_profile.php"); 
	?><title>PSL Videos</title>
	<?php?>



	<div class="title"><h4>PAKISTAN SUPER LEAGUE VIDEOS</h4></div>

	<div id="content">
	<?php
		$country = "PSL";
		$type = "video";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>