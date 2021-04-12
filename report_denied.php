<?php include("init.php"); ?>
<?php include("logged_in_nimda.php");  ?>

    
<?php

if(isset($_GET['post_id']))
{
    $post_id = $_GET['post_id'];
}

if(isset($_POST['result3']))
{
	if($_POST['result3'] == 'true')
	{
		$query = mysqli_query($con, "UPDATE posts SET report = '' AND report_accepted = 'no' WHERE id = '$post_id'");
	}
    
}



?>


</body>

</html>
