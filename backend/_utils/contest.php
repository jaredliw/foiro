<?php
require_once __DIR__ . "/database.php";

function check_contest_exists(string $id, bool $expect_to_be): void
{
    $stmt = MySQL::connection()->prepare("
        SELECT id
        FROM   contest
        WHERE  id = ?;
    ");
    $stmt->bind_param("s", $id);
    $stmt->execute();

    if ($expect_to_be xor $stmt->get_result()->num_rows !== 0) {
        json_write(
            $expect_to_be ? 404 : 409,
            'Pertandingan dengan kod \'' .
            htmlspecialchars($id) .
            '\' ' .
            ($expect_to_be ? "tidak" : "telah") .
            " wujud dalam pangkalan data."
        );
    }
}

function fetch_contests_participated_by_student(string $student_username): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT c.id,
               c.`name`,
               c.`date`
        FROM   student_contest_lnk as scl
        LEFT JOIN contest c
        ON scl.contest_id = c.id
        WHERE  scl.student_username = ?;
    ");
    $stmt->bind_param("s", $student_username);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function fetch_contests_participated_by_judge(string $judge_username): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT c.id,
               c.`name`,
               c.`date`
        FROM   judge_contest_lnk as jcl
        LEFT JOIN contest c
        ON jcl.contest_id = c.id
        WHERE  jcl.judge_username = ?;
    ");
    $stmt->bind_param("s", $judge_username);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function fetch_all_contests(): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT id,
               `name`,
               `date`
        FROM   contest;
    ");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function add_new_contest(string $name, string $date): void
{
    $stmt = MySQL::connection()->prepare("
        INSERT INTO contest
                    (`name`,
                     `date`)
        VALUES      (?,
                     ?);
    ");
    $stmt->bind_param("ss", $name, $date);
    $stmt->execute();
}

function update_contest($id, $name, $date): void
{
    $stmt = MySQL::connection()->prepare("
        UPDATE contest
        SET    `name` = ?,
               `date` = ?
        WHERE  id = ?;
    ");
    $stmt->bind_param("sss", $name, $date, $id);
    $stmt->execute();
}

function delete_contest($id): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM contest
        WHERE  id = ?;
    ");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
