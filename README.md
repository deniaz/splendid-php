# Splendid PHP

Splendid PHP is an alternative to the Node.js based Splendid. It's actively kept in sync with the changes and the 
`generator-splendid` can be applied in Splendid PHP as well.

Splendid PHP runs on PHP and uses the Twig Template Engine. The idea is to use the same templates in the Frontend 
Prototype and the productive application. Markup-changes will never have to be actively integrated into an existing 
application.

## Installation
Using [composer](https://packagist.org/packages/deniaz/splendid-php):

```bash
$ composer create-project deniaz/splendid-php project-name
$ cd project-name
$ php -S localhost:8080 -t . index.php
```

## Custom Routes
Splendid embraces Silex. Therefore any Silex feature is usable within Splendid. To add a custom route you can do 
something like this:

```php
$app = new Application(__DIR__);

$app->get('/service/posts', function(Request $request) use ($app) {
    $response = new Response();
    $response->setStatusCode(200);
    $response->headers->set('Content-Type', 'application/json');
    $response->setContent(json_encode([
        [
            'id' => 1,
            'title' => 'Hello World'
        ],
        [
            'id' => 2,
            'title' => 'Hello Universe'
        ]
    ]));

    return $response;
});

$app->run();
```

## Requirements
The following versions of PHP are supported by this version.

+ PHP 5.4
+ PHP 5.5
+ PHP 5.6
+ HHVM

## Documentation
For more information about assets compilation and watchers refer to the [Splendid Docs](https://github.com/namics/generator-splendid). 
The Twig `component` tag is documented in its [own repository](https://github.com/deniaz/terrific-twig).

### Daily Tasks

## Credits
+ [Twig Template Engine](http://twig.sensiolabs.org/)
+ [Terrific](http://terrifically.org/)
+ [Terrific Micro](https://github.com/namics/terrific-micro)
+ [Terrific Micro Twig](https://github.com/namics/terrific-micro-twig)
+ [Splendid](https://github.com/namics/generator-splendid)
+ [Silex](http://silex.sensiolabs.org/)
+ [Terrific Twig](https://github.com/deniaz/terrific-twig)
