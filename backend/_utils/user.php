<?php
require_once __DIR__ . "/io.php";

function user_dispatch(string $privilege): ?string
{
    # Return redirect url, null if it is not recognized
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

function compulsory_param(?string $param): string
{
    # Make sure the parameter is not null, throw 400 error if it is
    if ($param === null) {
        json_write(400, "Parameter wajib tidak dibekalkan.");
    }
    return $param;
}

function hash_password(string $password): string
{
    # SHA512 hash the password
    return hash("sha512", $password);
}

function logout()
{
    session_start();
    session_unset();
    session_destroy();
}

function search_user_on_username(string $username): ?array
{
    # Return user record if found, null otherwise
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM user
        WHERE username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function search_user_on_username_and_password(
    string $username,
    string $password
): ?array {
    # Return user record if found, null otherwise
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM user
        WHERE username = ? AND password = ?;
    ");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function fetch_all_users(): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM user
        ORDER BY username;
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function check_user_exists(string $username, bool $expect_to_be): void
{
    $stmt = MySQL::connection()->prepare("
        SELECT username
        FROM user
        WHERE username = ?
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    if ($expect_to_be xor $stmt->num_rows() !== 0) {
        json_write(
            $expect_to_be ? 404 : 409,
            'Nama pengguna \'' .
                htmlspecialchars($username) .
                '\' ' .
                ($expect_to_be ? "tidak" : "telah") .
                " wujud dalam pangkalan data."
        );
    }
}

function add_new_user(
    string $username,
    string $name,
    string $password,
    string $role
): void {
    $stmt = MySQL::connection()->prepare("
        INSERT INTO user (username, name, password, role)
        VALUES (?, ?, ?, ?);
    ");
    $stmt->bind_param("ssss", $username, $name, $password, $role);
    $stmt->execute();
}

function update_user_info(string $username, string $name, string $role): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE user
        SET name = ?, role = ?
        WHERE username = ?;
    ");
    $stmt->bind_param("sss", $name, $role, $username);
    $stmt->execute();
}

function change_password(string $username, string $password): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE user
        SET password = ?
        WHERE username = ?;
    ");
    $stmt->bind_param("ss", $password, $username);
    $stmt->execute();
}

function delete_user(string $username): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM user
        WHERE username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
}
