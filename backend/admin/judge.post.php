<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/judge.php";
require_once __DIR__ . "/../_utils/contest.php";
require_once __DIR__ . "/../_utils/judge_registration.php";
require_once __DIR__ . "/../_utils/validate.php";
require_once __DIR__ . "/../_utils/login_logout.php";

// Read
$json = json_read();
$username = strtolower(compulsory_param(@$json->username));
$name = compulsory_param(@$json->name);
$raw_password = compulsory_param(@$json->password);
$contests = @$json->contests;

// Check
validate_username($username);
validate_name($name);
validate_password($raw_password);
if ($contests !== null) {
    validate_contest_array($contests);
}
check_judge_exists($username, false);
$password = hash_password($raw_password);

// Add
add_new_judge($username, $name, $password);
if ($contests !== null) {
    foreach ($contests as $contest) {
        register_judge_to_contest($username, $contest);
    }
}

json_write(201, "Akaun '" . $username . "' telah dicipta.");
