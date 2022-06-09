<?php
require_once __DIR__ . '/_utils/database.php';
require_once __DIR__ . '/_utils/json.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();
    $my_username = sql_sanitize($_SESSION['username']);

    /** @noinspection PhpUndefinedVariableInspection */
    $data = mysqli_query($conn, <<<EOD
            SELECT *
            FROM user
            WHERE username = '$my_username';
        EOD
    );
    $user = mysqli_fetch_array($data);
    if (is_null($user)) {
        session_unset();
        session_destroy();
        response(401, 'Sesi pelanggan tamat. Sila log masuk semula.');
    } else {
        response(200, 'Berjaya.', [
            'username' => $user['username'],
            'name' => $user['name'],
            'role' => $user['role']
        ]);
    }
} else {
    response(405, 'Kaedah tidak dibenarkan.');
}
