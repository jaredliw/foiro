<?php
require_once __DIR__ . "/io.php";
require_once __DIR__ . "/database.php";

function search_student_on_username(string $username): ?array
{
    # Return user record if found, null otherwise
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM student
        WHERE username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function search_student_on_username_and_password(
    string $username,
    string $password
): ?array {
    # Return user record if found, null otherwise
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM student
        WHERE username = ? AND password = ?;
    ");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function fetch_all_students(): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT username, `name`, IF(gender = 'M', 'L', 'P') AS gender, school
        FROM student
        ORDER BY username;
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function check_student_exists(string $username, bool $expect_to_be): void
{
    $stmt = MySQL::connection()->prepare("
        SELECT username
        FROM student
        WHERE username = ?
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    if ($expect_to_be xor $stmt->get_result()->num_rows !== 0) {
        json_write(
            $expect_to_be ? 404 : 409,
            'Nama pelajar \'' .
            htmlspecialchars($username) .
            '\' ' .
            ($expect_to_be ? "tidak" : "telah") .
            " wujud dalam pangkalan data."
        );
    }
}

function add_new_student(
    string $username,
    string $name,
    string $gender,
    string $password
): void {
    $stmt = MySQL::connection()->prepare("
        INSERT INTO user (username, name, password, gender)
        VALUES (?, ?, ?, ?);
    ");
    $stmt->bind_param("ssss", $username, $name, $password, $gender);
    $stmt->execute();
}

function update_student_info(string $username, string $name, string $gender): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE student
        SET name = ?, gender = ?
        WHERE username = ?;
    ");
    $stmt->bind_param("ssss", $name, $role, $username, $gender);
    $stmt->execute();
}

function change_student_password(string $username, string $password): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE student
        SET password = ?
        WHERE username = ?;
    ");
    $stmt->bind_param("ss", $password, $username);
    $stmt->execute();
}

function delete_student(string $username): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM student
        WHERE username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
}
