<?php // all functions go here

// for pages/actions requiring database info
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
   
// error message
function setError($error_message, $redirect_page) {
    $_SESSION["error"] = $error_message;
    // redirect back to login page
    header("Location: " . $redirect_page);
    exit;
}

$test = "functions.php is parsing correctly";