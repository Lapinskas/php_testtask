<?php

namespace Vladas\Docs;

use \Ramsey\Uuid\Uuid;
use \Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Document {
    // External interface
    public $id;
    public $status;
    public $payload;
    public $createAt;
    public $modifyAt;

    // Database interface
    private $db;
    private $created;
    private $modified;
    private $data;
    
    const REMOVE_OBJECTS = [
        'payload' => true,
        'db' => true
    ];

    public function __construct() 
    {
    }
    
    public function connect(\PDO $connection ) : Document
    {
        $this->db = $connection;
        return $this;
    }
    
    public function create() : Document
    {
        try {
            $this->id = Uuid::uuid4()->toString();
        } catch (UnsatisfiedDependencyException $e) {
            $this->id = null;
        }
        $this->status = 'draft';
        $this->payload = new \stdClass;
        
        $date = new \DateTime();
        $this->created = $this->modified = $date->getTimestamp();
        $this->createAt = $this->modifyAt = $date->format('c');

        return $this;
    }
    
    public function save() : Document
    {
        $this->created = (new \DateTime($this->createAt))->getTimestamp();
        $this->modified = (new \DateTime($this->modifyAt))->getTimestamp();
        $this->data = json_encode($this->payload);

        $res = $this->db->prepare('
            INSERT INTO `documents` (`id`, `status`, `data`, `created`, `modified`)
            VALUES (:id, :status, :data, :created, :modified)
            ON DUPLICATE KEY UPDATE
                `status` = :status,
                `data` = :data,
                `modified` = :modified
        ')->execute(
            array_diff_key(
                get_object_vars($this),
                self::REMOVE_OBJECTS
            )
        );
        
        return ($res) ? $this : new Document();
    }

    public function read($id) : Document
    {
        ($stmt = $this->db->prepare('
            SELECT `id`, `status`, `data`, `created`, `modified`
            FROM `documents`
            WHERE `id` = ?
        '))->execute([
            $id
        ]);
                
        if ($doc = $stmt->fetchObject(__CLASS__)) {
            $doc->createAt = (new \DateTime())->setTimestamp($doc->created)->format('c');
            $doc->modifyAt = (new \DateTime())->setTimestamp($doc->modified)->format('c');
            $doc->payload = json_decode($doc->data);
            $doc->db = $this->db;
        } else {
            $doc = new Document();
        }

        return $doc;
    }

    public function publish($id) : Document
    {
        $doc = $this->read($id);
        if (isset($doc->id)) {
            $doc->modifyAt = (new \DateTime())->format('c');
            $doc->status = 'published';
            $doc->save();
        }

        return $doc;
    }
}