<?php // all functions go here
$test = "functions.php is patching correctly";

// required for pages/actions querying database info
function connectToDB() {
  $host = "devkinsta_db";
  $database_name = "Simple_CMS";
  $database_user = "root";
  $database_password = "in4VkcqsYWTIdopj";

  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
  );
  return $database;
}
   
// for error message
function setError($error_message, $redirect_page) {
  $_SESSION["error"] = $error_message;
  // redirect to other page
  header("Location: " . $redirect_page);
  exit;
}

// for success message
function setSuccess($success_message, $redirect_page) {
  $_SESSION["success"] = $success_message;
  // redirect to other page
  header("Location: " . $redirect_page);
  exit;
}

// redirects
// check if logged in
function isLoggedIn() {
  return isset($_SESSION["user"]);
}

// checks if logged in and admin 
function isAdmin() {
  return isLoggedIn() && $_SESSION["user"]["role"] === "admin";
}

// checks if logged in and editor
function isEditor() {
  return isLoggedIn() && $_SESSION["user"]["role"] === "editor";
}

// checks if logged in and user
function isUser() {
  return isLoggedIn() && $_SESSION["user"]["role"] === "user";
}