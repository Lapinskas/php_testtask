<?php

namespace Vladas\Docs;

/**
 * API route group
 * Common prefix : /api/{VERSION}
 * 
 * Auto comments below for OpenApi 3.0.0
 *  
 */

/**
 * @OA\Info(title="Docs API", version="1.0")
 */
$this->app->group('/api/' . $this::API_VERSION, function(\Slim\App $app) {
    /**
     * @OA\Post(
     *     path="/api/v1/document/",
     *     summary="Create draft of the document",
     *     @OA\Response(response="201", description="Document created"),
     * )
     */           
    $app->post('/document/', DocsController::class . ':createDoc');

    /**
     * @OA\Get(
     *     path="/api/v1/document/{id}",
     *     summary="Get document by id",
     *     @OA\Response(response="200", description="Document found"),
     *     @OA\Response(response="404", description="Document not found") 
     * )
     */            
    $app->get('/document/{id}', DocsController::class . ':getDoc');

    /**
     * @OA\Patch(
     *     path="/api/v1/document/{id}",
     *     summary="Update draft of the document",
     *     @OA\Response(response="200", description="Document updated"),
     *     @OA\Response(response="404", description="Document not found") 
     * )
     */           
    $app->patch('/document/{id}', DocsController::class . ':updateDoc');

    /**
     * @OA\Post(
     *     path="/api/v1/document/{id}/publish",
     *     summary="Publish draft of the document",
     *     @OA\Response(response="200", description="Document published"),
     *     @OA\Response(response="404", description="Document not found") 
     * )
     */           
    $app->post('/document/{id}/publish', DocsController::class . ':publishDoc');

    /**
     * @OA\Get(
     *     path="/api/v1/document/?",
     *     summary="Get documents with pagination",
     *     @OA\Response(response="200", description="Documents found"),
     *     @OA\Response(response="404", description="Documents not found") 
     * )
     */
    $app->get('/document/', DocsController::class . ':getAllDocs');
});
