<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/contest.php";
require_once __DIR__ . "/../_utils/validate.php";

// Read
$json = json_read();
$name = compulsory_param(@$json->name);
$date = compulsory_param(@$json->date);

// Check
validate_general_name($name);
validate_date($date);

// Add
add_new_contest($name, $date);

json_write(201, "Pertandingan '" . $name . "' telah dicipta.");
