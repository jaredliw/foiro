<?php
require_once __DIR__ . "/io.php";
require_once __DIR__ . "/database.php";

function search_judge_on_username(string $username): ?array
{
    # Return user record if found, null otherwise
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM judge
        WHERE username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function search_judge_on_username_and_password(
    string $username,
    string $password
): ?array
{
    # Return user record if found, null otherwise
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM judge
        WHERE username = ? AND password = ?;
    ");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function fetch_all_judges(): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT username, `name`
        FROM judge
        ORDER BY username;
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function check_judge_exists(string $username, bool $expect_to_be): void
{
    $stmt = MySQL::connection()->prepare("
        SELECT username
        FROM judge
        WHERE username = ?
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    if ($expect_to_be xor $stmt->get_result()->num_rows !== 0) {
        json_write(
            $expect_to_be ? 404 : 409,
            'Nama pengguna hakim \'' .
            htmlspecialchars($username) .
            '\' ' .
            ($expect_to_be ? "tidak" : "telah") .
            " wujud dalam pangkalan data."
        );
    }
}

function add_new_judge(
    string $username,
    string $name,
    string $password
): void
{
    $stmt = MySQL::connection()->prepare("
        INSERT INTO user (username, name, password)
        VALUES (?, ?, ?);
    ");
    $stmt->bind_param("sss", $username, $name, $password);
    $stmt->execute();
}

function update_judge_info(string $username, string $name): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE student
        SET name = ?
        WHERE username = ?;
    ");
    $stmt->bind_param("ss", $name, $username);
    $stmt->execute();
}

function change_judge_password(string $username, string $password): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE student
        SET password = ?
        WHERE username = ?;
    ");
    $stmt->bind_param("ss", $password, $username);
    $stmt->execute();
}

function delete_judge(string $username): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM judge
        WHERE username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
}
