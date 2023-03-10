<?php
session_start();

// check if the user is logged in
if (!isset($_SESSION['admin'])) {
  // redirect to the login.php file
  header('Location: login.php');
  exit();
}
?>