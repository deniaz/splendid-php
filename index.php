<?php

namespace Deniaz\Splendid;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Prevent Silex form serving static files when served with PHP's built-in webserver.
 * @see http://silex.sensiolabs.org/doc/web_servers.html#php-5-4
 */
$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

(new Application(__DIR__))->run();