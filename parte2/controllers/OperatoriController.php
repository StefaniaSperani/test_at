<?php
namespace controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Slim\Routing\RouteContext;
use data\models\OperatoreDataModel;
use data\Operatori\Operatore;
use data\Operatori\OperatoreService;

class OperatoriController
{

    // Lista ciclata che si vede appena loggati
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

    // Render della pagina di aggiunta dell'operatore
    public function add(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {

        $view = Twig::fromRequest($request);
        return $view->render($response, 'operatori/add.html', []);

    }

    // Funzione che serve per aggiungere gli operatori nel db
    // public function submit(ServerRequestInterface $request, ResponseInterface $response, array $args)
    // {

    //     $conn = getDbConn();
    //     $data = $request->getParsedBody();

    //     $nome = $data["nome"];
    //     $cognome = $data["cognome"];
    //     $mansione = $data["mansione"];
    //     $username = $data["username"];
    //     $password = $data["password"];
    //     $stato = $data["stato"];
    //     $statoInt = $stato === 'true' ? 'Attivo' : 'Non attivo';

    //     $sql = "INSERT INTO operators (nome, cognome, mansione, username, password, stato) VALUES ('$nome', '$cognome', '$mansione', '$username', '$password', '$statoInt')";

    //     if ($conn->query($sql) === true) {
    //         $response->getBody()->write('<div class="text-center text-danger fs-3 mt-3"> Operatore aggiunto con successo! </div>');
    //     } else {
    //         $response->getBody()->write('<div class="text-center text-danger fs-3 mt-3"> Errore durante l\'aggiunta dell\'operatore: </div>' . $conn->error);
    //     }

    //     // Premuto il submit vengono reindirizzati alla pagina principale(la lista degli operatori)
    //     $routeParser = RouteContext::fromRequest($request)->getRouteParser();
    //     $urlOperatori = $routeParser->urlFor("operatori.index");
    //     return $response
    //         ->withStatus(302)
    //         ->withHeader("Location", $urlOperatori);


    // }

    // Pagina di render per la modifica dell'utente
    public function edit(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {

        $view = Twig::fromRequest($request);

        if (isset($args['id'])) {
            $conn = getDbConn();
            $id = $args['id'];
            $sql = "SELECT * FROM operators WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);

            return $view->render($response, 'operatori/edit.html', ['user' => $user]);
        } else {
            $response->getBody()->write("Errore nella query");
            return $response->withStatus(500);
        }

        // $view = Twig::fromRequest($request);
        // return $view->render($response, 'operatori/edit.html', []);

    }

    // Funzione che serve per la modifica dell'operatore
    public function editSubmit(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        //if ($request->getMethod() === 'POST' && $_POST['submit']) {
        //Questo if non ti serve...la richiesta è già mappata in POST

        $conn = getDbConn();

        $id = $args['id'];
        $nome = $request->getParsedBody()['nome'];
        $cognome = $request->getParsedBody()['cognome'];
        $mansione = $request->getParsedBody()['mansione'];
        $stato = $request->getParsedBody()['stato'];
        $statoInt = $stato === 'true' ? 'Attivo' : 'Non attivo';

        $sql = "UPDATE operators SET nome='$nome', cognome='$cognome', mansione='$mansione', stato='$statoInt' WHERE id='$id'";

        // $result = mysqli_query($conn, $sql);

        // if ($result) {
        //     $response->getBody()->write('<div class="text-center text-danger fs-3 mt-3"> Operatore modificato con successo! </div>');
        // } else {
        //     $response->getBody()->write('<div class="text-center text-danger fs-3 mt-3"> Errore durante la modifica dell\'operatore: </div>' . $conn->error);
        // }

        if ($conn->query($sql) === TRUE) {
            $data = ['success' => true, 'message' => 'Modifica completata con successo.'];
        } else {
            $data = ['error' => true, 'message' => 'Impossibile completare la modifica.'];
        }

        $payload = json_encode($data);
        // Premuto il submit vengono reindirizzati alla pagina principale(la lista degli operatori)
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $urlOperatori = $routeParser->urlFor("operatori.index");
        return $response
            ->withStatus(302)
            ->withHeader("Location", $urlOperatori)
            ->withHeader('Content-Type', 'application/json');
        // ->getBody()->write($payload);


    }

    //Funzione per cancellare l'utente
    // public function delete(ServerRequestInterface $request, ResponseInterface $response, array $args)
    // {

    //     $conn = getDbConn();
    //     $id = $args['id'];
    //     $sql = "DELETE FROM operators WHERE id='$id'";

    //     if ($conn->query($sql) === TRUE) {
    //         $data = ['success' => true, 'message' => 'Eliminazione completata con successo.'];
    //     } else {
    //         $data = ['error' => true, 'message' => 'Impossibile completare l\'eliminazione.'];
    //     }

    //     $payload = json_encode($data);
    //     $response->getBody()->write($payload);
    //     return $response
    //         ->withHeader("Content-Type", "application/json")
    //         ->withStatus(200);
    // }


    //DOCTRINE

    public function addOp(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $data = $request->getParsedBody();

        $operatore = new OperatoreDataModel();
        $operatore->nome = $data['nome'];
        $operatore->cognome = $data['cognome'];
        $operatore->username = $data['username'];
        $operatore->mansione = $data['mansione'];
        $operatore->stato = $data['stato'] === 'true' ? 'Attivo' : 'Non attivo';

        // $view = Twig::fromRequest($request);
        // return $view->render($response, 'home/test.html', [
        //     "model" => $operatori
        // ]);

        $operatori = OperatoreService::createOperatore($operatore);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $urlOperatori = $routeParser->urlFor("operatori.index");
        return $response
            ->withStatus(302)
            ->withHeader("Location", $urlOperatori);

    }


    public function editOp(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        list("id" => $idOp) = $args;

        $operatore = OperatoreService::findById($idOp);

        $view = Twig::fromRequest($request);
        return $view->render($response, 'operatori/edit.html', [
            "model" => $operatore
        ]);
    }

    public function editOpSubmit(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        list("id" => $idOp) = $args;
        $data = $request->getParsedBody();

        $operatore = new OperatoreDataModel();
        $operatore->id = $idOp;
        $operatore->nome = $data['nome'];
        $operatore->cognome = $data['cognome'];
        $operatore->mansione = $data['mansione'];
        $operatore->stato = $data['stato'] === 'true' ? 'Attivo' : 'Non attivo';

        $operatori = OperatoreService::updateOperatore($operatore);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $urlOperatori = $routeParser->urlFor("operatori.index");
        return $response
            ->withStatus(302)
            ->withHeader("Location", $urlOperatori);
    }

    public function deleteOp(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        list("id" => $idOp) = $args;

        OperatoreService::deleteOperatore($idOp);
        $data = ['success' => true, 'message' => 'Eliminazione completata con successo.'];

        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
            ->withHeader("Content-Type", "application/json")
            ->withStatus(200);
    }


}


// ROTTE

// Pagina principale con la lista degli operatori
$app->get("/operatori", [OperatoriController::class, "operators"])->setName("operatori.index");
// $app->delete("/operatori/{id}", [OperatoriController::class, 'delete']);
$app->delete("/operatori/{id}", [OperatoriController::class, 'deleteOp']);

// Pagina di aggiunta operatore
// $app->get("/operatori/add", [OperatoriController::class, "add"]);
// $app->post("/operatori/add", [OperatoriController::class, "submit"]);

$app->get("/operatori/add", [OperatoriController::class, "add"]);
$app->post("/operatori/add", [OperatoriController::class, "addOp"]);

// Pagina di modifica operatore
// $app->get("/operatori/{id}/edit", [OperatoriController::class, "edit"]);
// $app->post("/operatori/{id}/edit", [OperatoriController::class, "editSubmit"]);

$app->get("/operatori/{id}/edit", [OperatoriController::class, "editOp"]);
$app->post("/operatori/{id}/edit", [OperatoriController::class, "editOpSubmit"]);