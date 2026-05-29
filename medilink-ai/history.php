<?php

session_start();

include "config/db.php";

if(!isset($_SESSION['user'])){

    header("Location: login.php");
}

$email = $_SESSION['user'];

/* DELETE ASSESSMENT */

if(isset($_GET['delete'])){

    $deleteId = $_GET['delete'];

    $deleteQuery = "
    DELETE FROM assessments
    WHERE id='$deleteId'
    AND email='$email'
    ";

    mysqli_query($conn,$deleteQuery);

    header("Location: history.php");
    exit();
}

$search =
isset($_GET['search'])
? $_GET['search']
: '';

$riskFilter =
isset($_GET['risk'])
? $_GET['risk']
: '';

$query = "
SELECT *
FROM assessments
WHERE email='$email'
";

if($search != ''){

    $query .= "
    AND symptom LIKE '%$search%'
    ";
}

if($riskFilter != ''){

    $query .= "
    AND risk_level='$riskFilter'
    ";
}

$query .= "
ORDER BY id DESC
";

$result =
mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Assessment History</title>

    <link rel="stylesheet"
          href="css/style.css">

</head>

<body>

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            MediLink AI
        </div>

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="history.php">
            History
        </a>

        <a href="logout.php">
            Logout
        </a>

    </div>

    <!-- MAIN -->

    <div class="main">

        <div class="topbar">

            <h1>
                Patient Assessment History
            </h1>

            <p>
                Welcome,
                <?php echo $email; ?>
            </p>

        </div>

        <!-- SEARCH & FILTER -->

<div class="history-controls">

    <form method="GET" class="history-form">

        <input type="text"
               name="search"
               placeholder="Search symptoms...">

        <select name="risk">

            <option value="">
                All Risk Levels
            </option>

            <option value="HIGH">
                High Risk
            </option>

            <option value="MEDIUM">
                Medium Risk
            </option>

            <option value="LOW">
                Low Risk
            </option>

        </select>

        <button class="btn filter-btn">

            Apply Filter

        </button>

    </form>

</div>

        <!-- GRID -->

        <div class="history-grid">

            <?php

            while($row = mysqli_fetch_assoc($result)){

                $riskClass =
                strtolower($row['risk_level']);

            ?>

            <div class="history-card <?php echo $riskClass; ?>">

                <h2>

                    <?php

                    echo strtoupper(
                    $row['risk_level']);

                    ?>

                    RISK

                </h2>

                <p>

                    <strong>Symptoms:</strong>

                    <?php echo $row['symptom']; ?>

                    

                </p>

                <p>

                    <strong>Age:</strong>

                    <?php echo $row['age'];?>

                </p>

                <p>

                    <strong>Gender:</strong>

                    <?php echo $row['gender']; ?>
                </p>

                <p>

                    <strong>Oxygen:</strong>

                    <?php echo $row['oxygen']; ?>%

                </p>

                <p>

                    <strong>Heart Rate:</strong>

                    <?php echo $row['heart_rate']; ?> bpm

                </p>

                <p>

                    <strong>Disease History:</strong>

                    <?php echo $row['disease_history'];?>

                </p>

                <p>

                    <strong>Assessment Time:</strong>

                    <?php echo $row['created_at'];?>

                </p>


<div class="history-actions">

    <a class="view-btn"
       href="report.php?id=<?php echo $row['id']; ?>">

        View Report

    </a>

    <a class="download-btn"
       href="download-report.php?id=<?php echo $row['id']; ?>">

        Download

    </a>

    <a class="delete-btn"
       href="history.php?delete=<?php echo $row['id']; ?>">

        Delete

    </a>

</div>
            </div>
  
 
            <?php

            }
            

            ?>

        </div>

    </div>
<script src="JS/script.js"></script>
</body>

</html>