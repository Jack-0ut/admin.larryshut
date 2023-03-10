<?php
include('auth.php');
// include the database connection file
include ('../templates/base.html');
include('../config.php'); 

$id = $_GET['id'];

// check if the admin clicked the delete button
if (isset($_POST['delete'])) {
    // delete the row from the database
    $sql = "DELETE FROM admins WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        // redirect to the room list page
        header('Location: ../admins.php');
        exit();
    } else {
        // display an error message if the deletion failed
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // close the database connection
    mysqli_close($conn);
}

// get the room details from the database
$sql = "SELECT * FROM admins WHERE id = $id";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);
?>

<!-- display the room details and the confirmation window -->
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h3>Delete Admin <?php echo $admin['admin_name']; ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>Are you sure you want to delete Admin <?php echo $admin['admin_name']; ?>?</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST">
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                <a href="/admins.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>