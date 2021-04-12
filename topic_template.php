<?php

echo "<center><div class='white_box'>
							<div class='status_post' onClick='javascript:toggle$id()'>
								<div class='post_profile_pic'>
									<img src='$profile_pic' width='80'>
								</div>

								<div class='posted_by' style='color:#ACACAC;'>
									<a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
                            <br>$delete_button $report_button
								</div>

								<div class='post_body'>
								<br><br>
									$body
									<br><br>
								</div>

								<div class='newsfeedPostOptions'>
									<br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

								</div>

							</div>
							<div class='post_comment' id='toggleComment$id' style='display:none;'>
								<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
							</div>
							<hr>
						</div></center>
						<br>
                        "




?>