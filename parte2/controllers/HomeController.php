<?php
namespace controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class HomeController
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'home/index.html', []);
        // $response->getBody()->write("Hello world!");
        // return $response;
    }

    public function sayHello(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        list("name" => $name) = $args;

        $users = [
            "Stefania",
            "Alberto"
        ];

        $view = Twig::fromRequest($request);
        return $view->render($response, 'home/sayHello.html', [
            "model" => [
                "users" => $users
            ]
        ]);

        // $response->getBody()->write("Hello {$name}!");
        // return $response;
    }
}


$app->get("/", [HomeController::class, "index"]);
$app->get("/hello/{name}", [HomeController::class, "sayHello"]);