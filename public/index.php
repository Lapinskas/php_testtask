<?php

require __DIR__ . '/../vendor/autoload.php';

(new Vladas\App(
    new Vladas\Docs\Document()
))->get()->run();
