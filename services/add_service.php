<?php
include('auth.php');
// include the database connection file
include('../config.php');
// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrieve the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // insert the new service into the database
    $sql = "INSERT INTO services (name, price) VALUES ('$name', '$price')";
    mysqli_query($conn, $sql);

    // redirect back to the services page
    header('Location: /services.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Service</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
  <div class="col-md-12 text-center">
        <h1>Add New Service</h1>
  </div>
    <div class="col-md-6">
      <form method="POST" action="" enctype="multipart/form-data">
          <div class="form-group">
              <label for="name">Service Name:</label>
              <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <div class="form-group">
              <label for="price">Service Price:</label>
              <input type="number" name="price" id="price" class="form-control" required min="0" step="1">
          </div>
          <div style="text-align: center; margin-top: 10px;">
            <button type="submit" class="btn btn-primary">Add Room</button>
          </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>