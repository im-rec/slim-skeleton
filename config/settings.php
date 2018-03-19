<?php
$env = (getenv("APP_ENV") == "development" ? true : false);
return [
    'settings' => [
        'displayErrorDetails' => $env,
        // Database berrybenka
        "dbberrybenka" => [
            "host" => getenv("MYSQL_HOST"),
            "dbname" => getenv("DB_BERRYBENKA"),
            "user" => getenv("MYSQL_USERNAME"),
            "pass" => getenv("MYSQL_PASSWORD")
        ],
 
       // Database Berrybenka WMS
        "dbberrybenka_wms" => [
            "host" => getenv("MYSQL_HOST"),
            "dbname" => getenv("DB_WMS"),
            "user" => getenv("MYSQL_USERNAME"),
            "pass" => getenv("MYSQL_PASSWORD")
        ],

        // Database Onedeca
        "onedeca" => [
            "host" => getenv("MYSQL_HOST"),
            "dbname" => getenv("DB_ONEDECA"),
            "user" => getenv("MYSQL_USERNAME"),
            "pass" => getenv("MYSQL_PASSWORD")
        ],

        // Redis
        "redis" => [
            "host" => getenv("REDIS_HOST"),
            "port" => getenv("REDIS_PORT"),
            "password" => getenv("REDIS_PASSWORD")
        ],
    ],
];