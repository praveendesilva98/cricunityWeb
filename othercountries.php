<?php include("headers/header_profile.php"); 
	?><title>Other Countries</title>
	<?php?>



	<div class="title"><h4>OTHER COUNTRIES</h4></div>

	<div id="content">
	<?php
		$country = "Countries";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>