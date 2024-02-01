<?php
  require "parts/auth_admin.php";
  
  // connect to database
  $database = connectToDB();

  // // if id sent to POST, create edit instance for id
  // if (isset($_POST["id"])) {
  //   $_SESSION["id"] = $_POST["id"];
  // }
  // var_dump($_SESSION["id"]); // sanity check

  // get data from GET
  $id = $_GET["id"];
  // var_dump($id);

  // query for target user
  $sql = "SELECT * FROM users WHERE id = :id"; 
  $query = $database -> prepare($sql);
  $query -> execute(["id" => $id]);
  $user = $query -> fetch();

  require "parts/header.php";
?>
  <div class="container mx-auto my-5" style="max-width: 700px">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h1">Change Password for <?= $user["name"]; ?></h1>
    </div>
    <div class="card mb-2 p-4">
      <?php require "parts/message_error.php"; ?>

      <form method="POST" action="changepassword_action">
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="password" class="form-label">New Password</label>
              <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password"
              />
            </div>
            <div class="col">
              <label for="confirm_password" class="form-label"
                >Confirm Password</label
              >
              <input
                type="password"
                class="form-control"
                id="confirm_password"
                name="confirm_password"
              />
            </div>
          </div>
        </div>
        <div class="d-grid">
          <input 
            type="hidden"
            name="id"
            value="<?= $user["id"]; ?>"
          />
          <button type="submit" class="btn btn-primary">
            Change Password
          </button>
        </div>
      </form>
      
    </div>
    <div class="text-center">
      <a href="/manageuser" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back to Users</a
      >
    </div>
  </div>

<?php require "parts/footer.php"; ?>