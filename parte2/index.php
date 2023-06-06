<?php
use controllers\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use App\WidgetController;


include "config.inc.php";

require __DIR__ . '/vendor/autoload.php';


$app = AppFactory::create();
$app->setBasePath("/test_at/parte2");


$app->addRoutingMiddleware();

$twig = Twig::create("views", []);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// $app->get('/', function (Request $request, Response $response, $args) {
//     $response->getBody()->write("Hello world!");
//     return $response;
// });

// Service factory for the ORM
// $container['db'] = function ($container) {
//     $capsule = new \Illuminate\Database\Capsule\Manager;
//     $capsule->addConnection($container['settings']['db']);

//     $capsule->setAsGlobal();
//     $capsule->bootEloquent();

//     return $capsule;
// };


// $container[controllers\WidgetController::class] = function ($c) {
//     $view = $c->get('view');
//     $logger = $c->get('logger');
//     $table = $c->get('db')->table('table_name');
//     return new \controllers\WidgetController($view, $logger, $table);
// };



include "controllers/HomeController.php";
include "controllers/OperatoriController.php";
//include "controllers/WidgetController.php";

$app->run();