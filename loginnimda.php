<?php include("headers/header_login.php");  ?>
        <?php if(logged_in_nimda())
        {
            redirect("nimda.php");
        }   ?>	


        <?php display_message();  ?>

        <?php validate_user_login_nimda();  ?>

        <br><br><h2>&nbsp;&nbsp;LOGIN ADMIN</h2><br><br><br>

        <center><form id="login-form" method="post" role="form">
        <div class="form-group">
        <input type="email" name="email_nimda" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
        </div>
        <div class="form-group">
        <input type="password" name="password_nimda" id="password" tabindex="2" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group form-check">
            <h5><input type="checkbox" name="remember" id="remember">&nbsp;Remember Me</h5>
        </div>
        <button type="submit" class="btn btn-primary" name="login-submit" id="login-submit">LOGIN</button>
        <br/><br/>

    </form></center>

</body>

<?php include("footer/footer.php");   ?>

</html>


