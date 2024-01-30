<?php
// var_dump($_SERVER["DOCUMENT_ROOT"]); // "/www/kinsta/public/simple-cms"

// start session; required on any page SESSION global variable is used
session_start();

// // current session credentials
// if (isset($_SESSION["user"])) {
//   print_r($_SESSION["user"]);
// } 

require "actions/functions.php";
// echo "<br>".$test; // sanity check

// Uniform Resource Identifier requested by prior page i.e. header("Location: X");
$path = $_SERVER["REQUEST_URI"];
// var_dump($_SERVER["REQUEST_URI"]); // current route

// // remove query from URL in GET scenario
// $path = parse_url($path, PHP_URL_PATH);

// remove starting slash
$path = trim($path, "/");

switch ($path) {
  // actions
  case "signup_action":
    require "actions/auth/signup.php";
    break;
  case "login_action":
    require "actions/auth/login.php";
    break;
  case "logout_action":
    require "actions/auth/logout.php";
    break;
  case "addpost_action":
    require "actions/post/add.php";
    break;
  case "updatepost_action":
    require "actions/post/update.php";
    break;
  case "deletepost_action":
    require "actions/post/delete.php";
    break;
  case "adduser_action":
    require "actions/user/add.php";
    break;
  case "updateuser_action":
    require "actions/user/update.php";
    break;
  case "changepassword_action":
    require "actions/user/changepassword.php";
    break;
  case "deleteuser_action":
    require "actions/user/delete.php";
    break;

  // pages
  case "signup":
    $subpage_title = "Sign Up";
    require "pages/signup.php";
    break;
  case "login":
    $subpage_title = "Login";
    require "pages/login.php";
    break;
  case "dashboard":
    $subpage_title = "Dashboard";
    require "pages/dashboard.php";
    break;
  case "post":
    // $subpage_title = "Post";
    require "pages/post.php";
    break;
  case "managepost":
    $subpage_title = "Manage Posts";
    require "pages/post/manage.php";
    break;
  case "addpost":
    $subpage_title = "Add New Post";
    require "pages/post/add.php";
    break;  
  case "editpost":
    $subpage_title = "Edit Post";
    require "pages/post/edit.php";
    break; 
  case "manageuser":
    $subpage_title = "Manage Users";
    require "pages/user/manage.php";
    break;
  case "adduser":
    $subpage_title = "Add New User";
    require "pages/user/add.php";
    break;
  case "edituser":
    $subpage_title = "Edit User";
    require "pages/user/edit.php";
    break;
  case "changepassword":
    $subpage_title = "Change Password";
    require "pages/user/changepassword.php";
    break;
  default:
    $subpage_title = "Home";
    require "pages/home.php";
    break;
}