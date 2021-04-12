<?php

include("headers/header_profile.php");

    if(isset($_POST['post-news']))
    {
        
        $uploadOk = 1;
        $imageName = $_FILES['fileToUpload']['name'];
        $errorMessage = "";

        if($imageName != "")
        {
            $targetDir = "posts/images/";
            $imageName = $targetDir . uniqid() . basename($imageName);
            $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

            if($_FILES['fileToUpload']['size'] > 100000000)
            {
                $errorMessage = "Sorry, your file is too large";
                $uploadOk = 0;
            }

            if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg")
            {
                $errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
                $uploadOk = 0;
            }

            if($uploadOk)
            {
                if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName))
                {

                }
                else
                {
                    $uploadOk = 0;
                }
            }
        }

        if($uploadOk)
        {
            $post = new Post($con, $email);
			$post->submitNews($_POST['title_news'], $imageName);
			header("Location: home.php");
        }
        else
        {
            echo "<div style='text-align:center;' class='alert alert-error'>
                $errorMessage
            </div>";
        }
    } ?>
    



	<div class="title"><h4>UPLOAD NEWS</h4><br><br></div>

		<h2>All articles not related to Cricket will be deleted.</h2>

        <center><form id="upload_input" method="POST" enctype="multipart/form-data">
            
            <h3>Title (*)</h3>
            <input  name="title_news" id="title_news" required>
            
            <h3>Upload an image (Optional)</h3>
            <input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input">
            
            <h3>Description</h3>
            <textarea  name="description_news" id="description_news" cols="100" rows="5" placeholder="(Optional)"></textarea>
            
            <h3>Link (*)</h3>
            <input  name="link_news" id="link_news" required>

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

            </div>
            <input type="submit" name="post-news" id="post_button" value="Upload"><br><br>


        </form></center>



	




	


</body>

</html>