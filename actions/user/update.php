<?php
// connect to database
$database = connectToDB();

// get data from SESSION, POST
$id = $_SESSION["edit"];
$name = $_POST["name"];
$email = $_POST["email"];
$role = $_POST["role"];

// error-handling
// ensure all fields filled
if (empty($name) || empty($email) || empty($role)) {
  setError("All fields are required.", "/edituser");
} else {
  // ensure email not in use 1/2
  $sql = "SELECT * FROM users WHERE email = :email";
  $query = $database -> prepare($sql);
  $query -> execute(["email" => $email]);
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

    // clear edit instance
    unset($_SESSION["edit"]);

    // confirm user update
    $_SESSION["success"] = "User updated.";
    
    // redirect to Manage Users
    header("Location: /manageuser");
    exit;

  // ensure email not in use 2/2
  } else {
    setError("Email is already in use.", "/edituser");
  }
}