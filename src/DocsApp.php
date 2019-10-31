<?php

namespace Vladas\DocsApp;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * DocsApp is the main application class
 * 
 * This class sets all routes and main execution logic using helper classes
 * 
 * @author Vladas Lapinskas <vlad.lapinskas@gmail.com>
 * @version '0.1'
 * 
 */
class DocsApp
{
    /**
     * @OA\Info(title="Docs API", version="1.0")
     */
    
    /**
     * Stores an instance of the Slim application.
     *
     * @var \Slim\App
     */
    private $app;

    /**
     * Creates a new instance of Slim Application
     * Sets all routes
     * Contains main execution logic
     */
    public function __construct()
    {
        
        // Create a new Slim Application instance 
        $app = new \Slim\App;
        
        /**
         * Route for the Documentation
         * 
         * Redirect default route to the Documentation 
         * This route is not a part of API and not included in OpenAPI documentation
         *  
         */
        $app->get('/', function (Request $request, Response $response, $args) {
            return $response->withRedirect('/doc.html', 301);
        });

        /**
         * API route group
         * Common prefix : /api/v1
         * 
         * TODO: add authorization for the API
         * 
         */
        $app->group('/api/v1', function(\Slim\App $app) {
            /**
             * @OA\Get(
             *     path="/api/v1/document/{id}",
             *     summary="Getting document by id",
             *     @OA\Response(response="200", description="Document found"),
             *     @OA\Response(response="404", description="Document not found") 
             * )
             */           
            $app->get('/document/{id}', function (Request $request, Response $response, $args) {
                $id = $args['id'] ?? null;

                // Return result as a JSON structure
                return $response->withJson([
                    'id' => $id
                ], 200);
            });
        });
       
        $this->app = $app;
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