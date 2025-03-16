<?php 

require_once __DIR__."/Routes/routes.php";
require_once __DIR__."/Core/Core.php";

spl_autoload_register(function ($file) {
    if (file_exists(__DIR__."/Utilitarios/$file.php")){
        require_once __DIR__."/Utilitarios/$file.php";
    } elseif (file_exists(__DIR__."/Models/$file.php")){
        require_once __DIR__."/Models/$file.php";

    }
});

$core = new Core;
$core->run($routes);