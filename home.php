
	<?php include("headers/header_profile.php"); 

if(isset($_POST['post']))
{
	$uploadOk = 1;
	$imageName = $_FILES['fileToUpload']['name'];
	$errorMessage = "";

	if($imageName != "")
	{
		$targetDir = "posts/images";
		$imageName = $targetDir . uniqid() . basename($imageName);
		$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

		if($_FILES['fileToUpload']['size'] > 100000000)
		{
			$errorMessage = "Sorry, your file is too large";
			$uploadOk = 0;
		}

		if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg")
		{
			$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk = 0;
		}

		if($uploadOk)
		{
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName))
			{

			}
			else
			{
				$uploadOk = 0;
			}
		}
	}

	if($uploadOk)
	{
		$post = new Post($con, $email);
		$post->submitPost($_POST['post_text'], 'none', $imageName);
		header("Location: home.php");
	}
	else
	{
		echo "<div style='text-align:center;' class='alert alert-error'>
			$errorMessage
		</div>";
	}

	
} ?>


<div class="post_topic">
	<form class="post_form" action="home.php" method="POST" enctype="multipart/form-data">
		<input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input">
		<center><textarea name="post_text" id="post_text" cols="100" rows="2" placeholder="Got something to say?"></textarea>
		<input type="submit" name="post" id="post_button" value="Post">

	</form>
</div></center><br><br><br>

<div id="content">

	<?php
	$posts = new Post($con, $email);
	$posts->loadPostsFriends();

	?>
</div>


<script type="text/javascript" src="javascript.js"></script>


</body>

</html>