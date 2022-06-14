<?php
require_once __DIR__ . "/_utils/router.php";

$white_list = ["/login", "/logout", "/me", "/admin/user"];

route(join(" ", $white_list));

function handleException(Throwable $ex): void
{
    error_log(
        "Uncaught exception class=" .
            get_class($ex) .
            " message=" .
            $ex->getMessage() .
            " line=" .
            $ex->getLine()
    );
    ob_end_clean(); # try to purge content sent so far
    require_once __DIR__ . "/_utils/json.php";
    response(500, "Ralat pelayan dalaman.");
}

set_exception_handler("handleException");

run();
