<?php
require_once __DIR__ . "/../_utils/database.php";
require_once __DIR__ . "/../_utils/io.php";
require_once __DIR__ . "/../_utils/security.php";
require_once __DIR__ . "/../_utils/user.php";
check_access("admin");

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $all_users = fetch_all_users();

        $records = [];
        foreach ($all_users as $user) {
            $formatted = [
                "username" => $user["username"],
                "name" => $user["name"],
                "role" => $user["role"],
            ];
            $records[] = $formatted;
        }

        json_write(200, "Berjaya.", $records);
        break; // This line is unreachable, code exited

    case "POST": // todo duplicate code segment
        $json = json_read();
        $username = compulsory_param($json->username);
        $name = compulsory_param($json->name);
        $raw_password = compulsory_param($json->password);
        $role = compulsory_param($json->role);

        // todo: stricter check
        if (!preg_match('/^[a-z\d_]{3,20}$/i', $username)) {
            json_write(400, "Nama pengguna tidak sah.");
        }
        if ($name === "") {
            json_write(400, "Nama tidak sah.");
        }
        if (
            !preg_match(
                '/^[a-zA-Z\d .,\/<>?;:"\'`~!@#$%^&*()\[\]{}_+=|\\-]{8,}$/',
                $raw_password
            )
        ) {
            json_write(400, "Kata laluan tidak sah.");
        }
        if (!in_array($role, ["student", "judge", "admin"])) {
            json_write(400, "Peranan akaun tidak sah.");
        }

        check_user_exists($username, false);
        $password = hash_password($raw_password);
        add_new_user($username, $name, $password, $role);

        json_write(201, "Akaun '" . $username . "' telah dicipta.");
        break; // This line is unreachable, code exited

    case "PUT":
        $json = json_read();
        $username = compulsory_param($json->username);
        $name = compulsory_param($json->name);
        $raw_password = compulsory_param($json->password);
        $role = compulsory_param($json->role);

        if (!preg_match('/^[a-z\d_]{3,20}$/i', $username)) {
            json_write(400, "Nama pengguna tidak sah.");
        }
        if ($name === "") {
            json_write(400, "Nama tidak sah.");
        }
        if (
            $raw_password !== "" &&
            !preg_match(
                '/^[a-zA-Z\d .,\/<>?;:"\'`~!@#$%^&*()\[\]{}_+=|\\-]{8,}$/',
                $raw_password
            )
        ) {
            json_write(400, "Kata laluan tidak sah.");
        }
        if (!in_array($role, ["student", "teacher", "admin"])) {
            json_write(400, "Peranan akaun tidak sah.");
        }

        check_user_exists($username, true);
        update_user_info($username, $name, $role);

        if ($raw_password !== "") {
            $password = hash_password($raw_password);
            change_password($username, $password);
        }

        json_write(200, "Akaun '" . $username . "' telah dikemas kini.");
        break; // This line is unreachable, code exited

    case "DELETE":
        $json = json_read();
        $username = compulsory_param($json->username);

        check_user_exists($username, true);
        delete_user($username);

        json_write(200, "Akaun '" . $username . "' telah dihapuskan.");
        break; // This line is unreachable, code exited

    default:
        json_write(405, "Kaedah tidak dibenarkan.");
}
