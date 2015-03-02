<?php

namespace Deniaz\Splendid;

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application();

// Implement your own endpoints here
//$app->get('/service/posts', function(Request $request) use ($app) {
//    return "hi";
//});

$app->run();