<?php

namespace Vladas\Docs;

use \Psr\Container\ContainerInterface as Container;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Vladas\Docs\Document as Document;

class DocsController {
    protected $container;
    
    public function __construct(Container $container)
    {
       $this->container = $container;
    }
   
    public function getDoc(Request $request, Response $response, $args) : Response
    {
        $doc = Document::create();

        return $response->withJson([
            'document' => get_object_vars($doc)
        ], 200);
    }
    
    public function getAllDocs(Request $request, Response $response, $args) : Response
    {
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
    }
    
    public function createDoc(Request $request, Response $response, $args) : Response
    {
        $data = $request->getParsedBody();
        
        return $response->withJson([
            'document' => $data
        ], 201);
    }
    
    public function updateDoc(Request $request, Response $response, $args) : Response
    {
        $data = $request->getParsedBody();
        
        return $response->withJson([
            'id' => $args['id'],
            'document' => $data
        ], 200);
    }
    
    public function publishDoc(Request $request, Response $response, $args) : Response
    {
        $data = $request->getParsedBody();
        
        return $response->withJson([
            'id' => $args['id'],
            'document' => $data,
            'publish' => true
        ], 200);
    }
}
