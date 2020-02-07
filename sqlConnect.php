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

//$sql = "SELECT name, age, gradeLevel FROM students ORDER BY name";
//$sql = "SELECT name, age, gradeLevel FROM students WHERE name='Deric' AND age=17 LIMIT 1";
//$sql = "DELETE FROM students WHERE id = 10"

$sql = "SELECT * FROM students"
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
        echo $row['name']." is " . $row['age']." years old and in grade ".$row['gradeLevel'];
         echo "<br><br>"; 
     }
 } else {
    echo "0 results";
 }

$conn->close();
?>