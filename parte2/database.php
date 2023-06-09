<?php
function getDbParams()
{
    return [
        "servername" => "localhost",
        "serverport" => 3306,
        "username" => "root",
        "password" => "root",
        "dbname" => "db_at",
        "unixsocket" => ""
    ];
}

function getDbConn()
{
    $dbParams = getDbParams();

    // Crea una connessione
    $conn = new mysqli($dbParams["servername"], $dbParams["username"], $dbParams["password"], $dbParams["dbname"]);
    // Verifica la connessione
    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }
    // echo "Connessione riuscita!";

    return $conn;
}
?>