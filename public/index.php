<?php

require __DIR__ . '/../vendor/autoload.php';

(new Vladas\Docs\DocsApp(
    new Vladas\Docs\Document()
))->get()->run();
