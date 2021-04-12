<?php include("headers/header_profile.php"); 
	?><title>IPL Videos</title>
	<?php?>



	<div class="title"><h4>INDIAN PREMIER LEAGUE VIDEOS</h4></div>

	<div id="content">
	<?php
		$country = "IPL";
		$type = "video";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>