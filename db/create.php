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

$db->prepare(
    'CREATE DATABASE IF NOT EXISTS `' . $_ENV['MYSQL_DATABASE'] . '`'
)->execute();

$db->prepare(
    'DROP USER IF EXISTS `' . $_ENV['MYSQL_USER'] . '`@`' . $_ENV['MYSQL_HOST'] . '`'
)->execute();

$db->prepare(
    'DROP USER IF EXISTS `' . $_ENV['MYSQL_USER'] . '`@`' . $_ENV['MYSQL_HOST'] . '`'
)->execute();

$db->prepare(
    'CREATE USER `' . $_ENV['MYSQL_USER'] . '`@`' . $_ENV['MYSQL_HOST'] . '` IDENTIFIED BY \'' . $_ENV['MYSQL_PASSWORD'] . '\''
)->execute();

$db->prepare(
    'GRANT ALL PRIVILEGES ON `' . $_ENV['MYSQL_DATABASE'] . '`.* TO `' . $_ENV['MYSQL_USER'] . '`@`' . $_ENV['MYSQL_HOST'] . '`'
)->execute();

$db->prepare(
    'FLUSH PRIVILEGES'
)->execute();
