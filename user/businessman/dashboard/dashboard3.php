<?php
      include "../../../includes/table_query/db_connection.php";
      
      include "blog/blog-data.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/asset/css/style.css">
  <?php include "../../../asset/link/cdn-link.html" ?>
</head>
<body>
  
</body>
</html>
<div class="container">
  <div class="row">
        
        <div class="col-4">
              <?php fetch_blog("BLG0000002") ?>
            </div>
            
            <div class="col-4">
                  <?php fetch_blog("BLG0000014") ?>
            </div>
      <div class="col-4">
            <?php fetch_blog("BLG0000003") ?>
      </div>
  </div>
  <div class="row">
      
  <div class="col-4">
            <?php fetch_blog("BLG0000004") ?>
      </div>

      <div class="col-4">
            <?php fetch_blog("BLG0000005") ?>
      </div>

      <div class="col-4">
            <?php fetch_blog("BLG0000006") ?>
      </div>
  </div>

  <div class="row">
  <div class="col-4">
            <?php fetch_blog("BLG0000007") ?>
      </div>

      <div class="col-4">
            <?php fetch_blog("BLG0000007") ?>
      </div>

      <div class="col-4">
            <?php fetch_blog("BLG0000014") ?>
      </div>
  </div>
</div>