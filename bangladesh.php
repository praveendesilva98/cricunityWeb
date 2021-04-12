<?php include("headers/header_profile.php"); 
	?><title>Bangladesh</title>
	<?php?>



	<div class="title"><h4>BANGLADESH</h4></div>

	<div id="content">
	<?php
		$country = "Bangladesh";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>