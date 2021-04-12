<?php include("headers/header_profile.php"); 
	?><title>New Zealand</title>
	<?php?>



	<div class="title"><h4>NEW ZEALAND</h4></div>

	<div id="content">
	<?php
		$country = "New";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>