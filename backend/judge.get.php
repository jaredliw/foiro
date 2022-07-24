<?php
require_once __DIR__ . "/_utils/security.php";
check_access("admin");

require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/judge.php";
require_once __DIR__ . "/_utils/judge_registration.php";

$judges = fetch_all_judges();

for ($idx = 0; $idx < count($judges); $idx++) {
    $judge_username = $judges[$idx]["username"];

    $judges[$idx]["contests"] = array_map(function ($item) {
        return $item["contest_id"];
    }, get_judge_registration($judge_username));
}

json_write(200, "Berjaya.", $judges);
