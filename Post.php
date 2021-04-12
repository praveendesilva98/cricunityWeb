<?php
function giveMeHTML($templateName){
	ob_start();
  	include("$templateName.template.php");
 	ob_get_clean();
}

class Post 
{
	private $user_obj;
	private $con;

    public function __construct($con, $user)
    {
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function submitVideo($body) 
    {
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$title = clean($_POST['title_videos']);
			$body = clean($_POST['link_videos']);
			

			$body = strip_tags($body);
			$body = mysqli_real_escape_string($this->con, $body);
			
			$body = str_replace('\r\n', '<br>', $body);
			$body = nl2br($body);

			$check_empty = preg_replace('/\s+/', '', $body); 
		
			if(strpos($body, "www.youtube.com/watch?v=") !== false) 
			{

				$body_array = preg_split("/\s+/", $body);
				$body_array_daily = preg_split("/\s+/", $body);			

				foreach($body_array as $key => $value)
				{
					if(strpos($value, "www.youtube.com/watch?v=") !== false || $check_empty != "")
					{
						$link = preg_split("!&!", $value);
						$value = preg_replace("!watch\?v=!", "embed/", $value);
						$value = "<br><center><iframe src=\'" . $value ."\' frameborder=\'0\' allowfullscreen></iframe></center><br>";
						$body_array[$key] = $value;
                    }
                    
                    
                }
                
				
				$body = implode(" ", $body_array);

				$date_added = date("Y-m-d H:i:s");
				$added_by = $this->user_obj->getUsername();
				
				$country = $_POST['country'];
				$check = "";

				foreach($country as $check1)
				{
					$check .= $check1.", ";
				}

				if($user_to == $added_by) 
				{
					$user_to = "none";
				}

				$query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0', '', 'video', '$title', '', '$body', '$check', '', '')");
				$returned_id = mysqli_insert_id($this->con);

				$email = $_SESSION['email'];
				$num_posts = $this->user_obj->getNumPosts();
				$num_posts++;
				$update_query = mysqli_query($this->con, "UPDATE user SET num_posts = '$num_posts' WHERE email='$email'");

            }
            else
            {
                echo "Your video URL is not valid";
                redirect("Location: upload-contents.php");
            }
		}
	}

	public function submitNews($title, $imageName)
	{
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$title = clean($_POST['title_news']);
			$description = clean($_POST['description_news']);
			$link = clean($_POST['link_news']);

			$country = $_POST['country'];
			$check = "";

			foreach($country as $check1)
			{
				$check .= $check1.", ";
			}



			$date_added = date("Y-m-d H:i:s");
			$added_by = $this->user_obj->getUsername();

			if($user_to == $added_by) 
			{
				$user_to = "none";
			}


			$query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '', '$added_by', '$user_to', '$date_added', 'no', 'no', '0', '$imageName', 'news', '$title', '$description', '$link', '$check', '', '')");
			$returned_id = mysqli_insert_id($this->con);

