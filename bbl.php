<?php include("headers/header_profile.php"); 
	?><title>BBL</title>
	<?php?>



	<div class="title"><h4>BIG BASH LEAGUE</h4></div>

	<div id="content">
	<?php
		$country = "BBL";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>