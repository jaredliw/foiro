<?php
require_once __DIR__ . "/database.php";

function check_school_exists(string $code, bool $expect_to_be): void
{
    $stmt = MySQL::connection()->prepare("
        SELECT code
        FROM   school
        WHERE  code = ?;
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
        SELECT s.code,
               s.name,
               COUNT(u.username) AS student_count
        FROM   school s
               LEFT JOIN (SELECT username,
                                 school
                          FROM   user
                          WHERE  user.role = 'student') u
                      ON u.school = s.code
        GROUP  BY s.code; 
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function delete_school($code): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM school
        WHERE  code = ?;
    ");
    $stmt->bind_param("s", $code);
    $stmt->execute();
}