			$email = $_SESSION['email'];
			$num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
            $update_query = mysqli_query($this->con, "UPDATE user SET num_posts = '$num_posts' WHERE email='$email'");
		}
	}

    public function submitPost($body, $user_to, $imageName) 
    {
		$body = strip_tags($body);
        $body = mysqli_real_escape_string($this->con, $body);
        
        $body = str_replace('\r\n', '<br>', $body);
		$body = nl2br($body);

		$check_empty = preg_replace('/\s+/', '', $body); 
      
        if((strpos($body, "www.youtube.com/watch?v=") !== false) || $check_empty != "") 
        {

			$body_array = preg_split("/\s+/", $body);
			$body_array_daily = preg_split("/\s+/", $body);			

			$date_added = date("Y-m-d H:i:s");
			$added_by = $this->user_obj->getUsername();

            if($user_to == $added_by) 
            {
				$user_to = "none";
			}

			

			$query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0', '$imageName', '', '', '', '', '', '', '')");
			$returned_id = mysqli_insert_id($this->con);

            $email = $_SESSION['email'];
			$num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
			$update_query = mysqli_query($this->con, "UPDATE user SET num_posts = '$num_posts' WHERE email='$email'");

		}
	}

	public function loadPostsFriends($limit=10,$offset=0,$hidden=false)
	{
        $userLoggedIn = $this->user_obj->getUsername();

		$str = "";
		// SQL : LIMIT, OFFSET
		$sql="SELECT * FROM posts WHERE deleted = 'no' ORDER BY date_added DESC ";
		if ($limit>0) {
			$sql.="LIMIT {$limit} ";
		}
		if ($offset>0) {
			$sql.="OFFSET {$offset}";
		}
		// echo $sql;
		$data_query = mysqli_query($this->con, $sql);

		if(mysqli_num_rows($data_query) > 0)
		{

			$num_iterations = 0;
			$count = 1; 

			while($row = mysqli_fetch_array($data_query))
			{
                $id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];
				$title = $row['title'];
                $link = $row['link']; 
                $type = $row['type'];
                $description = $row['description']; 
                $report =  $row['report'];
 

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
                
                
                 if($userLoggedIn == $added_by)
                {
                    $delete_button = "<button class='delete_button' id='post$added_by'>Delete <i class='fa fa-trash'></i></button>";
                    $report_button = "";
                }
                else
                {
                    $delete_button = "";
                    $ed= $report=="0" ? "ed" : "";
                    $report_button = "<button class='report_button$ed' id='report$added_by'>Report$ed <i class='fa fa-exclamation'></i></button>";
                } 


				$email = $_SESSION['email'];
				$user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                


				$comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id' AND removed='no' ORDER BY `date_added` DESC ");
                $comment_check_num = mysqli_num_rows($comment_check);
                

                include("time_message.php");
				

				if($imagePath != "")
				{
					$imageDiv = "<div class='postedImage'>
									<img src='$imagePath' class='img-responsive' >	
								</div>";
				}
				else
				{
					$imageDiv = "";
                }
            

				if($type == 'video')
                {
                    $type = 'VIDEO';
                }
                else if($type == '')
                {
                    $type = 'TOPIC';
				}

                
                $hiddenP=$hidden ?  "display: none" : ""; 
               // infinite scroll, fadeIn (index.js)
                if($type == 'news')
                {
                	 ob_start();
  					include("otherprofilesNew.template.php");
                    $str .=ob_get_clean();
				
                }
                else
                {
                	// ICI giveMeHTLM avec le bon fichier 
                	 ob_start();
  					include("newpost.template.php");
                    $str .=ob_get_clean();
				}

				
                    
                }
		}

		echo $str;
            
	}

	public function loadPostsProfile($added_id, $hidden=false) //NON 
	{
        $userLoggedIn = $this->user_obj->getUsername();
		$str = "";
		// SQL : LIMIT, OFFSET
		$sql="SELECT * FROM posts WHERE deleted = 'no' AND added_by = '$added_id' ORDER BY date_added DESC ";

		// echo $sql;
		$data_query = mysqli_query($this->con, $sql);

		if(mysqli_num_rows($data_query) > 0)
		{

			$num_iterations = 0;
			$count = 1; 

			while($row = mysqli_fetch_array($data_query))
			{
                $id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];
				$title = $row['title'];
                $link = $row['link']; 
                $type = $row['type'];
                $description = $row['description']; 
                $report =  $row['report'];
 

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
                
                
                 if($userLoggedIn == $added_by)
                {
                    $delete_button = "<button class='delete_button' id='post$id'>Delete <i class='fa fa-trash'></i></button>";
                    $report_button = "";
                }
                else
                {
                    $delete_button = "";
                    $ed= $report=="0" ? "ed" : "";
                    $report_button = "<button class='report_button$ed' id='report$id'>Report$ed <i class='fa fa-exclamation'></i></button>";
                } 


				$email = $_SESSION['email'];
				$user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                


				$comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id' AND removed='no' ORDER BY `date_added` DESC ");
                $comment_check_num = mysqli_num_rows($comment_check);
                

                include("time_message.php");
				

				if($imagePath != "")
				{
					$imageDiv = "<div class='postedImage'>
									<img src='$imagePath' class='img-responsive' >	
								</div>";
				}
				else
				{
					$imageDiv = "";
                }
            

				if($type == 'video')
                {
                    $type = 'VIDEO';
                }
                else if($type == '')
                {
                    $type = 'TOPIC';
                }

                
                $hiddenP=$hidden; 
               // infinite scroll, fadeIn (index.js)
                if($type == 'news')
                {
                	 ob_start();
  					include("otherprofilesNew.template.php");
                    $str .=ob_get_clean();
				
                }
                else
                {
                	// ICI giveMeHTLM avec le bon fichier 
                	 ob_start();
  					include("newpost.template.php");
                    $str .=ob_get_clean(); }
                    
                    
                }
		}

		echo $str;
    }
    
    

    public function loadGeneral($type, $hidden=false)
    {
        $userLoggedIn = $this->user_obj->getUsername();

		$str = "";
		// SQL : LIMIT, OFFSET
		$sql="SELECT * FROM posts WHERE deleted = 'no' AND type = '$type' ORDER BY date_added DESC ";

		// echo $sql;
		$data_query = mysqli_query($this->con, $sql);

		if(mysqli_num_rows($data_query) > 0)
		{

			$num_iterations = 0;
			$count = 1; 

			while($row = mysqli_fetch_array($data_query))
			{
                $id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];
				$title = $row['title'];
                $link = $row['link']; 
                $type = $row['type'];
                $description = $row['description']; 
                $report =  $row['report'];
 

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
                
                
                 if($userLoggedIn == $added_by)
                {
                    $delete_button = "<button class='delete_button' id='post$id'>Delete <i class='fa fa-trash'></i></button>";
                    $report_button = "";
                }
                else
                {
                    $delete_button = "";
                    $ed= $report=="0" ? "ed" : "";
                    $report_button = "<button class='report_button$ed' id='report$id'>Report$ed <i class='fa fa-exclamation'></i></button>";
                } 


				$email = $_SESSION['email'];
				$user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                


				$comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id' AND removed='no' ORDER BY `date_added` DESC ");
                $comment_check_num = mysqli_num_rows($comment_check);
                

                include("time_message.php");
				

				if($imagePath != "")
				{
					$imageDiv = "<div class='postedImage'>
									<img src='$imagePath' class='img-responsive' >	
								</div>";
				}
				else
				{
					$imageDiv = "";
                }
            

				if($type == 'video')
                {
                    $type = 'VIDEO';
                }
                else if($type == '')
                {
                    $type = 'TOPIC';
                }

                
                $hiddenP=$hidden; 
               // infinite scroll, fadeIn (index.js)
                if($type == 'news')
                {
                	 ob_start();
  					include("otherprofilesNew.template.php");
                    $str .=ob_get_clean();
				
                }
                else
                {
                	// ICI giveMeHTLM avec le bon fichier 
                	 ob_start();
  					include("newpost.template.php");
                    $str .=ob_get_clean();
                    
                    }
                }


		}

		echo $str;
            
	
    }

	

