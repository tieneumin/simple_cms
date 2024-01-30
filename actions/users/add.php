<?php
// connect to database
$database = connectToDB();

// get posted form data
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$role = $_POST["role"];

// error-handling
// ensure all fields filled
if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
  setError("All fields are required.", "/manage-users-add");
// ensure password matches confirmation
} else if ($password !== $confirm_password) {
  setError("Passwords do not match.", "/manage-users-add");
// ensure password >= 8 characters 
} else if (strlen($password) < 8) {
  setError("Password must be at least 8 characters.", "/manage-users-add");
} else {
  // ensure email not in use
  $sql = "SELECT * FROM users WHERE email = :email";
  $query = $database -> prepare($sql);
  $query -> execute(["email" => $email]);
  $user = $query -> fetch();

  if (empty($user)) {
    // create user account
    $sql = "INSERT INTO users (`name`,`email`,`password`,`role`) VALUES (:name, :email, :password, :role)";
    $query = $database -> prepare($sql);
    $query -> execute([
      "name" => $name,
      "email" => $email,
      "password" => password_hash($password, PASSWORD_DEFAULT),
      "role" => $role
    ]);

    // confirm account creation
    $_SESSION["success"] = "User successfully added.";
    
    // redirect to manage users
    header("Location: /manage-users");
    exit;

  } else {
    setError("Email is already in use.", "/manage-users-add");
  }
}