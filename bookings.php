<?php
include('auth.php');
// include the database connection file
include('config.php');
include('templates/admin.html');

// Retrieve the list of bookings
$result = mysqli_query($conn, "SELECT * FROM bookings");
$bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h3>Bookings</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room ID</th>
                        <th>Guest Name</th>
                        <th>Guest Email</th>
                        <th>Check-IN</th>
                        <th>Check-OUT</th>
                        <th>Booking Date</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo $booking['id']; ?></td>
                            <td><?php echo $booking['room_id']; ?></td>
                            <td><?php echo $booking['guest_name']; ?></td>
                            <td><?php echo $booking['guest_email']; ?></td>
                            <td><?php echo $booking['checkin_date']; ?></td>
                            <td><?php echo $booking['checkout_date']; ?></td>
                            <td><?php echo $booking['booking_date']; ?></td>
                            <td><?php echo $booking['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div