//Countries Posts


public function loadCountryPosts($country, $hidden=false)
{
    $userLoggedIn = $this->user_obj->getUsername();
    $str = "";
	$sql="SELECT * FROM posts WHERE deleted = 'no' AND country LIKE '%$country%' ORDER BY date_added DESC ";

		// echo $sql;
		$data_query = mysqli_query($this->con, $sql);

		if(mysqli_num_rows($data_query) > 0)
		{

			$num_iterations = 0;
			$count = 1; 

			while($row = mysqli_fetch_array($data_query))
			{
                $id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];
				$title = $row['title'];
                $link = $row['link']; 
                $type = $row['type'];
                $description = $row['description']; 
                $report =  $row['report'];
 

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
                
                
                 if($userLoggedIn == $added_by)
                {
                    $delete_button = "<button class='delete_button' id='post$id'>Delete <i class='fa fa-trash'></i></button>";
                    $report_button = "";
                }
                else
                {
                    $delete_button = "";
                    $ed= $report=="0" ? "ed" : "";
                    $report_button = "<button class='report_button$ed' id='report$id'>Report$ed <i class='fa fa-exclamation'></i></button>";
                } 


				$email = $_SESSION['email'];
				$user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                


				$comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id' AND removed='no' ORDER BY `date_added` DESC ");
                $comment_check_num = mysqli_num_rows($comment_check);
                

                include("time_message.php");
				

				if($imagePath != "")
				{
					$imageDiv = "<div class='postedImage'>
									<img src='$imagePath' class='img-responsive' >	
								</div>";
				}
				else
				{
					$imageDiv = "";
                }
            

				if($type == 'video')
                {
                    $type = 'VIDEO';
                }

                
                $hiddenP=$hidden; 
               // infinite scroll, fadeIn (index.js)
                if($type == 'news')
                {
                	 ob_start();
  					include("otherprofilesNew.template.php");
                    $str .=ob_get_clean();
				
                }
                else
                {
                	// ICI giveMeHTLM avec le bon fichier 
                	 ob_start();
  					include("newpost.template.php");
                    $str .=ob_get_clean();
                    
                    }
                }
		}

		echo $str;

}

