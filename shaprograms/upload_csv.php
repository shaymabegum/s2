<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csvFile"])) {
    // Get the temporary file path for the uploaded CSV
    $target_file = $_FILES["csvFile"]["tmp_name"]; 
    echo "Uploaded CSV File Path: " . htmlspecialchars($target_file) . "<br>"; // Debugging output

    // Path to the JAR file generated by Maven (ensure the correct .jar extension)
    $jar_path = 'C:\Users\shyma\Documents\workspace-spring-tool-suite-4-4.21.1.RELEASE\Springpro\target\Springpro-0.0.1-SNAPSHOT.jar';

    // Prepare to execute the Java program using the JAR file
    // Pass the temporary CSV file path as an argument to the JAR file
    $command = 'java -jar "' . $jar_path . '" ' . escapeshellarg($target_file) . ' 2>&1';
    echo "Executing command: $command<br>"; // Debugging output

    // Capture output
    $output = [];
    $return_var = 0;

    // Execute the command
    exec($command, $output, $return_var);

    // Check if there was an error
    if ($return_var != 0) {
        echo "Error occurred while running the Java program.<br>";
        foreach ($output as $line) {
            echo htmlspecialchars($line) . "<br>"; // Display error details
        }
    } else {
        echo "File processed successfully.<br>";
        foreach ($output as $line) {
            echo htmlspecialchars($line) . "<br>"; // Display success output
        }
    }
}
?>

<form action="upload_csv.php" method="post" enctype="multipart/form-data">
    <input type="file" name="csvFile" accept=".csv" required>
    <input type="submit" value="Upload CSV">
</form>
