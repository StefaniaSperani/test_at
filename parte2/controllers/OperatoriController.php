<?php
namespace controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class OperatoriController
{
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
            return $view->render($response, 'operatori/operators.html', ['operators' => $operators]);
        } else {
            $response->getBody()->write("Errore nella query");
            return $response->withStatus(500);
        }

    }

    public function add(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $conn = getDbConn();

        $view = Twig::fromRequest($request);
        return $view->render($response, 'operatori/add.html', []);
    }

}



$app->get("/operatori", [OperatoriController::class, "operators"])->setName("operatori.index");
$app->get("/operatori/add", [OperatoriController::class, "add"]);