<?php include("headers/header_profile.php"); 
	?><title>Sri Lanka Videos</title>
	<?php?>



	<div class="title"><h4>SRI LANKA VIDEOS</h4></div>

	<div id="content">
	<?php
		$country = "Sri";
		$type = "video";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>