<?php

session_start();

if(!isset($_SESSION['user'])){

    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Settings | MediLink AI</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

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

        <a href="hospitals.php">
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

        <a class="active" href="settings.php">
            Settings
        </a>

        <a href="logout.php">
            Logout
        </a>

    </div>

</div>

<div class="main">

    <div class="topbar">

        <h1>
            Platform Settings
        </h1>

        <p>
            Manage platform preferences and AI system settings.
        </p>

    </div>

    <div class="settings-grid">

        <!-- ACCOUNT -->

        <div class="settings-card">

            <h2>
                Account Information
            </h2>

            <div class="setting-item">

                <span>Email</span>

                <h3>
                    <?php echo $_SESSION['user']; ?>
                </h3>

            </div>

            <div class="setting-item">

                <span>Platform Status</span>

                <h3 style="color:#22c55e;">
                    ACTIVE
                </h3>

            </div>

        </div>

        <!-- THEME -->

        <div class="settings-card">

            <h2>
                Appearance
            </h2>

            <div class="theme-box">

                <span>
                    Dark / Light Mode
                </span>

                <button id="themeToggle"
                        class="theme-btn">

                    Toggle Theme

                </button>

            </div>

        </div>

        <!-- AI SETTINGS -->

        <div class="settings-card">

            <h2>
                AI Monitoring Settings
            </h2>

            <div class="setting-item">

                <span>
                    Emergency AI Monitoring
                </span>

                <h3>
                    ENABLED
                </h3>

            </div>

            <div class="setting-item">

                <span>
                    Real-time Alerts
                </span>

                <h3>
                    ACTIVE
                </h3>

            </div>

        </div>

        <!-- SECURITY -->

        <div class="settings-card">

            <h2>
                Security
            </h2>

            <div class="setting-item">

                <span>
                    Account Security
                </span>

                <h3 style="color:#22c55e;">
                    PROTECTED
                </h3>

            </div>

            <div class="setting-item">

                <span>
                    AI System Access
                </span>

                <h3>
                    VERIFIED
                </h3>

            </div>

        </div>

    </div>

</div>

<script>

document.getElementById("themeToggle").addEventListener("click", function() {
    document.body.classList.toggle("dark-theme");
});

</script>
<script src="JS/script.js"></script>
</body>

</html>