<?php
use controllers\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\Views\TwigExtension;

require __DIR__ . '/vendor/autoload.php';


$app = AppFactory::create();
$app->setBasePath("/test_at/parte2");



$app->addRoutingMiddleware();

// $app->get('/', function (Request $request, Response $response, $args) {
//     $response->getBody()->write("Hello world!");
//     return $response;
// });

include "controllers/HomeController.php";

$app->run();