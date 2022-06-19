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
$raw_password = @$json->password;
$school = @$json->school;

// Check
validate_username($username);
validate_name($name);
if ($raw_password !== null && $raw_password !== "") {
    validate_password($raw_password);
}
if ($school !== null && $school !== "") {
    check_school_exists($school, true);
}
check_student_exists($username, true);

// Update
error_log("Updating student: " . $username);
error_log("Name: " . $name);
error_log("Password: " . $raw_password);
error_log("School: " . $school);
update_student_info($username, $name, $school);
if ($raw_password !== null) {
    $password = hash_password($raw_password);
    change_student_password($username, $password);
}

json_write(200, "Akaun '" . $username . "' telah dikemas kini.");
