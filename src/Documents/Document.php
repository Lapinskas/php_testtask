<?php

namespace Vladas\Docs;

class Document {
    public $id;
    public $status;
    public $payload;
    public $createAt;
    public $modifyAt;
    private $created;
    private $modified;


    public static function create() : Document
    {
        $doc = new Document();

        $doc->id = '718ce61b-a669-45a6-8f31-32ba41f94784';
        $doc->status = 'draft';
        $doc->payload = [];
        $doc->created = $doc->modified = time();
        
        $date = new \DateTime();
        $date->setTimestamp($doc->created);
        $doc->createAt = $doc->modifyAt = $date->format('c');

        return $doc;
    }
}