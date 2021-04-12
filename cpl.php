<?php include("headers/header_profile.php"); 
	?><title>CPL</title>
	<?php?>



	<div class="title"><h4>CARRIBEAN PREMIER LEAGUE</h4></div>

	<div id="content">
	<?php
		$country = "CPL";
		$posts = new Post($con, $email);
		$posts->loadCountryPosts($country);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>