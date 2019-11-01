<?php
use Swagger\Swagger;

require __DIR__ . '/../vendor/autoload.php';

// Scan and parse Open API annotations
$openapi = \OpenApi\scan('../routes');

// Provide API specification in JSON format 'on-the-fly'
header('Content-Type: application/json');
echo $openapi->toJson();
