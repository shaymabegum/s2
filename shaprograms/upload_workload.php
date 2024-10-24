<?php
session_start();
if (!isset($_SESSION['faculty_id'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "faculty_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch existing workload data for the logged-in faculty
$id = $_SESSION['faculty_id'];
$sql = "SELECT * FROM faculty WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$faculty = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    
    // Collect workload data for each day
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

    // Update faculty table with new workload
    $sql = "UPDATE faculty SET name=?, designation=?, 
            MONDAYM=?, MONDAYA=?, 
            TUESDAYM=?, TUESDAYA=?, 
            WEDNESDAYM=?, WEDNESDAYA=?, 
            THURSDAYM=?, THURSDAYA=?, 
            FRIDAYM=?, FRIDAYA=?, 
            SATURDAYM=?, SATURDAYA=? 
            WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssi", $name, $designation, 
                                         $MONDAYM, $MONDAYA, 
                                         $TUESDAYM, $TUESDAYA, 
                                         $WEDNESDAYM, $WEDNESDAYA, 
                                         $THURSDAYM, $THURSDAYA, 
                                         $FRIDAYM, $FRIDAYA, 
                                         $SATURDAYM, $SATURDAYA, 
                                         $id);
    
    if ($stmt->execute()) {
        $success = "Workload updated successfully!";
        // Optionally, refresh data after update
        $result = $stmt->get_result();
        $faculty = $result->fetch_assoc();
    } else {
        $error = "Failed to update workload!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Workload</title>
</head>
<body>
    <h2>Update Your Workload</h2>
    <form action="update_workload.php" method="POST">
        Name: <input type="text" name="name" value="<?php echo $faculty['name']; ?>" required><br><br>
        Designation: <input type="text" name="designation" value="<?php echo $faculty['designation']; ?>" required><br><br>
        
        <h3>Monday</h3>
        Morning: <input type="text" name="MONDAYM" value="<?php echo $faculty['MONDAYM']; ?>" required><br><br>
        Afternoon: <input type="text" name="MONDAYA" value="<?php echo $faculty['MONDAYA']; ?>" required><br><br>

        <h3>Tuesday</h3>
        Morning: <input type="text" name="TUESDAYM" value="<?php echo $faculty['TUESDAYM']; ?>" required><br><br>
        Afternoon: <input type="text" name="TUESDAYA" value="<?php echo $faculty['TUESDAYA']; ?>" required><br><br>

        <h3>Wednesday</h3>
        Morning: <input type="text" name="WEDNESDAYM" value="<?php echo $faculty['WEDNESDAYM']; ?>" required><br><br>
        Afternoon: <input type="text" name="WEDNESDAYA" value="<?php echo $faculty['WEDNESDAYA']; ?>" required><br><br>

        <h3>Thursday</h3>
        Morning: <input type="text" name="THURSDAYM" value="<?php echo $faculty['THURSDAYM']; ?>" required><br><br>
        Afternoon: <input type="text" name="THURSDAYA" value="<?php echo $faculty['THURSDAYA']; ?>" required><br><br>

        <h3>Friday</h3>
        Morning: <input type="text" name="FRIDAYM" value="<?php echo $faculty['FRIDAYM']; ?>" required><br><br>
        Afternoon: <input type="text" name="FRIDAYA" value="<?php echo $faculty['FRIDAYA']; ?>" required><br><br>

        <h3>Saturday</h3>
        Morning: <input type="text" name="SATURDAYM" value="<?php echo $faculty['SATURDAYM']; ?>" required><br><br>
        Afternoon: <input type="text" name="SATURDAYA" value="<?php echo $faculty['SATURDAYA']; ?>" required><br><br>

        <input type="submit" value="Update Workload">
    </form>
    <?php if (isset($success)) { echo "<p style='color:green;'>$success</p>"; } ?>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>
