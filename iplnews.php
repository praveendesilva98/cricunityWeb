<?php include("headers/header_profile.php"); 
	?><title>IPL News</title>
	<?php?>



	<div class="title"><h4>INDIAN PREMIER LEAGUE NEWS</h4></div>

	<div id="content">
	<?php
		$country = "IPL";
		$type = "news";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>