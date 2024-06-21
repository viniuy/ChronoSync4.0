<?php
session_start();
session_unset();
session_destroy();
require_once "auth/important/session.php";
require_once "auth/login/login_view.php";
require_once "auth/register/signup_view.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css">
    <title>Login</title>
</head>

<style>
@keyframes float {
    0% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-15px); /* Adjust the value for how much you want it to move up */
    }
    100% {
        transform: translateY(0);
    }
}

.sd-shape {
    animation: float 3s linear infinite;
    width: auto; /* Adjust the width as needed */
    position: absolute; /* Use absolute positioning to place it at the left end */
    left: 5%; /* Align to the left end */
    transform: translateY(-50%) scale(1.1); /* Center the image vertically and scale it */
    z-index: 1;
}

/* Hide .sd-shape on small screens */
@media (max-width: 768px) {
    .sd-shape {
        display: none;
    }
}

.sd-shape1 {
    animation: float 4s linear infinite;
    width:400px; /* Adjust the width as needed */
    height: 400px; /* Adjust the width as needed */

    position: relative; /* Use absolute positioning to place it at the left end */
    top: -20%; /* Align to the left end */
    right: 10%;
    transform: translateY(-10%) scale(1.2); /* Center the image vertically and scale it */
    z-index: 1;
}

/* Hide .sd-shape on small screens */
@media (max-width: 900px) {
    .sd-shape1 {
        display: none;
    }
}

.blob {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 380px; /* Adjust width as needed */
    height: 380px; /* Adjust height as needed */
    animation: animate 5s ease-in-out infinite;
    transition: all 1s ease-in-out;
    z-index: 1;
}

@keyframes animate {
    0%, 100% {
        border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
    }
    50% {
        border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
    }
}

</style>

<body>
    <div class="container">
        <?php
        require_once('auth/important/sqlconnect.php');
        ?>
        <div class="login__image-container">
            <img src="images/bluebackground.png" alt="login image" class="login__img">

        </div>
        <img src="images/animatedlogo.png" alt="login image" class="login__img sd-shape">
        
        <!-- modal -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        <img src="images/playicon.png" alt="login image" class="login__img sd-shape1" data-toggle="modal" data-target="#videoModal">

    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">ChronoSync Product Demo Video </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <video id="manualVideo" width="100%" controls>
                        <source src="images/imp/manual.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#videoModal').on('hidden.bs.modal', function () {
            var video = document.getElementById("manualVideo");
            video.pause();
            video.currentTime = 0;
        });
    </script>

        

        <form id="login-form" class="login__form" action="auth/login/login.php" method="post">
            <!-- <img src="images/LOGO-ChronoSync.png" alt="Logo" class="logo"> -->
            <h1 class="login__title">LOGIN</h1>
            <div class="login__content">
                
                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="email" name="email" required class="login__input" id="email" placeholder=" " value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        <label for="email" class="login__label">Email</label>
                    </div>
                </div>
                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="password" name="password" required minlength="8" class="login__input" id="password" placeholder=" ">
                        <label for="password" class="login__label">Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                    </div>
                </div>
            </div>
            <button type="submit" class="login__button" name="submit">Login</button>
            <p class="links">
                Don't have an account? <a href="register.php">Register</a>
            </p>
        </form>
    </div>
    <script src='js/show_password.js'></script>
</body>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</html>