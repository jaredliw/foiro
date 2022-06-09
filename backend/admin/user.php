<?php
require_once __DIR__ . '/../_utils/database.php';
require_once __DIR__ . '/../_utils/json.php';
require_once __DIR__ . '/../_utils/security.php';
check_access('admin');

function check_user_exists(string $username, bool $expect_to_be): void
{
    global $conn;
    $query_status = mysqli_query($conn, <<<EOD
            SELECT username
            FROM user
            WHERE username = '$username'; 
        EOD
    );

    if ($expect_to_be xor mysqli_num_rows($query_status) !== 0) {
        response($expect_to_be ? 404 : 409,
            'Nama pengguna \'' .
            htmlspecialchars($username) .
            '\' ' .
            ($expect_to_be ? 'tidak' : 'telah') .
            ' wujud dalam pangkalan data.');
    }
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        /** @noinspection PhpUndefinedVariableInspection */
        $query_status = mysqli_query($conn, <<<EOD
            SELECT username, name, role
            FROM user
            ORDER BY username;
        EOD
        );

        $records = [];
        while ($record = $query_status->fetch_assoc()) {
            $formatted = [
                'username' => $record['username'],
                'name' => $record['name'],
                'role' => $record['role']
            ];
            $records[] = $formatted;
        }
        response(200, 'Berjaya.', $records);
        break;  // This line is unreachable, code exited

    case 'POST':  // todo duplicate code segment
        if (!isset($_POST['username'], $_POST['name'], $_POST['password'], $_POST['role'])) {
            response(400, 'Parameter wajib tidak dibekalkan.');
        }
        $username = sql_sanitize($_POST['username']);
        $name = sql_sanitize($_POST['name']);
        $password = sql_sanitize($_POST['password']);
        $role = sql_sanitize($_POST['role']);
        // todo: stricter check
        if (!preg_match('/^[a-z\d_]{3,20}$/i', $username)) {
            response(400, 'Nama pengguna tidak sah.');
        }
        if ($name === '') {
            response(400, 'Nama tidak sah.');
        }
        if (!preg_match('/^[a-zA-Z\d .,\/<>?;:"\'`~!@#$%^&*()\[\]{}_+=|\\-]{8,}$/', $password)) {
            response(400, 'Kata laluan tidak sah.');
        }
        if (!in_array($role, ['student', 'teacher', 'admin'])) {
            response(400, 'Peranan akaun tidak sah.');
        }

        check_user_exists($username, false);
        $password = hash('sha512', $password);
        /** @noinspection PhpUndefinedVariableInspection */
        $query_status = mysqli_query($conn, <<<EOD
            INSERT INTO user (username, name, password, role)
            VALUES ('$username', '$name', '$password', '$role');
        EOD
        );

        response(201, 'Akaun \'' . $username . '\' telah dicipta.');
        break;  // This line is unreachable, code exited

    case 'PUT':
        parse_str(file_get_contents('php://input'), $_PUT);  // Access DELETE data
        error_log(print_r($_PUT, true));
        // todo repeated code
        if (!isset($_PUT['username'], $_PUT['name'], $_PUT['password'], $_PUT['role'])) {
            response(400, 'Parameter wajib tidak dibekalkan.');
        }
        $username = sql_sanitize($_PUT['username']);
        $name = sql_sanitize($_PUT['name']);
        $password = sql_sanitize($_PUT['password']);
        $role = sql_sanitize($_PUT['role']);

        if (!preg_match('/^[a-z\d_]{3,20}$/i', $username)) {
            response(400, 'Nama pengguna tidak sah.');
        }
        if ($name === '') {
            response(400, 'Nama tidak sah.');
        }
        if ($password != '' && !preg_match('/^[a-zA-Z\d .,\/<>?;:"\'`~!@#$%^&*()\[\]{}_+=|\\-]{8,}$/', $password)) {
            response(400, 'Kata laluan tidak sah.');
        }
        if (!in_array($role, ['student', 'teacher', 'admin'])) {
            response(400, 'Peranan akaun tidak sah.');
        }

        check_user_exists($username, true);
        if ($password == '') {
            /** @noinspection PhpUndefinedVariableInspection */
            $query_status = mysqli_query($conn, <<<EOD
                UPDATE user
                SET name='$name', role='$role'
                WHERE username='$username';
            EOD
            );
        } else {
            $password = hash('sha512', $password);
            error_log($password);
            /** @noinspection PhpUndefinedVariableInspection */
            $query_status = mysqli_query($conn, <<<EOD
                UPDATE user
                SET name='$name', password='$password', role='$role'
                WHERE username='$username';
            EOD
            );
        }
        response(200, 'Akaun \'' . $username . '\' telah dikemas kini.');
        break;  // This line is unreachable, code exited

    case 'DELETE':
        parse_str(file_get_contents('php://input'), $_DELETE);  // Access DELETE data
        if (!isset($_DELETE['username'])) {
            response(400, 'Parameter wajib tidak dibekalkan.');
        }
        $username = sql_sanitize($_DELETE['username']);

        check_user_exists($username, true);
        /** @noinspection PhpUndefinedVariableInspection */
        $query_status = mysqli_query($conn, <<<EOD
            DELETE FROM user
            WHERE username = '$username';
        EOD
        );

        response(200, 'Akaun \'' . $username . '\' telah dihapuskan.');
        break;  // This line is unreachable, code exited

    default:
        response(405, 'Kaedah tidak dibenarkan.');
}
