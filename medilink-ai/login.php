<?php

session_start();

include "config/db.php";
$success = "";

if(isset($_GET['success'])){

    $success =
    "<div class='alert success'>
    Registration Successful.
    Please Login.
    </div>";
}
if(isset($_SESSION['user'])){

    header("Location: dashboard.php");
}

if(isset($_POST['login'])){

    $email = $_POST['email'];

    $password = $_POST['password'];

    $sql =
    "SELECT * FROM users
    WHERE email='$email'
    AND password='$password'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        $_SESSION['user'] = $email;

        header("Location: dashboard.php");
    }

    else{

        $error = "Invalid Email or Password";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MediLink AI Login</title>

    <link rel="stylesheet" href="css/login.css">

</head>

<body>

<div class="login-page">

    <!-- BACKGROUND GLOW -->

    <div class="bg-glow glow1"></div>
    <div class="bg-glow glow2"></div>

    <!-- LOGIN CARD -->

    <div class="login-container">

        <!-- LEFT CONTENT -->

        <div class="login-left">

            <div class="brand">
                <h1>MediLink AI</h1>
                <span>Emergency Healthcare Intelligence</span>
            </div>

            <div class="hero-content">

                <h2>
                    AI-Powered Healthcare Monitoring Platform
                </h2>

                <p>
                    Real-time emergency analytics,
                    patient monitoring, intelligent
                    AI assessment and hospital assistance.
                </p>

            </div>

            <div class="feature-list">

                <div class="feature-box">
                    🚨 Live Emergency Detection
                </div>

                <div class="feature-box">
                    📊 Real-Time AI Analytics
                </div>

                <div class="feature-box">
                    🏥 Smart Hospital Connectivity
                </div>

            </div>

        </div>

        <!-- RIGHT LOGIN -->

        <div class="login-right">

            <div class="login-card">

                <div class="heart-icon">
                    ❤️
                </div>

                <h2>Welcome Back</h2>

                <p>
                    Login to continue using MediLink AI
                </p>

                <?php echo $success; ?>

<?php
if(isset($error)){
echo "<div class='alert error'>$error</div>";
}
?>

                <form method="POST">

                    <input type="email"
                           name="email"
                           placeholder="Enter Email"
                           required>

                    <input type="password"
                           name="password"
                           placeholder="Enter Password"
                           required>

                    <button type="submit"
                            name="login">

                        Login

                    </button>

                </form>

                <a href="register.php"
                   class="create-account">

                    Create New Account

                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>