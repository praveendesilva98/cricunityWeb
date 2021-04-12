<?php include("headers/header_admin.php"); ?>
<br><br>
<a href="index.php"><button class="btn btn-danger">HOME</button></a>
<a href="logoutnimda.php"><button class="btn btn-warning">LOGOUT</button></a>
<br><br><br>
<div id="content">
		<?php
		
		$posts = new Post($con, $email_nimda);
		$posts->loadPostsReport(); 

		?>
	</div>

<script type="text/javascript" src="indexjs.js"></script>


</body>

</html>