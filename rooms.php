<?php
include('auth.php');
// include the database connection file
include('config.php');
include('templates/admin.html');

// Retrieve the list of rooms
$sql = "SELECT * FROM rooms";
$result = mysqli_query($conn, $sql);

$rooms = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rooms[] = $row;
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h3>Rooms</h3>
        </div>
        <div class="col-2 text-right ml-auto">
            <a href="rooms/add_room.php" class="btn btn-primary">Add Room</a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Room Number</th>
                <th>Type</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?php echo $room['id']; ?></td>
                    <td><?php echo $room['room_number']; ?></td>
                    <td><?php echo $room['room_type']; ?></td>
                    <td><?php echo $room['room_description']; ?></td>
                    <td><?php echo $room['price']; ?></td>
                    <td>
                        <a href="rooms/edit_room.php?id=<?php echo $room['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="rooms/delete_room.php?id=<?php echo $room['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
// close database connection
mysqli_close($conn);
?>
