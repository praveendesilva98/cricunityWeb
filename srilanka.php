<?php include("headers/header_profile.php"); 
	?><title>Sri Lanka</title>
	<?php?>



	<div class="title"><h4>SRI LANKA</h4></div>

	<div id="content">
	<?php
		$country = "Sri";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>