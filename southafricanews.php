<?php include("headers/header_profile.php"); 
	?><title>South Africa News</title>
	<?php?>



	<div class="title"><h4>SOUTH AFRICA NEWS</h4></div>

	<div id="content">
	<?php
		$country = "South";
		$type = "news";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>