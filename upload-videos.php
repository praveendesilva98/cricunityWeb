<?php

include("headers/header_profile.php");

    if(isset($_POST['post-videos']))
    {
        $post = new Post($con, $email);
        $post->submitVideo($_POST['title_videos']);
        header("Location: home.php");

    } ?>




	<div class="title"><h4>UPLOAD VIDEOS</h4><br><br></div>

		<h2>All videos not related to Cricket will be deleted.</h2>

        <center><form id="upload_input" method="POST" enctype="multipart/form-data">>
            
            <h3>Title (*)</h3>
            <input  name="title_videos" id="title_videos" required> 
            
            <h3>Link (*)</h3>
            <input  name="link_videos" id="link_videos" required>
            
            <h3>Teams</h3>
            <div class="container">
            <div class="row">
                <h1><div class="col-md-4">
                    <input type="checkbox" name="country[]" class="checkbox" value="Australia">&nbsp&nbspAustralia&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="Bangladesh">&nbsp&nbspBangladesh&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="England">&nbsp&nbspEngland&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="India">&nbsp&nbspIndia&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="New Zealand">&nbsp&nbspNew Zealand&nbsp&nbsp<br><br>
                </div>

                <div class="col-md-4">
                    <input type="checkbox" name="country[]" class="checkbox" value="Pakistan">&nbsp&nbspPakistan&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="South Africa">&nbsp&nbspSouth Africa&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="Sri Lanka">&nbsp&nbspSri Lanka&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="West Indies">&nbsp&nbspWest Indies&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="Other Countries">&nbsp&nbspOther Countries&nbsp&nbsp<br><br>
                </div>

                <div class="col-md-4">
                    <input type="checkbox" name="country[]" class="checkbox" value="IPL">&nbsp&nbspIPL&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="BBL">&nbsp&nbspBBL&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="CPL">&nbsp&nbspCPL&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="PSL">&nbsp&nbspPSL&nbsp&nbsp
                    <br><input type="checkbox" name="country[]" class="checkbox" value="Other Leagues">&nbsp&nbspOther Leagues&nbsp&nbsp<br><br><br>
                </div></h1>
            
            <input type="submit" name="post-videos" id="post_button" value="Upload"><br><br>


        </form></center>



	




	


</body>

</html>