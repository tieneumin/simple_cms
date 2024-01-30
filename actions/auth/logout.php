<?php
// log user out
unset($_SESSION['user']);

// redirect to home page
header("Location: /");
exit;