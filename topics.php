<?php include("headers/header_profile.php"); 
	?><title>Topics</title>
	<?php?>

	<div class="title"><h4>TOPICS</h4></div>

	<?php
	

	if(isset($_POST['post']))
	{
		$post = new Post($con, $email);
		$post->submitPost($_POST['post_text'], 'none');
		header("Location: topics.php");
	} ?>

	<center>
	<div class="post_topic"></div>
		<form class="post_form" action="home.php" method="POST" enctype="multipart/form-data">
			<textarea name="post_text" id="post_text" cols="100" rows="2" placeholder="Any new Topics?"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">

		</form>
	</div><br><br><br></center>

	<div id="content">

	<?php
		$type = "";
		$posts = new Post($con, $email);
		$posts->loadGeneral($type);

	?>
	</div>


<script type="text/javascript" src="indexjs.js"></script>




</body>

</html>