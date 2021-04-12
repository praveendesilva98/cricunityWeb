<?php include("headers/header_profile.php"); 
	?><title>Other Leagues Videos</title>
	<?php?>



	<div class="title"><h4>OTHER LEAGUES VIDEOS</h4></div>

	<div id="content">
	<?php
		$country = "Leagues";
		$type = "video";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>