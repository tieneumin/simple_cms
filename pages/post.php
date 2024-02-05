<?php
  $database = connectToDB();

  // get data from GET if available
  $id = isset($_GET["id"])? $_GET["id"]: "";

  // query for target post
  $sql = "SELECT posts.*, users.name AS username
    FROM posts
    JOIN users
    ON posts.user_id = users.id
    WHERE posts.id = :id AND status = :status"; 
  $query = $database -> prepare($sql);
  $query -> execute([
    "id" => $id,
    "status" => "published"
  ]);
  $post = $query -> fetch();

  require "parts/header.php";
?>
  <div class="container mx-auto my-5" style="max-width: 500px">
    <!-- show post if published, error if not; $post returns false if query not found -->
    <?php if ($post): ?>
      <h1 class="h1 text-center"><?= $post["title"]; ?></h1>
      <!-- $post["username"] possible via AS and JOIN/ON -->
      <h6 class="mb-3 text-center">By <?= $post["username"]; ?></h6>
      <!-- long method to code paragraphing:
      $paragraph_array = preg_split("/\n\s*\n/", $post["content"]);
      foreach ($paragraph_array as $paragraph) {
        echo "<p>$paragraph</p>";
      } -->
      <p><?= nl2br($post["content"]); ?></p>
    <?php else: ?>
      <p class="lead text-center">This post is not available.</h1>
    <?php endif; ?>

    <div class="text-center mt-3">
      <!-- should vary; either / or /manage-posts -->
      <a href="/" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back</a
      >
    </div>
  </div>

<?php require "parts/footer.php"; ?>