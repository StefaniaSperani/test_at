<?php
use controllers\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;


include "config.inc.php";

require __DIR__ . '/vendor/autoload.php';


$app = AppFactory::create();
$app->setBasePath("/test_at/parte2");


$app->addRoutingMiddleware();

$twig = Twig::create("views", []);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));


include "controllers/HomeController.php";
include "controllers/OperatoriController.php";

$app->run();