<?php

/*
|--------------------------------------------------------------------------
| Sub-directory deployment shim
|--------------------------------------------------------------------------
| This file lets the project sit under c:/xampp/htdocs/HRMS while keeping
| Laravel's secure layout (only public/ is exposed via .htaccess rewrites).
|
| By having Apache route requests through THIS file (instead of directly
| through public/index.php), $_SERVER['SCRIPT_NAME'] resolves to
| "/HRMS/index.php" — so Laravel generates URLs like /HRMS/login rather
| than the broken /login. Static assets (build/, favicon, etc.) are
| forwarded to public/ by the sibling .htaccess.
*/

require __DIR__.'/public/index.php';
