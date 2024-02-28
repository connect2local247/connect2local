<?php
// Assuming you have fetched notifications data from the database and stored it in an array called $notifications
// Example $notifications array structure: $notifications = [ [ 'n_content' => 'Notification content', 'n_type' => 'Notification type', 'n_time' => 'Notification time', 'n_user_id' => 'User ID' ], ... ];

// Function to calculate elapsed time
function elapsedTime($timestamp) {
    $timeDifference = time() - strtotime($timestamp);
    $intervals = array(
        1                   => 'second',
        60                  => 'minute',
        3600                => 'hour',
        86400               => 'day',
        604800              => 'week',
        2592000             => 'month',
        31536000            => 'year'
    );

    foreach ($intervals as $seconds => $label) {
        $numberOfUnits = $timeDifference / $seconds;
        if ($numberOfUnits >= 1) {
            $roundedUnits = round($numberOfUnits);
            return $roundedUnits . ' ' . $label . (($roundedUnits > 1) ? 's' : '') . ' ago';
        }
    }
}

// Function to differentiate notification type based on user ID prefix
function notificationType($user_id) {
    if (strpos($user_id, 'C2LB') === 0) {
        return 'Business';
    } elseif (strpos($user_id, 'C2L') === 0) {
        return 'Customer';
    } else {
        return 'Unknown';
    }
}
?>
<div class="container">
    <?php foreach ($notifications as $notification): ?>
        <?php
        $elapsedTime = elapsedTime($notification['n_time']);
        ?>
        <?php if ($notification['n_status'] == 0): ?>
            <?php if ($notification['n_type'] == 'request'): ?>
                <div class="request-notification border border-info shadow p-3 my-3 rounded d-flex justify-content-between align-items-center text-bg-dark">
                    <div class="requester-info d-flex px-2 align-items-center" style="gap:7px">
                        <i class="fa-solid fa-circle-info  fs-4 text-info"></i>
                        <span class="fullname fw-semibold text-white"><u><?= $notification['n_content'] ?></u></span>
                        <span style="margin-y:auto">has requested to add their Customer</span>
                    </div>
                    <div class="request-reply d-flex px-2" style="gap:10px">
                        <i class="fa-solid fa-check p-2 border rounded border-success"></i>
                        <i class="fa-solid fa-xmark p-2 border rounded border-danger"></i>
                    </div>
                    <span><?= $elapsedTime ?></span>
                </div>
            <?php elseif ($notification['n_type'] == 'Business'): ?>
                <div class="business-notification border border-info shadow p-3 my-3 rounded d-flex justify-content-between align-items-center text-bg-dark">
                    <div class="business-info d-flex px-2 align-items-center" style="gap:7px">
                        <i class="fa-solid fa-circle-info  fs-4 text-info"></i>
                        <span class="fullname fw-semibold text-white"><u><?= $notification['n_content'] ?></u></span>
                        <span style="margin-y:auto">has requested to add their Business</span>
                    </div>
                    <div class="business-reply d-flex px-2" style="gap:10px">
                        <i class="fa-solid fa-check p-2 border rounded border-success"></i>
                        <i class="fa-solid fa-xmark p-2 border rounded border-danger"></i>
                    </div>
                    <span><?= $elapsedTime ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
