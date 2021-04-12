<?php include("headers/header_profile.php"); 
	?><title>News</title>
	<?php?>


	<div class="title"><h4>NEWS</h4></div>

	<div id="content">

		<?php
		$type = "news";
		$posts = new Post($con, $email);
		$posts->loadGeneral($type); ?>

	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>