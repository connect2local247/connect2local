<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include "../../../../asset/link/cdn-link.html"; ?>
</head>
<body> 
  <div class="card">
      <div class="card-content">
        <?php include "blog-data.php";?>
        <?php  $row = fetch_blog($blog_id); ?>
        <?php include "blog-header.php"; ?>
        <?php include "blog-body.php"; ?>
        <?php include "blog-footer.php"; ?>
      </div>
  </div>
</body>
</html>