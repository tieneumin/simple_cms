<?php
require "parts/auth_login.php";

// connect to database
$database = connectToDB();

// get data from POST
$title = $_POST["title"];
$content = $_POST["content"];
$status = $_POST["status"];
$id = $_POST["id"];

// error-handling
// ensure all fields filled
if (empty($title) || empty($content) || empty($status)) {
  setError("All fields are required.", "/editpost?id=".$id);
} else {
    // update post
    $sql = "UPDATE posts SET title = :title, content = :content, status = :status WHERE id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
      "title" => $title,
      "content" => $content,
      "status" => $status,
      "id" => $id
    ]);

    // confirm post updated and redirect
    setSuccess("Post updated.", "/managepost");
}
