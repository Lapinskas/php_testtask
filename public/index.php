<?php

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../config/config.php';

(new Vladas\App(
    new Vladas\Docs\Document()
))->get()->run();
