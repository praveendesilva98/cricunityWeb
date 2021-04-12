<?php include("headers/header_profile.php"); 
	?><title>Videos</title>
	<?php?>

	<div class="title"><h4>VIDEOS</h4></div>

	<div id="content">
	<?php
		$type = "video";
		$posts = new Post($con, $email);
		$posts->loadGeneral($type); ?>

	</div>

	
	<script type="text/javascript" src="indexjs.js"></script>

</body>

</html>