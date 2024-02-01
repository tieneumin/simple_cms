<?php
  require "parts/auth_login.php";

  // connect to database
  $database = connectToDB();

  // admin & editor see all posts; users see own post
  if (isAdmin() || isEditor()) {
    $sql = "SELECT * FROM posts ORDER BY id DESC"; 
    $query = $database -> prepare($sql);
    $query -> execute();
  } else {  
    $user_id = $_SESSION["user"]["id"];
    $sql = "SELECT * FROM posts WHERE user_id = :user_id ORDER BY id DESC";
    $query = $database -> prepare($sql);
    $query -> execute(["user_id" => $user_id]);
  }
  // ALL posts
  $posts = $query -> fetchAll();
    
  require "parts/header.php"; 
?>
  <div class="container mx-auto my-5" style="max-width: 700px">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h1">Manage Posts</h1>
      <div class="text-end">
        <a href="/addpost" class="btn btn-primary btn-sm"
          >Add New Post</a
        >
      </div>
    </div>
    <div class="card mb-2 p-4">
      <?php require "parts/message_success.php"; ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col" style="width: 40%">Title</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>

          <!-- array_reverse(foreach) also works if "ORDER BY id DESC" not used above -->
          <?php foreach ($posts as $post): ?>
            <tr>
              <th scope="row"><?= $post["id"]; ?></th>
              <td><?= $post["title"]; ?></td>
              <td>
                <!-- status-based formatting -->
                <?php if ($post["status"] === "pending"): ?>
                  <span class="badge bg-warning">Pending Review</span>
                <?php endif; ?>
                <?php if ($post["status"] === "published"): ?>
                  <span class="badge bg-success">Published</span>
                <?php endif; ?>
              </td>
              <td class="text-end">
                <div class="buttons">
                  <!-- view button -->
                  <!-- href only works with anchor; Bootstrap "disabled" class used -->
                  <a
                    href="/post?id=<?= $post["id"]; ?>"
                    target="_blank"
                    class="btn btn-primary btn-sm me-2 <?= $post["status"] === "pending"? "disabled": "" ?>"
                    ><i class="bi bi-eye"></i
                  ><a>
                  <!-- edit button -->
                  <a
                    href="/editpost?id=<?= $post["id"]; ?>"
                    class="btn btn-secondary btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
                  <!-- delete button
                  - ensure unique modal targeted to avoid potential issues -->
                  <button 
                    class="btn btn-danger btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#deletepostmodal<?= $post["id"]; ?>"
                    ><i class="bi bi-trash"></i
                  ></button>

                  <!-- delete modal -->
                  <div class="modal fade text-start" id="deletepostmodal<?= $post["id"]; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5">Are you sure you want to delete this post?<br>(<?= $post["title"]; ?>)</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          This action cannot be reversed.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <form method="POST" action="/deletepost_action">
                            <input 
                              type="hidden"
                              name="id"
                              value="<?= $post["id"]; ?>"
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