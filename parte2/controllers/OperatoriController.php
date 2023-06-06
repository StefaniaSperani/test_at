<?php
namespace controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class OperatoriController
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'operatori/index.html', []);
        // $response->getBody()->write("Hello world!");
        // return $response;
    }

    // public function operators(ServerRequestInterface $request, ResponseInterface $response, array $args)
    // {
    //     // list("name" => $name) = $args;

    //     // $users = [
    //     //     "Stefania",
    //     //     "Alberto"
    //     // ];

    //     $view = Twig::fromRequest($request);
    //     $response->getBody()->write("Hello!");
    //     return $view->render($response, 'home/operators.html', [

    //     ]);

    //     // $response->getBody()->write("Hello {$name}!");
    //     // return $response;
    // }
}



$app->get("/operatori", [OperatoriController::class, "index"])->setName("operatori.index");