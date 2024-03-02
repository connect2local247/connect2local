<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "delete from customer_register where c_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);

        $query = "delete from customer_verification where c_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);

      }
      if(isset($_GET['b_id'])){
        $id = $_GET['b_id'];

        $query = "DELETE from business_register where b_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);
        // die($query);

        $query = "DELETE from business_verification where b_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);

      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Data</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    .delete-btn {
      color: red;
      text-decoration: none;
    }

    .pagination {
      margin-top: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .pagination a {
      padding: 5px 10px;
      margin: 0 5px;
      border: 1px solid #ddd;
      text-decoration: none;
      color: black;
    }

    .pagination a.active {
      background-color: #ddd;
    }
  </style>
</head>
<body>
  <!-- Modal HTML -->


<!-- Trigger Button -->


  <div class="container w-100 vertical-bar" style="overflow:auto">
    <h2 class="my-3">Customer</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Birth Date</th>
          <th>Gender</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Database connection
          $conn = $GLOBALS['connect'];

          // Number of records per page
          $records_per_page = 15;
          
          // Check if page number is set, if not set it to 1
          $page = isset($_GET['page']) ? $_GET['page'] : 1;

          // Calculate the offset for the query
          $offset = ($page - 1) * $records_per_page;

          // Fetch data from customer_register table with pagination
          $sql = "SELECT c_id, c_fname, c_lname, c_email, c_contact, c_birth_date, c_gender FROM customer_register LIMIT $offset, $records_per_page";
          $result = mysqli_query($conn, $sql);
          
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $decrypt_query = "SELECT c_key from customer_verification where c_id = '{$row['c_id']}'";
              $decrypt_result = mysqli_query($conn,$decrypt_query);
              $key = mysqli_fetch_assoc($decrypt_result);
              
              $modal_id = uniqid('deleteCustomerModal_');

              echo "<tr>";
              echo "<td>" . $row["c_id"] . "</td>";
              echo "<td>" . $row["c_fname"] . "</td>";
              echo "<td>" . $row["c_lname"] . "</td>";
              echo "<td>" . $row["c_birth_date"] . "</td>";
              echo "<td>" . $row["c_gender"] . "</td>";
              echo "<td>" . decryptData($row["c_email"],$key['c_key']) . "</td>";
              echo "<td>" . decryptData($row["c_contact"],$key['c_key']) . "</td>";
              echo "<td><a href='#' class='delete-btn btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#$modal_id'>Delete</a>
              </td>";
              echo "</tr>";

              

         
            
            ?>
            <div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="?id=<?php echo $row['c_id'];?>&content=create" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
            <?php
            }
          } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
          }

        ?>
      </tbody>
    </table>

    <!-- Pagination -->
    <?php
      // Database connection
      $conn = $GLOBALS['connect'];

      // Fetch total number of records
      $sql = "SELECT COUNT(*) AS total FROM customer_register";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $total_records = $row['total'];

      // Calculate total pages
      $total_pages = ceil($total_records / $records_per_page);

      // Display pagination only if there are more records than the limit per page
      if ($total_pages > 1) {
        echo "<div class='pagination'>";
        // Render pagination links
        for ($i = 1; $i <= $total_pages; $i++) {
          echo "<a href='?page=$i' " . ($page == $i ? 'class="active"' : '') . ">$i</a>";
        }
        echo "</div>";
      }

      // Close connection
      // mysqli_close($conn);
    ?>


<h2 class="my-3">Business</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Birth Date</th>
          <th>Gender</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Database connection
          // $conn = $GLOBALS['connect'];

          // Number of records per page
          $records_per_page = 15;
          
          // Check if page number is set, if not set it to 1
          $page = isset($_GET['page']) ? $_GET['page'] : 1;

          // Calculate the offset for the query
          $offset = ($page - 1) * $records_per_page;

          // Fetch data from customer_register table with pagination
          $sql = "SELECT b_id, b_fname, b_lname, b_email, b_contact, b_birth_date, b_gender FROM business_register LIMIT $offset, $records_per_page";
          $result = mysqli_query($conn, $sql);
          
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $decrypt_query = "SELECT b_key from business_verification where b_id = '{$row['b_id']}'";
              $decrypt_result = mysqli_query($conn,$decrypt_query);
              $key = mysqli_fetch_assoc($decrypt_result);
              
              $modal_id = uniqid('deleteBusinessModal_');

              echo "<tr>";
              echo "<td>" . $row["b_id"] . "</td>";
              echo "<td>" . $row["b_fname"] . "</td>";
              echo "<td>" . $row["b_lname"] . "</td>";
              echo "<td>" . $row["b_birth_date"] . "</td>";
              echo "<td>" . $row["b_gender"] . "</td>";
              echo "<td>" . decryptData($row["b_email"],$key['b_key']) . "</td>";
              echo "<td>" . decryptData($row["b_contact"],$key['b_key']) . "</td>";
              echo "<td><a href='#' class='delete-btn btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#$modal_id'>Delete</a>
              </td>";
              echo "</tr>";

              

         
            
            ?>
            <div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="?b_id=<?php echo $row['b_id'];?>&content=create" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
            <?php
            }
          } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
          }

        ?>
      </tbody>
    </table>

    <!-- Pagination -->
    <?php
      // Database connection
      $conn = $GLOBALS['connect'];

      // Fetch total number of records
      $sql = "SELECT COUNT(*) AS total FROM business_register";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $total_records = $row['total'];

      // Calculate total pages
      $total_pages = ceil($total_records / $records_per_page);

      // Display pagination only if there are more records than the limit per page
      if ($total_pages > 1) {
        echo "<div class='pagination'>";
        // Render pagination links
        for ($i = 1; $i <= $total_pages; $i++) {
          echo "<a href='?page=$i' " . ($page == $i ? 'class="active"' : '') . ">$i</a>";
        }
        echo "</div>";
      }

      // Close connection
      mysqli_close($conn);
    ?>
  </div>
</body>
</html>
