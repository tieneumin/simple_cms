<?php
// var_dump($_SERVER["DOCUMENT_ROOT"]); // '/www/kinsta/public/simple-cms'

// starts session; required on any page SESSION global variable is used
session_start();
// current session credentials
// if (isset($_SESSION["user"])) {
//   print_r($_SESSION["user"]);
// }

require "actions/functions.php";
// sanity check
// echo "<br>".$test;

// Uniform Resource Identifier requested by prior page i.e. header("Location: X");
$path = $_SERVER["REQUEST_URI"];
// to confirm routing
// var_dump($_SERVER["REQUEST_URI"]);

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
  // pending below actions  
  case 'addpost_action':
    require 'actions/posts/add.php';
    break;
  case 'updatepost_action':
    require 'actions/posts/update.php';
    break;
  case 'deletepost_action':
    require 'actions/posts/delete.php';
    break;
  case 'adduser_action':
    require 'actions/users/add.php';
    break;
  case 'updateuser_action':
    require 'actions/users/update.php';
    break;
  case 'changepassword_action':
    require 'actions/users/password.php';
    break;
  case 'deleteuser_action':
    require 'actions/users/delete.php';
    break;

  // pages
  case "manage-users-changepwd":
    $page_title_suffix = "Change Password";
    require "pages/manage-users-changepwd.php";
    break;
  case "manage-users-edit":
    $page_title_suffix = "Edit User";
    require "pages/manage-users-edit.php";
    break;
  case "manage-users-add":
    $page_title_suffix = "Add New User";
    require "pages/manage-users-add.php";
    break;
  case "manage-users":
    $page_title_suffix = "Manage Users";
    require "pages/manage-users.php";
    break;
  case "manage-posts-edit":
    $page_title_suffix = "Edit Post";
    require "pages/manage-posts-edit.php";
    break; 
  case "manage-posts-add":
    $page_title_suffix = "Add New Post";
    require "pages/manage-posts-add.php";
    break;  
  case "manage-posts":
      $page_title_suffix = "Manage Posts";
      require "pages/manage-posts.php";
      break;
  case "post":
    // $page_title_suffix = "Post";
    require "pages/post.php";
    break;
  case "dashboard":
    $page_title_suffix = "Dashboard";
    require "pages/dashboard.php";
    break;
  case "login":
    $page_title_suffix = "Login";
    require "pages/login.php";
    break;
  case "signup":
    $page_title_suffix = "Sign Up";
    require "pages/signup.php";
    break;
  default:
    $page_title_suffix = "Home";
    require "pages/home.php";
    break;
}