<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/contest.php";
require_once __DIR__ . "/../_utils/validate.php";

function main(object $data) {
    $name = compulsory_param(@$data->name);
    $date = compulsory_param(@$data->date);

    // Check
    validate_general_name($name);
    validate_date($date);

    // Add
    add_new_contest($name, $date);
}

// Read
$json = json_read();
$bulk = @$json->bulk ?? false;
if ($bulk) {
    $contests = compulsory_param(@$json->items);
    if (!is_array($contests)) {
        json_write(400, "Rekod perlu dalam bentuk tatasusunan.");
    }
    foreach ($contests as $contest) {
        main($contest);
    }
    json_write(201, "Semua data akaun telah diimport.");
} else {
    main($json);
    json_write(201, "Pertandingan '" . $name . "' telah dicipta.");
}
