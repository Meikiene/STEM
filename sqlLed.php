<!DOCTYPE html>
<html>

<head>
    <title>
        GPIO LED
    </title>
</head>

<body style="text-align:center;">

    <h1 style="color:green;">
        GPIO LED CONTROL
    </h1>


    <?php
        // Use an if statement to trigger php functions
        if(array_key_exists('offButton', $_POST)) { 
            offButton(); 
        } 
        else if(array_key_exists('onButton', $_POST)) { 
            onButton(); 
        } 
        // Define our php functions 
        function offButton() { 
            $servername = "localhost"; // Use localhost because file is already on the server
			$username = "root";
			$password = "guzzo";
			$dbname = "gpioControl"; // Database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update our value toggle led
    $sql = "UPDATE led SET toggleOne=1 "; 
    
    // Holds result of the query
    $result = $conn->query($sql); 

    // Tell user if the sql query failed 
    if ($conn->query($sql) === TRUE) {
        echo "Record successfully updated";
    }
    else {
        echo "Error: " .$sql . "<br>" . $conn->error;
    }
    
    //Close connection to database
    $conn->close(); 
        } 
        function onButton() { 
            $servername = "localhost"; // Use localhost because file is already on the server
			$username = "root";
			$password = "guzzo";
			$dbname = "gpioControl"; // Database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Update value to toggle led
    $sql = "UPDATE led SET toggleOne=2 "; 
    
    // Holds result of the query
    $result = $conn->query($sql); 
    
    // Tell user if the sql query failed 
    if ($conn->query($sql) === TRUE) {
        echo "Record successfully updated";
    }
    else {
        echo "Error: " .$sql . "<br>" . $conn->error;
    }
    
    // Close connection to database
    $conn->close(); 
        }  
    ?>
    <!-- use a form to automatically execute our php functions -->
    <form method="post">
        <input type="submit" value="Off" class="button" name="offButton" />

        <input type="submit" value="On" class="button" name="onButton" />
    </form>
    </head>

</html>
