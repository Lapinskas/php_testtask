<?php

namespace Vladas\Docs;

class Document {
    
    private $document;
    
    public function __construct()
    {
        $this->document = [
            "id" => "some-uuid-string",
            "status" => "draft|published",
            "createAt" => "iso-8601 date time with time zone",
            "modifyAt" => "iso-8601 date time with time zone"
        ];
    }

    public function find() : bool
    {
        return true;
    }
    
    public function get() : array
    {
        return $this->document;
    }
}