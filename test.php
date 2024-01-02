<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            background-color: #333;
            padding: 10px;
        }

        .navbar-brand img {
            max-height: 60px;
            width: auto;
        }

        .navbar-toggler {
            border: 1px solid #fff;
        }

        .navbar-nav {
            flex-direction: column;
            text-align: center;
        }

        .navbar-nav .nav-item {
            margin: 10px 0;
        }

        .register {
            margin-top: 10px;
        }

        .menu-bar-icon {
            display: none;
        }

        @media (max-width: 768px) {
            .navbar-nav {
                flex-direction: row;
            }

            .navbar-nav .nav-item {
                margin: 0;
            }

            .register {
                margin-top: 0;
            }

            .menu {
                display: none;
            }

            .menu-bar-icon {
                display: block;
            }

            .offcanvas-body {
                padding: 15px;
            }
        }
    </style>
    <title>Your Website</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark position-fixed">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <!-- Replace the placeholder with your logo -->
                <img src="/asset/image/logo.png" alt="Your Logo">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto d-flex" style="gap:7px">
                    <li class="nav-item"><a href="#" class="nav-link text-white d-flex flex-column"><i
                                class="fa-solid fa-house mx-1"></i> Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white d-flex flex-column"><i
                                class="fa-solid fa-address-card mx-1"></i> About</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white d-flex flex-column"><i
                                class="fas fa-cogs mx-1"></i> Service</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white d-flex flex-column"><i
                                class="fas fa-phone mx-1"></i> Contact</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white d-flex flex-column"><i
                                class="fas fa-pencil-alt mx-1"></i> Blog</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white d-flex flex-column"><i
                                class="fas fa-question-circle mx-1"></i> Help</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white d-flex flex-column"><i
                                class="fas fa-file-alt mx-1"></i> Term & Condition</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white d-flex flex-column"><i
                                class="fas fa-shield-alt mx-1"></i> Privacy Policy</a></li>
                </ul>

                <div class="register ms-lg-3">
                    <button class="btn btn-primary px-4 py-2 user-auth-btn"
                        onclick="location.href='/component/choice.php'">Sign Up</button>
                    <button class="btn btn-info px-4 py-2 user-auth-btn">Login</button>
                    <button class="btn btn-success py-2 px-3 ms-2" id="add-new-btn"><i
                            class="fas fa-plus shadow border rounded-circle p-1"></i> Add Business</button>
                </div>
            </div>

            <div class="menu-bar-icon">
                <i class="fa-solid fa-bars fs-4 text-white" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"></i>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-white ps-3" id="offcanvasRightLabel">Menu</h5>
            <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="register d-flex justify-content-center" style="gap:15px">
                <button id="sign-up-btn" class="btn btn-primary px-4 py-2 rounded-pill"
                    onclick="location.href='/component/choice.php'">Sign Up</button>
                <button id="login-btn" class="btn btn-info px-4 py-2 rounded-pill">Login</button>
            </div>
            <div class="menu d-flex justify-content-center mt-3">
                <ul class="list-unstyled text-white text-center">
                    <li class="nav-item"><a href="#" class="nav-link fs-5"><i
                                class="fas fa-house mx-1"></i> Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link fs-5"><i
                                class="fas fa-address-card mx-1"></i> About</a></li>
                    <li class="nav-item"><a href="#" class="nav-link fs-5"><i
                                class="fas fa-cogs mx-1"></i> Service</a></li>
                    <li class="nav-item"><a href="#" class="nav-link fs-5"><i
                                class="fas fa-phone mx-1"></i> Contact</a></li>
                    <li class="nav-item"><a href="#" class="nav-link fs-5"><i
                                class="fas fa-pencil-alt mx-1"></i> Blog</a></li>
                    <li class="nav-item"><a href="#" class="nav-link fs-5"><i
                                class="fas fa-question-circle mx-1"></i> Help</a></li>
                    <li class="nav-item"><a href="#" class="nav-link fs-5"><i
                                class="fas fa-file-alt mx-1"></i> Term & Condition</a></li>
                    <li class="nav-item"><a href="#" class="nav-link fs-5"><i
                                class="fas fa-shield-alt mx-1"></i> Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
