<?php
require "parts/auth_login.php";

// connect to database
$database = connectToDB();

// get id from POST
$id = $_POST["id"];
// var_dump($id);

// delete post
$sql = "DELETE FROM posts where id = :id";
$query = $database -> prepare($sql);
$query -> execute(["id" => $id]);

// confirm post deletion and redirect
setSuccess("Post deleted.", "/managepost");