<?php
  require "parts/auth_admin.php";

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
                  <!-- edit button
                  - GET format required for edit/changepwd buttons to accomodate both 
                  manage_page -> edit_page AND update_action (cannot POST) -> edit_page -->
                  <a
                    href="/edituser?id=<?= $user["id"]; ?>"
                    class="btn btn-success btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
                  <!-- changepwd button -->
                  <a
                    href="/changepassword?id=<?= $user["id"]; ?>"
                    class="btn btn-warning btn-sm me-2"
                    ><i class="bi bi-key"></i
                  ></a>
                  <!-- delete button
                  - assign "disabled" attribute to current user to prevent admin from deleting self
                  - ensure unique modal targeted to avoid potential issues -->
                  <button 
                    class="btn btn-danger btn-sm"
                    <?= $user["id"] === $_SESSION["user"]["id"]? "disabled": "" ?>
                    data-bs-toggle="modal"
                    data-bs-target="#deleteusermodal<?= $user["id"]; ?>"
                    ><i class="bi bi-trash"></i
                  ></button>

                  <!-- delete modal -->
                  <div class="modal fade text-start" id="deleteusermodal<?= $user["id"]; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5">Are you sure you want to delete this user?<br>(<?= $user["email"]; ?>)</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          This action cannot be reversed.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <form method="POST" action="/deleteuser_action">
                            <input 
                              type="hidden"
                              name="id"
                              value="<?= $user["id"]; ?>"
                            />
                            <!-- button w attribute type="button" does not work with forms -->
                            <button class="btn btn-danger">Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

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