<?php include("headers/header_profile.php"); 
	?><title>Australia</title>
	<?php?>



	<div class="title"><h4>AUSTRALIA</h4></div>

	<div id="content">
	<?php
		$country = "Australia";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>