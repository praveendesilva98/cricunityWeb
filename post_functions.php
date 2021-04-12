<?php
include("init.php");
include("User.php");
include("Post.php");




function news_upload()
{
    $errors = [];

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $title = clean($_POST['title_news']);
        $imageName = clean($_POST['NewsImage']);
        $description = clean($_POST['description_news']);
        $link = clean($_POST['link_news']);
    }

    if(isset($_POST['post-news']))
    {
        $_SESSION['title'] = $title;
        $_SESSION['description'] = $description;
        $_SESSION['link'] = $link;

        $uploadOk = 1;
        $imageName = $_FILES['NewsImage']['name'];
        $errorMessage = "";

        if($imageName != "")
        {
            $targetDir = "posts";
            $imageName = $targetDir . uniqid() . basename($imageName);
            $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

            if($_FILES['NewsImage']['size'] > 100000000)
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
                if(move_uploaded_file($_FILES['NewsImage']['tmp_name'], $imageName))
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
			$post->submitNews($_POST['title_news'], 'none', $imageName);
			header("Location: home.php");
        }
        else
        {
            echo "<div style='text-align:center;' class='alert alert-error'>
                $errorMessage
            </div>";
        }


        $title = escape($title);
        $description = escape($description);
        $link = escape($link);

        $sql = "INSERT INTO posts(image, type, title, description, link, country)";
        $sql.= " VALUES('$imageName, 'news', $title, '$description', '$link', '')";
        $result = query($sql);
    }    

}





?>