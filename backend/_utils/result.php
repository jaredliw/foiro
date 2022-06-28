<?php
require_once __DIR__ . "/../_utils/database.php";

function get_results($contest_id): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT            RANK() OVER (ORDER BY SUM(r.score) DESC) AS `rank`,    
                          scl.student_username AS username,
                          s.name,
                          s.school AS school_code,
                          sc.name AS school_name
        FROM              student_contest_lnk AS scl
        NATURAL LEFT JOIN result AS r
        LEFT JOIN         student AS s
        ON                scl.student_username = s.username
        LEFT JOIN         school AS sc
        ON                s.school = sc.code
        WHERE             scl.contest_id = ?
        GROUP BY          scl.student_username
        ORDER BY          `rank`;
    ");
    $stmt->bind_param("i", $contest_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function get_score($contest_id): array
{
    $stmt = MySQL::connection()->prepare("
        SELECT     scl.student_username,
                   jcl.judge_username,
                   IFNULL(r.score, 0) AS score
        FROM       student_contest_lnk AS scl
        CROSS JOIN judge_contest_lnk jcl
        LEFT JOIN  result AS r
        ON         scl.student_username = r.student_username
                   AND jcl.judge_username = r.judge_username
        WHERE      scl.contest_id = jcl.contest_id
                   AND jcl.contest_id = ?;
    ");
    $stmt->bind_param("i", $contest_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
