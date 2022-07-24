<?php
require_once __DIR__ . "/_utils/security.php";
check_access("admin");

require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/student.php";
require_once __DIR__ . "/_utils/school.php";
require_once __DIR__ . "/_utils/student_registration.php";
require_once __DIR__ . "/_utils/validate.php";
require_once __DIR__ . "/_utils/login_logout.php";

// Read
$json = json_read();
$username = strtolower(compulsory_param(@$json->username));
$name = compulsory_param(@$json->name);
$raw_password = @$json->password;
$school = @$json->school;
$contests = @$json->contests;

// Check
validate_username($username);
validate_name($name);
if ($raw_password !== null && $raw_password !== "") {
    validate_password($raw_password);
}
if ($school !== null && $school !== "") {
    validate_school_code($school);
    check_school_exists($school, true);
}
if ($contests !== null) {
    validate_contest_array($contests);
}
check_student_exists($username, true);

// Update
update_student_info($username, $name, $school);
if ($raw_password !== null) {
    $password = hash_password($raw_password);
    change_student_password($username, $password);
}
$registered_contests = get_student_registration($username);
foreach ($registered_contests as $registered_contest) {
    if (!@in_array($registered_contest, $contests)) {
        unregister_student_from_contest($username, $registered_contest["contest_id"]);
    }
}
if ($contests !== null) {
    foreach ($contests as $contest) {
        if (!@in_array($contest, $registered_contests)) {
            register_student_to_contest($username, $contest);
        }
    }
}
json_write(200, "Akaun '" . $username . "' telah dikemas kini.");
