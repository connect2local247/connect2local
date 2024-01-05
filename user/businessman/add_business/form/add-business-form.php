<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="/asset/css/style.css"> -->
    <link rel="stylesheet" href="/asset/css/form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="/asset/image/favicon/favicon.ico" sizes="192 x 192" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"> </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <style>
    .popup-container {
      display: none;
      position: absolute;
      top: 40px;
      right: 0;
      background-color: #fff;
      border: 1px solid #ccc;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 10px;
      z-index: 1000;
    }

    .popup-container i {
      margin: 0 5px;
      cursor: pointer;
    }
  </style>

</head>
<body id="form-body" style="width:100%;">
    <form action="" method="post" style="height:calc(100vh + 10vh); width:100%;" class="p-2 col-lg-9 col-md-10 col-12 d-flex align-items-center">
        <fieldset class="border p-3 bg-gradient rounded-2 col-lg-6 col-md-10 col-12 text-white" style="margin:auto" id="register-form">
            <legend class="text-center fs-2 fw-bold">Add Business</legend>
            <div class="mt-5">
                <div class="row">
                    <div class="col-6">
                        <input type="text" name="company-name" id="company-name" class="form-control border-2 p-2 border-dark" placeholder="Company Name" value="<?php if(isset($_SESSION['company-name'])) echo $_SESSION['company-name'];?>"  required>
                    </div>

                    <div class="col-6">
                        <select name="category" class="form-select" required>
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
                </div>
        </div>

        <div class="mt-4">
            <div class="row">
                                
                                <div class="col-6">
                                    <input type="email" name="email" id="email" class="form-control border-2 p-2 border-dark" placeholder="Email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>" required>
                                </div>
                                <div class="col-6">
                                    <input type="tel" name="contact" id="contact" class="form-control border-2 p-2 border-dark" placeholder="Phone Number" value="<?php if(isset($_SESSION['contact'])) echo $_SESSION['contact'];?>" required>
                                </div>
            </div>
        </div>
        
        <div class="mt-3">
            <textarea name="address" class="form-control border border-2 border-dark" placeholder="Your Address" id="address" cols="30" rows="4"></textarea>
        </div>
        <div class="mt-3">
            <input type="text" name="operating-time" id="operating-time" class="form-control" placeholder="Operating Hours">
        </div>

        <div class="mt-3">
        <div class="position-relative">
  <input type="text" class="form-control border border-dark border-2 py-2" name="web-url" id="web-url" placeholder="http://www.example.com">
  <div class="popup-container position-absolute" id="socialPopup">
    <i class="fab fa-linkedin"></i>
    <i class="fab fa-instagram"></i>
    <i class="fab fa-twitter"></i>
    <i class="fab fa-facebook"></i>
  </div>
  <i id="togglePassword" class="fas fa-plus text-bg-dark border rounded-circle position-absolute bottom-0 end-0 p-2 mb-2 me-2" style="font-size:13px"></i>
</div>

<script>
  const togglePassword = document.getElementById('togglePassword');
  const socialPopup = document.getElementById('socialPopup');

  togglePassword.addEventListener('click', () => {
    socialPopup.style.display = (socialPopup.style.display === 'none' || socialPopup.style.display === '') ? 'block' : 'none';
  });

  document.addEventListener('click', (event) => {
    if (!event.target.matches('#togglePassword') && !event.target.closest('.popup-container')) {
      socialPopup.style.display = 'none';
    }
  });
</script>        
</div>
<div class="mt-3">
    <textarea name="description" id="" cols="30" rows="5" class="form-control border-dark" placeholder="Tell About Your Business"></textarea>
</div>

<div class="mt-3 d-flex justify-content-center">
                            <input type="submit" value="Submit" name="submit" class="btn border text-white bg-primary bg-gradient py-3 px-5 fs-5 rounded-pill" id="register-btn">
                    </div>
        </fieldset>
    </form>


    <?php include "/connect2local/component/form-footer.php"; ?>
</body>
</html>