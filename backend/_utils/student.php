<?php
require_once __DIR__ . "/io.php";
require_once __DIR__ . "/database.php";

function get_student_profile(string $username): ?array
{
    $stmt = MySQL::connection()->prepare("
        SELECT    s.username,
                  s.`name`,
                  s.school AS school_code,
                  sc.`name` AS school_name
        FROM      student s
        LEFT JOIN school sc
        ON        s.school = sc.code
        WHERE     username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function search_student_on_username_and_password(
    string $username,
    string $password
): ?array {
    $stmt = MySQL::connection()->prepare("
        SELECT *
        FROM   student
        WHERE  username = ?
               AND `password` = ?;
    ");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function fetch_all_students(): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT    s.username,
                  s.name,
                  s.school,
                  COUNT(scl.contest_id) AS participation_count
        FROM      student AS s
        LEFT JOIN student_contest_lnk AS scl
        ON        s.username = scl.student_username
        GROUP BY  s.username
        ORDER BY  s.username;
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function check_student_exists(string $username, bool $expect_to_be): void
{
    $stmt = MySQL::connection()->prepare("
        SELECT username
        FROM   student
        WHERE  username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    if ($expect_to_be xor $stmt->get_result()->num_rows !== 0) {
        json_write(
            $expect_to_be ? 404 : 409,
            'Nama pengguna pelajar \'' .
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
    string $password,
    ?string $school
): void {
    $stmt = MySQL::connection()->prepare("
        INSERT INTO student
                    (username,
                     `name`,
                     `password`,
                     school)
        VALUES      (?,
                     ?,
                     ?,
                     ?);
    ");
    $stmt->bind_param("ssss", $username, $name, $password, $school);
    $stmt->execute();
}

function update_student_info(
    string $username,
    string $name,
    ?string $school
): void {
    $stmt = MySQL::connection()->prepare("
        UPDATE student
        SET    `name` = ?,
               school = ?
        WHERE  username = ?;
    ");
    $stmt->bind_param("sss", $name, $school, $username);
    $stmt->execute();
}

function change_student_password(string $username, string $password): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE student
        SET    `password` = ?
        WHERE  username = ?;
    ");
    $stmt->bind_param("ss", $password, $username);
    $stmt->execute();
}

function delete_student(string $username): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM student
        WHERE  username = ?;
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
}
