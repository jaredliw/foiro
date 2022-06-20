<?php
require_once __DIR__ . "/database.php";

function check_school_exists(string $code, bool $expect_to_be): void
{
    $stmt = MySQL::connection()->prepare("
        SELECT `code`
        FROM   school
        WHERE  `code` = ?;
    ");
    $stmt->bind_param("s", $code);
    $stmt->execute();

    if ($expect_to_be xor $stmt->get_result()->num_rows !== 0) {
        json_write(
            $expect_to_be ? 404 : 409,
            'Sekolah degan kod \'' .
                htmlspecialchars($code) .
                '\' ' .
                ($expect_to_be ? "tidak" : "telah") .
                " wujud dalam pangkalan data."
        );
    }
}

function fetch_all_schools(): array
{
    # Return all schools
    $stmt = MySQL::connection()->prepare("
        SELECT sc.code,
               sc.name,
               COUNT(s.username) AS student_count
        FROM   school AS sc
               LEFT JOIN student AS s
                      ON sc.code = s.school
        GROUP  BY sc.code
        ORDER  BY sc.code;
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function add_new_school(string $code, string $name): void
{
    $stmt = MySQL::connection()->prepare("
        INSERT INTO school
                    (`code`,
                     `name`)
        VALUES      (?,
                     ?);
    ");
    $stmt->bind_param("ss", $code, $name);
    $stmt->execute();
}

function update_school_info(string $code, string $name): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE school
        SET    `name` = ?
        WHERE  `code` = ?;
    ");
    $stmt->bind_param("ss", $name, $code);
    $stmt->execute();
}

function delete_school($code): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM school
        WHERE  `code` = ?;
    ");
    $stmt->bind_param("s", $code);
    $stmt->execute();
}
