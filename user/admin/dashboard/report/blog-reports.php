<?php
        $query = "SELECT * FROM blog_report WHERE 1";
        $result = mysqli_query($GLOBALS['connect'],$query);

        if(mysqli_num_rows($result) <= 0):
            echo '<div class="request-container d-flex justify-content-center align-items-center flex-column" style="height:calc(90vh - 100px)">
            <i class="fa-solid fa-file-alt" style="font-size:5rem"></i>
            <h1 class="mt-2">No Report</h1>
            </div>';
        
        else:
?>
<div class="container mt-5">
    <h2>Reports</h2>

    <!-- Filter dropdown -->
    <div class="form-group">
        <label for="filter">Filter:</label>
        <select class="form-control" id="filter">
            <option value="all" selected>All Reports</option>
            <option value="new">New Reports</option>
            <option value="resolved">Resolved Reports</option>
            <option value="pending">Pending Reports</option>
        </select>
    </div>

    <!-- All Reports Table -->
    <div id="all-reports">
        <h3>All Reports</h3>
        <table class="table table-bordered text-center" id="all-report-table">
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Blog ID</th>
                    <th>Blogger ID</th>
                    <th>Reporter ID</th>
                    <th>Issue</th>
                    <th>Check</th>
                    <th>Action</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                <!-- Fetch and populate All Reports dynamically -->
                <?php
                    $all_reports_query = "SELECT `report_id`, `blg_id`, `reporter_user_id`, `bp_user_id`, `report_content`, `report_status`, `report_time` FROM `blog_report`";
                    $all_reports_result = mysqli_query($GLOBALS['connect'], $all_reports_query);
                    $all_reports_count = mysqli_num_rows($all_reports_result);

                    while ($report = mysqli_fetch_assoc($all_reports_result)) {
                        echo "<tr>";
                        echo "<td>{$report['report_id']}</td>";
                        echo "<td>{$report['blg_id']}</td>";
                        echo "<td>{$report['bp_user_id']}</td>";
                        echo "<td>{$report['reporter_user_id']}</td>";
                        echo "<td>{$report['report_content']}</td>";
                        echo "<td><button class='btn text-info' onclick=\"location.href='/modules/blog/shared-blog.php?shared_blog_id={$report['blg_id']}&current_user_id={$report['bp_user_id']}'\">View</button></td>";
                        if($report['report_status'] == 1){
                          echo "<td>Accepted</td>"; 
                          echo "<td><button class='btn'>Resolved</button></td>";
                        } else{

                          echo "<td><i class='fa-solid fa-check mx-2 fs-5 btn btn-outline-primary' onclick=\"location.href='?report_id={$report['report_id']}&current_user_id={$report['bp_user_id']}&report_type={$report['report_content']}&report_status=true'\"></i><i class='fa-solid fa-times mx-2 fs-5 btn btn-outline-danger' onclick=\"location.href='?report_id={$report['report_id']}&report_status=false'\"></i></td>";
                          echo "<td><button class='btn'>Not Resolved</button></td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php if ($all_reports_count > 15) { ?>
            <ul class="pagination">
                <?php
                    $total_pages = ceil($all_reports_count / 15);
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='#'>$i</a></li>";
                    }
                ?>
            </ul>
        <?php } ?>
    </div>

    <!-- New Reports Table -->
    <div id="new-reports" style="display: none;">
        <h3>New Reports</h3>
        <table class="table table-bordered text-center">
        <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Blog ID</th>
                    <th>Blogger ID</th>
                    <th>Reporter ID</th>
                    <th>Issue</th>
                    <th>Check</th>
                    <th>Action</th>
                    <th>Status</th>

                </tr>
            </thead>
            <?php
    // Fetch new reports where report_status equals 0
    $new_reports_query = "SELECT `report_id`, `blg_id`, `reporter_user_id`, `bp_user_id`, `report_content`, `report_status`, `report_time` FROM `blog_report` WHERE `report_status` = 0";
    $new_reports_result = mysqli_query($GLOBALS['connect'], $new_reports_query);
    $new_reports_count = mysqli_num_rows($new_reports_result);

    while ($report = mysqli_fetch_assoc($new_reports_result)) {
      echo "<tr>";
      echo "<td>{$report['report_id']}</td>";
      echo "<td>{$report['blg_id']}</td>";
      echo "<td>{$report['bp_user_id']}</td>";
      echo "<td>{$report['reporter_user_id']}</td>";
      echo "<td>{$report['report_content']}</td>";
      echo "<td><button class='btn text-info' onclick=\"location.href='/modules/blog/shared-blog.php?shared_blog_id={$report['blg_id']}&current_user_id={$report['bp_user_id']}'\">View</button></td>";
      echo "<td><i class='fa-solid fa-check mx-2 fs-5 btn btn-outline-primary' onclick=\"location.href='?report_id={$report['report_id']}&current_user_id={$report['bp_user_id']}&report_type={$report['report_content']}&report_status=true'\"></i><i class='fa-solid fa-times mx-2 fs-5 btn btn-outline-danger onclick='\"location.href='?report_id={$report['report_id']}&current_user_id={$report['reporter_user_id']}&report_status=false'\"></i></td>";
      echo "<td><button class='btn'>Not Resolved</button></td>";
      echo "</tr>";
    }
