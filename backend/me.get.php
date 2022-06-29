<?php
require_once __DIR__ . "/_utils/database.php";
require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/student.php";
require_once __DIR__ . "/_utils/judge.php";

session_start();
$my_username = $_SESSION["username"];
if (!$my_username) {
    json_write(401, "Sila log masuk terlebih dahulu.");
}

$role = $_SESSION["role"];
switch ($role) {
    case "student":
        $user = search_student_on_username($my_username);
        $user["role"] = "student";
        break;
    case "judge":
        $user = search_judge_on_username($my_username);
        $user["role"] = "judge";
        break;
    case "admin":
        $user = [
            "username" => ADMIN_USERNAME,
            "name" => "Admin",
            "role" => "admin"
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
