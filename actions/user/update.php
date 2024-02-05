<?php
require "parts/auth_admin.php";

// connect to database
$database = connectToDB();

// get data from POST
$name = $_POST["name"];
$email = $_POST["email"];
$role = $_POST["role"];
$id = $_POST["id"];

// error-handling
// ensure all fields filled
if (empty($name) || empty($email)) {
  setError("All fields are required.", "/edituser?id=".$id);
} else {
  // ensure email not in use AND not checking self 1/2; prevents "email in use" if email not edited
  $sql = "SELECT * FROM users WHERE email = :email AND id != :id";
  $query = $database -> prepare($sql);
  $query -> execute([
    "email" => $email,
    "id" => $id
  ]);
  $user = $query -> fetch();
  if (empty($user)) {

    // update user
    $sql = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
      "name" => $name,
      "email" => $email,
      "role" => $role,
      "id" => $id
    ]);

    // confirm user updated and redirect
    setSuccess("User updated.", "/manageuser");

  // ensure email not in use AND not checking self 2/2;
  } else {
    setError("Email is already in use.", "/edituser?id=".$id);
  }
}