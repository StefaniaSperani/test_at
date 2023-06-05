<?php
use controllers\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;


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

include "controllers/HomeController.php";

$app->run();