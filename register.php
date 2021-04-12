<?php include("headers/header_login.php");  ?>
        
        <?php validate_user_registration();  ?>
        <br><br><h2>&nbsp;&nbsp;Create an account</h2><br><br><br>

        <div class="body-content">
            

        <center><form id="register-form" method="post" role="form">
        <div class="form-group">
            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php
            if(isset($_SESSION['first_name']))
            {
                echo $_SESSION['first_name'];
            }
            ?>" required>
        </div>

        <div class="form-group">
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php
            if(isset($_SESSION['last_name']))
            {
                echo $_SESSION['last_name'];
            }
            ?>" required>
        </div>

        <div class="form-group">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php
            if(isset($_SESSION['username']))
            {
                echo $_SESSION['username'];
            }
            ?>" required>
        </div>
        
        <div class="form-group">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="<?php
                if(isset($_SESSION['email']))
                {
                    echo $_SESSION['email'];
                }
                ?>" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        </div>

        <div class="form-group">
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password" required> 
        </div>

        <button type="submit" class="btn btn-primary" name="register-submit" id="register-submit">REGISTER</button>

        <div class="text">
            <br><h5><a href="login.php">Already have an account ? Sign in here</a>LOGIN</h5><br><br>
        </div>

    </form></center>

</body>

<?php include("footer/footer.php");   ?>

</html>