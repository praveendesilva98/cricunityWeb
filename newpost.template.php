<?php 

echo "<center><div class='white_box' style='$hiddenP' post-id='$id'>
                        <div class='status_post' >
                            <div class='post_profile_pic'>
                                <img src='$profile_pic' width='120'>
                            </div>

                            <div class='posted_by' id='post_name$added_by' style='color:#ACACAC;'>
                                <a href=''> $first_name $last_name </a> </div>
                                <div class='post_id'>
                                
                                </div>
                                <div class='type'>
                                    $type
                                </div>
                            </div>
                                <br><br>
                                $delete_button $report_button
                                <br>
                                <div class='time'>
                                $time_message
                                </div>
                            

                                <div class='post_body' id='post_body'>
                                <br><br><h5>$title</h5><br>
                                    $body
                                    <br><br>
                                    $imageDiv
                                   
                                </div>

                                <div class='newsfeedPostOptions'>
                                <br><br>Comments($comment_check_num)&nbsp;&nbsp;&nbsp;&nbsp;

                            </div>

                        
                        <div class='post_comment' id='toggleComment$id' style='display:none;'>
                            <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                        </div>
                        <hr>
                    </div></center>
                    <br>
                    "

                    ;
                    ?>

