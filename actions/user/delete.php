<?php
require "parts/auth_admin.php";

// connect to database
$database = connectToDB();

// get id from POST
$id = $_POST["id"];
// var_dump($id);

// delete user
$sql = "DELETE FROM users where id = :id";
$query = $database -> prepare($sql);
$query -> execute(["id" => $id]);

// confirm user deletion and redirect
setSuccess("User deleted.", "/manageuser");
 