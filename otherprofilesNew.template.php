<?php
echo "<center><div class='white_box' style='$hiddenP' post-id='$id'>
                    <div class='status_post'>
                        <div class='post_profile_pic'>
                            <img src='$profile_pic' width='120'>
                        </div>

                        <div class='posted_by' id='post_name$added_by' style='color:#ACACAC;'>
                            <a href='$added_by'> $first_name $last_name</a> </div>
                            <div class='post_id' value='$id'>
                                
                                </div>
                            <div class='type'>
                                NEWS
                            </div>
                        </div>
                            <br><br>
                            $delete_button $report_button
                            <br>
                            <div class='time'>
                            $time_message
                            </div>
                        

                        <div id='content$id' class='content_link'>
                        
                            <br><br><h5>$title</h5>
                                <br><br><br>
                                $imageDiv
                                
                            </div>

                        <div class='newsfeedPostOptions'>
                            <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                        </div>

                    
                    <div class='post_comment' id='toggleComment$id' style='display:none;'>
                        <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                    </div>
                    <hr>
                </center>
                <br>
                
                ";



                ?>

