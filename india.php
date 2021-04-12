<?php include("headers/header_profile.php"); 
	?><title>India</title>
	<?php?>



	<div class="title"><h4>INDIA</h4></div>

	<div id="content">
	<?php
		$country = "India";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>