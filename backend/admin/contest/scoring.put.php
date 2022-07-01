<?php
require_once __DIR__ . "/../../_utils/security.php";
check_access("judge");

require_once __DIR__ . "/../../_utils/sql.php";
require_once __DIR__ . "/../../_utils/io.php";
require_once __DIR__ . "/../../_utils/validate.php";
require_once __DIR__ . "/../../_utils/result.php";

$json = json_read();
$contest_id = compulsory_param(@$json->contest_id);
validate_contest_id($contest_id);
$contest_id = (int)$contest_id;
$records = compulsory_param(@$json->records);
if (!is_array($records)) {
    json_write(400, "Rekod perlu dalam bentuk tatasusunan.");
}

MySQL::connection()->begin_transaction();

foreach ($records as $record) {
    $student_username = @$record->student_username;
    $score = @$record->score;
    if ($student_username === null || $score === null) {
        MySQL::connection()->rollback();
        json_write(400, "Gagal membaca rekod yang dihantar.");
    }

    update_score($contest_id, $_SESSION['username'], $student_username, $score);
}

MySQL::connection()->commit();

json_write(200, "Berjaya.");
