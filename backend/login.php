<?php
require_once __DIR__ . "/_utils/database.php";
require_once __DIR__ . "/_utils/json.php";

function user_dispatch(string $privilege): ?string
{
    switch ($privilege) {
        case "student":
            return "/student/student";
        case "judge":
            return "/judge/judge";
        case "admin":
            return "/admin/user";
        default:
            return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    // Read json input
    $raw = file_get_contents("php://input");
    $json = json_decode($raw);

    if (!isset($json->username, $json->password)) {
        response(400, "Parameter wajib tidak dibekalkan.");
    }
    $username = MySQL::sanitize($json->username);
    $password = MySQL::sanitize($json->password);
    $remember = isset($json->remember) && $json->remember === "on";

    $password = hash("sha512", $password);
    $data = MySQL::connection()->query(
        <<<EOD
    SELECT *
    FROM user
    WHERE username = '$username' AND password = '$password';
EOD
    );

    $user = mysqli_fetch_array($data);
    if (is_null($user)) {
        response(403, "Nama pengguna atau kata laluan tidak sah.");
    }

    $role = $user["role"];
    $redirect_url = user_dispatch($role);
    if ($redirect_url === null) {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw new Exception("Unrecognized role: " . $role . "."); // Error handler is set in app.php
    }

    $_SESSION["username"] = $username;
    $_SESSION["role"] = $role;
    json_write(200, "Log masuk berjaya.", [
        "redirect_url" => $redirect_url,
    ]);
} else {
    json_write(405, "Kaedah tidak dibenarkan.");
}
