<?php

include("config/db.php");
$patients = mysqli_query($conn,
"SELECT * FROM patients ORDER BY id DESC LIMIT 5");

$high = mysqli_query($conn,
"SELECT COUNT(*) as total FROM patients WHERE risk='HIGH RISK'");

$highCount = mysqli_fetch_assoc($high);

?>

<?php

session_start();

include "config/db.php";

$email = $_SESSION['user'];



if(!isset($_SESSION['user'])){

    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>AI Monitoring | MediLink AI</title>

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

        <a class="active" href="monitoring.php">
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

    <!-- TOP -->

    <div class="topbar">

        <div>

            <h1>
                AI Emergency Monitoring
            </h1>

            <p>
                Real-time healthcare intelligence and emergency tracking.
            </p>

        </div>

        <div class="user-box">

            <span>
                System Status
            </span>

            <h3 style="color:#22c55e;">
                ● ACTIVE
            </h3>

        </div>

    </div>

    <div class="card">

<h2>
Live Emergency Feed
</h2>

<!-- ANALYTICS -->

    <div class="analytics-grid">

        <div class="analytics-card live-card">

            <span>
                Monitoring Status
            </span>

            <h1>
                ACTIVE
            </h1>

        </div>

        <div class="analytics-card high-card">

            <span>
                Critical Alerts
            </span>

            <h1>
                08
            </h1>

        </div>

        <div class="analytics-card">

            <span>
                AI Predictions
            </span>

            <h1 style="color:#38bdf8;">
                26
            </h1>

        </div>

        <div class="analytics-card low-card">

            <span>
                System Accuracy
            </span>

            <h1>
                94%
            </h1>

        </div>

    </div>

<!-- RECENT EMERGENCY TABLE -->

<div class="insight-card">

    <h2>
        Recent Emergency Cases
    </h2>

    <div class="table-wrapper">

        <table class="patient-table">

            <tr>

                <th>
                    Risk
                </th>

                <th>
                    Oxygen
                </th>

                <th>
                    Heart
                </th>

                <th>
                    Time
                </th>

            </tr>


<?php

$tableQuery = "
SELECT *
FROM assessments
WHERE email='$email'
ORDER BY id DESC
LIMIT 5
";

$tableResult =
mysqli_query($conn,$tableQuery);

while($table = mysqli_fetch_assoc($tableResult)){

?>

<tr>

    <td>

        <?php

        if($table['risk_level']=="HIGH"){

            echo "<span class='table-high'>
                  HIGH
                  </span>";
        }

        elseif($table['risk_level']=="MEDIUM"){

            echo "<span class='table-medium'>
                  MEDIUM
                  </span>";
        }

        else{

            echo "<span class='table-low'>
                  LOW
                  </span>";
        }

        ?>

    </td>

    <td>
        <?php echo $table['oxygen']; ?>%
    </td>

    <td>
        <?php echo $table['heart_rate']; ?>
    </td>

    <td>

        
        <?php

        $timestamp = strtotime($table['created_at']);
        $formattedTime = date("h:i A", $timestamp);
        echo $formattedTime;

        ?>

        

    </td>

</tr>

<?php } ?>

        </table>

    </div>

</div>

    <!-- GRID -->

    <div class="monitor-grid">

        <!-- LEFT -->

        <div class="monitor-left">

            <!-- LIVE FEED -->

            <div class="card">

                <div class="section-header">

                    <h2>
                        Live Emergency Feed
                    </h2>

                    <div class="live-badge">
                        LIVE
                    </div>

                </div>

                <div class="feed-item high-feed">

                    <div class="feed-top">

                        <span>
                            CRITICAL
                        </span>

                        <small>
                            2 mins ago
                        </small>

                    </div>

                    Oxygen instability detected in ICU patient monitoring.

                </div>

                <div class="feed-item medium-feed">

                    <div class="feed-top">

                        <span>
                            ALERT
                        </span>

                        <small>
                            5 mins ago
                        </small>

                    </div>

                    Increased fever-related emergency activity detected.

                </div>

                <div class="feed-item high-feed">

                    <div class="feed-top">

                        <span>
                            CRITICAL
                        </span>

                        <small>
                            8 mins ago
                        </small>

                    </div>

                    High heart-rate emergency case reported.

                </div>

                <div class="feed-item low-feed">

                    <div class="feed-top">

                        <span>
                            STABLE
                        </span>

                        <small>
                            12 mins ago
                        </small>

                    </div>

                    AI healthcare monitoring system operational.

                </div>

            </div>

            <!-- AI INSIGHTS -->

            <div class="card">

                <div class="section-header">

                    <h2>
                        AI Emergency Insights
                    </h2>

                </div>

                <div class="insight-monitor">

                    AI predicts increasing emergency activity
                    during late-night monitoring hours.

                </div>

                <div class="insight-monitor">

                    Respiratory instability detected
                    in recent patient assessments.

                </div>

                <div class="insight-monitor">

                    AI recommends continuous monitoring
                    for medium and high-risk patients.

                </div>

                <div class="insight-monitor">

                    Emergency alert patterns indicate
                    potential seasonal increase in cases.


                </div>


            </div>

        </div>

        <!-- RIGHT -->

        <div class="monitor-right">

            <!-- SYSTEM HEALTH -->

            <div class="card">

                <div class="section-header">

                    <h2>
                        System Health
                    </h2>

                </div>

                <div class="system-box">

                    <p>
                        AI Engine Status
                    </p>

                    <h3 class="online-text">
                        ONLINE
                    </h3>

                </div>

                <div class="system-box">

                    <p>
                        Emergency Network
                    </p>

                    <h3 class="online-text">
                        CONNECTED
                    </h3>

                </div>

                <div class="system-box">

                    <p>
                        Hospital Connectivity
                    </p>

                    <h3 class="online-text">
                        ACTIVE
                    </h3>

                </div>

            </div>

            <!-- ACTIVITY -->

            <div class="card">

                <div class="section-header">

                    <h2>
                        Monitoring Activity
                    </h2>

                </div>

                <div class="activity-box">

                    AI processed
                    <b>126</b>
                    patient assessments today.

                </div>

                <div class="activity-box">

                    <b>11</b>
                    high-risk emergency alerts detected.

                </div>

                <div class="activity-box">

                    Real-time healthcare intelligence
                    currently operational.

                </div>

            </div>

            <!-- AI STATUS -->

            <div class="card">

                <div class="section-header">

                    <h2>
                        AI Recommendation
                    </h2>

                </div>

                <div class="ai-recommend-box">

                    Continuous monitoring recommended
                    for oxygen-related emergency cases.
                    AI suggests emergency escalation
                    for critical instability patterns.

                </div>
                
            </div>

        </div>

    </div>

</div>

<script src="JS/script.js"></script>

</body>

</html>