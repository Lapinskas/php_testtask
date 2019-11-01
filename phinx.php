<?php

require __DIR__ . '/vendor/autoload.php';

Dotenv\Dotenv::create(__DIR__)->load();

return [
    'paths' => [
        'migrations' => __DIR__ . '/db/migrations',
    ],
    'environments' => [
        'default_database' => 'staging',
        'default_migration_table' => 'phinxlog',
        'staging' => [
            'adapter' => 'mysql',
            'host' => $_ENV['MYSQL_HOST'],
            'name' => $_ENV['MYSQL_DATABASE'],
            'user' => $_ENV['MYSQL_USER'],
            'pass' => $_ENV['MYSQL_PASSWORD'],
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ],
];