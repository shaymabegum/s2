<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "faculty_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM faculty";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>MONDAYM</th>
                <th>MONDAYA</th>
                <th>TUESDAYM</th>
                <th>TUESDAYA</th>
                <th>WEDNESDAYM</th>
                <th>WEDNESDAYA</th>
                <th>THURSDAYM</th>
                <th>THURSDAYA</th>
                <th>FRIDAYM</th>
                <th>FRIDAYA</th>
                <th>SATURDAYM</th>
                <th>SATURDAYA</th>
            </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['designation'] . "</td>
                <td>" . $row['MONDAYM'] . "</td>
                <td>" . $row['MONDAYA'] . "</td>
                <td>" . $row['TUESDAYM'] . "</td>
                <td>" . $row['TUESDAYA'] . "</td>
                <td>" . $row['WEDNESDAYM'] . "</td>
                <td>" . $row['WEDNESDAYA'] . "</td>
                <td>" . $row['THURSDAYM'] . "</td>
                <td>" . $row['THURSDAYA'] . "</td>
                <td>" . $row['FRIDAYM'] . "</td>
                <td>" . $row['FRIDAYA'] . "</td>
                <td>" . $row['SATURDAYM'] . "</td>
                <td>" . $row['SATURDAYA'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No data available.";
}
$conn->close();
?>
