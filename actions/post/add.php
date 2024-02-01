<?php
require "parts/auth_login.php";

// connect to database
$database = connectToDB();

// get data from POST
$title = $_POST["title"];
$content = $_POST["content"];
$user_id = $_POST["user_id"];

// error-handling
// ensure all fields filled
if (empty($title) || empty($content)) {
  setError("All fields are required.", "/addpost");
} else {
  // add post
  $sql = "INSERT INTO posts (`title`,`content`,`user_id`) VALUES (:title, :content, :user_id)";
  $query = $database -> prepare($sql);
  $query -> execute([
    "title" => $title,
    "content" => $content,
    "user_id" => $user_id
  ]);

  // confirm post added and redirect
  setSuccess("Post added.", "/managepost");
}