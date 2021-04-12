<?php include("headers/header_profile.php"); 
	?><title>West Indies</title>
	<?php?>



	<div class="title"><h4>WEST INDIES</h4></div>

	<div id="content">
	<?php
		$country = "West";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>