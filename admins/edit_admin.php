<?php
include('../auth.php');
// include the database connection file
include ('../templates/base.html');
include('../config.php'); 
// get the ID of the admin to be edited from the URL parameter
$id = $_GET['id'];

// fetch the room data from the database
$sql = "SELECT * FROM admins WHERE id = $id";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);

// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get the form data
  $admin_name = $_POST['admin_name'];
  $admin_email = $_POST['admin_email'];
  $admin_phone = $_POST['admin_phone'];
  $admin_password = $_POST['admin_password'];

  // update the row in the database
  $sql = "UPDATE admins SET admin_name='$admin_name', admin_email='$admin_email', admin_phone='$admin_phone', admin_password='$admin_password' WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    header('Location: ../admins.php');
    exit();
  } else {
    // display an error message if the update failed
    echo "Error updating record: " . mysqli_error($conn);
  }
}

// close the database connection
mysqli_close($conn);
?>
<title>Edit Admin</title>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <h1>Edit Admin</h1>
        </div>
        <div class="col-md-6">
            <form action="" method="POST">
            <div class="form-group">
                <label for="admin_name">Name</label>
                <input type="text" class="form-control" id="admin_name" name="admin_name" value="<?php echo $admin['admin_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="admin_email">Email</label>
                <input type="email" class="form-control" id="admin_email" name="admin_email" value="<?php echo $admin['admin_email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="admin_phone">Phone Number</label>
                <input type="tel" class="form-control" id="admin_phone" name="admin_phone" value="<?php echo $admin['admin_phone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="admin_password">Password</label>
                <input type="password" class="form-control" id="admin_password" name="admin_password" value="<?php echo $admin['admin_password']; ?>" required>
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <button type="submit" class="btn btn-primary">Update Room</button>
            </div>
            </form>
        </div>
    </div>
</div>