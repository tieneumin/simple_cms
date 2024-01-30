<?php
// connect to database
$database = connectToDB();

// get data from POST
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$role = $_POST["role"];

// error-handling
// ensure all fields filled
if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
  setError("All fields are required.", "/adduser");
// ensure password matches confirmation
} else if ($password !== $confirm_password) {
  setError("Passwords do not match.", "/adduser");
// ensure password >= 8 characters 
} else if (strlen($password) < 8) {
  setError("Password must be at least 8 characters.", "/adduser");
} else {
  // ensure email not in use 1/2
  $sql = "SELECT * FROM users WHERE email = :email";
  $query = $database -> prepare($sql);
  $query -> execute(["email" => $email]);
  $user = $query -> fetch();
  if (empty($user)) {
    
    // add user account
    $sql = "INSERT INTO users (`name`,`email`,`password`,`role`) VALUES (:name, :email, :password, :role)";
    $query = $database -> prepare($sql);
    $query -> execute([
      "name" => $name,
      "email" => $email,
      "password" => password_hash($password, PASSWORD_DEFAULT),
      "role" => $role
    ]);

    // confirm user added
    $_SESSION["success"] = "User added.";
    
    // redirect to Manage Users
    header("Location: /manageuser");
    exit;

  // ensure email not in use 2/2
  } else {
    setError("Email is already in use.", "/adduser");
  }
}