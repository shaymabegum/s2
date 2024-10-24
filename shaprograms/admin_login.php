<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "faculty_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['admin_id'];

    // Fetch admin by admin_id
    $sql = "SELECT * FROM admin WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Admin exists, set session and redirect to the dashboard
        $_SESSION['admin_id'] = $admin_id;  // Set the session variable
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Admin ID not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form action="admin_login.php" method="POST">
        Admin ID: <input type="text" name="admin_id" required><br><br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>
