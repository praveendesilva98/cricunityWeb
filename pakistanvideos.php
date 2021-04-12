<?php include("headers/header_profile.php"); 
	?><title>Pakistan Videos</title>
	<?php?>



	<div class="title"><h4>PAKISTAN VIDEOS</h4></div>

	<div id="content">
	<?php
		$country = "Pakistan";
		$type = "video";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>