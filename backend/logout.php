<?php
require_once __DIR__ . "/_utils/io.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    logout();
    json_write(200, "Log keluar berjaya.");
} else {
    json_write(405, "Kaedah tidak dibenarkan.");
}
