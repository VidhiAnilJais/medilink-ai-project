
<?php

date_default_timezone_set("Asia/Kolkata");

session_start();

include "config/db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['user'];

/* =========================
   ANALYTICS QUERIES
========================= */

$totalQuery = "
SELECT COUNT(*) AS total
FROM assessments
WHERE email='$email'";

$totalData = mysqli_fetch_assoc(
    mysqli_query($conn,$totalQuery)
);

$highQuery = "
SELECT COUNT(*) AS highRisk
FROM assessments
WHERE risk_level='HIGH'
AND email='$email'";

$highData = mysqli_fetch_assoc(
    mysqli_query($conn,$highQuery)
);

$mediumQuery = "
SELECT COUNT(*) AS mediumRisk
FROM assessments
WHERE risk_level='MEDIUM'
AND email='$email'";

$mediumData = mysqli_fetch_assoc(
    mysqli_query($conn,$mediumQuery)
);

$lowQuery = "
SELECT COUNT(*) AS lowRisk
FROM assessments
WHERE risk_level='LOW'
AND email='$email'";

$lowData = mysqli_fetch_assoc(
    mysqli_query($conn,$lowQuery)
);

$highCount = $highData['highRisk'];
$mediumCount = $mediumData['mediumRisk'];
$lowCount = $lowData['lowRisk'];

?>

<!DOCTYPE html>
<html>

<head>

    <title>MediLink AI Dashboard</title>

    <link rel="stylesheet" href="css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        MediLink AI
    </div>

    <div class="nav-section">

        <a class="active" href="dashboard.php">
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
            <h1>AI Healthcare Control Center</h1>
            <p>
                Real-time emergency healthcare analytics platform
            </p>
        </div>

        <div class="user-box">
            <?php echo $_SESSION['user']; ?>
        </div>

    </div>

    <!-- ANALYTICS -->

    <div class="analytics-grid">

        <div class="analytics-card">
            <span>Total Patients</span>
            <h1><?php echo $totalData['total']; ?></h1>
        </div>

        <div class="analytics-card high-card">
            <span>High Risk</span>
            <h1><?php echo $highCount; ?></h1>
        </div>

        <div class="analytics-card medium-card">
            <span>Medium Risk</span>
            <h1><?php echo $mediumCount; ?></h1>
        </div>

        <div class="analytics-card low-card">
            <span>Low Risk</span>
            <h1><?php echo $lowCount; ?></h1>
        </div>

    </div>

    <!-- MAIN GRID -->

    <div class="dashboard-grid">

        <!-- LEFT SECTION -->

        <div class="left-panel">

            <div class="hero-box">

                <div>
                    <h1>AI Emergency Monitoring System</h1>

                    <p>
                        Real-time healthcare intelligence platform
                        for emergency patient monitoring and analytics.
                    </p>
                </div>

            </div>

            <!-- CHARTS -->

            <div class="chart-grid">

                <div class="chart-card">

                    <div class="chart-header">
                        <h2>Risk Distribution</h2>
                    </div>

                    <div class="chart-container">
                        <canvas id="riskChart"></canvas>
                    </div>

                </div>

                <div class="chart-card">

                    <div class="chart-header">
                        <h2>Emergency Analytics</h2>
                    </div>

                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>

                </div>

            </div>

            <!-- AI INSIGHTS -->

            <div class="insight-card">

                <h2>AI Insights</h2>

                <div class="insight-box">
                    Oxygen instability detected in recent assessments.
                </div>

                <div class="insight-box">
                    High-risk patient activity increasing gradually.
                </div>

                <div class="insight-box">
                    AI monitoring recommends continuous observation.
                </div>

            </div>


            <div class="insight-card">

    <h2>
        Emergency Status
    </h2>

    <div class="insight-box">
        System Status: Active
    </div>

    <div class="insight-box">
        AI Monitoring: Enabled
    </div>

    <div class="insight-box">
        Last Assessment:
        <?php echo date("h:i A"); ?>
    </div>

</div>

        </div>



        <!-- RIGHT SECTION -->

        <div class="right-panel">

            <div class="form-box">

                <h2>Smart Emergency Assessment</h2>

                <form method="POST">

                    <input type="number"
                           name="age"
                           placeholder="Enter Patient Age"
                           required>

                    <input type="text"
                           name="gender"
                           placeholder="Enter Gender"
                           required>

                    <input type="text"
                           name="symptom"
                           placeholder="Enter Symptoms"
                           required>

                    <input type="number"
                           name="oxygen"
                           placeholder="Oxygen Level (%)"
                           required>

                    <input type="number"
                           name="heart"
                           placeholder="Heart Rate"
                           required>

                    <input type="text"
                           name="history"
                           placeholder="Existing Diseases">

                    <button class="btn"
                            name="check">

                        Analyze Patient

                    </button>

                </form>

<?php

