<?php
// connect to database
$database = connectToDB();

// get posted form data
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// error-handling
// ensure all fields filled
if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
     setError("All fields are required.", "/signup");
// ensure email not in use; DOES NOT WORK
// } else if (isset($email)) {
//      $check_sql = "SELECT * FROM users WHERE email = :email";
//      $check_query = $database -> prepare($check_sql);
//      $check_query -> execute(["email" => $email]);
//      if ($check_query -> rowCount() > 0) {
//           setError("Email is already in use.", "/signup");
//      }
// ensure password matches confirmation
} else if ($password !== $confirm_password) {
     setError("Passwords do not match.", "/signup");
// ensure password >= 8 characters 
} else if (strlen($password) < 8) {
     setError("Password must be at least 8 characters.", "/signup");
     
// create user account
} else {
     $create_sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";
     $create_query = $database -> prepare($create_sql);
     $create_query -> execute([
          "name" => $name,
          "email" => $email,
          "password" => password_hash($password, PASSWORD_DEFAULT)
     ]);

     // redirect to login
     header("Location: /login");
     exit;
}