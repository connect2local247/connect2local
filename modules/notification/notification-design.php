<?php
               

                $user_type = determine_user_type($current_user_id);

                if($user_type == 'Customer'){
                    $user_data_query = "SELECT * FROM customer_profile WHERE c_id = '$current_user_id'";
                    $data_result = mysqli_query($GLOBALS['connect'],$user_data_query);
                       
                    if(mysqli_num_rows($data_result) > 0){
                        $row = mysqli_fetch_assoc($data_result);

                        $username = $row['cp_username'];
                        $profile_img = $row['cp_profile_img_url'];
                        // $name = $row['fname']." ".$row['lname'];
                    }
                } else if($user_type == 'Business'){
                    $user_data_query = "SELECT * FROM business_profile WHERE b_id = '$current_user_id'";
                    $data_result = mysqli_query($GLOBALS['connect'],$user_data_query);
                    
                    if(mysqli_num_rows($data_result) > 0){
                        $row = mysqli_fetch_assoc($data_result);

                        $username = $row['username'];
                        $profile_img = $row['profile_img_url'];
                        $name = $row['fname']." ".$row['lname'];
                        
                        // die();
                    }
                }

        if($notification['n_type'] == 'greeting'){       
?>

        <div class="container">
        <div class="d-flex justify-content-between p-3 align-items-center text-bg-light rounded-1 shadow" style="height:80px">
                
                <div class="content text-bg-light d-flex align-items-center" style="gap:10px">
                    <div class="">
                          <img src="/asset/image/user/profile.png" alt="" style="height:50px;width:50px" class="rounded-circle">
                    </div>
                    <div class="notifcation-box">
                          <div class="username">
                              <b><i><?php if(isset($username)) echo $username; else if(isset($name)) echo $name; else "Undefined" ?></i></b>
                              <span><?php if(isset($notification['n_content'])) echo $notification['n_content']; ?></span>
                              <span style="font-size:13px;" class="text-secondary">
                                just now
                              </span>
            
                          </div>
                          
                    </div>
                  </div>
                 
            </div>
              
        </div>
<?php
        }
?>

