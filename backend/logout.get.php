<?php
require_once __DIR__ . "/_utils/io.php";
require_once __DIR__ . "/_utils/login_logout.php";

logout();
json_write(200, "Log keluar berjaya.");
