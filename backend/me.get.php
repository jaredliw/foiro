<?php
require_once __DIR__ . "/_utils/security.php";
check_access("student", "judge", "admin");

require_once __DIR__ . "/_utils/database.php";
require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/student.php";
require_once __DIR__ . "/_utils/judge.php";
require_once __DIR__ . "/_utils/contest.php";

$my_username = $_SESSION["username"];
if (!$my_username) {
    json_write(401, "Sila log masuk terlebih dahulu.");
}

switch ($_SESSION["role"]) {
    case "student":
        $user = get_student_profile($my_username);
        $user["contests"] = fetch_contests_participated_by_student($my_username);
        $user["role"] = "Pelajar";
        break;
    case "judge":
        $user = get_judge_profile($my_username);
        $user["contests"] = fetch_contests_participated_by_judge($my_username);
        $user["role"] = "Hakim";
        break;
    case "admin":
        $user = [
            "username" => ADMIN_USERNAME,
            "name" => "Administrator",
            "role" => "Admin"
        ];
        break;
    default:
        $user = null;
}

if ($user === null) {
    logout();
    json_write(401, "Sesi pelanggan tamat. Sila log masuk semula.");
}

json_write(200, "Berjaya.", $user);
