<?php

class User
{
    private $user;
    private $con;

    public function __construct($con, $user)
    {
        $this->con = $con;
        $sql = "SELECT * FROM user WHERE email = '$user'";
        $result = query($sql);
        $this->user = fetch_array($result);
    }

    public function getUsername() 
    {
		return $this->user['username'];
	}

    public function getNumPosts() 
    {
		$email = $this->user['email'];
		$query = mysqli_query($this->con, "SELECT num_posts FROM user WHERE email='$email'");
		$row = mysqli_fetch_array($query);
		return $row['num_posts'];
	}

    public function getFirstAndLastName()
    {
        $email = $this->user['email'];
        $sql2 = "SELECT first_name, last_name FROM user WHERE email='$email'";
        $result2 = query($sql2);
        $name = fetch_array($result2);
        return $name['first_name'] ." ". $name['last_name'];
    }

    public function getProfilePic()
    {
        $email = $this->user['email'];
        $sql = mysqli_query($con, "SELECT profile_pic FROM user WHERE email='$email'");
        $name = mysqli_fetch_array($sql);
        return $name['profile_pic'];
    }

    public function isClosed()
    {
        $email = $this->user['email'];
        $query = mysqli_query($this->con, "SELECT active FROM user WHERE email = '$email'");
        $row = mysqli_fetch_array($query);

        if($row['active'] == '0')
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    
}













?>