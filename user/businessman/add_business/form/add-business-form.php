<?php 
      session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connect2Local - Add Business</title>
  <link rel="stylesheet" href="/asset/css/form.css">
  <?php include "../../../../asset/link/cdn-link.html"; ?>

  <style>
    /* #form-body{
            margin: 0;
            padding: 0;
            /* min-height: 100vh; */
            /* background-size: cover; */
            /* Add your background image or color here */
            /* background: url('/asset/image/background/register_bg.jpg') no-repeat center center fixed; */
            /* Additional styling for the body */
            /* Add other styles as needed */
        
    /* #form-footer{
      position:fixed;
      bottom:0;
    } */
    /* @media only screen and (max-height:750px){
        #form-body{
           overflow-y:scroll;
        }
        .add-form{
          overflow-y:scroll;
          overflow-x:hidden;
        
        }

        #register-form{
          overflow-y:scroll;
          overflow-x:hidden;
        }

        #form-footer{
          position:static !important;
        }
    } */

    @keyframes rotateAndSlideInner {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        #social-icon {
            display: none;
        }

        .social-icon i{
            animation: rotateAndSlideInner .7s ease-in-out forwards;
        }
        .social-icon i:hover{
            color:yellow !important;
        }
  </style>
</head>

<body class="text-bg-dark d-flex flex-column align-items-center p-2" style="height:100vh;width:100%">
        <script>
            path = "/user/businessman/add_business/form/request_info.php";
        </script>
        <?php 

                include "../../../../component/form-alert.php";
                unset($_SESSION['error']);
        ?>
    
    <form action="/user/businessman/add_business/code/add-business-validation.php" method="POST" class="d-flex justify-content-center col-lg-8 col-md-9 col-12 add-form m-auto">
    <!-- <script>
        // Function to set the body height dynamically
        function setBodyHeight() {
            var formBody = document.getElementById('form-body');
            var formElement = document.querySelector('.add-form');

            // Calculate the form height
            var formHeight = formElement.offsetHeight;

            // Set the body height to the form height + 10vh
            formBody.style.height = `calc(${formHeight}px + 10vh)`;
        }

        // Call the function when the window is loaded and resized
        window.onload = setBodyHeight;
        window.onresize = setBodyHeight;
    </script> -->
        <fieldset class="border p-2 col-lg-10 col-12 text-white rounded-2" id="register-form">
            <legend class="text-center fs-2 fw-bold">Add Business</legend>

            <div class="mt-4">
              <div class="row">

              
                <div class="col-6">
                    <input type="text" name="business-name" id="business-name" class="form-control py-2 border border-dark border-2" placeholder="Business Name" value = "<?php if(isset($_SESSION['business-name'])) echo $_SESSION['business-name'] ?>" required>
                </div>
                <div class="col-6">
                                        <select name="category" class="form-select py-2 border border-dark border-2" required>
                                        <option value="" disabled selected>Select Category</option>
                                <?php
                                $categories = array(
                                    'Advertising',
                                    'Clothing',
                                    'Construction',
                                    'Automobile',
                                    'Bicycle',
                                    'Stationary',
                                    'Electronics',
                                    'Education',
                                    'Environment',
                                    'Fashion',
                                    'Beauty Parlor',
                                    'Legal Services',
                                    'Gift Articles',
                                    'Mobile And Computer',
                                    'Restaurants',
                                    'Delivery Services',
                                    'Hospital And Medical Store',
                                    'Others'
                                );

                                foreach ($categories as $category) {
                                    echo '<option value="' . $category . '" ' . isSelected($category) . '>' . $category . '</option>';
                                }

                                function isSelected($category) {
                                    return (isset($_SESSION['category']) && $_SESSION['category'] === $category) ? 'selected' : '';
                                }
                                ?>
                            </select>

                    </div>
                  </div>
                </div>
              

              
              <div class="mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <input type="tel" name="contact" id="contact" class="form-control py-2 border-2 p-2 border-dark" placeholder="Phone Number" value="<?php if(isset($_SESSION['contact'])) echo $_SESSION['contact'];?>" required>
                                </div>

                                <div class="col-6">
                                    <input type="email" name="email" id="email" class="form-control py-2 border-2 p-2 border-dark" placeholder="Email Address" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>" required>        
                              </div>
                            </div>
              </div>

                <div class="mt-3">
                      <textarea name="address" id="address" cols="30" rows="4" class="form-control py-2 border border-2 border-dark" placeholder="Enter your address here.." required><?php if(isset($_SESSION['address'])) echo htmlspecialchars($_SESSION['address']);?></textarea>
                </div>

                <div class="mt-3">
    <div class="input-group">
        <span class="input-group-text">Operating Time</span>
        <input type="text" class="form-control py-2" name="operating-time" id="operating-time" placeholder="Select operating time" value="<?php if(isset($_SESSION['operate-time'])) echo $_SESSION['operate-time'];?>">
    </div>
    <div id="time-fields" class="p-2" style="display: none;">
        <div class="row mt-3">
            <div class="col-lg-6 col-md-6 col-12 g-2">
                <label for="start_day">Start Day:</label>
                <select class="form-select py-2" id="start_day" name="start_day" onchange="updateOperatingTime()">
                    <option value="mon">Monday</option>
                    <option value="tue">Tuesday</option>
                    <option value="wed">Wednesday</option>
                    <option value="thu">Thursday</option>
                    <option value="fri">Friday</option>
                    <option value="sat">Saturday</option>
                    <option value="sun">Sunday</option>
                </select>
            </div>
            <div class="col-lg-6 col-md-6 col-12 g-2">
                <label for="end_day">End Day:</label>
                <select class="form-select py-2" id="end_day" name="end_day" onchange="updateOperatingTime()">
                    <option value="mon">Monday</option>
                    <option value="tue">Tuesday</option>
                    <option value="wed">Wednesday</option>
                    <option value="thu">Thursday</option>
                    <option value="fri">Friday</option>
                    <option value="sat">Saturday</option>
                    <option value="sun">Sunday</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6 col-md-6 col-12 g-2">
                <label for="start_time">Start Time:</label>
                <input type="time" class="form-control py-2" id="start_time" name="start_time" onchange="updateOperatingTime()">
            </div>
            <div class="col-lg-6 col-md-6 col-12 g-2">
                <label for="end_time">End Time:</label>
                <input type="time" class="form-control py-2" id="end_time" name="end_time" onchange="updateOperatingTime()">
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="input-group">
            <span class="input-group-text">Web URL</span>
            <input type="text" class="form-control py-2" name="web-url" id="web-url" placeholder="Enter web URL" value="<?php if(isset($_SESSION['web-url'])) echo $_SESSION['web-url'];?>">
        </div>
    </div>

    <div class="mt-3">
        
        <div id="social-links" class="mt-2 p-2">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 g-2">
                    <div class="input-group">
                        <input type="text" class="form-control py-2" name="insta-link" placeholder="Instagram link" value="<?php if(isset($_SESSION['insta-url'])) echo $_SESSION['insta-url'];?>">
                        <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 g-2">
                    <div class="input-group">
                        <input type="text" class="form-control py-2" name="fb-link" placeholder="Facebook link" value="<?php if(isset($_SESSION['fb-url'])) echo $_SESSION['fb-url'];?>">
                        <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-6 col-md-6 col-12 g-2">
                    <div class="input-group">
                        <input type="text" class="form-control py-2" name="linkedin-link" placeholder="LinkedIn link" value="<?php if(isset($_SESSION['linkedin-url'])) echo $_SESSION['linkedin-url'];?>">
                        <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 g-2">
                    <div class="input-group">
                        <input type="text" class="form-control py-2" name="twit-link" placeholder="Twitter link" value="<?php if(isset($_SESSION['x-url'])) echo $_SESSION['x-url'];?>">
                        <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to show time fields when operating time input is clicked
    document.getElementById('operating-time').addEventListener('click', function() {
        document.getElementById('time-fields').style.display = 'block';
    });

    // Function to update operating time input based on time field selections
    function updateOperatingTime() {
        var startDay = document.getElementById('start_day').value;
        var endDay = document.getElementById('end_day').value;
        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;

        var startDayName = document.getElementById('start_day').options[document.getElementById('start_day').selectedIndex].text;
        var endDayName = document.getElementById('end_day').options[document.getElementById('end_day').selectedIndex].text;

        var formattedStartTime = formatTime(startTime);
        var formattedEndTime = formatTime(endTime);

        var operatingTime = startDayName.substring(0, 3) + ' - ' + endDayName.substring(0, 3) + ' ' + formattedStartTime + '-' + formattedEndTime;

        document.getElementById('operating-time').value = operatingTime;
    }

    // Function to format time to 12-hour format
    function formatTime(time) {
        var hours = parseInt(time.substring(0, 2));
        var minutes = time.substring(3, 5);
        var ampm = hours >= 12 ? 'p.m.' : 'a.m.';
        hours = hours % 12;
        hours = hours ? hours : 12;
        var formattedTime = hours + ':' + minutes + ' ' + ampm;
        return formattedTime;
    }
   
</script>

                <div class="mt-3">
                      <textarea name="description" id="description" cols="30" rows="5" class="form-control py-2 border border-dark border-2" placeholder="Tell About Your Business" required><?php if(isset($_SESSION['description'])) echo htmlspecialchars($_SESSION['description']);?></textarea>
                </div>

                <div class="mt-4 d-flex">
                      <input type="submit" value="Submit" name="submit" id="register-btn" class="text-white border-light py-3 px-5 rounded-pill mx-auto">
                </div>
        </fieldset>  
    </form>
    
    <?php //include "../../../../component/form-footer.php"; ?>
</body>
</html>