public function loadCountryPostsType($country,$type,$hidden=false)
{
    $userLoggedIn = $this->user_obj->getUsername();
    $str = "";
	$sql="SELECT * FROM posts WHERE deleted = 'no' AND country LIKE '%$country%' AND type = '$type' ORDER BY date_added DESC ";

		// echo $sql;
		$data_query = mysqli_query($this->con, $sql);

		if(mysqli_num_rows($data_query) > 0)
		{

			$num_iterations = 0;
			$count = 1; 

			while($row = mysqli_fetch_array($data_query))
			{
                $id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];
				$title = $row['title'];
                $link = $row['link']; 
                $type = $row['type'];
                $description = $row['description']; 
                $report =  $row['report'];
 

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
                
                
                 if($userLoggedIn == $added_by)
                {
                    $delete_button = "<button class='delete_button' id='post$id'>Delete <i class='fa fa-trash'></i></button>";
                    $report_button = "";
                }
                else
                {
                    $delete_button = "";
                    $ed= $report=="0" ? "ed" : "";
                    $report_button = "<button class='report_button$ed' id='report$id'>Report$ed <i class='fa fa-exclamation'></i></button>";
                } 


				$email = $_SESSION['email'];
				$user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                


				$comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id' AND removed='no' ORDER BY `date_added` DESC ");
                $comment_check_num = mysqli_num_rows($comment_check);
                

                include("time_message.php");
				

				if($imagePath != "")
				{
					$imageDiv = "<div class='postedImage'>
									<img src='$imagePath' class='img-responsive' >	
								</div>";
				}
				else
				{
					$imageDiv = "";
                }
            

				if($type == 'video')
                {
                    $type = 'VIDEO';
                }

                
                $hiddenP=$hidden; 
               // infinite scroll, fadeIn (index.js)
                if($type == 'news')
                {
                	 ob_start();
  					include("otherprofilesNew.template.php");
                    $str .=ob_get_clean();
				
                }
                else
                {
                	// ICI giveMeHTLM avec le bon fichier 
                	 ob_start();
  					include("newpost.template.php");
                    $str .=ob_get_clean();
                    
                    }
                }
		}

		echo $str;

}


