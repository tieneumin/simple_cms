<?php
  // redirect user to login if not logged in
  if (!isLoggedIn()) {
    header("Location: /login");
  }
?>