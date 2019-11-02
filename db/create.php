<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::create(__DIR__.'/../', '.env')->load();
Dotenv\Dotenv::create(__DIR__.'/../', '.env_create_db')->load();

$db = new PDO(
    'mysql:host=' . $_ENV['MYSQL_HOST'],
    $_ENV['ROOT_MYSQL_USER'],
    $_ENV['ROOT_MYSQL_PASSWORD']
);

$db->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);

$db->query(
    'CREATE DATABASE IF NOT EXISTS `' . $_ENV['MYSQL_DATABASE'] . '`'
);

$db->query(
    'DROP USER IF EXISTS `' . $_ENV['MYSQL_USER'] . '`@`' . $_ENV['MYSQL_HOST'] . '`'
);

$db->query(
    'DROP USER IF EXISTS `' . $_ENV['MYSQL_USER'] . '`@`' . $_ENV['MYSQL_HOST'] . '`'
);

$db->query(
    'CREATE USER `' . $_ENV['MYSQL_USER'] . '`@`' . $_ENV['MYSQL_HOST'] . '` IDENTIFIED BY \'' . $_ENV['MYSQL_PASSWORD'] . '\''
);

$db->query(
    'GRANT ALL PRIVILEGES ON `' . $_ENV['MYSQL_DATABASE'] . '`.* TO `' . $_ENV['MYSQL_USER'] . '`@`' . $_ENV['MYSQL_HOST'] . '`'
);

$db->query(
    'FLUSH PRIVILEGES'
);
