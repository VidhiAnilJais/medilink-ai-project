<?php

session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Help Center | MediLink AI</title>

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

        <a href="hospitals.php">
            Emergency Hospitals
        </a>

        <a href="history.php">
            Patient History
        </a>

    </div>

    <div class="nav-bottom">

        <a class="active" href="help.php">
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

    <!-- TOPBAR -->

    <div class="topbar">

        <div>

            <h1>
                Help Center
            </h1>

            <p>
                AI healthcare guidance and emergency support center.
            </p>

        </div>

    </div>

    <!-- HERO -->

    <div class="hero-box">

        <div>

            <h1>
                24/7 Emergency Assistance
            </h1>

            <p>
                Get support for emergency monitoring,
                AI assessment reports, hospital guidance
                and healthcare analytics.
            </p>

        </div>

    </div>

    <!-- GRID -->

    <div class="dashboard-grid">

        <!-- LEFT -->

        <div class="left-panel">

            <!-- FAQ -->

            <div class="insight-card">

                <h2>
                    Frequently Asked Questions
                </h2>

                <div class="insight-box">

                    <h3>
                        How does AI emergency detection work?
                    </h3>

                    <p>
                        MediLink AI analyzes oxygen level,
                        heart rate and symptoms to predict
                        emergency severity.
                    </p>

                </div>

                <div class="insight-box">

                    <h3>
                        Is patient data stored securely?
                    </h3>

                    <p>
                        Yes. All patient assessments are
                        securely stored within the system.
                    </p>

                </div>

                <div class="insight-box">

                    <h3>
                        Can I download reports?
                    </h3>

                    <p>
                        Yes. Detailed AI medical reports
                        can be downloaded directly as PDF.
                    </p>

                </div>

            </div>

            <!-- GUIDE -->

            <div class="insight-card">

                <h2>
                    Emergency Guide
                </h2>

                <div class="insight-box">

                    🚨 HIGH RISK:
                    Immediate hospital consultation recommended.

                </div>

                <div class="insight-box">

                    ⚠ MEDIUM RISK:
                    Continuous monitoring and hydration advised.

                </div>

                <div class="insight-box">

                    ✅ LOW RISK:
                    Maintain routine observation and precautions.

                </div>

            </div>
<!-- emergency contact --> 
<div class="insight-card">

                <h2>
                    Emergency Contact Information
                </h2>

                <div class="insight-box">

                    <a href="tel:112"> 112 - Government Helpline Number</a>

                </div>

                <div class="insight-box">

                    <a href="tel:108"> 108 - Medical Emergency Contact Number</a>

                </div>

                <div class="insight-box">

                    <a href="tel:102"> 102 - Ambulance Contact Number</a>

                </div>

                <div class="insight-box">

                    <a href="tel:1090"> 1090 - Hospital Contact Number</a>

                </div>
            
                <div class="insight-box">

                    <a href="tel:1098"> 1098 - Child Helpline Number</a>

                </div>

                
            
        </div>


</div>
            

        <!-- RIGHT -->

        <div class="right-panel">

            <!-- SUPPORT -->

            <div class="form-box">

                <h2>
                    Contact Support
                </h2>

                <form>

                    <input type="text"
                           placeholder="Enter Your Name">

                    <input type="email"
                           placeholder="Enter Email Address">

                    <textarea
placeholder="Describe your issue..."
rows="6"></textarea>

                    <button class="btn">

                        Submit Support Request

                    </button>

                </form>

            </div>

            <!-- CONTACT -->

            <div class="insight-card">

                <h2>
                    Support Information
                </h2>

                <div class="insight-box">

                    📍 Nagpur, Maharashtra

                </div>

                <div class="insight-box">

                    📞 +91 9158515258

                </div>

                <div class="insight-box">

                    ✉ support@medilinkai.com

                </div>

                <div class="insight-box">

                    🕒 24/7 Emergency Assistance

                </div>

            </div>

            <!-- AI -->

            <div class="insight-card">

                <h2>
                    AI Assistance Status
                </h2>

                <div class="insight-box">

                    🤖 AI Monitoring Engine:
                    ONLINE

                </div>

                <div class="insight-box">

                    🚨 Emergency Detection:
                    ACTIVE

                </div>

                <div class="insight-box">

                    🏥 Hospital Network:
                    CONNECTED

                </div>

            </div>

        </div>

    </div>

</div>

<script src="JS/script.js"></script>

</body>
</html>