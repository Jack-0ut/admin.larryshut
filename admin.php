<?php
include('auth.php');
// include the database connection file
include('config.php');
include('templates/admin.html');

// fetch the booking date and number of bookings for each date
$sql = "SELECT booking_date, COUNT(*) AS num_bookings FROM bookings GROUP BY booking_date";
$result = mysqli_query($conn, $sql);

// store the results in an array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data['days'][] = $row['booking_date'];
    $data['bookers'][] = $row['num_bookings'];
}

// close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
<style>
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px; /* set the height of the container to the height of the viewport */
    }
    h1 {
        text-align: center;
    }
    .chart-container {
        position: relative;
        margin: auto;
        height: 600px; /* smaller height */
        width: 50%; /* smaller width */
    }
</style>
    <title>Admin Dashboard</title>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['admin_name']; ?>!</h1>
    </div>
    <div class="chart-container">
        <canvas id="bookings-chart"></canvas>
    </div>
    <!-- include the Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Get the canvas element
    var canvas = document.getElementById('bookings-chart');

    // Create the chart
    var chart = new Chart(canvas, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($data['days']); ?>,
            datasets: [{
                label: 'Number of Bookings',
                data: <?php echo json_encode($data['bookers']); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            elements: {
                point: {
                    radius: 6,
                    borderWidth: 3,
                    backgroundColor: 'rgba(255, 99, 132, 1)',
                    hoverRadius: 8,
                    hoverBorderWidth: 3
                },
                line: {
                    tension: 0 // set tension to 0 to remove curves
                }
            }
        }
    });
    </script>
</body>
</html>
