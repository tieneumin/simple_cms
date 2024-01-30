<?php 
  // connect to database
  $database = connectToDB();

  // query for all users in descending order
  $sql = "SELECT * FROM users ORDER BY id DESC"; 
  $query = $database -> prepare($sql);
  $query -> execute();
  // ALL users
  $users = $query -> fetchAll();

  require "parts/header.php";
?>
  <div class="container mx-auto my-5" style="max-width: 700px">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h1">Manage Users</h1>
      <div class="text-end">
        <a href="/adduser" class="btn btn-primary btn-sm"
          >Add New User
        </a>
      </div>
    </div>
    <div class="card mb-2 p-4">
      <?php require "parts/message_success.php"; ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col" class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>

          <!-- array_reverse(foreach) also works if "ORDER BY id DESC" not used above -->
          <?php foreach ($users as $user): ?>
            <tr>
              <th scope="row"><?= $user["id"]; ?></th>
              <td><?= $user["name"]; ?></td>
              <td><?= $user["email"]; ?></td>
              <td>
                <!-- role-based formatting -->
                <?php if ($user["role"] === "admin"): ?>
                  <span class="badge bg-primary">Admin</span>
                <?php endif; ?>
                <?php if ($user["role"] === "editor"): ?>
                  <span class="badge bg-info">Editor</span>
                <?php endif; ?>
                <?php if ($user["role"] === "user"): ?>
                  <span class="badge bg-success">User</span>
                <?php endif; ?>
              </td>
              
              <td class="text-end">
                <div class="buttons">
                  <!-- edit button -->
                  <form method="POST" action="/edituser" class="d-inline">
                    <input 
                      type="hidden"
                      name="id"
                      value="<?= $user["id"]; ?>"
                    />
                    <button class="btn btn-success btn-sm me-2">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </form>
                  <!-- changepwd button -->
                  <form method="POST" action="/changepassword" class="d-inline">
                    <input 
                      type="hidden"
                      name="id"
                      value="<?= $user["id"]; ?>"
                    />
                    <button class="btn btn-warning btn-sm me-2">
                      <i class="bi bi-key"></i>
                    </button>
                  </form>
                  <!-- delete button -->
                  <form method="POST" action="/deleteuser_action" class="d-inline">
                    <input 
                      type="hidden"
                      name="id"
                      value="<?= $user["id"]; ?>"
                    />
                    <button class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
    <div class="text-center">
      <a href="/dashboard" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
      >
    </div>
  </div>

<?php require "parts/footer.php"; ?>