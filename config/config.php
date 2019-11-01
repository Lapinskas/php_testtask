<?php

Dotenv\Dotenv::create(__DIR__. '/../')->load();

define ('DB', [
    'host' => getenv('MYSQL_HOST'),
    'database' => getenv('MYSQL_DATABASE'), 
    'user' => getenv('MYSQL_USER'),
    'pass' => getenv('MYSQL_PASSWORD')
]);
