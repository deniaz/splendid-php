<?php

namespace Deniaz\Splendid;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application(__DIR__);

// Implement your own endpoints here
//$app->get('/service/posts', function(Request $request) use ($app) {
//    $response = new Response();
//    $response->setStatusCode(200);
//    $response->headers->set('Content-Type', 'application/json');
//    $response->setContent(json_encode([
//        [
//            'id' => 1,
//            'title' => 'Hello World'
//        ],
//        [
//            'id' => 2,
//            'title' => 'Hello Universe'
//        ]
//    ]));
//
//    return $response;
//});

$app->run();