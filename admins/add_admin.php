<?php
  include('auth.php');
  include('../templates/base.html');
  include('../config.php');

  // check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if passwords match
    if ($_POST['admin_password'] != $_POST['admin_password_confirm']) {
        // Passwords do not match, display error message
        echo "Passwords do not match.";
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO admins (admin_name, admin_email, admin_phone, admin_password) VALUES (?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param('ssss', $admin_name, $admin_email, $admin_phone, $admin_password);

    // set parameters and execute
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_phone = $_POST['admin_phone'];
    $admin_password = $_POST['admin_password'];

    // execute the SQL statement
    if ($stmt->execute() === TRUE) {
        echo "New admin added successfully!";
        // redirect to admins.php
        header("Location: /");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // close the statement and database connection
    $stmt->close();
    $conn->close();
  }
?>
<title>Add Admin</title>

<div class="container">
  <div class="row justify-content-center">
  <div class="col-md-12 text-center">
      <h1>Add New Admin</h1>
  </div>
  <div class="col-md-6">
    <form action="" method="POST">
      <div class="form-group">
        <label for="admin_name">Name</label>
        <input type="text" class="form-control" id="admin_name" name="admin_name" required>
      </div>
      <div class="form-group">
        <label for="admin_email">Email</label>
        <input type="email" class="form-control" id="admin_email" name="admin_email" required>
      </div>
      <div class="form-group">
        <label for="admin_phone">Phone Number</label>
        <input type="tel" class="form-control" id="admin_phone" name="admin_phone" required>
      </div>
      <div class="form-group">
        <label for="admin_password">Password</label>
        <input type="password" class="form-control" id="admin_password" name="admin_password" required>
      </div>
      <div class="form-group">
        <label for="admin_password_confirm">Confirm Password</label>
        <input type="password" class="form-control" id="admin_password_confirm" name="admin_password_confirm" required>
      </div>
      <div style="text-align: center; margin-top: 10px;">
            <button type="submit" class="btn btn-primary">Add Admin</button>
      </div>
    </form>
  </div>
  </div>
</div>
