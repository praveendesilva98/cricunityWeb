<?php include("headers/header_profile.php"); 
	?><title>IPL</title>
	<?php?>



	<div class="title"><h4>INDIAN PREMIER LEAGUE</h4></div>

	<div id="content">
	<?php
		$country = "IPL";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>