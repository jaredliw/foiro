<?php
require_once __DIR__ . "/_utils/security.php";
check_access("admin");

require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/student.php";
require_once __DIR__ . "/_utils/student_registration.php";

$students = fetch_all_students();

for ($idx = 0; $idx < count($students); $idx++) {
    $student_username = $students[$idx]["username"];

    $students[$idx]["contests"] = array_map(function ($item) {
        return $item["contest_id"];
    }, get_student_registration($student_username));
}

json_write(200, "Berjaya.", $students);
