<?php
// logs user out
unset($_SESSION['user']);

// redirect user to home page
header("Location: /");
exit;