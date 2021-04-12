
<?php include("init.php");     ?>
<div class="jumbotron">
    <h1 class="text-center">
        <?php    
        
        if(logged_in())
        {
            echo "Logged in";
        }
        else
        {
            redirect("index.php");
        }
        
        
        ?>
    </h1>

</div>
