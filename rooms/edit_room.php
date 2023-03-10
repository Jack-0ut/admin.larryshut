<?php
// include the database connection file
include('auth.php');
include ('../templates/base.html');
include('../config.php'); 
// get the ID of the room to be edited from the URL parameter
$id = $_GET['id'];

// fetch the room data from the database
$sql = "SELECT * FROM rooms WHERE id = $id";
$result = mysqli_query($conn, $sql);
$room = mysqli_fetch_assoc($result);

// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get the form data
  $room_number = $_POST['room_number'];
  $room_type = $_POST['room_type'];
  $room_description = $_POST['room_description'];
  $price = $_POST['price'];

  // update the row in the database
  $sql = "UPDATE rooms SET room_number='$room_number', room_type='$room_type', room_description='$room_description', price=$price WHERE id=$id";
  if (mysqli_query($conn, $sql)) {
    // redirect to the room list page
    header('Location: ../rooms.php');
    exit();
  } else {
    // display an error message if the update failed
    echo "Error updating record: " . mysqli_error($conn);
  }
}

// close the database connection
mysqli_close($conn);
?>
<title>Edit Room</title>
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h1>Edit Room</h1>
      <form method="POST" action="">
        <div class="form-group">
          <label for="room_number">Room Number:</label>
          <input type="text" name="room_number" id="room_number" class="form-control" value="<?php echo $room['room_number']; ?>" required>
        </div>
        <div class="form-group">
          <label for="room_type">Room Type:</label>
          <input type="text" name="room_type" id="room_type" class="form-control" value="<?php echo $room['room_type']; ?>" required>
        </div>
        <div class="form-group">
          <label for="room_description">Room Description:</label>
          <textarea name="room_description" id="room_description" class="form-control" required><?php echo $room['room_description']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="price">Price:</label>
          <input type="number" name="price" id="price" class="form-control" value="<?php echo $room['price']; ?>" min="0" required>
        </div>
        <div style="text-align: center; margin-top: 10px;">
          <button type="submit" class="btn btn-primary">Update Room</button>
        </div>
      </form>
    </div>
  </div>
</div>
