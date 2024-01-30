<?php require "parts/header.php"; ?>
  <div class="container mx-auto my-5" style="max-width: 700px">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h1">Add New User</h1>
    </div>
    <div class="card mb-2 p-4">
      <?php require "parts/message_error.php"; ?>
      <form method="POST" action="/adduser_action">
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="name" class="form-label">Name</label>
              <input 
                type="text" 
                class="form-control" 
                id="name" 
                name="name" 
              />
            </div>
            <div class="col">
              <label for="email" class="form-label">Email</label>
              <input 
                type="email" 
                class="form-control" 
                id="email" 
                name="email" 
              />
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="password" class="form-label">Password</label>
              <input 
                type="password" 
                class="form-control" 
                id="password"
                name="password" 
              />
            </div>
            <div class="col">
              <label for="confirm_password" class="form_label"
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
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select
            class="form-control" 
            id="role" 
            name="role"
          >
            <option value="">Select an option</option>
            <option value="user">User</option>
            <option value="editor">Editor</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
    <div class="text-center">
      <a href="/manage-users" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back to Users</a
      >
    </div>
  </div>

<?php require "parts/footer.php"; ?>