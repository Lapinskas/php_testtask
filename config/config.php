<?php

Dotenv\Dotenv::create(__DIR__. '/../')->load();

define ('DB', [
    'host' => getenv('MYSQL_HOST'),
    'user' => getenv('MYSQL_USER'),
    'pass' => getenv('MYSQL_PASSWORD'),
]);
