
<?php

include "config/db.php";

$message = "";

if(isset($_POST['register'])){

    $fullname =
    mysqli_real_escape_string(
    $conn,
    $_POST['name']
    );

    $email =
    mysqli_real_escape_string(
    $conn,
    $_POST['email']
    );

    $password =
    mysqli_real_escape_string(
    $conn,
    $_POST['password']
    );

    // CHECK EXISTING USER

    $checkUser =
    mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE email='$email'"
    );

    if(mysqli_num_rows($checkUser) > 0){

        $message =
        "<div class='alert error'>
        User already registered.
        </div>";
    }

    else{

        // INSERT USER

        $insert =
        mysqli_query(
        $conn,
        "INSERT INTO users(
        fullname,
        email,
        password
        )

        VALUES(
        '$fullname',
        '$email',
        '$password'
        )"
        );

        if($insert){

            header("Location: login.php?success=1");
            exit();
        }

        else{

            $message =
            "<div class='alert error'>
            Registration Failed.
            </div>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>MediLink AI Register</title>

<link rel="stylesheet"
href="css/auth.css">

</head>

<body>

<div class="auth-container">

    <!-- LEFT SIDE -->

    <div class="left-side">

        <div class="brand">
            MediLink AI
        </div>

        <span class="tagline">
            AI Emergency Healthcare Platform
        </span>

        <h1>
            Smart Healthcare
            Registration System
        </h1>

        <p class="description">

            Create your MediLink AI account
            to access intelligent emergency
            monitoring, AI healthcare analytics,
            hospital connectivity and real-time
            patient assessment.

        </p>

        <div class="stats-row">

            <div class="stat-card">
                <h2>24/7</h2>
                <span>Emergency Monitoring</span>
            </div>

            <div class="stat-card">
                <h2>50+</h2>
                <span>Connected Hospitals</span>
            </div>

            <div class="stat-card">
                <h2>AI</h2>
                <span>Risk Detection</span>
            </div>

        </div>

        <div class="feature-list">

            <div class="feature-item">
                🚑 Instant Emergency Alerts
            </div>

            <div class="feature-item">
                📊 AI Healthcare Analytics
            </div>

            <div class="feature-item">
                🏥 Smart Hospital Connectivity
            </div>

            <div class="feature-item">
                ❤️ Secure Patient Monitoring
            </div>

        </div>

    </div>

    <!-- RIGHT SIDE -->

    <div class="auth-right">

        <div class="auth-card">

            <div class="auth-icon">
                💗
            </div>

            <h2 class="auth-title">
                Create Account
            </h2>

            <p class="auth-subtitle">
                Register to continue with MediLink AI
            </p>

            <?php echo $message; ?>

            <form method="POST"
                  class="auth-form">

                <input type="text"
                       name="name"
                       placeholder="Full Name"
                       required>

                <input type="email"
                       name="email"
                       placeholder="Enter Email"
                       required>

                <input type="password"
                       name="password"
                       placeholder="Create Password"
                       required>

                <button type="submit"
                        name="register"
                        class="auth-btn">

                    Register

                </button>

            </form>

            <div class="auth-link">

                <a href="login.php">
                    Already have an account? Login
                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>