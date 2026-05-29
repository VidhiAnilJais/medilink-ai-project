
<?php

session_start();

include "config/db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$email = $_SESSION['user'];

$query = "
SELECT *
FROM assessments
WHERE id='$id'
AND email='$email'
";

$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

if(!$row){
    die("Report not found");
}

$risk = $row['risk_level'];

if($risk == "HIGH"){

    $summary =
    "Critical instability detected. Immediate medical consultation and emergency monitoring recommended.";

    $riskClass = "high";
}

elseif($risk == "MEDIUM"){

    $summary =
    "Moderate instability observed. Continuous monitoring and hydration advised.";

    $riskClass = "medium";
}

else{

    $summary =
    "Patient currently stable. Maintain routine observation and healthy precautions.";

    $riskClass = "low";
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Medical Report | MediLink AI</title>

    <link rel="stylesheet" href="css/report.css">

</head>

<body>

<div class="report-container">

    <!-- HEADER -->

    <div class="report-header">

        <div>
            <h1>MediLink AI</h1>
            <p>
                AI-Powered Emergency Healthcare Platform
            </p>
        </div>

        <div class="hospital-details">
            <p>📍 Nagpur, Maharashtra</p>
            <p>📞 +91 9876543210</p>
            <p>✉ support@medilinkai.com</p>
        </div>

    </div>

    <!-- TITLE -->

    <div class="report-title">

        <h2>
            AI Medical Assessment Report
        </h2>

        <span>
            Generated on:
            <?php echo date("d M Y - h:i A"); ?>
        </span>

    </div>

    <!-- STATUS -->

    <div class="status-section <?php echo $riskClass; ?>">

        <h2>
            <?php echo $risk; ?> RISK
        </h2>

        <p>
            AI Emergency Severity Analysis
        </p>

    </div>

    <!-- PATIENT DETAILS -->

    <div class="section">

        <h3>
            Patient Information
        </h3>

        <div class="info-grid">

            <div class="info-box">
                <span>Age</span>
                <h4><?php echo $row['age']; ?></h4>
            </div>

            <div class="info-box">
                <span>Gender</span>
                <h4><?php echo ucfirst($row['gender']); ?></h4>
            </div>

            <div class="info-box">
                <span>Oxygen Level</span>
                <h4><?php echo $row['oxygen']; ?>%</h4>
            </div>

            <div class="info-box">
                <span>Heart Rate</span>
                <h4><?php echo $row['heart_rate']; ?> bpm</h4>
            </div>

        </div>

    </div>

    <!-- SYMPTOMS -->

    <div class="section">

        <h3>
            Symptoms Reported
        </h3>

        <div class="detail-box">
            <?php echo ucfirst($row['symptom']); ?>
        </div>

    </div>

    <!-- HISTORY -->

    <div class="section">

        <h3>
            Medical History
        </h3>

        <div class="detail-box">

            <?php

            if($row['disease_history'] != ''){
                echo ucfirst($row['disease_history']);
            }
            else{
                echo "No major disease history provided.";
            }

            ?>

        </div>

    </div>

    <!-- AI SUMMARY -->

    <div class="section">

        <h3>
            AI Medical Summary
        </h3>

        <div class="summary-box">

            <p>
                <?php echo $summary; ?>
            </p>

            <ul>

                <li>
                    AI risk analysis completed successfully.
                </li>

                <li>
                    Emergency monitoring recommendation generated.
                </li>

                <li>
                    Real-time patient assessment recorded.
                </li>

            </ul>

        </div>

    </div>

    <!-- FOOTER -->

    <div class="report-footer">

        <p>
            This report is generated automatically using MediLink AI Emergency Monitoring System.
        </p>

        <h4>
            MediLink AI • Healthcare Intelligence Platform
        </h4>

    </div>

    <!-- BUTTONS -->

<div class="button-group">

    <button onclick="downloadPDF()">
        Download PDF
    </button>

    <button onclick="window.print()">
        Print Report
    </button>

    <a href="history.php">
        Back to History
    </a>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>

function downloadPDF(){

    const element =
    document.querySelector(".report-container");

    const options = {

        margin:0,

        filename:'MediLink_Report.pdf',

        image:{
            type:'jpeg',
            quality:1
        },

        html2canvas:{
            scale:2,
            scrollY:0,
            windowWidth:1400
        },

        jsPDF:{
            unit:'px',
            format:[1200,1700],
            orientation:'portrait'
        }

    };

    html2pdf()
    .set(options)
    .from(element)
    .save();
}

</script>

</body>
</html>
