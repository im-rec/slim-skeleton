<?php

define("PATH_ROOT", __DIR__ . '/../');

date_default_timezone_set("Asia/Jakarta");

if (PHP_SAPI == 'cli-server') {
    return false;
}

session_start();

require __DIR__ . '/../vendor/autoload.php';

// Init config .env
$dotenv = new Dotenv\Dotenv(PATH_ROOT);
$dotenv->load();

require __DIR__ . '/../config/constant.php';

// Instantiate the app
$settings = require __DIR__ . '/../config/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/../bootstrap/dependencies.php';

require __DIR__ . '/../bootstrap/middleware.php';

require __DIR__ . '/../bootstrap/route.php';

require __DIR__ . '/../bootstrap/Autoload.php';

New Bootstrap\Autoload($app);

$app->run();
