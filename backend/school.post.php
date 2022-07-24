<?php
require_once __DIR__ . "/_utils/security.php";
check_access("admin");

require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/school.php";
require_once __DIR__ . "/_utils/validate.php";
require_once __DIR__ . "/_utils/login_logout.php";

function main(object $data) {
    $code = compulsory_param(@$data->code);
    $name = compulsory_param(@$data->name);

    // Check
    validate_school_code($code);
    validate_general_name($name);
    check_school_exists($code, false);

    // Add
    add_new_school($code, $name);
}

// Read
$json = json_read();
$bulk = @$json->bulk ?? false;
if ($bulk) {
    $schools = compulsory_param(@$json->items);
    if (!is_array($schools)) {
        json_write(400, "Rekod perlu dalam bentuk tatasusunan.");
    }
    foreach ($schools as $school) {
        main($school);
    }
    json_write(201, "Semua data sekolah telah diimport.");
} else {
    main($json);
    json_write(201, "Sekolah dengan kod '" . $code . "' telah dicipta.");
}
