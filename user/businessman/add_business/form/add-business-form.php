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
    #form-footer{
      position:fixed;
      bottom:0;
    }
    @media only screen and (max-height:750px){
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
    }

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
        <script>
            // path = "/user/businessman/register/form/email_verification.php";
        </script>
        <?php 

                include "../../../../component/form-alert.php";
                unset($_SESSION['error']);
        ?>

<body id="form-body" class="d-flex flex-column align-items-center " style="max-height:100vh;height:100vh;width:100%;background-size:cover; ">
    <div class="container m-auto p-1">
    <form action="/user/businessman/add_business/code/add-business-validation.php" method="POST" class="d-flex justify-content-center col-lg-8 col-md-9 col-12 m-auto add-form" style="max-height:100vh">
        <fieldset class="border p-2 col-lg-10 col-12 text-white rounded-2 h-75" id="register-form">
            <legend class="text-center fs-2 fw-bold">Add Business</legend>

            <div class="mt-4">
              <div class="row">

              
                <div class="col-6">
                    <input type="text" name="business-name" id="business-name" class="form-control border border-dark border-2" placeholder="Business Name" value = "<?php if(isset($_SESSION['business-name'])) echo $_SESSION['business-name'] ?>" required>
                </div>
                <div class="col-6">
                                        <select name="category" class="form-select border border-dark border-2" required>
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
                                    <input type="tel" name="contact" id="contact" class="form-control border-2 p-2 border-dark" placeholder="Phone Number" value="<?php if(isset($_SESSION['contact'])) echo $_SESSION['contact'];?>" required>
                                </div>

                                <div class="col-6">
                                    <input type="email" name="email" id="email" class="form-control border-2 p-2 border-dark" placeholder="Email Address" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>" required>        
                              </div>
                            </div>
              </div>

                <div class="mt-3">
                      <textarea name="address" id="address" cols="30" rows="4" class="form-control border border-2 border-dark" placeholder="Enter your address here.." value="<?php if(isset($_SESSION['address']))  echo $_SESSION['address'] ?>" required></textarea>
                </div>

                <div class="mt-3">
                     <input name="operating-time" id="operating-time" class="form-control border border-dark border-2" placeholder="Opening Hours" value="<?php  if(isset($_SESSION['operating-time'])) echo $_SESSION['opeating-time']?>"></input>
                </div>

                <div class="mt-3 position-relative d-flex flex-column align-items-center" id="url-container">
                  
                      <input type="text" name="web-url" id="web-url" class="form-control border border-dark border-2" placeholder="url: https://www.example.com" value="<?php if(isset($_SESSION['web-url'])) echo $_SESSION['web-url']?>">
                        <div class="row" id="input-container">
                                     
                        </div>
                      <div class="d-flex align-items-center h-100">
                        <i class="fa-solid fa-plus position-absolute top-0 end-0 mt-2 p-1 me-2 text-bg-dark rounded-circle" id="plus-icon"></i>
                        <div class="d-none social-icon d-flex flex-column fs-5 position-absolute end-0  ms-5 p-2 rounded" style="gap:10px;margin-bottom:165px;background:linear-gradient(rgba(0, 8, 6, 0.985),rgba(0, 0, 0, 0.882));" id="social-icon">
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-linkedin"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-solid fa-minus" id="minus-icon"></i>
                       
                        <script>
  // Function to create and append an input element
  function appendInputElement(container, type,placeholder,name) {
    var inputElement = document.createElement('input');
    inputElement.setAttribute('type', type);
      inputElement.setAttribute('class',"form-control col-5 border-dark border border-2");
    inputElement.setAttribute('placeholder',placeholder);
    inputElement.setAttribute('name',name)
    container.appendChild(inputElement);
    
  }

  // Toggle visibility of socialIcon container
  function toggleSocialIconVisibility() {
    var socialIcon = document.getElementById('social-icon');
    socialIcon.classList.toggle('d-none');
  }

  // Event listener for plusIcon
  document.getElementById('plus-icon').addEventListener('click', function() {
    toggleSocialIconVisibility();
  });

  // Event listener for minusIcon
  document.getElementById('minus-icon').addEventListener('click', function() {
    toggleSocialIconVisibility();
  });

  // Event listener for instaIcon
  document.querySelector('.fa-instagram').addEventListener('click', function() {
    var inputContainer = document.getElementById('input-container');
    appendInputElement(inputContainer, 'text',"instagram url",'insta-link');
    this.removeEventListener('click', arguments.callee); 
  });

  document.querySelector('.fa-facebook').addEventListener('click', function() {
    var inputContainer = document.getElementById('input-container');
    appendInputElement(inputContainer, 'text',"facebook url",'fb-link');
    this.removeEventListener('click', arguments.callee); 

  });

  document.querySelector('.fa-twitter').addEventListener('click', function() {
    var inputContainer = document.getElementById('input-container');
    appendInputElement(inputContainer, 'text',"twitter url",'twit-link');
    this.removeEventListener('click', arguments.callee); 

  });

  document.querySelector('.fa-linkedin').addEventListener('click', function() {
    var inputContainer = document.getElementById('input-container');
    appendInputElement(inputContainer, 'text',"linkedin url",'linkedin-link');
    this.removeEventListener('click', arguments.callee); 

    
  });

  // Add similar event listeners for other social icons if needed
</script>

                  </div>
                  
                      </div>
                      
                </div>
                

                <div class="mt-3">
                      <textarea name="description" id="description" cols="30" rows="5" max="100" class="form-control border border-dark border-2" placeholder="Tell About Your Business" value="<?php  if(isset($_SESSION['description'])) echo $_SESSION['description']?>" required></textarea>
                </div>

                <div class="mt-4 d-flex">
                      <input type="submit" value="Submit" name="submit" id="register-btn" class="text-white border-light py-3 px-5 rounded-pill mx-auto">
                </div>
        </fieldset>  
    </form>
    </div>
    <?php include "../../../../component/form-footer.php"; ?>
</body>
</html>