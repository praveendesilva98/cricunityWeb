<?php include("headers/header_profile.php"); 
	?><title>Other Leagues</title>
	<?php?>



	<div class="title"><h4>OTHER LEAGUES</h4></div>

	<div id="content">
	<?php
		$country = "Leagues";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>