public function loadPostsReport($hidden=false)
{
    $userLoggedIn = $this->user_obj->getUsername();

    $str = "";
	$sql="SELECT * FROM posts WHERE deleted = 'no' AND report = '0' ORDER BY date_added DESC";

	// echo $sql;
	$data_query = mysqli_query($this->con, $sql);

	if(mysqli_num_rows($data_query) > 0)
	{

		$num_iterations = 0;
		$count = 1; 

		while($row = mysqli_fetch_array($data_query))
		{
			$id = $row['id'];
			$body = $row['body'];
			$added_by = $row['added_by'];
			$date_time = $row['date_added'];
			$imagePath = $row['image'];
			$title = $row['title'];
			$link = $row['link']; 
			$type = $row['type'];
			$description = $row['description']; 
			$report =  $row['report'];



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
            
            
			$delete_button = "<button class='delete_button' id='post$id'>Delete <i class='fa fa-trash'></i></button>";
			$report_button = "";



            $user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
            $user_row = mysqli_fetch_array($user_details_query);
            $first_name = $user_row['first_name'];
            $last_name = $user_row['last_name'];
            $profile_pic = $user_row['profile_pic'];
            


            $comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id' AND removed='no' ORDER BY `date_added` DESC ");
            $comment_check_num = mysqli_num_rows($comment_check);
            

            include("time_message.php");
            

            if($imagePath != "")
            {
                $imageDiv = "<div class='postedImage'>
                                <img src='$imagePath' class='img-responsive'>	
                            </div>";
            }
            else
            {
                $imageDiv = "";
            }
        

            if($type == 'video')
            {
                $type = 'VIDEO';
            }
            else if($type == '')
            {
                $type = 'TOPIC';
            }

            
            $hiddenP=$hidden; 
           // infinite scroll, fadeIn (index.js)
		   if($type == 'news')
			{
					ob_start();
				include("otherprofilesNew.template.php");
				$str .=ob_get_clean();
			
			}
			else
			{
				// ICI giveMeHTLM avec le bon fichier 
				ob_start();
				include("newpost.template.php");
				$str .=ob_get_clean();
			
			}

		}
   }

   echo $str;

}

public function loadContentNews($id)
	{
        $userLoggedIn = $this->user_obj->getUsername();

		$str = "";
		$data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE id = $id");

		if(mysqli_num_rows($data_query) > 0)
		{

			$num_iterations = 0;
			$count = 1; 

			while($row = mysqli_fetch_array($data_query))
			{
                $id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];
				$title = $row['title'];
                $link = $row['link']; 
                $type = $row['type'];
                $description = $row['description']; 
                $report =  $row['report'];
 

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
                
                
                 if($userLoggedIn == $added_by)
                {
                    $delete_button = "<button class='delete_button' id='post$added_by'>Delete <i class='fa fa-trash'></i></button>";
                    $report_button = "";
                }
                else
                {
                    $delete_button = "";
                    $ed= $report=="0" ? "ed" : "";
                    $report_button = "<button class='report_button$ed' id='report$added_by'>Report$ed <i class='fa fa-exclamation'></i></button>";
                } 


				$email = $_SESSION['email'];
				$user_details_query = mysqli_query($this->con, "SELECT user.first_name, user.last_name, user.profile_pic FROM user, posts WHERE user.username = '$added_by'");
				$user_row = mysqli_fetch_array($user_details_query);
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];
                


				$comment_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id' AND removed='no' ORDER BY `date_added` DESC ");
                $comment_check_num = mysqli_num_rows($comment_check);
                

                include("time_message.php");
				

				if($imagePath != "")
				{
					$imageDiv = "<div class='postedImage'>
									<img src='$imagePath' class='img-responsive' >	
								</div>";
				}
				else
				{
					$imageDiv = "";
                }
            

				if($type == 'video')
                {
                    $type = 'VIDEO';
                }
                else if($type == '')
                {
                    $type = 'TOPIC';
				}

				
				$str = "<center>
				<div class='white_box' post-id='$id'>
					<div class='status_post' >
						<div class='post_profile_pic'>
							<img src='$profile_pic' width='120'>
						</div>

						<div class='posted_by' id='post_name$added_by' style='color:#ACACAC;'>
							<a href=''> $first_name $last_name </a> </div>
						<div class='post_id'>
						
						</div>
						
						<div class='type'>
							NEWS
						</div>
					</div>
						<br><br>
						$delete_button $report_button
						<br>
						<div class='time'>
							$time_message
						</div>
					

						<div class='post_body' id='post_body'>
							<br><br><h5>$title</h5>
							<br><br>
							$description
							<br><br>
							$imageDiv
						   
						</div>

						<div class='newsfeedPostOptions'>
						<br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

					</div>

				
				<div class='post_comment' id='toggleComment$id' style='display:none;'>
					<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
				</div>

			</div>
			<div class='link' id='link_web$link'>
					<button class='btn btn-success' value='$link'>Click here to watch the Article</button>
				</div>
			
			</center>
			<br>
			";


				
                    
                }
		}

		echo $str;
            
	}

}


?>