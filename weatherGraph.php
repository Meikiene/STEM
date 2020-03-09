<?php 
//store credentials into variables
$servername = "192.168.0.200";
$username = "humid";
$password = "raspberry";
$dbname = "gpioControl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//sql statement
$sql = "SELECT * FROM DHT ORDER by id ASC";
$result = $conn->query($sql);

//store rows of data into array
$chart_hum = ' ';
$chart_temp= ' ';
$chart_date = ' ';

// For high and low values of humidity and temperature
$highHum = 0;
$highTemp = 0;
$lowHum = 10000;
$lowTemp = 10000;

$dateTime1 = 0;
$dateTime2 = 0;
$dateTime3 = 0;
$dateTime4 = 0;

//loop
if ($result->num_rows>0) {
     while($row = $result->fetch_assoc()) {
        $chart_hum = $chart_hum.$row['humidity'].', ';
        $chart_temp = $chart_temp.$row['temperature'].', ';
        $chart_date = $chart_date.strtotime($row['time']).', ';
    
        //compare to update values to find high/low for temperature/humidity
        if($row['humidity'] > $highHum){
            $highHum = $row['humidity'];
            $dateTime1 = $row['time'];
        }
        if($row['temperature'] > $highTemp){
            $highTemp = $row['temperature'];
            $dateTime2 = $row['time'];
        }
        if($row['humidity'] < $lowHum){
            $lowHum = $row['humidity'];
            $dateTime3 = $row['time'];
        }
        if($row['temperature'] < $lowTemp){
            $lowTemp = $row['temperature'];
            $dateTime4 = $row['time'];
        }
    }
}

//display highest and lowest value of temperature and humidity
echo 'Highest Humidity: '.$highHum.' Date/Time: '.$dateTime1;
echo "<br>";
echo 'Highest Temperature: '.$highTemp.' Date/Time: '.$dateTime2;
echo "<br>";
echo 'Lowest Humidity: '.$lowHum.' Date/Time: '.$dateTime3;
echo "<br>";
echo 'Lowest Temperature: '.$lowTemp.' Date/Time: '.$dateTime4;

//close connection
$conn->close();
?>

<!--Apex Charts-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<meta charset="utf-8">
<title></title>
</head>
<body>

<div id="chart">
</div>
<script>
var options = {
series: [
{
name: "Humidity",
data: [<?php echo $chart_hum;?>]
},
{
name: "Temperature",
data: [<?php echo $chart_temp;?>]
}
],
chart: {
height: 350,
type: 'line',
dropShadow: {
enabled: true,
color: '#000',
top: 18,
left: 7,
blur: 10,
opacity: 0.2
},
toolbar: {
show: false
}
},
colors: ['#77B6EA', '#545454'],
dataLabels: {
enabled: false,
},
stroke: {
curve: 'smooth'
},
title: {
text: 'Humidity and Temperature',
align: 'left'
},
grid: {
borderColor: '#e7e7e7',
row: {
colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
opacity: 0.5
},
},
markers: {
size: 1
},
xaxis: {
categories: [<?php echo $chart_date;?>],
title: {
text: 'Time'
}
},
yaxis: {
title: {
text: 'Temperature & Humidity'
},
min: 5,
max: 100
},
legend: {
position: 'top',
horizontalAlign: 'right',
floating: true,
offsetY: -25,
offsetX: -5
}
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

</script>
</body>
</html>