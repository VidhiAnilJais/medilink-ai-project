<?php

session_start();

if(!isset($_SESSION['user'])){

    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Emergency Hospitals | MediLink AI</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">
        MediLink AI
    </div>

    <div class="nav-section">

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="monitoring.php">
            AI Monitoring
        </a>

        <a class="active" href="hospitals.php">
            Emergency Hospitals
        </a>

        <a href="history.php">
            Patient History
        </a>

    </div>

    <div class="nav-bottom">

        <a href="help.php">
            Help Center
        </a>

        <a href="about.php">
            About Platform
        </a>

        <a href="settings.php">
            Settings
        </a>

        <a href="logout.php">
            Logout
        </a>

    </div>

</div>

<!-- MAIN -->

<div class="main">

    <div class="topbar">

        <h1>
            Emergency Hospitals
        </h1>

        <p>
            AI-assisted nearby emergency healthcare support system.
        </p>

    </div>

    <!-- TOP STATUS -->

    <div class="analytics">

        <div class="analytics-card">

            <h3>
                Available Hospitals
            </h3>

            <h1>
                12
            </h1>

        </div>

        <div class="analytics-card">

            <h3>
                Emergency Beds
            </h3>

            <h1 style="color:#22c55e;">
                28
            </h1>

        </div>

        <div class="analytics-card">

            <h3>
                Ambulance Support
            </h3>

            <h1 style="color:#38bdf8;">
                ACTIVE
            </h1>

        </div>

        <div class="analytics-card">

            <h3>
                AI Response Time
            </h3>

            <h1 style="color:#f59e0b;">
                2 min
            </h1>

        </div>

    </div>

    <!-- HOSPITAL GRID -->

    <div class="hospital-grid">

        <!-- CARD 1 -->

        <div class="hospital-card">

            <div class="hospital-top">

                <h2>
                    CityCare Emergency Hospital
                </h2>

                <span class="available">
                    Available
                </span>

            </div>

            <p>
                Advanced emergency and trauma care.
            </p>

            <div class="hospital-info">

                <div>

                    <span>Distance</span>

                    <h3>2.1 KM</h3>

                </div>

                <div>

                    <span>Emergency Beds</span>

                    <h3>08</h3>

                </div>

            </div>

            <button class="hospital-btn">
                Request Emergency Booking
            </button>

        </div>

        <!-- CARD 2 -->

        <div class="hospital-card">

            <div class="hospital-top">

                <h2>
                    Apollo Healthcare Center
                </h2>

                <span class="limited">
                    Limited
                </span>

            </div>

            <p>
                AI-supported emergency response facility.
            </p>

            <div class="hospital-info">

                <div>

                    <span>Distance</span>

                    <h3>3.4 KM</h3>

                </div>

                <div>

                    <span>Emergency Beds</span>

                    <h3>03</h3>

                </div>

            </div>

            <button class="hospital-btn">
                Contact Emergency Team
            </button>

        </div>

        <!-- CARD 3 -->

        <div class="hospital-card">

            <div class="hospital-top">

                <h2>
                    MediLife Trauma Center
                </h2>

                <span class="available">
                    Available
                </span>

            </div>

            <p>
                Specialized cardiac and trauma monitoring.
            </p>

            <div class="hospital-info">

                <div>

                    <span>Distance</span>

                    <h3>1.7 KM</h3>

                </div>

                <div>

                    <span>Emergency Beds</span>

                    <h3>11</h3>

                </div>

            </div>

            <button class="hospital-btn">
                Book Emergency Support
            </button>

        </div>

    </div>

</div>
<script src="JS/script.js"></script>
</body>

</html>