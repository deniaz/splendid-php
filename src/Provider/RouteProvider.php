<?php

namespace Deniaz\Splendid\Provider;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use \Twig_Error_Loader;
use \DomainException;

class RouteProvider implements ControllerProviderInterface
{
    private $content;

    function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection  $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function(Application $app) {
            $subRequest = Request::create('/index', 'GET');
            return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
        });

        $controllers->get('/{view}', function(Application $app, $view) {
            $fileName = $view . $app['tc.config']->micro->view_file_extension;
            try {
                if (!isset($this->content[$view])) {
                    $data = [];
                } else {
                    $data = $this->content[$view];
                }

                return $app['twig']->render($fileName, $data);
            } catch (Exception $e) {
                throw new NotFoundHttpException($e->getMessage());
            }
        });

        return $controllers;
    }
}