?>

        </table>
    </div>

    <!-- Resolved Reports Table -->
    <div id="resolved-reports" style="display: none;">
        <h3>Resolved Reports</h3>
        <table class="table table-bordered">
        <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Blog ID</th>
                    <th>Blogger ID</th>
                    <th>Reporter ID</th>
                    <th>Issue</th>
                    <th>Check</th>
                    <th>Status</th>

                </tr>
        </thead>
        <?php
    // Fetch resolved reports where report_status equals 1 and time difference is greater than 2 days
    $resolved_reports_query = "SELECT `report_id`, `blg_id`, `reporter_user_id`, `bp_user_id`, `report_content`, `report_status`, `report_time` FROM `blog_report` WHERE `report_status` = 1 AND TIMESTAMPDIFF(DAY, `report_time`, NOW()) < 2";
    $resolved_reports_result = mysqli_query($GLOBALS['connect'], $resolved_reports_query);
    $resolved_reports_count = mysqli_num_rows($resolved_reports_result);

    if ($resolved_reports_count > 0) {
        while ($report = mysqli_fetch_assoc($resolved_reports_result)) {
          echo "<tr>";
          echo "<td>{$report['report_id']}</td>";
          echo "<td>{$report['blg_id']}</td>";
          echo "<td>{$report['bp_user_id']}</td>";
          echo "<td>{$report['reporter_user_id']}</td>";
          echo "<td>{$report['report_content']}</td>";
          echo "<td><button class='btn text-info' onclick=\"location.href='/modules/blog/shared-blog.php?shared_blog_id={$report['blg_id']}&current_user_id={$report['bp_user_id']}'\">View</button></td>";
          echo "<td><button class='btn'>Resolved</button></td>";
          echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No resolved reports yet.</td></tr>";
    }
?>


        </table>
    </div>

    <!-- Pending Reports Table -->
    <div id="pending-reports" style="display: none;">
        <h3>Pending Reports</h3>
        <table class="table table-bordered">
        <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Blog ID</th>
                    <th>Blogger ID</th>
                    <th>Reporter ID</th>
                    <th>Issue</th>
                    <th>Check</th>
                    <th>Action</th>
                    <th>Status</th>

                </tr>
        </thead>
        <?php
    // Fetch pending reports where report_status equals 0 and time difference is greater than 2 days
    $pending_reports_query = "SELECT `report_id`, `blg_id`, `reporter_user_id`, `bp_user_id`, `report_content`, `report_status`, `report_time` FROM `blog_report` WHERE `report_status` = 0 AND TIMESTAMPDIFF(DAY, `report_time`, NOW()) > 2";
    $pending_reports_result = mysqli_query($GLOBALS['connect'], $pending_reports_query);
    $pending_reports_count = mysqli_num_rows($pending_reports_result);

    if ($pending_reports_count > 0) {
        while ($report = mysqli_fetch_assoc($pending_reports_result)) {
          echo "<tr>";
      echo "<td>{$report['report_id']}</td>";
      echo "<td>{$report['blg_id']}</td>";
      echo "<td>{$report['bp_user_id']}</td>";
      echo "<td>{$report['reporter_user_id']}</td>";
      echo "<td>{$report['report_content']}</td>";
      echo "<td><button class='btn text-info' onclick=\"location.href='/modules/blog/shared-blog.php?shared_blog_id={$report['blg_id']}&current_user_id={$report['bp_user_id']}'\">View</button></td>";
      echo "<td><i class='fa-solid fa-check mx-2 fs-5 btn btn-outline-primary' onclick=\"location.href='?report_id={$report['report_id']}&report_status=true'\"></i><i class='fa-solid fa-times mx-2 fs-5 btn btn-outline-danger onclick='\"location.href='?report_id={$report['report_id']}&report_status=false'\"></i></td>";
      echo "<td><button class='btn'>Pending</button></td>";
      echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No pending reports yet.</td></tr>";
    }
?>

        </table>
    </div>
</div>
<?php endif;?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle filter change
        $('#filter').change(function() {
            var filterValue = $(this).val();
            toggleTables(filterValue);
        });

        // Function to toggle tables based on filter
        function toggleTables(filterValue) {
            $('#all-reports, #new-reports, #resolved-reports, #pending-reports').hide();

            if (filterValue === 'all') {
                $('#all-reports').show();
            }
            else if (filterValue === 'new') {
                $('#new-reports').show();
            }
            else if (filterValue === 'resolved') {
                $('#resolved-reports').show();
            }
            else if (filterValue === 'pending') {
                $('#pending-reports').show();
            }
        }
    });
</script>
