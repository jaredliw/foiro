<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/student.php";
require_once __DIR__ . "/../_utils/school.php";
require_once __DIR__ . "/../_utils/validate.php";
require_once __DIR__ . "/../_utils/login_logout.php";

// Read
$json = json_read();
$username = strtolower(compulsory_param(@$json->username));
$name = compulsory_param(@$json->name);
$raw_password = compulsory_param(@$json->password);
$school = @$json->school;

// Check
validate_username($username);
validate_name($name);
validate_password($raw_password);
if ($school !== null && $school !== "") {
    check_school_exists($school, true);
}
check_student_exists($username, false);
$password = hash_password($raw_password);

// Add
add_new_student($username, $name, $password, $school);

json_write(201, "Akaun '" . $username . "' telah dicipta.");