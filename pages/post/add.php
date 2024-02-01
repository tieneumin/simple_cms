<?php
  require "parts/auth_login.php";
  require "parts/header.php";
?>
  <div class="container mx-auto my-5" style="max-width: 700px">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h1">Add New Post</h1>
    </div>
    <div class="card mb-2 p-4">
      <?php require "parts/message_error.php"; ?>

      <form method="POST" action="/addpost_action">
        <div class="mb-3">
          <label for="post-title" class="form-label">Title</label>
          <input 
            type="text"
            class="form-control"
            id="post-title"
            name="title"
          >
        </div>
        <div class="mb-3">
          <label for="post-content" class="form-label">Content</label>
          <textarea
            class="form-control"
            id="post-content"
            rows="10"
            name="content"
          ></textarea>
        </div>
        <div class="d-grid">
          <input
            type="hidden"
            name="user_id"
            value="<?= $_SESSION["user"]["id"]; ?>"
          />
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>

    </div>
    <div class="text-center">
      <a href="/managepost" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back to Posts</a
      >
    </div>
  </div>

<?php require "parts/footer.php"; ?>