<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin</h1>

    <ul>
        <li><a href="view_faculty.php">View Faculty Table</a></li>
    </ul>

    <!-- CSV File Upload Form -->
    <h2>Upload Examination CSV File</h2>
    <form action="upload_csv.php" method="POST" enctype="multipart/form-data">
        <label for="csv_file">Choose CSV file:</label>
        <input type="file" name="csv_file" id="csv_file" accept=".csv" required><br><br>
        <input type="submit" value="Upload CSV">
    </form>
</body>
</html>
