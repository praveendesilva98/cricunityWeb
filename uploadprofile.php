<?php include("init.php"); ?>
<?php include("User.php");  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
	integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
	crossorigin="anonymous"> 	
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="nav.css">	
	<link rel="stylesheet" href="profile.css"> 
	

	

</head>
    
    <body>
	
	<?php include("logged_in.php");?>	
	<?php include("header.php");  ?>
	<?php include("nav.php");  ?>

    <?php

    $email = $_SESSION['email']; 

    if(isset($_POST['submit']))
    {
        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                if($fileSize < 1000000)
                {
                    $fileNameNew = "profile".$email.".".$fileActualExt;
                    $fileDestination = 'uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $sql = "UPDATE user SET photo_status = 0 WHERE email = '$email'";
                    $result = mysqli_query($con, $sql);
                    $profile_pic = "uploads/profile$email.$fileActualExt";
                    $sql2 = "UPDATE user SET profile_pic = '$profile_pic' WHERE email = '$email'";
                    $result2 = mysqli_query($con, $sql2);
                    header("Location: home.php");
                }
                else
                {
                    echo "Your file is too big";
                }
            }
            else
            {
                echo "There was an error uploading your file!";
            }
        }
        else
        {
            echo "You cannot upload files of this type!";
        }
    }












?>




</body>

</html>