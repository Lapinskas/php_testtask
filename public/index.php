<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/config.php';

$pdo = new PDO(
    'mysql:host='. DB['host'] .';dbname=' . DB['database'],
    DB['user'],
    DB['pass']
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$doc = (new Vladas\Docs\Document())->connect($pdo);

(new Vladas\App($doc))->get()->run();
