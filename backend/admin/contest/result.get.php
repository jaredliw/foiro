<?php
require_once __DIR__ . "/../../_utils/security.php";
check_access("admin");

require_once __DIR__ . "/../../_utils/io.php";
require_once __DIR__ . "/../../_utils/result.php";
require_once __DIR__ . "/../../_utils/validate.php";

$contest_id = compulsory_param(@$_GET["contest_id"]);
validate_contest_id($contest_id);
$results = get_results($contest_id);

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
json_write(200, "Berjaya.", $results);
