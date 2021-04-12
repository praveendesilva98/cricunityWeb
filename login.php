<?php include("headers/header_login.php");  ?>


        <br><br><h2>&nbsp;&nbsp;LOGIN</h2><br><br><br>

        <?php if(logged_in())
        {
            redirect("home.php");
        }   ?>	


        <?php display_message();  ?>

        <?php validate_user_login();  ?>

        <center><form id="login-form" method="post" role="form">
        <div class="form-group">
            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group form-check">
            <h5><input type="checkbox" name="remember" id="remember">&nbsp;Remember Me</h5>
        </div>
            <button type="submit" class="btn btn-primary" name="login-submit" id="login-submit">LOGIN</button>
        <br/><br/>
        <div class="text">
            <h5><a href="register.php">Don't have an account yet ? Register in here</a></h5>
            <br/>
            <h5><a href="recover.php">Forgot Password ?</a></h5>
        </div>
    </form></center>



</body>

<?php include("footer/footer.php");   ?>

</html>


