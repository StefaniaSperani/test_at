<?php
namespace controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Slim\Routing\RouteContext;

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

        $view = Twig::fromRequest($request);
        return $view->render($response, 'operatori/add.html', []);

    }


    public function submit(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        if ($request->getMethod() === 'POST' && $_POST['submit']) {
            $conn = getDbConn();
            $data = $request->getParsedBody();

            $nome = $data["nome"];
            $cognome = $data["cognome"];
            $mansione = $data["mansione"];
            $username = $data["username"];
            $password = $data["password"];
            $stato = $data["stato"];

            $statoInt = $stato === 'true' ? 'Attivo' : 'Non attivo';

            $sql = "INSERT INTO operators (nome, cognome, mansione, username, password, stato) VALUES ('$nome', '$cognome', '$mansione', '$username', '$password', '$statoInt')";

            if ($conn->query($sql) === true) {
                $response->getBody()->write('<div class="text-center text-danger fs-3 mt-3"> Operatore aggiunto con successo! </div>');
            } else {
                $response->getBody()->write('<div class="text-center text-danger fs-3 mt-3"> Errore durante l\'aggiunta dell\'operatore: </div>' . $conn->error);
            }


            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $urlOperatori = $routeParser->urlFor("operatori.index");
            return $response
                ->withStatus(302)
                ->withHeader("Location", $urlOperatori);
        }
    }

}



$app->get("/operatori", [OperatoriController::class, "operators"])->setName("operatori.index");
$app->get("/operatori/add", [OperatoriController::class, "add"]);
$app->post("/operatori/add", [OperatoriController::class, "submit"]);