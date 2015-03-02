<?php

namespace Deniaz\Splendid;

use Deniaz\Splendid\Provider\RouteProvider;
use Deniaz\Terrific\Twig\Extension\ComponentExtension;
use Silex\Application as SilexApp;
use Silex\Provider\TwigServiceProvider;

class Application extends SilexApp
{
    private $rootDir;

    public function __construct(array $values = [])
    {
        parent::__construct($values);

        $this['root_dir'] = realpath(__DIR__ . '/../') . '/';

        $this['debug'] = true;
        $this['tc.config'] = (is_readable($this->rootDir . 'config.json'))
            ? json_decode(file_get_contents($this->rootDir . 'config.json'))
            : null
        ;

        $this->register(new TwigServiceProvider(), ['twig.path' => $this->rootDir . 'views']);

        $app['twig'] = $this->share($this->extend('twig', function($twig, $app) {
            $paths = [
                $app['root_dir'] . $app['tc.config']->micro->view_partial_directory
            ];
            foreach ($app['tc.config']->micro->components as $component) {
                $paths[] = $app['root_dir'] . $component->path;
            }

            $twig->addExtension(new ComponentExtension($paths, $app['tc.config']->micro->view_file_extension));
            return $twig;
        }));

        $this->mount(
            '/',
            new RouteProvider(
                json_decode(
                    file_get_contents($this->rootDir . 'project/content.json'),
                    true
                )
            )
        );
    }

    /**
     * @return mixed
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }
}