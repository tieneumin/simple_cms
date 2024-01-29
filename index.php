<?php
// var_dump($_SERVER["DOCUMENT_ROOT"]); // '/www/kinsta/public/simple-cms'

session_start();
require "actions/functions.php";
echo $test;
echo $_SESSION["user"];

// get user's path i.e. header("Location: X");
$path = $_SERVER["REQUEST_URI"]; 
var_dump($_SERVER["REQUEST_URI"]);

// remove starting slash
$path = trim($path, "/");

switch ($path) {
    // actions
    case "login_action":
      require "actions/auth/login.php";
      break;
    case "signup_action":
      require "actions/auth/signup.php";
      break;
    // case 'student/add':
    //   require 'includes/student/add.php';
    //   break;
    // case 'student/update':
    //   require 'includes/student/update.php';
    //   break;
    // case 'student/delete':
    //   require 'includes/student/delete.php';
    //   break;

    // pages
    // case "posts":
    //   require "pages/manage/posts.php";
    //   break;
    // case "posts/add":
    //   require "pages/manage/posts/add.php";
    //   break;
    // case "posts/edit":
    //   require "pages/manage/posts/edit.php";
    //   break;
    // case "users":
    //   require "pages/manage/users.php";
    //   break;
    // case "users/add":
    //   require "pages/manage/users/add.php";
    //   break;
    // case "users/changepwd":
    //   require "pages/manage/users/changepwd.php";
    //   break;
    // case "users/edit":
    //   require "pages/manage/users/edit.php";
    //   break;
    
    case "dashboard":
      $page_title_suffix = "Dashboard";
      require "pages/dashboard.php";
      break;
    case "login":
      $page_title_suffix = "Login";
      require "pages/login.php";
      break;
    case "post":
      // $page_title_suffix = "Post";
      require "pages/post.php";
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