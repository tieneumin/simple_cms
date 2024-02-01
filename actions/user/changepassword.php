<?php
require "parts/auth_admin.php";

// connect to database
$database = connectToDB();

// get data from SESSION, POST
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$id = $_POST["id"];

// error-handling
// ensure all fields filled
if (empty($password) || empty($confirm_password)) {
  setError("All fields are required.", "/changepassword?id=".$id);
// ensure password matches confirmation
} else if ($password !== $confirm_password) {
  setError("Passwords do not match.", "/changepassword?id=".$id);
// ensure password >= 8 characters 
} else if (strlen($password) < 8) {
  setError("Password must be at least 8 characters.", "/changepassword?id=".$id);
// ensure same password not used
} else {
  $sql = "SELECT * FROM users WHERE id = :id"; 
  $query = $database -> prepare($sql);
  $query -> execute(["id" => $id]);
  $user = $query -> fetch();
  if (password_verify($password, $user["password"])) {
    setError("New password is the same as current password.", "/changepassword?id=".$id);
  } else {

    // update password
    $sql = "UPDATE users SET password = :password WHERE id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
      "password" => password_hash($password, PASSWORD_DEFAULT),
      "id" => $id
    ]);

    // confirm password change and redirect
    setSuccess("Password changed.", "/manageuser");
  }
}