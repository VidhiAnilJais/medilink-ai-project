<?php

session_start();

include "config/db.php";

if(!isset($_SESSION['user'])){
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
    "Critical instability detected. Immediate medical consultation recommended.";

    $color = "#ef4444";
}

elseif($risk == "MEDIUM"){

    $summary =
    "Moderate instability observed. Continuous monitoring advised.";

    $color = "#f59e0b";
}

else{

    $summary =
    "Patient currently stable. Routine observation recommended.";

    $color = "#22c55e";
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Download Report</title>

    <link rel="stylesheet"
          href="css/report.css">

</head>

<body>

<div class="report-container">

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

    <div class="report-title">

        <h2>
            AI Medical Assessment Report
        </h2>

        <span>

            Generated:
            <?php echo date("d M Y - h:i A"); ?>

        </span>

    </div>

    <div class="status-section"
         style="background:<?php echo $color; ?>;">

        <h2>
            <?php echo $risk; ?> RISK
        </h2>

        <p>
            AI Emergency Severity Analysis
        </p>

    </div>

    <div class="section">

        <h3>
            Patient Information
        </h3>

        <div class="info-grid">

            <div class="info-box">

                <span>Age</span>

                <h4>
                    <?php echo $row['age']; ?>
                </h4>

            </div>

            <div class="info-box">

                <span>Gender</span>

                <h4>
                    <?php echo ucfirst($row['gender']); ?>
                </h4>

            </div>

            <div class="info-box">

                <span>Oxygen</span>

                <h4>
                    <?php echo $row['oxygen']; ?>%
                </h4>

            </div>

            <div class="info-box">

                <span>Heart Rate</span>

                <h4>
                    <?php echo $row['heart_rate']; ?> bpm
                </h4>

            </div>

        </div>

    </div>

    <div class="section">

        <h3>
            Symptoms Reported
        </h3>

        <div class="detail-box">

            <?php echo ucfirst($row['symptom']); ?>

        </div>

    </div>

    <div class="section">

        <h3>
            AI Medical Summary
        </h3>

        <div class="summary-box">

            <?php echo $summary; ?>

        </div>

    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>

window.onload = function(){

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
    .save()
    .then(() => {

        window.close();

    });

}

</script>

</body>
</html>
