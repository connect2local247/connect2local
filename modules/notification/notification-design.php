<?php
// Assuming you have fetched row data from the database and stored it in an array called $row
// Example $row array structure: $row = [ [ 'n_content' => 'Notification content', 'n_type' => 'Notification type', 'n_time' => 'Notification time', 'n_user_id' => 'User ID' ], ... ];

// Function to calculate elapsed time
function elapsedTime($timestamp) {
    $timeDifference = time() - strtotime($timestamp);
    $intervals = array(
        1                   => 'second',
        60                  => 'minute',
        3600                => 'hour',
        86400               => 'day',
        604800              => 'week',
        2592000             => 'month',
        31536000            => 'year'
    );

    foreach ($intervals as $seconds => $label) {
        $numberOfUnits = $timeDifference / $seconds;
        if ($numberOfUnits >= 1) {
            $roundedUnits = round($numberOfUnits);
            return $roundedUnits . ' ' . $label . (($roundedUnits > 1) ? 's' : '') . ' ago';
        }
    }
}

// Function to differentiate notification type based on user ID prefix
function userType($user_id) {
    if (strpos($user_id, 'C2LB') === 0) {
        return 'Business';
    } elseif (strpos($user_id, 'C2L') === 0) {
        return 'Customer';
    } else {
        return 'Unknown';
    }
}
?>
<div class="container">
                    <?php 
                                        if(userType($user_id) == 'Business'){
                                                $notificationDataQuery = "SELECT bp_fname,bp_lname,bp_profile_img_url, bp_username from business_profile WHERE b_id = '$user_id'";
                                                echo $notificationDataQuery;
                                                $resultQuery = mysqli_query($GLOBALS['connect'],$notificationDataQuery);
                                                
                                                if(mysqli_num_rows($resultQuery) > 0){
                                        
                                                    $data = mysqli_fetch_assoc($resultQuery);
                                                ?>
                                                <div class="request-notification border border-info shadow p-3 my-3 rounded d-flex justify-content-between align-items-center text-bg-dark">
                                                    <div class="requester-info d-flex px-2 align-items-center" style="gap:7px">
                                                    
                                                        <span class="fullname fw-semibold text-white d-flex " style="gap:5px;"><i class="fa-solid fa-circle-info fs-4 text-info"></i> <u><?php echo $data['bp_fname']." ".$data['bp_lname'];?></u></span>
                                                        <span style="margin-y:auto"><?php echo $content ?></span>
                                                    </div>
                                                    <div class="request-reply d-flex px-2  ms-auto" style="gap:10px">
                                                        <i class="fa-solid fa-check p-2 border rounded border-success"></i>
                                                        <i class="fa-solid fa-xmark p-2 border rounded border-danger"></i>
                                                    </div>
                                                    <span>
                                                </div>
                                                <?php
                                                }
                                        } else if(userType($user_id) == 'Customer'){

                                        } else{

                                        }
                    ?>
                

                <div class="business-notification border border-info shadow p-3 my-3 rounded d-flex justify-content-between align-items-center text-bg-dark">
                    <div class="business-info d-flex px-2 align-items-center" style="gap:7px">
                        <img src="/asset/image/user/profile.png" style="height:35px;width:35px" class="rounded-circle" alt="">
                        <span class="fullname fw-semibold text-white"><u>Bhavesh_1724</u></span>
                        <span style="margin-y:auto"> started following you.</span>
                    </div>
                </div>
</div>
