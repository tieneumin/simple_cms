<?php   
// make sure the user is logged in
if ( !isset( $_SESSION["user"] ) ) {
  // if is not logged in, redirect to /login page
  header("Location: /login");
  exit;
}

// make sure only admin can see certain pages; ! = inverse i.e. is not Logged In
if (!isAdmin()) {
  // if is not admin, then redirect the user back to /dashboard
  header("Location: /");
  exit;
}

// apply above and if (isAdmin()) to action files; otherwise, anyone with route to action can trigger it