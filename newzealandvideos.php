<?php include("headers/header_profile.php"); 
	?><title>New Zealand Videos</title>
	<?php?>



	<div class="title"><h4>NEW ZEALAND VIDEOS</h4></div>

	<div id="content">
	<?php
		$country = "New";
		$type = "video";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>