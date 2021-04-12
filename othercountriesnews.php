<?php include("headers/header_profile.php"); 
	?><title>Other Countries News</title>
	<?php?>



	<div class="title"><h4>OTHER COUNTRIES NEWS</h4></div>

	<div id="content">
	<?php
		$country = "Countries";
		$type = "news";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>