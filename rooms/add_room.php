<?php
include('auth.php');
include ('../templates/base.html');
include('../config.php'); 
?>
<div class="container">
  <div class="row justify-content-center">
  <div class="col-md-12 text-center">
        <h1>Add New Room</h1>
    </div>
    <div class="col-md-6">
      <form method="POST" action="" enctype="multipart/form-data">
          <div class="form-group">
              <label for="room_number">Room Number:</label>
              <input type="text" name="room_number" id="room_number" class="form-control" required>
          </div>
          <div class="form-group">
              <label for="room_type">Room Type:</label>
              <input type="text" name="room_type" id="room_type" class="form-control" required>
          </div>
          <div class="form-group">
              <label for="room_description">Room Description:</label>
              <textarea name="room_description" id="room_description" class="form-control" required></textarea>
          </div>
          <div class="form-group">
              <label for="price">Price:</label>
              <input type="number" name="price" id="price" class="form-control" required min="0" step="1">
          </div>
          <div class="form-group">
              <label for="room_images">Room Images:</label>
              <input type="file" name="room_images[]" id="room_images" class="form-control" multiple required>
          </div>
          <div style="text-align: center; margin-top: 10px;">
            <button type="submit" class="btn btn-primary">Add Room</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Connect to the database
  include('../config.php');
  
  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO rooms (room_number, room_type, room_description, price) VALUES (?, ?, ?, ?)");

  // Bind the parameters
  $stmt->bind_param('sssd', $_POST['room_number'], $_POST['room_type'], $_POST['room_description'], $_POST['price']);

  // Execute the query
  $stmt->execute();

  // Get the ID of the newly inserted room
  $room_id = $stmt->insert_id;

  if (!is_dir($IMAGES_SAVE_PATH)) {
      // Create the directory if it doesn't exist
      mkdir($IMAGES_SAVE_PATH, 0777, true);
  }

  if (is_writable($IMAGES_SAVE_PATH)) {
      $images = $_FILES['room_images'];
      $num_images = count($images['name']);

      for ($i = 0; $i < $num_images; $i++) {
          $tmp_name = $images['tmp_name'][$i];
          $extension = pathinfo($images['name'][$i], PATHINFO_EXTENSION);
          $file_name = uniqid('img_') . '.' . $extension;
          $file_path = $IMAGES_SAVE_PATH . $file_name;

          if (move_uploaded_file($tmp_name, $file_path)) {
              echo "The file has been uploaded successfully!";
          } else {
              echo "Sorry, there was an error uploading your file.";
          }

          // Save the image URL to the database
          $rel_path = 'rooms_images/' . $file_name;
          $stmt = $conn->prepare("INSERT INTO room_images (room_id, image_url) VALUES (?, ?)");
          $stmt->bind_param('is', $room_id, $rel_path);
          $stmt->execute();
      }
  } else {
      echo "Error: The upload directory is not writable.";
  }

  // Redirect to the admin page
  header('Location: /admin/rooms.php');
  exit;
}?>