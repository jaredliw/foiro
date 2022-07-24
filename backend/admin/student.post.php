<?php
require_once __DIR__ . "/../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/student.php";
require_once __DIR__ . "/../_utils/school.php";
require_once __DIR__ . "/../_utils/contest.php";
require_once __DIR__ . "/../_utils/student_registration.php";
require_once __DIR__ . "/../_utils/validate.php";
require_once __DIR__ . "/../_utils/login_logout.php";

function main(object $data) {
    $username = strtolower(compulsory_param(@$data->username));
    $name = compulsory_param(@$data->name);
    $raw_password = compulsory_param(@$data->password);
    $school = @$data->school;
    $contests = @$data->contests;

    // Check
    validate_username($username);
    validate_name($name);
    validate_password($raw_password);
    if ($school !== null && $school !== "") {
        validate_school_code($school);
        check_school_exists($school, true);
    }
    if ($contests !== null) {
        validate_contest_array($contests);
    }
    check_student_exists($username, false);
    $password = hash_password($raw_password);

    // Add
    add_new_student($username, $name, $password, $school);
    if ($contests !== null) {
        foreach ($contests as $contest) {
            register_student_to_contest($username, $contest);
        }
    }
}

// Read
$json = json_read();
$bulk = @$json->bulk ?? false;
if ($bulk) {
    $students = compulsory_param(@$json->items);
    if (!is_array($students)) {
        json_write(400, "Rekod perlu dalam bentuk tatasusunan.");
    }
    foreach ($students as $student) {
        main($student);
    }
    json_write(201, "Semua data akaun telah diimport.");
} else {
    main($json);
    json_write(201, "Akaun '" . $username . "' telah dicipta.");
}
