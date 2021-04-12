<?php include("headers/header_profile.php"); 
	?><title>CPL News</title>
	<?php?>



	<div class="title"><h4>CARRIBEAN PREMIER LEAGUE NEWS</h4></div>

	<div id="content">
	<?php
		$country = "CPL";
		$type = "news";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>