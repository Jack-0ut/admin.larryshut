<?php
include('auth.php');
// Get the visitor data from the database
include('config.php');

$sql = "SELECT DATE_FORMAT(booking_date, '%Y-%m-%d') AS booking_date, COUNT(*) AS bookers FROM bookings GROUP BY booking_date";
$result = mysqli_query($conn, $sql);

// Create an array of the visitor data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data['days'][] = $row['booking_date'];
    $data['bookers'][] = $row['bookers'];
}

// Convert the visitor data to JSON format
$json = json_encode($data);

// Output the JSON data to the browser
header('Content-Type: application/json');
echo $json;

// Close the database connection
mysqli_close($conn);

?>
