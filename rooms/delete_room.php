<?php
include('auth.php');
// include the database connection file
include ('../templates/base.html');
include('../config.php'); 
// get the ID of the room to be deleted from the URL parameter
$id = $_GET['id'];

// check if the admin clicked the delete button
if (isset($_POST['delete'])) {
    // delete the row from the database
    $sql = "DELETE FROM rooms WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        // redirect to the room list page
        header('Location: ../rooms.php');
        exit();
    } else {
        // display an error message if the deletion failed
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // close the database connection
    mysqli_close($conn);
}

// get the room details from the database
$sql = "SELECT * FROM rooms WHERE id = $id";
$result = mysqli_query($conn, $sql);
$room = mysqli_fetch_assoc($result);
?>

<!-- display the room details and the confirmation window -->
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h3>Delete Room <?php echo $room['room_number']; ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>Are you sure you want to delete Room <?php echo $room['room_number']; ?>?</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST">
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                <a href="/rooms.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>