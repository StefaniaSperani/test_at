<?php
namespace controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }

    public function sayHello(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        list("name" => $name) = $args;

        $response->getBody()->write("Hello {$name}!");
        return $response;
    }
}


$app->get("/", [HomeController::class, "index"]);
$app->get("/hello/{name}", [HomeController::class, "sayHello"]);