<?php
require_once __DIR__ . "/_utils/database.php";
require_once __DIR__ . "/_utils/credentials.php";
require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/login_logout.php";
require_once __DIR__ . "/_utils/student.php";
require_once __DIR__ . "/_utils/judge.php";

session_start();

$json = json_read();
$username = compulsory_param($json->username);
$raw_password = compulsory_param($json->password);
$role = compulsory_param($json->role);

$password = hash_password($raw_password);
switch ($role) {
    case "student":
        $user = search_student_on_username_and_password($username, $password);
        break;
    case "judge":
        $user = search_judge_on_username_and_password($username, $password);
        break;
    case "admin":
        $user = $username === ADMIN_USERNAME && $password === hash_password(ADMIN_PASSWORD) ? true : null;
        break;
    default:
        json_write(400, "Peranan pengguna tidak sah");
}

/** @noinspection PhpUndefinedVariableInspection */
if ($user === null) {
    json_write(403, "Log masuk gagal.");
}

if (!in_array($role, ["student", "judge", "admin"])) {
    /** @noinspection PhpUnhandledExceptionInspection */
    throw new Exception("Unrecognized role: " . $role . "."); // Error handler is set in app.php
}

$_SESSION["username"] = $username;
$_SESSION["role"] = $role;
json_write(200, "Log masuk berjaya.", [
    "redirect_url" => "/dashboard",
]);
