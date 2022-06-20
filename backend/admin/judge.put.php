<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/judge.php";
require_once __DIR__ . "/../_utils/validate.php";
require_once __DIR__ . "/../_utils/login_logout.php";

// Read
$json = json_read();
$username = strtolower(compulsory_param(@$json->username));
$name = compulsory_param(@$json->name);
$raw_password = @$json->password;

// Check
validate_username($username);
validate_name($name);
if ($raw_password !== null && $raw_password !== "") {
    validate_password($raw_password);
}
check_judge_exists($username, true);

// Update
update_judge_info($username, $name);
if ($raw_password !== null) {
    $password = hash_password($raw_password);
    change_judge_password($username, $password);
}

json_write(200, "Akaun '" . $username . "' telah dikemas kini.");
