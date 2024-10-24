<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "faculty_db");

if (!isset($_SESSION['faculty_id'])) {
    header("Location: login.php");
    exit();
}

$faculty_id = $_SESSION['faculty_id'];
$action = isset($_GET['action']) ? $_GET['action'] : 'enter'; // Default to 'enter'
$success_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $MONDAYM = $_POST['MONDAYM'];
    $MONDAYA = $_POST['MONDAYA'];
    $TUESDAYM = $_POST['TUESDAYM'];
    $TUESDAYA = $_POST['TUESDAYA'];
    $WEDNESDAYM = $_POST['WEDNESDAYM'];
    $WEDNESDAYA = $_POST['WEDNESDAYA'];
    $THURSDAYM = $_POST['THURSDAYM'];
    $THURSDAYA = $_POST['THURSDAYA'];
    $FRIDAYM = $_POST['FRIDAYM'];
    $FRIDAYA = $_POST['FRIDAYA'];
    $SATURDAYM = $_POST['SATURDAYM'];
    $SATURDAYA = $_POST['SATURDAYA'];

    // Update workload in the faculty table
    $sql = "UPDATE faculty SET name=?, designation=?, MONDAYM=?, MONDAYA=?, 
            TUESDAYM=?, TUESDAYA=?, WEDNESDAYM=?, WEDNESDAYA=?, 
            THURSDAYM=?, THURSDAYA=?, FRIDAYM=?, FRIDAYA=?, 
            SATURDAYM=?, SATURDAYA=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Check if statement preparation was successful
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ssssssssssssssi", $name, $designation, $MONDAYM, $MONDAYA, 
                          $TUESDAYM, $TUESDAYA, $WEDNESDAYM, $WEDNESDAYA, 
                          $THURSDAYM, $THURSDAYA, $FRIDAYM, $FRIDAYA, 
                          $SATURDAYM, $SATURDAYA, $faculty_id);

        // Execute statement
        if ($stmt->execute()) {
            $success_message = ($action === 'enter') ? "Workload entered successfully." : "Workload updated successfully.";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Fetch faculty data for the form
$sql = "SELECT * FROM faculty WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $faculty_id);
$stmt->execute();
$result = $stmt->get_result();
$faculty_data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ucfirst($action); ?> Workload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        h2 {
            text-align: center;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
        }
        .form-container input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .success-message {
            text-align: center;
            color: green;
        }
    </style>
</head>
<body>

<h2><?php echo ucfirst($action); ?> Workload for Faculty ID: <?php echo $faculty_id; ?></h2>

<div class="form-container">
    <form action="workload_form.php?action=<?php echo $action; ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $faculty_data['name']; ?>" required>

        <label for="designation">Designation:</label>
        <input type="text" id="designation" name="designation" value="<?php echo $faculty_data['designation']; ?>" required>

        <label for="MONDAYM">Monday Morning:</label>
        <input type="text" id="MONDAYM" name="MONDAYM" value="<?php echo $faculty_data['MONDAYM']; ?>">

        <label for="MONDAYA">Monday Afternoon:</label>
        <input type="text" id="MONDAYA" name="MONDAYA" value="<?php echo $faculty_data['MONDAYA']; ?>">

        <label for="TUESDAYM">Tuesday Morning:</label>
        <input type="text" id="TUESDAYM" name="TUESDAYM" value="<?php echo $faculty_data['TUESDAYM']; ?>">

        <label for="TUESDAYA">Tuesday Afternoon:</label>
        <input type="text" id="TUESDAYA" name="TUESDAYA" value="<?php echo $faculty_data['TUESDAYA']; ?>">

        <label for="WEDNESDAYM">Wednesday Morning:</label>
        <input type="text" id="WEDNESDAYM" name="WEDNESDAYM" value="<?php echo $faculty_data['WEDNESDAYM']; ?>">

        <label for="WEDNESDAYA">Wednesday Afternoon:</label>
        <input type="text" id="WEDNESDAYA" name="WEDNESDAYA" value="<?php echo $faculty_data['WEDNESDAYA']; ?>">

        <label for="THURSDAYM">Thursday Morning:</label>
        <input type="text" id="THURSDAYM" name="THURSDAYM" value="<?php echo $faculty_data['THURSDAYM']; ?>">

        <label for="THURSDAYA">Thursday Afternoon:</label>
        <input type="text" id="THURSDAYA" name="THURSDAYA" value="<?php echo $faculty_data['THURSDAYA']; ?>">

        <label for="FRIDAYM">Friday Morning:</label>
        <input type="text" id="FRIDAYM" name="FRIDAYM" value="<?php echo $faculty_data['FRIDAYM']; ?>">

        <label for="FRIDAYA">Friday Afternoon:</label>
        <input type="text" id="FRIDAYA" name="FRIDAYA" value="<?php echo $faculty_data['FRIDAYA']; ?>">

        <label for="SATURDAYM">Saturday Morning:</label>
        <input type="text" id="SATURDAYM" name="SATURDAYM" value="<?php echo $faculty_data['SATURDAYM']; ?>">

        <label for="SATURDAYA">Saturday Afternoon:</label>
        <input type="text" id="SATURDAYA" name="SATURDAYA" value="<?php echo $faculty_data['SATURDAYA']; ?>">

        <input type="submit" value="Submit">
    </form>

    <div class="success-message">
        <?php echo $success_message; ?>
    </div>
</div>

</body>
</html>