<?php include("init.php"); ?>
<?php include("logged_in.php");  ?>
<?php include("User.php");  ?>
<?php include("Post.php");  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
	integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
	crossorigin="anonymous"> 	
	<link rel="stylesheet" href="css/comment6.css"> 


</head>
    
<body>
	
    

    <script>
        function toggle()
        {
            var element = document.getElementById("comment_section");

            if(element.style.display == "block")
            {
                element.style.display == "none";
            }
            else
            {
                element.style.display == "block";
            }
                
        }
    </script>

    
    <?php

 if(isset($_POST['comment_delete']))
            {
                $id=$_POST['comment_delete'];
                $sql="UPDATE comments SET removed = 'yes' where id = '$id'";
                // $sql = "DELETE FROM comments WHERE id = '$id'"
                $sql = mysqli_query($con, $sql); // PK TU SUPPRIMES PAS LE COMMENTAIRE ? 

            }
    if(isset($_GET['post_id']))
    {
        $post_id = $_GET['post_id'];
    }

    $user_query = mysqli_query($con, "SELECT added_by, user_to FROM posts WHERE id = '$post_id'");
    $row = mysqli_fetch_array($user_query);

    $posted_to = $row['added_by'];

    $query = mysqli_query($con, "SELECT username FROM user WHERE email = '$email'");
    $row2 = mysqli_fetch_array($query);

    $query1 = mysqli_query($con, "SELECT id, posted_by FROM comments WHERE post_id = '$post_id' ORDER BY `date_added` DESC ");
    $row3 = mysqli_fetch_array($query1);

    $username = $row2['username'];
    $id = $row3['id'];
    $posted_by = $row3['posted_by'];

    if(isset($_POST['postComment' . $post_id]))
    {
        $post_body = $_POST['post_body'];
        $post_body = mysqli_escape_string($con, $post_body);
        $date_time_now = date("Y-m-d H:i:s");
        $insert_post = mysqli_query($con, "INSERT INTO comments VALUES ('', '$post_body', '$username', '$posted_to', '$date_time_now', 'no', '$post_id')");
    }




    ?>

    <form action="comment_frame.php?post_id=<?php echo $post_id;  ?>" id = "comment_form" name = "postComment<?php echo $post_id; ?>" method="POST">
        <textarea name="post_body"  cols="60" rows="1" placeholder="Comment..."></textarea>
        <br><br><input type="submit" name="postComment<?php echo $post_id; ?>" value="Post"><br><br><br>
    </form>

    <?php
    $get_comments = mysqli_query($con, "SELECT * FROM comments WHERE post_id = '$post_id' AND removed = 'no' ORDER BY date_added DESC");
    $count = mysqli_num_rows($get_comments);

    if($count != 0)
    {
        while($comment = mysqli_fetch_array($get_comments))
        {
            $comment_body = $comment['post_body'];
            $posted_to = $comment['posted_to'];
            $posted_by = $comment['posted_by'];
            $date_added = $comment['date_added'];
            $comment_id = $comment['id'];

            if($posted_by == $user['username'])
            {
                $delete_button = "<form id = 'comment_delete' name = 'comment_delete$comment_id' method='POST'>
                    <input type='hidden' name='comment_delete' value='$comment_id'>
                    <button class='btn'>Delete<i class='fa fa-trash' aria-hidden='true'></button></i>
                </form>
                <br><br>";
                
            }
            else if($posted_to == $user['username'])
            {
                $delete_button = "<form id = 'comment_delete' name = 'comment_delete$comment_id' method='POST'>
                    <input type='hidden' name='comment_delete' value='$comment_id'>
                    <button class='btn'>Delete&nbsp;<i class='fa fa-trash' aria-hidden='true'></button></i>
                </form>
                <br><br>";
                
            }
            else
            {
                $delete_button = "<br><br><br>";
            }

            

           


            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_added);
            $end_date = new DateTime($date_time_now);
            $interval = $start_date->diff($end_date);
            
            
            if($interval->y >= 1)
            {
                if($interval == 1)
                {
                    $time_message = $interval->y . " year ago";
                }
                else
                {
                    $time_message = $interval->y . " years ago";	
                }
            }
            else if($interval->m >= 1)
            {
                if($interval->d == 0)
                {
                    $days = " ago";
                }
                else if($interval->d == 1)
                {
                    $days = $interval->d . " day ago";	
                }
                else
                {
                    $days = $interval->d . " days ago";	
                }

                if($interval->m == 1)
                {
                    $time_message = $interval->m . " month". $days;
                }
                else
                {
                    $time_message = $interval->m . " months". $days;	
                }
            }
            else if($interval->d >= 1)
            {
                if($interval->d == 1)
                {
                    $time_message = "Yesterday";
                }
                else
                {
                    $time_message = $interval->d . " days ago";	
                }
            }
            else if($interval->h >= 1)
            {
                if($interval->h == 1)
                {
                    $time_message = $interval->h . " hour ago";	
                }
                else
                {
                    $time_message = $interval->h . " hours ago";	
                }
            }
            else if($interval->i >= 1)
            {
                if($interval->i == 1)
                {
                    $time_message = $interval->i . " minute ago";
                }
                else
                {
                    $time_message = $interval->i . " minutes ago";	
                }
            }
            else
            {
                if($interval->s < 30)
                {
                    $time_message = "Just now";
                }
                else
                {
                    $time_message = $interval->s . " seconds ago";	
                }
            } 
            
            $user_obj = new User($con, $posted_by);

            $email = $_SESSION['email'];
            $user_details_query = mysqli_query($con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$posted_by'");
            $user_row = mysqli_fetch_array($user_details_query);
            $first_name = $user_row['first_name'];
            $last_name = $user_row['last_name'];
            $profile_pic = $user_row['profile_pic'];

            ?>
            <div class="comment_section">
                <a href="<?php echo $posted_by;  ?>" target="_parent"><img src="<?php echo $profile_pic;   ?>" title="<?php echo $posted_by; ?>" style="float:left;" height="30" class="photo_comment"></a>
                <a href="<?php echo $posted_by;  ?>"target="_parent" class="name_comment"><b><?php echo $first_name ." ". $last_name;  ?></b></a>
                <?php echo " - ". $time_message ." ". $delete_button;  ?>
                <div class="body_comment">
                    <?php echo $comment_body;  ?>
                </div>
                <br><br>

            </div>

            <?php

        }
    }
    else
    {
        echo "<center>No Comments to Show!</center>";
    }

    ?>

    



</body>

</html>