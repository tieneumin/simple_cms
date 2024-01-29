<?php
// connect to database
$database = connectToDB();

// get posted form data
$email = $_POST["email"];
$password = $_POST["password"];

// error-handling
// ensure all fields filled
if (empty($email) || empty($password)) {
  setError( "All fields are required.", "/login" );
} else {
  // ensure user exists
  $sql = "SELECT * FROM users WHERE email = :email";
  $query = $database -> prepare($sql);
  $query -> execute(["email" => $email]);
  $user = $query -> fetch();
  if (empty($user)) {
    setError("Account does not exist.", "/login");
  } else {
    // ensure password correct
    if (password_verify($password, $user["password"])) {
      // log user in
      $_SESSION["user"] = $user;
      // redirect to home
      header("Location: /");
      exit;
    } else {
      setError("Incorrect password.", "/login");
    }
  }
}