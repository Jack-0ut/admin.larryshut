<?php
session_start();
include('config.php');
include('templates/base.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['admin_email'];
  $password = $_POST['admin_password'];

  // check if the email and password match a record in the admins table
  $sql = "SELECT * FROM admins WHERE admin_email='$email' AND admin_password='$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    // get the name of the logged-in user
    $row = mysqli_fetch_assoc($result);
    $admin_name = $row['admin_name'];

    // set session variables to indicate that the user is logged in and store their name
    $_SESSION['admin'] = true;
    $_SESSION['admin_name'] = $admin_name;

    // redirect to the admin.php file
    header('Location: admin.php');
    exit();
  } else {
    $error = 'Invalid email or password';
  }
}

// close the database connection
mysqli_close($conn);

?>
<title>Login</title>
<div class="container">
  <div class="row justify-content-center">
  <div class="col-md-12 text-center">
      <h1>Enter your email and password to use Admin Panel</h1>
  </div>
  <div class="col-md-6">
    <form action="" method="POST">
      <div class="form-group">
        <label for="admin_email">Email</label>
        <input type="email" class="form-control" id="admin_email" name="admin_email" required>
      </div>
      <div class="form-group">
        <label for="admin_password">Password</label>
        <input type="password" class="form-control" id="admin_password" name="admin_password" required>
      </div>
      <div style="text-align: center; margin-top: 10px;">
            <button type="submit" class="btn btn-primary">Log In</button>
      </div>
    </form>
  </div>
  </div>
</div>
