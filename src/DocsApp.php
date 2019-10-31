<?php

namespace Vladas\Docs;

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
     * Stores an instance of the Docs
     *
     * @var Vladas\Docs\Document
     */    
    private $doc;


    const VERSION = "v1";

    /**
     * Creates a new instance of Slim Application
     * Sets all routes
     * Contains main execution logic
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
        
        /**
         * API route group
         * Common prefix : /api/{VERSION}
         * 
         * TODO: add authorization for the API
         * 
         */
        $this->app->group('/api/' . $this::VERSION, function(\Slim\App $app) {
            /**
             * @OA\Post(
             *     path="/api/v1/document/",
             *     summary="Create draft of the document",
             *     @OA\Response(response="201", description="Document created"),
             * )
             */           
            $app->post('/document/', function (Request $request, Response $response, $args) {
                return $response->withJson([
                ], 201);
            });

            /**
             * @OA\Get(
             *     path="/api/v1/document/{id}",
             *     summary="Get document by id",
             *     @OA\Response(response="200", description="Document found"),
             *     @OA\Response(response="404", description="Document not found") 
             * )
             */           
            $app->get('/document/{id}', function (Request $request, Response $response, $args) {
                $doc = $this->get('doc');
                $res = $doc->find($args);
                return $response->withJson([
                    'document' => $doc->get()
                ], $res ? 200 : 404);
            });

            /**
             * @OA\Patch(
             *     path="/api/v1/document/{id}",
             *     summary="Update draft of the document",
             *     @OA\Response(response="200", description="Document updated"),
             *     @OA\Response(response="404", description="Document not found") 
             * )
             */           
            $app->patch('/document/{id}', function (Request $request, Response $response, $args) {
                $id = $args['id'] ?? null;
                return $response->withJson([
                ], 200);
            });

            /**
             * @OA\Post(
             *     path="/api/v1/document/{id}/publish",
             *     summary="Publish draft of the document",
             *     @OA\Response(response="200", description="Document published"),
             *     @OA\Response(response="404", description="Document not found") 
             * )
             */           
            $app->post('/document/{id}/publish', function (Request $request, Response $response, $args) {
                $id = $args['id'] ?? null;
                return $response->withJson([
                ], 200);
            });

            /**
             * @OA\Get(
             *     path="/api/v1/document/?",
             *     summary="Get documents with pagination",
             *     @OA\Response(response="200", description="Documents found"),
             *     @OA\Response(response="404", description="Documents not found") 
             * )
             */           
            $app->get('/document/', function (Request $request, Response $response, $args) {
                $pagination = array_merge([
                        'page' => 1,
                        'perPage' => 20
                    ],
                    $request->getQueryParams()
                );
                
                $pagination['total'] = 1;

                return $response->withJson([
                    'pagination' => $pagination
                ], 200);
            });
        });
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