<?php
require_once __DIR__ . "/../_utils/database.php";

function get_judge_registration($contest_id): array
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
