<?php include("init.php"); ?>
<?php include("logged_in_nimda.php");  ?>

    
<?php

if(isset($_GET['post_id']))
{
    $post_id = $_GET['post_id'];
}

if(isset($_POST['result2']))
{
	if($_POST['result2'] == 'true')
	{
		$query = mysqli_query($con, "UPDATE posts SET report = 'yes' AND report_accepted = 'yes' AND deleted = 'yes' WHERE id = '$post_id'");
	}
    
}



?>


</body>

</html>
