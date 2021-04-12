<?php include("headers/header_profile.php"); 
	?><title>New Zealand News</title>
	<?php?>



	<div class="title"><h4>NEW ZEALAND NEWS</h4></div>

	<div id="content">
	<?php
		$country = "New";
		$type = "news";
		$posts = new Post($con, $email);
		$posts->loadCountryPostsType($country, $type);
	

	?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>