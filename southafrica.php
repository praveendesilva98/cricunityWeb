<?php include("headers/header_profile.php"); 
	?><title>South Africa</title>
	<?php?>



	<div class="title"><h4>SOUTH AFRICA</h4></div>

	<div id="content">
	<?php
		$country = "South";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>