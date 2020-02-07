<?php
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT name, age, gradeLevel FROM students ORDER BY name";
// $sql = "SELECT name, age, gradeLevel FROM students WHERE name='Deric' AND age=17 LIMIT 1";
$sql = "UPDATE students SET age=17 WHERE name ='Loelle' ";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>