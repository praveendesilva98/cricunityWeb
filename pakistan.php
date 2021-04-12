<?php include("headers/header_profile.php"); 
	?><title>Pakistan</title>
	<?php?>



	<div class="title"><h4>PAKISTAN</h4></div>

	<div id="content">
	<?php
		$country = "Pakistan";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>