if(isset($_POST['check'])){

    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $symptom = strtolower($_POST['symptom']);
    $oxygen = $_POST['oxygen'];
    $heart = $_POST['heart'];
    $history = strtolower($_POST['history']);

    $risk = "LOW";
    $message = "Patient condition appears stable.";

    if(
        $oxygen < 90
        ||
        $heart > 120
        ||
        strpos($symptom,"chest pain") !== false
        ||
        strpos($symptom,"breathing") !== false
    ){

        $risk = "HIGH";

        $message =
        "Immediate medical attention required.";
    }

    elseif(
        $oxygen < 95
        ||
        $heart > 100
        ||
        strpos($symptom,"fever") !== false
        ||
        strpos($symptom,"headache") !== false
    ){

        $risk = "MEDIUM";

        $message =
        "Monitor symptoms carefully.";
    }

    $sql = "INSERT INTO assessments(

    email,
    age,
    gender,
    symptom,
    oxygen,
    heart_rate,
    disease_history,
    risk_level

    )

    VALUES(

    '$email',
    '$age',
    '$gender',
    '$symptom',
    '$oxygen',
    '$heart',
    '$history',
    '$risk'

    )";

    mysqli_query($conn,$sql);

?>

<div class="result-card">

    <h2>
        AI Emergency Result
    </h2>

<?php

if($risk == "HIGH"){

    echo "<div class='risk-badge high-badge'>
            HIGH RISK
          </div>";

    $specialist = "Emergency Specialist";

    $precaution =
    "Immediate hospital consultation recommended.";

    $concern =
    "Possible respiratory or cardiac instability.";
}

elseif($risk == "MEDIUM"){

    echo "<div class='risk-badge medium-badge'>
            MEDIUM RISK
          </div>";

    $specialist = "General Physician";

    $precaution =
    "Continuous monitoring and hydration advised.";

    $concern =
    "Moderate infection or oxygen instability detected.";
}

else{

    echo "<div class='risk-badge low-badge'>
            LOW RISK
          </div>";

    $specialist = "Routine Consultation";

    $precaution =
    "Maintain healthy observation and rest.";

    $concern =
    "No major emergency indicators detected.";
}

?>

    <p class="result-message">

        <?php echo $message; ?>

    </p>

    <div class="patient-info">

        <div>

            <span>Age</span>

            <h3>
                <?php echo $age; ?>
            </h3>

        </div>

        <div>

            <span>Oxygen</span>

            <h3>
                <?php echo $oxygen; ?>%
            </h3>

        </div>

        <div>

            <span>Heart Rate</span>

            <h3>
                <?php echo $heart; ?> bpm
            </h3>

        </div>

    </div>

    <div class="ai-section">

        <h3>
            AI Medical Summary
        </h3>

        <p>

            Symptoms suggest
            <b><?php echo $risk; ?></b>
            emergency priority.

        </p>

        <p>

            <b>Possible Concern:</b>
            <?php echo $concern; ?>

        </p>

        <p>

            <b>Recommended Specialist:</b>
            <?php echo $specialist; ?>

        </p>

        <p>

            <b>Immediate Precautions:</b>
            <?php echo $precaution; ?>

        </p>

        <p>

            <b>Assessment Time:</b>
            <?php echo date("d M Y - h:i A"); ?>

        </p>

    </div>

</div>



<?php } ?>

            </div>

        </div>

    </div>

</div>

<!-- CHARTS -->

<script>

const riskChart =
document.getElementById('riskChart');

new Chart(riskChart, {

    type:'doughnut',

    data:{

        labels:[
            'High Risk',
            'Medium Risk',
            'Low Risk'
        ],

        datasets:[{

            data:[
                <?php echo $highCount; ?>,
                <?php echo $mediumCount; ?>,
                <?php echo $lowCount; ?>
            ],

            backgroundColor:[
                '#ef4444',
                '#f59e0b',
                '#22c55e'
            ],

            borderWidth:0
        }]
    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{
                labels:{
                    color:'white'
                }
            }
        }
    }
});

const barChart =
document.getElementById('barChart');

new Chart(barChart, {

    type:'bar',

    data:{

        labels:[
            'High',
            'Medium',
            'Low'
        ],

        datasets:[{

            label:'Cases',

            data:[
                <?php echo $highCount; ?>,
                <?php echo $mediumCount; ?>,
                <?php echo $lowCount; ?>
            ],

            backgroundColor:[
                '#ef4444',
                '#f59e0b',
                '#22c55e'
            ],

            borderRadius:10
        }]
    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{
                labels:{
                    color:'white'
                }
            }
        },

        scales:{

            y:{
                ticks:{
                    color:'white'
                },

                grid:{
                    color:'rgba(255,255,255,0.05)'
                }
            },

            x:{
                ticks:{
                    color:'white'
                },

                grid:{
                    color:'rgba(255,255,255,0.05)'
                }
            }
        }
    }
});

</script>
<script src="JS/script.js"></script>
</body>
</html>

