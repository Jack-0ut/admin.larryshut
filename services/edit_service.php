<?php
// include the database connection file
include ('../templates/base.html');
include('../config.php'); 
// get the ID of the room to be edited from the URL parameter
$id = $_GET['id'];

// fetch the room data from the database
$sql = "SELECT * FROM services WHERE id = $id";
$result = mysqli_query($conn, $sql);
$service = mysqli_fetch_assoc($result);

// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get the form data
  $name = $_POST['name'];
  $price = $_POST['price'];

  // update the row in the database
  $sql = "UPDATE services SET name='$name', price=$price WHERE id=$id";
  if (mysqli_query($conn, $sql)) {
    // redirect to the room list page
    header('Location: ../services.php');
    exit();
  } else {
    // display an error message if the update failed
    echo "Error updating record: " . mysqli_error($conn);
  }
}

// close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h1>Edit Service</h1>
      <form method="POST" action="">
        <div class="form-group">
          <label for="room_type">Service Name:</label>
          <input type="text" name="name" id="name" class="form-control" value="<?php echo $service['name']; ?>" required>
        </div>
        <div class="form-group">
          <label for="price">Service Price:</label>
          <input type="number" name="price" id="price" class="form-control" value="<?php echo $service['price']; ?>" min="0" required>
        </div>
        <div style="text-align: center; margin-top: 10px;">
          <button type="submit" class="btn btn-primary">Update Service</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>