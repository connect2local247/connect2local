<?php
function timeElapsedString($datetime) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $formats = array(
        'y' => 'year',
        'm' => 'month',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );

    $result = '';

    foreach ($formats as $format => $timeUnit) {
        $timeValue = $diff->$format;
        if ($timeValue) {
            $plural = $timeValue > 1 ? 's' : '';
            $result .= $timeValue . ' ' . $timeUnit . $plural . ' ';
        }
    }

    return $result ? $result . 'ago' : 'Just now';
}

?>
