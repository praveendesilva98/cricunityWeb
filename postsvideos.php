    <?php


    //Australia Videos//

    public function loadVideosAustralia(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%Australia%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }


    //Bangladesh Videos//

    public function loadVideosBangladesh(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%Bangladesh%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }



    //England Videos//

    public function loadVideosEngland(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%England%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }

    //India Videos//

    public function loadVideosIndia(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%India%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }

    //New Zealand Videos//

    public function loadVideosNewZealand(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%New%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }

    //Pakistan Videos//

    public function loadVideosPakistan(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%Pakistan%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }

    //South Africa Videos//

    public function loadVideosSouthAfrica(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%South%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }

    //Sri Lanka Videos//

    public function loadVideosSriLanka(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%Sri%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }


    //West Indies Videos//

    public function loadVideosWestIndies(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%West%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }

    //Other Countries Videos//

    public function loadVideosOtherCountries(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%Countries%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }


    //IPL Videos//

    public function loadVideosIPL(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%IPL%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }

    //BBL Videos//

    public function loadVideosBBL(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%BBL%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }

    //CPL Videos//

    public function loadVideosCPL(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%CPL%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }


    //PSL Videos//

    public function loadVideosPSL(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%PSL%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }


    //Other Leagues Videos//


    public function loadVideosOtherLeagues(/*$data, $limit*/)
    {
        /* $page = $data['page'];
        $email = $this->user_obj->getUsername();

        if($page == 1)
        {
            $start = 0;
        }
        else
        {
            $start = ($page - 1) * $limit;
        } */

        $str = "";
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' AND type = 'video' AND country LIKE '%Leagues%' ORDER BY date_added DESC");

        if(mysqli_num_rows($data_query) > 0)
        {

            while($row = mysqli_fetch_array($data_query))
            {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $title = $row['title'];
                $description = $row['description'];
                $link = $row['link'];
                $country = $row['country'];


                if($row['user_to'] == "none")
                {
                    $user_to = "";
                }
                else
                {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name ."</a>";
                }
                
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj->isClosed())
                {
                    continue;
                }

                /* if($num_iterations++ < $start)
                {
                    continue;
                }

                if($count > $limit)
                {
                    break;
                }
                else
                {
                    $count++;
                }
    */
                $email = $_SESSION['email'];
                $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                ?>

                <script>
                    function toggle<?php echo $id;   ?>()
                    {
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";

                    }
                </script>

                <?php

                $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comment_check_num = mysqli_num_rows($comment_check);

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                if($imagePath != "")
                {
                    $imageDiv = "<div class='postedImage'>
                                    <img src='$imagePath'>	
                                </div>";
                }
                else
                {
                    $imageDiv = "";
                }

                $str .= "<center><div class='white_box'>
                            <div class='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='80'>
                                </div>

                                <div class='posted_by' style='color:#ACACAC;'>
                                    <a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                                </div>

                                <div class='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    <a href='$link'>$imageDiv</a>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>

                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>
                        </div></center>
                        <br>
                        ";
                
            }

        /* 	if($count > $limit) 
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                            <input type='hidden' class='noMorePosts' value='false'>";
            else 
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>"; */
        }

        echo $str;


    }




    ?>