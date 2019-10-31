<?php

require __DIR__ . '/../vendor/autoload.php';

// Create and run app
$app = (new Vladas\DocsApp\DocsApp())->get();
$app->run();
