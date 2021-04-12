<?php include("headers/header_login.php");  ?>

    <h3><?php display_message();   ?></h3>	

    <?php password_reset();  ?>

    <div class="body-content">
        <form id="reset-form" method="post" role="form" autocomplete="off">
            <h3>Reset your Password</h3>
           
            <input type="password" name="password" id="password" tabindex="2" placeholder="New Password" required> 
           
            <input type="password" name="confirm_password" id="confirm_password" tabindex="2" placeholder="Confirm New Password" required> 
  
            <input type="submit" name="reset-password-submit" id="recover-submit" tabindex="4" value="Reset Password" />

            <input type="hidden" class="hide" name="token" value="<?php echo token_generator();    ?>">
    </div>

    </form>
	


    </body>

    <?php include("footer/footer.php");   ?>

</html>