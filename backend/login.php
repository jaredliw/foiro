<?php
require_once __DIR__ . '/_utils/database.php';
require_once __DIR__ . '/_utils/sql.php';
require_once __DIR__ . '/_utils/json.php';

function user_dispatch(string $privilege): ?string
{
    switch ($privilege) {
        case 'student':
            return '/student/student';
        case 'teacher':
            return '/judge/judge';
        case 'admin':
            return '/admin/user';
        default:
            return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    // Read json input
    $raw = file_get_contents('php://input');
    $json = json_decode($raw);
    
    if (!isset($json->username, $json->password)) {
        response(400, 'Parameter wajib tidak dibekalkan.');
    }
    $username = sql_sanitize($json->username);
    $password = sql_sanitize($json->password);
    $remember = isset($json->remember) && $json->remember === 'on';

    $password = hash('sha512', $password);
    /** @noinspection PhpUndefinedVariableInspection */
    $data = mysqli_query($MYSQL_CONNECTION, <<<EOD
            SELECT *
            FROM user
            WHERE username = '$username' AND password = '$password';
        EOD
    );

    $user = mysqli_fetch_array($data);
    if (is_null($user)) {
        response(403, 'Nama pengguna atau kata laluan tidak sah.');
    }

    $role = $user['role'];
    $redirect_url = user_dispatch($role);
    if (is_null($redirect_url)) {
        error_log('Unrecognized role: ' . $role . '.');
        response(500, 'Ralat pelayan dalaman.');
    } else {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        response(200, 'Log masuk berjaya.', [
            'redirect_url' => $redirect_url
        ]);
    }
} else {
    response(405, 'Kaedah tidak dibenarkan.');
}
