<?php
  require "parts/auth_login.php";

  // connect to database
  $database = connectToDB();

  // get data from GET
  $id = $_GET["id"];
  // var_dump($id);

  // query for target user
  $sql = "SELECT * FROM posts WHERE id = :id"; 
  $query = $database -> prepare($sql);
  $query -> execute(["id" => $id]);
  $post = $query -> fetch();

  require "parts/header.php"; 
?>
  <div class="container mx-auto my-5" style="max-width: 700px">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h1">Edit Post</h1>
    </div>
    <div class="card mb-2 p-4">
      <?php require "parts/message_error.php"; ?>
      <form method="POST" action="/updatepost_action">
        <div class="mb-3">
          <label for="post-title" class="form-label">Title</label>
          <input
            type="text"
            class="form-control"
            id="post-title"
            name="title"
            value="<?= $post["title"]; ?>"
          />
        </div>
        <div class="mb-3">
          <label for="post-content" class="form-label">Content</label>
          <textarea 
            class="form-control"
            id="post-content"
            rows="10"
            name="content"><?= $post["content"]; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="post-content" class="form-label">Status</label>
          <!-- option disabled for non-admin/editors -->
          <select 
            class="form-control" 
            id="post-status" 
            name="status"
            <?= isUser()? "disabled": ""; ?>
          >
            <!-- assign "selected" attribute to preselect option based on status -->
            <option value="pending"
              <?= $post["status"] === "pending"? "selected": "" ?>
            >Pending Review</option>
            <option value="published"
              <?= $post["status"] === "published"? "selected": "" ?>
            >Published</option>
          </select>
        </div>
        <div class="d-grid">
          <input
            type="hidden"
            name="id"
            value="<?= $post["id"]; ?>"
          />
          <button type="submit" class="btn btn-primary">Update</button>
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