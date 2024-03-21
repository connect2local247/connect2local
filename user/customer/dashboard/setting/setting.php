

<div class="container mt-3">
  
  
  <div class="accordion" id="accordionExample1">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn  m-auto d-flex text-dark fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Activitiy
          </button>
        </h2>
      </div>
      
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
        <div class="card-body">
          <p class="px-3 fw-semibold text-secondary">Blocked User</p>
          <?php
            $fetch_query = "SELECT * FROM blocked_user_data WHERE bu_user_id = '$current_user_id'";
            $result = mysqli_query($GLOBALS['connect'], $fetch_query);

            if (mysqli_num_rows($result) > 0) {
              while ($data = mysqli_fetch_assoc($result)) {
                $business_user_id = $data['bu_business_id'];
                
                $fetch_user_data = "SELECT bp_username, bp_profile_img_url FROM business_profile WHERE bp_user_id = '$business_user_id' ";
                $user_result = mysqli_query($GLOBALS['connect'], $fetch_user_data);
                
                if (mysqli_num_rows($user_result) > 0) {
                    while ($row = mysqli_fetch_assoc($user_result)) {
                        $username = $row['bp_username'];
                        $profile_image = $row['bp_profile_img_url'];
                        ?>
                        <div class="d-flex justify-content-between px-5 shadow rounded p-3 border">
                          <div class="blocked-user-profile d-flex align-items-center" style="gap:6px">
                            <img src="<?php if(empty($profile_image) || $profile_image == NULL){echo "/asset/image/user/profile.png";} else{echo $profile_image;} ?>" style="height:35px;width:35px;" class="rounded-circle" alt="Profile Image">
                            <div class="username fw-semibold">@<?php echo $username; ?></div>
                          </div>
                          <button class="btn btn-outline-warning" onclick="location.href='?content=setting&unblock_id=<?php echo $business_user_id  ?>'">Unblock</button>
                        </div>
        <?php
                    }
                  }
                }
              } else{
                echo "<div class='text-secondary ps-3'>No blocked User </div>";
              }
              ?>
    </div>
  </div>
      </div>
      <?php
    // Assume $current_user_id is set elsewhere
    $two_step_enabled = false; // Default value
    
    if(isset($current_user_id)) {
      $get_verification_status = "SELECT two_step_status FROM customer_verification WHERE c_id = '$current_user_id'";
      $result = mysqli_query($GLOBALS['connect'], $get_verification_status);
      
      if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $two_step_enabled = $row['two_step_status']; // Convert to boolean
      }
      
      // Handle form submission to update user's two-step authentication setting
      if(isset($_GET['security_status'])) {
        if($_GET['security_status'] == 1){
          if($two_step_enabled == 0){
            $update_query = "UPDATE customer_verification SET two_step_status = 1 WHERE c_id = '$current_user_id'";
          } else{
            $update_query = "UPDATE customer_verification SET two_step_status = 0 WHERE c_id = '$current_user_id'";
          }
          // Update the database with the new two-step authentication setting
          // die($update_query);
          // unset($_GET['security_status']);
          mysqli_query($GLOBALS['connect'], $update_query);
          $_GET['security_status'] = 0;
          echo "<script>location.href='/user/customer/dashboard/dashboard.php?content=setting'</script>";
        }
      }
    }
    ?>

<div class="card">
  <div class="card-header" id="headingFive">
    <h2 class="mb-0">
      <button class="btn  m-auto d-flex text-dark fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
        Security
      </button>
    </h2>
  </div>
  <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
    <div class="card-body">
      <div class="security-container d-flex justify-content-between border p-3 rounded shadow">
        <span>Two Step Authentication</span>
                <form method="GET" id="twoStepForm">
                  <div class="form-check form-switch">
                    <?php 
                            if($two_step_enabled == 1){
                              
                              
                        ?>
                        <input class="form-check-input" type="checkbox" name="flexSwitchCheckChecked" id="flexSwitchCheckChecked" checked>
                        <?php
                          } else{
                        ?>
                        <input class="form-check-input" type="checkbox" name="flexSwitchCheckChecked" id="flexSwitchCheckChecked">
                        <?php
                          }
                          ?>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          <script>
            document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("twoStepForm");
    const checkbox = document.getElementById("flexSwitchCheckChecked");
    
    checkbox.addEventListener("change", function() {
      location.href = "/user/customer/dashboard/dashboard.php?content=setting&security_status=1";
    });
  });
</script>

<div class="card">
  <div class="card-header" id="headingThree">
    <h2 class="mb-0">
      <button class="btn  m-auto d-flex text-dark fw-semibold collapsed" type="button" data-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" onclick = "location.href='/webpage/help/help.php'">
        Help
      </button>
    </h2>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn  m-auto d-flex text-dark fw-semibold collapsed" type="button" data-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" onclick="location.href='/webpage/about/about.php'">
          About Us
        </button>
      </h2>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFour">
      <h2 class="mb-0">
        <button class="btn  m-auto d-flex text-danger fw-semibold collapsed" type="button" data-bs-toggle="modal" data-bs-target="#DeleteUserModal" aria-expanded="false" aria-controls="collapseFour">
          Delete Account
        </button>
      </h2>
    </div>
  </div>
</div>


<?php include "unblock_user.php"; ?>
<?php include "delete_user_modal.php"; ?>