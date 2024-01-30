<?php
// connect to database
$database = connectToDB();

// get data from SESSION, POST
$id = $_SESSION["edit"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// error-handling
// ensure all fields filled
if (empty($password) || empty($confirm_password)) {
  setError("All fields are required.", "/changepassword");
// ensure password matches confirmation
} else if ($password !== $confirm_password) {
  setError("Passwords do not match.", "/changepassword");
// ensure password >= 8 characters 
} else if (strlen($password) < 8) {
  setError("Password must be at least 8 characters.", "/changepassword");
} else {

  // update password
  $sql = "UPDATE users SET password = :password WHERE id = :id";
  $query = $database -> prepare($sql);
  $query -> execute([
    "password" => password_hash($password, PASSWORD_DEFAULT),
    "id" => $id
  ]);

  // clear edit instance
  unset($_SESSION["edit"]);

  // confirm password change
  $_SESSION["success"] = "Password changed.";
  
  // redirect to Manage Users
  header("Location: /manageuser");
  exit;
}