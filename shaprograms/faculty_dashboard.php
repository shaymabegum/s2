<?php
session_start();

if (!isset($_SESSION['faculty_id'])) {
    header("Location: login.php");
    exit();
}

$faculty_id = $_SESSION['faculty_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Dashboard</title>
    <style>
        .button {
            padding: 10px 20px;
            font-size: 18px;
            margin: 10px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Welcome, Faculty ID: <?php echo $faculty_id; ?></h2>

    <!-- Enter Workload Button -->
    <a href="workload_form.php?action=enter" class="button">Enter Workload</a>

    <!-- Update Workload Button -->
    <a href="workload_form.php?action=update" class="button">Update Workload</a>

</body>
</html>
