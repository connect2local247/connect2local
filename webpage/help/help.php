<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Help</title>
  <?php include "../../asset/link/cdn-link.html"; ?>
  <link rel="stylesheet" href="/asset/css/style.css">
  <style>
    /* Global styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #fafafa;
    }
    .container {
      /* max-width: 800px; */
      margin: auto;
      padding: 20px;
    }
    /* Dropdown styles */
    .dropdown-item {
      padding: 10px;
      cursor: pointer;
    }

    .vertical-bar::-webkit-scrollbar {
  width: 0px;  /* Remove scrollbar space */
  background: transparent;  /* Optional: just make scrollbar invisible */
}
  </style>
</head>
<body class="vertical-bar text-white" id="home-body">
  <?php include "../../component/navbar.php"; ?>
  <div class="container" style="min-height:calc(100vh - 30px)">
    <div class="search-container" style="margin-top:130px">
      <form action="" class="search d-flex  position-relative">
        <input type="search" class="form-control rounded-pill py-2 px-3 border-dark" placeholder="Search here.." name="search" id="search">
        <i class="fa-solid fa-magnifying-glass position-absolute top-0 end-0 me-3 text-dark" style="margin:13px"></i>
      </form>
    </div>
    <div class="dropdown mt-4">
      <button class="accordion-button fs-5" id="registrationHeading" onclick="toggleDropdown('registrationDropdown')">
        How to Register on our Platform or System ?
      </button>
      <div id="registrationDropdown" class="dropdown-content" style="display: none;">
        <!-- Step 1: Choosing User Type -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 1: Choose User Type</h2>
          <p>Choose whether you want to register as a <strong>Customer</strong> or a <strong>Business</strong>.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Input: Selecting "Customer" or "Business" as per your role.</li>
            <li>Inappropriate Input: Not selecting any user type.</li>
          </ul>
        </div>
        <!-- Step 2: Fill Basic Details -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 2: Fill Basic Details</h2>
          <p>Fill in your basic details including first name, last name, email, gender, date of birth, contact number, and password.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Input:
              <ul>
                <li>First Name: John</li>
                <li>Last Name: Doe</li>
                <li>Email: johndoe@gmail.com</li>
                <li>Gender: Male</li>
                <li>Date of Birth: 1990-01-01</li>
                <li>Contact Number: 1234567890</li>
                <li>Password: Example@123</li>
              </ul>
            </li>
            <li>Inappropriate Input:
              <ul>
                <li>Leaving any required field blank.</li>
                <li>Entering invalid email format.</li>
                <li>Providing a weak password.</li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- Step 3: Additional Details for Business -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 3: Additional Details for Business</h2>
          <p>If registering as a business, provide additional details including shop address and category.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Input:
              <ul>
                <li>Shop Address: 123 Main St, City, State</li>
                <li>Category: Clothing</li>
              </ul>
            </li>
            <li>Inappropriate Input:
              <ul>
                <li>Entering incomplete shop address.</li>
                <li>Selecting an invalid or irrelevant category.</li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>


  <div class="dropdown">
      <button class="accordion-button fs-5" id="loginHeading" onclick="toggleDropdown('loginDropdown')">
        How to Login to Our System?
      </button>
      <div id="loginDropdown" class="dropdown-content" style="display: none;">
        <!-- Step 1: Enter Credentials -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 1: Enter Credentials</h2>
          <p>Enter your email and password in the login form.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Input: Entering valid email and password.</li>
            <li>Inappropriate Input: Leaving email or password field blank.</li>
          </ul>
        </div>
        <!-- Step 2: Two-step Authentication -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 2: Two-step Authentication (if enabled)</h2>
          <p>If two-step authentication is enabled, enter the verification code sent to your email.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Input: Entering correct verification code.</li>
            <li>Inappropriate Input: Entering incorrect verification code.</li>
          </ul>
        </div>
        <!-- Step 3: Account Creation -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 3: Account Creation</h2>
          <p>If you don't have an account, click on the "Create an Account" link to register.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Clicking on "Create an Account" link.</li>
            <li>Inappropriate Action: Trying to login without registering.</li>
          </ul>
        </div>
        <!-- Step 4: Password Recovery -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 4: Password Recovery</h2>
          <p>If you forgot your password, click on the "Forgot Password" link to reset it.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Clicking on "Forgot Password" link and following the instructions.</li>
            <li>Inappropriate Action: Trying to guess the password multiple times.</li>
          </ul>
        </div>
      </div>
    </div>

  <div class="dropdown">
      <button class="accordion-button fs-5" id="searchHeading" onclick="toggleDropdown('searchDropdown')">
        How to Search for Businesses?
      </button>
      <div id="searchDropdown" class="dropdown-content" style="display: none;">
        <!-- Step 1: Login -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 1: Login</h2>
          <p>Login to your account to access the search functionality.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Enter valid credentials and login.</li>
            <li>Inappropriate Action: Trying to access search without logging in.</li>
          </ul>
        </div>
        <!-- Step 2: Access Search -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 2: Access Search</h2>
          <p>Once logged in, go to your dashboard and click on the "Search" link.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Click on the "Search" link in the dashboard.</li>
            <li>Inappropriate Action: Skipping to search without logging in.</li>
          </ul>
        </div>
        <!-- Step 3: Perform Search -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 3: Perform Search</h2>
          <p>In the search bar, enter your search query and select the search type as "Search Business". You can filter the search results by category, business name, or username.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Select "Search Business" and enter search query with filters.</li>
            <li>Inappropriate Action: Leaving search bar blank or selecting incorrect search type.</li>
          </ul>
        </div>
        <!-- Step 4: View Results -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 4: View Results</h2>
          <p>After performing the search, you'll see a list of businesses matching your criteria. Click on a business to view its profile.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Click on "View Profile" to see detailed information about the business.</li>
            <li>Inappropriate Action: Ignoring search results or closing the search without checking.</li>
          </ul>
        </div>
        <!-- Step 5: No Results Found -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 5: No Results Found</h2>
          <p>If no businesses match your search criteria, a message will be displayed indicating "No Search Found".</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Refine your search criteria and try again.</li>
            <li>Inappropriate Action: Assuming no businesses exist without refining search.</li>
          </ul>
        </div>
      </div>
    </div>



  <div class="dropdown">
      <button class="accordion-button fs-5" id="blogHeading" onclick="toggleDropdown('blogDropdown')">
        How to Search and View Blogs?
      </button>
      <div id="blogDropdown" class="dropdown-content" style="display: none;">
        <!-- Step 1: Navigate to Blog Section -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 1: Navigate to Blog Section</h2>
          <p>If not registered, you can access the blog section from the navbar. Registered users can also access it from the dashboard.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Click on the "Blog" link in the navbar or dashboard menu.</li>
            <li>Inappropriate Action: Trying to access blogs without proper navigation.</li>
          </ul>
        </div>
        <!-- Step 2: Perform Search -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 2: Perform Search</h2>
          <p>In the blog section, use the search bar to search for blogs by title.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Enter the title of the blog you're looking for in the search bar.</li>
            <li>Inappropriate Action: Not using the search feature to find specific blogs.</li>
          </ul>
        </div>
        <!-- Step 3: View Blogs -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 3: View Blogs</h2>
          <p>Once you've searched for a blog, you'll see a list of relevant blogs matching your search criteria.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Click on a blog title to view its content and details.</li>
            <li>Inappropriate Action: Ignoring search results or not clicking on any blog.</li>
          </ul>
        </div>
        <!-- Step 4: Comment and Share (For Registered Users) -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 4: Comment and Share (For Registered Users)</h2>
          <p>If you're a registered user, you can comment on and share blogs from the blog section.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Commenting on a blog or sharing it with others.</li>
            <li>Inappropriate Action: Trying to comment or share without being logged in.</li>
          </ul>
        </div>
        <!-- Step 5: No Blogs Found -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 5: No Blogs Found</h2>
          <p>If no blogs match your search criteria, a message will be displayed indicating "No Blogs Found".</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Refine your search criteria and try again.</li>
            <li>Inappropriate Action: Assuming no blogs exist without refining search.</li>
          </ul>
        </div>
      </div>


      <div class="dropdown">
      <button class="accordion-button fs-5" id="addBusinessHeading" onclick="toggleDropdown('addBusinessDropdown')">
        How to Add Your Business?
      </button>
      <div id="addBusinessDropdown" class="dropdown-content" style="display: none;">
        <!-- Step 1: Navigate to Add Business -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 1: Navigate to Add Business</h2>
          <p>If you're registered, click on the "Add Business" link in the navigation bar of the home page. If you're logged in to your dashboard, click on the shop icon in the dashboard navigation.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Click on "Add Business" link or shop icon.</li>
            <li>Inappropriate Action: Trying to add business without proper navigation.</li>
          </ul>
        </div>
        <!-- Step 2: Fill Business Details -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 2: Fill Business Details</h2>
          <p>Complete the add business form by providing mandatory details such as business name, category, address, email, and contact. You can also fill optional fields like opening hours, website, and social media links.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Fill in all required fields accurately.</li>
            <li>Inappropriate Action: Leaving mandatory fields blank or providing incorrect information.</li>
          </ul>
        </div>
        <!-- Step 3: Submit Form -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 3: Submit Form</h2>
          <p>After filling in the form, submit it. If all the required fields are properly filled, you will receive an email confirmation and be redirected to a page with a greeting message.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Click on "Submit" button after completing the form.</li>
            <li>Inappropriate Action: Trying to submit the form with incomplete or incorrect information.</li>
          </ul>
        </div>
        <!-- Step 4: Await Admin Approval -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 4: Await Admin Approval</h2>
          <p>Once you submit the form, await admin approval. You will receive an email notifying you whether your request has been accepted or denied.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Check your email for updates on your business request.</li>
            <li>Inappropriate Action: Trying to add business again without waiting for admin approval.</li>
          </ul>
        </div>
        <!-- Step 5: No Resubmission -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 5: No Resubmission</h2>
          <p>Once your request is denied or approved, there is no mechanism to request to add your business again. Respect the admin's decision.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Abide by the admin's decision and take necessary steps accordingly.</li>
            <li>Inappropriate Action: Attempting to resubmit the business request after denial.</li>
          </ul>
        </div>
      </div>
    </div>



    <div class="dropdown">
      <button class="accordion-button fs-5" id="contactBusinessHeading" onclick="toggleDropdown('contactBusinessDropdown')">
        How to Contact Any Business?
      </button>
      <div id="contactBusinessDropdown" class="dropdown-content" style="display: none;">
        <!-- Step 1: Navigate to Business Profile -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 1: Navigate to Business Profile</h2>
          <p>If you're a registered user, use the search functionality to find the business you want to contact. Click on the business profile to view details.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Use search to find business and view profile.</li>
            <li>Inappropriate Action: Trying to contact business without viewing its profile.</li>
          </ul>
        </div>
        <!-- Step 2: Access Contact Options -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 2: Access Contact Options</h2>
          <p>In the business profile, locate the contact option usually found at the right corner or beside the share button.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Click on the contact option to proceed.</li>
            <li>Inappropriate Action: Ignoring contact option and trying to contact through other means.</li>
          </ul>
        </div>
        <!-- Step 3: Choose Contact Method -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 3: Choose Contact Method</h2>
          <p>After clicking on the contact option, a drawer from the bottom will open with options to contact via email or phone number.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Select email or phone number based on your preference.</li>
            <li>Inappropriate Action: Not selecting any contact method and closing the drawer.</li>
          </ul>
        </div>
        <!-- Step 4: Contact via Email -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 4: Contact via Email</h2>
          <p>If you choose to contact via email, clicking on the email button will redirect you to your email account app.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Use your email app to compose and send an email.</li>
            <li>Inappropriate Action: Trying to contact through email without having an email account set up.</li>
          </ul>
        </div>
        <!-- Step 5: Contact via Phone Number -->
        <div class="dropdown-item">
          <h2 class="fs-5" style="font-size:14px">Step 5: Contact via Phone Number</h2>
          <p>If you choose to contact via phone number, clicking on the phone number will redirect you to the phone dialer app.</p>
          <p>Example:</p>
          <ul>
            <li>Appropriate Action: Use your phone dialer to call the provided phone number.</li>
            <li>Inappropriate Action: Trying to contact through phone without having a phone dialer app.</li>
          </ul>
        </div>
      </div>
    </div>


    </div>
</div>
  <script>
    function toggleDropdown(id) {
      var dropdown = document.getElementById(id);
      dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
    }
  </script>
  <?php include "../../component/footer.php"; ?>
</body>
</html>
