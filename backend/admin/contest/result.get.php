<?php
require_once __DIR__ . "/../../_utils/security.php";
check_access("student", "judge", "admin");

require_once __DIR__ . "/../../_utils/io.php";
require_once __DIR__ . "/../../_utils/result.php";
require_once __DIR__ . "/../../_utils/validate.php";
require_once __DIR__ . "/../../_utils/student_registration.php";
require_once __DIR__ . "/../../_utils/judge_registration.php";

$contest_id = compulsory_param(@$_GET["contest_id"]);
validate_contest_id($contest_id);
$contest_id = (int)$contest_id;

// Check student/judge has permission to view this contest (only if he/she is participating in that contest)
if (in_array($_SESSION["role"], ["student", "judge"])) {
    $contest_found = false;
    if ($_SESSION["role"] == "judge") {
        $registered_contests = get_judge_registration($_SESSION["username"], $contest_id);
    } else {
        $registered_contests = get_student_registration($_SESSION["username"], $contest_id);
    }

    foreach ($registered_contests as $contest) {
        if ($contest["contest_id"] === $contest_id) {
            $contest_found = true;
            break;
        }
    }

    if (!$contest_found) {
        json_write(401, "Permisi tidak diberikan.");
    }
}

$results = get_results($contest_id);

// Students won't see the actual score of every participant
if ($_SESSION["role"] === "admin") {
    $scores = get_score($contest_id);
    for ($i = 0; $i < count($scores); $i++) {
        for ($j = 0; $j < count($results); $j++) {
            if ($scores[$i]["student_username"] == $results[$j]["username"]) {
                if (!isset($results[$j]["scores"])) {
                    $results[$j]["scores"] = [];
                }
                if (!isset($results[$j]["total_score"])) {
                    $results[$j]["total_score"] = 0;
                }

                $results[$j]["scores"][$scores[$i]["judge_username"]] = $scores[$i]["score"];
                $results[$j]["total_score"] += $scores[$i]["score"];
            }
        }
    }
}
json_write(200, "Berjaya.", $results);
