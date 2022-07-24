<?php
require_once __DIR__ . "/database.php";

function get_judges_of_contest($contest_id): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT    jc.judge_username AS username,
                  j.name
        FROM      judge_contest_lnk jc
        LEFT JOIN judge j
        ON        jc.judge_username = j.username
        WHERE     jc.contest_id = ?;
    ");
    $stmt->bind_param("i", $contest_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function register_judge_to_contest(string $judge_username, $contest_id): void
{
    $stmt = MySQL::connection()->prepare("
        INSERT INTO judge_contest_lnk
                    (judge_username,
                     contest_id)
        VALUES      (?,
                     ?);
    ");
    $stmt->bind_param("si", $judge_username, $contest_id);
    $stmt->execute();
}

function get_judge_registration(string $judge_username): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT contest_id
        FROM   judge_contest_lnk
        WHERE  judge_username = ?;
    ");
    $stmt->bind_param("s", $judge_username);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function unregister_judge_from_contest(string $judge_username, $contest_id): void
{
    $stmt = MySQL::connection()->prepare("
        DELETE FROM judge_contest_lnk
        WHERE  judge_username = ?
               AND contest_id = ?;
    ");
    $stmt->bind_param("si", $judge_username, $contest_id);
    $stmt->execute();
}
