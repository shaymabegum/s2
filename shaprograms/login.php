<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "faculty_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Check if ID exists in the faculty table
    $sql = "SELECT * FROM faculty WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Faculty ID is valid, allow login
        $_SESSION['faculty_id'] = $id;
        header("Location: faculty_dashboard.php");
        exit();
    } else {
        // Invalid ID
        $error = "Invalid Faculty ID";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h2>Faculty Login</h2>
<form action="login.php" method="POST">
    Faculty ID: <input type="text" name="id" required><br>
    <input type="submit" value="Login">
</form>
<?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

</body>
</html>
