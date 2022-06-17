<?php
# Security concerns, do not report error to the client
//error_reporting(0);
//ini_set('display_errors', 0);

require_once __DIR__ . "/_utils/router.php";

$white_list = ["/login", "/logout", "/me", "/admin/student", "/admin/judge", "/admin/school", "/admin/contest"];

route(join(" ", $white_list));

function handle_exception(Throwable $ex): void
{
    error_log(
        "Uncaught exception class=" .
            get_class($ex) .
            " message=" .
            $ex->getMessage() .
            " line=" .
            $ex->getLine() .
            " file=" .
            $ex->getFile()
    );
    ob_end_clean(); # try to purge content sent so far
    require_once __DIR__ . "/_utils/io.php";
    json_write(500, "Ralat pelayan dalaman."); # Response 500 on any exception
}

set_exception_handler("handle_exception");

run();
