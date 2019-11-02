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
        $doc = $this->container->get('doc')->create()->read($args['id']);
        
        return $response->withJson([
            'document' => get_object_vars($doc)
        ], (isset($doc->id)) ? 200 : 404);
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
        $doc = $this->container->get('doc')->create()->save();
        
        return $response->withJson([
            'document' => $doc
        ], (isset($doc->id)) ? 201 : 400);
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
        $doc = $this->container->get('doc')->publish($args['id']);
        
        return $response->withJson([
            'document' => $doc
        ], (isset($doc->id)) ? 200 : 404);
    }
}
