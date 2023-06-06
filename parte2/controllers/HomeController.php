<?php
namespace controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Slim\Routing\RouteContext;

class HomeController
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'home/index.html', []);
        // $response->getBody()->write("Hello world!");
        // return $response;
    }

    public function loginPost(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $formData = $request->getParsedBody();
        $username = $formData["username"];
        $password = $formData["password"];

        $conn = null;
        try {
            $conn = getDbConn();
            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                $routeParser = RouteContext::fromRequest($request)->getRouteParser();
                $urlOperatori = $routeParser->urlFor("operatori.index");
                return $response
                    ->withStatus(302)
                    ->withHeader("Location", $urlOperatori);
            }

            $view = Twig::fromRequest($request);
            return $view->render($response, 'home/index.html', [
                "error" => "Utente non trovato",
                "username" => $username
            ]);
        } finally {
            if (isset($conn)) {
                $conn->close();
            }
        }
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



$app->get("/", [HomeController::class, "index"]);
$app->post("/", [HomeController::class, "loginPost"]);
// $app->get("/operators", [HomeController::class, "operators"]);