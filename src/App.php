<?php

namespace Vladas;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Vladas\Docs\Document as Document;

/**
 * App is the main application class
 * 
 * This class sets container and all routes
 * 
 * @author Vladas Lapinskas <vlad.lapinskas@gmail.com>
 * @version '0.1'
 * 
 */
class App
{   
    // API version, part of the URI path
    const API_VERSION = "v1";   
    
    /**
     * Stores an instance of the Slim application.
     *
     * @var \Slim\App
     */
    private $app;
    
    /**
     * Stores an instance of the Docs
     *
     * @var Vladas\Docs\Document
     */    
    private $doc;

    /**
     * Creates a new instance of Slim Application
     * Sets all routes
     */
    public function __construct(Document $document)
    {
        // Save Docs instance
        $this->doc = $document;
        
        // Create a new Slim Application instance 
        $this->app = new \Slim\App;
        $this->app->getContainer()['doc'] = function ($container) {
            return $this->doc;
        };

        // Routes
        require __DIR__ . "/../routes/api.php";
    }

    /**
     * Get an instance of the application.
     *
     * @return \Slim\App
     */
    public function get() : \Slim\App
    {
        return $this->app;
    }
}