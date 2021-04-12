<?php include("headers/header_profile.php"); 
	?><title>England</title>
	<?php?>



	<div class="title"><h4>ENGLAND</h4></div>

	<div id="content">
	<?php
		$country = "England";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>