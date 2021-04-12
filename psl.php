<?php include("headers/header_profile.php"); 
	?><title>PSL</title>
	<?php?>



	<div class="title"><h4>PAKISTAN SUPER LEAGUE</h4></div>

	<div id="content">
	<?php
		$country = "PSL";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>