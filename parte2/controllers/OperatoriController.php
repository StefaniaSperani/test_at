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

    public function operators(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $conn = getDbConn();

        $sql = "SELECT * FROM operators";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $operators = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $operators[] = $row;
            }
            $view = Twig::fromRequest($request);
            return $view->render($response, 'operatori/index.html', ['operators' => $operators]);
        } else {
            $response->getBody()->write("Errore nella query");
            return $response->withStatus(500);
        }

    }
}



// $app->get("/operatori", [OperatoriController::class, "index"])->setName("operatori.index");
$app->get("/operatori", [OperatoriController::class, "operators"])->setName("operatori.index");