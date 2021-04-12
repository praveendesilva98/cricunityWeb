<?php include("headers/header_home.php");  ?>


		<div class="jumbotron">

			<h1>WELCOME TO CRICUNITY</h1>

			<h3>The Oval for all Cricket Fans</h3><br>
			

			<div class="row">
				<div class="col-md-3">
				<?php
					if(logged_in()):  ?>
					<a class="btn btn-warning btn-lg" href="home.php" role="button">MY PROFILE</a>
					<?php endif;  ?>
					<?php if(!logged_in()):  ?>
					<a class="btn btn-warning btn-lg" href="login.php" role="button">LOG IN</a>
					<?php endif;  ?>
				</div>
				<div class="col-md-3 ">
				</div>
				<div class="col-md-3">
					<div class="cover1">
						<img src="photos/mac.png" width='120'>
					</div>
				</div>
				<div class="col-md-3">
					<div class="cover2">
						<img src="photos/iphone.png" width='120'>
					</div>
				</div>
			</div>

		</div>

		<div class="col-md-3 ">
			<div class="mobile"> 
				<img src="photos/iphone.png" width='120'>
			</div>
		</div>


<?php include("footer/footer.php");   ?>

