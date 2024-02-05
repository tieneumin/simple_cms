<?php // also applied to action files; otherwise, anyone with action route can trigger it
  // redirect user to login if not logged in
  if (!isLoggedIn()) {
    header("Location: /login");
  }
?>