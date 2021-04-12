<?php include("init.php"); ?>
<?php include("logged_in.php");  ?>

    
<?php

if(isset($_GET['post_id']))
{
    $post_id = $_GET['post_id'];
}

if(isset($_POST['result1']))
{
	if($_POST['result1'] == 'true')
	{
		$query = mysqli_query($con, "UPDATE posts SET report = 'yes' AND report_accepted = 'deciding' WHERE id = '$post_id'");
	}
    
}



?>


</body>

</html>
