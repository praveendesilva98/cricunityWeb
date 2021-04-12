<?php

function clean($string)
{
    return htmlentities($string);
}

function redirect($location)
{
    return header("Location: {$location} ");
}

function set_message($message)
{
    if(!empty($message))
    {
        $_SESSION['message'] = $message;
    }
    else
    {
        $message = "";
    }
}

function display_message()
{
    if(isset($_SESSION['message']))
    {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function token_generator()
{
    $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token;
}

function validation_errors($error_message)
{
    $error_message = '
            <h2><strong>Warning!</strong> ' .$error_message .'
            </h2>

            ';

    return $error_message;
}


function email_exists($email)
{
    $sql = "SELECT id FROM user WHERE email = '$email'";
    $result = query($sql);

    if(row_count($result) == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
    
}

function username_exists($username)
{
    $sql = "SELECT id FROM user WHERE username = '$username'";
    $result = query($sql);

    if(row_count($result) == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
    
}

function send_mail($email, $subject, $message, $headers)
{
    return mail($email, $subject, $message, $headers);
}







function validate_user_registration()
{
    $errors = [];

    $min = 5;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $username = clean($_POST['username']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $confirm_password= clean($_POST['confirm_password']);
    }

    if(isset($_POST['register-submit']))
    {
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
    
 

        if(username_exists($username))
        {
            $errors[] = "Sorry, that Username is already registered";
        }

        if(strlen($username) < $min)
        {
            $errors[] = "Your Username must contain between {$min} to {$max} characters";
        }

        if(strlen($username) > $max)
        {
            $errors[] = "Your Username must contain between {$min} to {$max} characters";
        }

        if(email_exists($email))
        {
            $errors[] = "Sorry, that Email is already registered";
        }

        if(strlen($password) < $min)
        {
            $errors[] = "Your Password cannot be less than {$min} characters";
        }

        if($password !== $confirm_password)
        {
            $errors[] = "Your password fields do not match";
        }

        if(!empty($errors))
        {
            foreach ($errors as $error)
            {
                echo validation_errors($error);
            }
        }
        else
        {
            if(register_user($first_name, $last_name, $username, $email, $password))
            {
                set_message("<h3>Please check your email or Spam folder for activation link <h3>");

                redirect("message.php");


            }
            else
            {
                set_message("<h3>Sorry, we could not register the user<h3>");

                redirect("message.php");
            }

        }
    }

}



function register_user($first_name, $last_name, $username, $email, $password)
{
    $first_name = escape($first_name);
    $last_name = escape($last_name);
    $username = escape($username);
    $email = escape($email);
    $password= escape($password);


    if(email_exists($email))
    {
        return false;
    }
    else if(username_exists($username))
    {
        return false;
    }
    else
    {
        $password = md5($password);

        $validation_code = md5($username + microtime());
        $profile_pic = "uploads/profile_random.png";
        $photo_status = "1";

        $sql = "INSERT INTO user(first_name, last_name, username, email, password, profile_pic, photo_status, validation_code, active)";
        $sql.= " VALUES('$first_name','$last_name','$username','$email','$password', '$profile_pic', $photo_status, '$validation_code', 0)";
        $result = query($sql);

        $subject = "Activate account";
        $message = " Please click the link below to activate your Account
        
        http://localhost/cricunity/activate.php?email=$email&code=$validation_code
        ";

        $headers = "From: noreply@cricunity.com";


        send_mail($email, $subject, $message, $headers);

        return true;


    }

    
}



function activate_user()
{
    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if(isset($_GET['email']))
        {
            $email = clean($_GET['email']);
            $validation_code = clean($_GET['code']);

            $sql = "SELECT id FROM user WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code'])."' ";
            $result = query($sql);


            if(row_count($result) == 1)
            {
                $sql2 = "UPDATE user SET active = 1, validation_code = 0 WHERE email = '".escape($email)."' AND validation_code = '".escape($validation_code)."' ";
                $result2 = query($sql2);
                confirm($result2);

                set_message("<h3>Your account has been activated, please login</h3>");

                redirect("login.php");
            }
            else
            {
                set_message("<h3>Sorry, your account could not be activated</h3>");

                redirect("index.php");
            }

            

            


        }

    }
}

function validate_user_login()
{
    $errors = [];
    $min = 5;
    $max = 20;




    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $remember = isset($_POST['remember']);


        if(empty($email))
        {
            $errors[] = "Email field cannot be empty";
        }

        if(empty($password))
        {
            $errors[] = "Password field cannot be empty";
        }


        if(!empty($errors))
        {
            foreach ($errors as $error)
            {
                echo validation_errors($error);
            }
        }
        else
        {
            if(login_user($email, $password, $remember))
            {
                redirect("home.php");
            }
            else
            {
                echo validation_errors("<h3>Your credentials are not correct</h3>");
            }
        } 
    }

}


function login_user($email, $password, $remember)
{
    $sql = "SELECT password, id FROM user WHERE email = '".escape($email)."' AND active = 1";
    $result = query($sql);

    if(row_count($result) == 1)
    {
        $row = fetch_array($result);
        $db_password = $row['password'];

        if(md5($password) === $db_password)
        {
            if($remember == "on")
            {
                setcookie('email', $email, time() + 86400);
            }

            $_SESSION['email'] = $email;

            return true;
        }
        else
        {
            return false;
        }

        return true;
    }
    else
    {
        return false;
    }



}


function logged_in()
{
    if(isset($_SESSION['email']) || isset($_COOKIE['email']))
    {
        return true;
	}
	else
	{
		return false;
	}

}

function validate_user_login_nimda()
{
    $errors = [];
    $min = 5;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email_nimda = clean($_POST['email_nimda']);
        $password_nimda = clean($_POST['password_nimda']);
        $remember = isset($_POST['remember']);


        if(empty($email_nimda))
        {
            $errors[] = "Email field cannot be empty";
        }

        if(empty($password_nimda))
        {
            $errors[] = "Password field cannot be empty";
        }


        if(!empty($errors))
        {
            foreach ($errors as $error)
            {
                echo validation_errors($error);
            }
        }
        else
        {
            if(login_user_nimda($email_nimda, $password_nimda, $remember))
            {
                redirect("nimda.php");
            }
            else
            {
                echo validation_errors("<h3>Your credentials are not correct</h3>");
            }
        } 
    }

}

function login_user_nimda($email_nimda, $password_nimda, $remember)
{
    $sql = "SELECT * FROM admin WHERE email_nimda = '".escape($email_nimda)."'";
    $result = query($sql);

    if(row_count($result) == 1)
    {
        $row = fetch_array($result);
        $db_password_nimda = $row['password_nimda'];

        if($password_nimda === $db_password_nimda)
        {
            if($remember == "on")
            {
                setcookie('email_nimda', $email_nimda, time() + 300);
            }

            $_SESSION['email_nimda'] = $email_nimda;

            return true;
        }
        else
        {
            return false;
        }

        return true;
    }
    else
    {
        return false;
    }



}


function logged_in_nimda()
{
    if(isset($_SESSION['email_nimda']) || isset($_COOKIE['email_nimda']))
    {
        return true;
	}
	else
	{
		return false;
	}

}



function recover_password()
{
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
       if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token'])
        {
            $email = clean($_POST['email']);

            if(email_exists($email))
            {
                $validation_code = md5($email + microtime());

                setcookie('temp_access_code', $validation_code, time() + 900);

                $sql = "UPDATE user SET validation_code = '".escape($validation_code)."' WHERE email = '".escape($email)."'";
                $result = query($sql);

                $subject = "Please reset your Password";
                $message = " Here is your password reset code {$validation_code};

                Click here to reset your password

                http://localhost/cricunity/code.php?email=$email&code=$validation_code
                
                
                
                ";

                $headers = "From: noreply@yourwebsite.com";

                if(!send_mail($email, $subject, $message, $headers))
                {
                    echo validation_errors("<h3>Email could not be sent</h3>");
                }

                set_message("<h3>Please check your email or spam folder for a password reset code</h3>");

                redirect("message.php");

            }
            else
            {
                echo validation_errors("<h3>This email does not exist</h3>");
            }
        }
        else
        {
            redirect("index.php");
        } 

        
    }
    if(isset($_POST['cancel_submit']))
    {
        redirect("login.php");
    }
}


function validate_code()
{
    if(isset($_COOKIE['temp_access_code']))
    {
        if(!isset($_GET['email']) && !isset($_GET['code']))
        {
            redirect("index.php");
        }
        else if(empty($_GET['email']) || empty($_GET['code']))
        {
            redirect("index.php");
        }
        else
        {
            if(isset($_POST['code']))
            {
                $email = clean($_GET['email']);

                $validation_code = clean($_POST['code']);

                $sql = "SELECT id FROM user WHERE validation_code = '".escape($validation_code)."' AND email = '".escape($email)."'";
                $result = query($sql);

                if(row_count($result) == 1)
                {
                    setcookie('temp_access_code', $validation_code, time() + 300);
                    redirect("reset.php?email=$email&code=$validation_code");
                }
                else
                {
                    echo validation_errors("Sorry, wrong validation code");
                }
            }
        }
    }
    else
    {
        set_message("<h3>Sorry, your validation cookie was expired</h3>");

        redirect("recover.php");
    }
}

function password_reset()
{
    if(isset($_COOKIE['temp_access_code']))
    {
        if(isset($_GET['email']) && isset($_GET['code']))
        {
            if(isset($_SESSION['token']) && isset($_POST['token']) && $_POST['token'] === $_SESSION['token'])
            {
                if($_POST['password'] === $_POST['confirm_password'])
                {
                    $updated_password = md5($_POST['password']);

                    $sql = "UPDATE user SET password = '".escape($updated_password)."', validation_code = 0 WHERE email = '".escape($_GET['email'])."'";
                    query($sql);

                    set_message("<h3>Your password has been updated, please Log in</h3>");
                    redirect("login.php");
                }    
            }

        }
    
    }
    else
    {
        set_message("<h3>Sorry, your time has expired</h3>");
        redirect("recover.php");
    }
}

















?>