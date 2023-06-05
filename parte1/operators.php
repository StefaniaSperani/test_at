<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.scss">

    <title>Elenco operatori</title>
</head>

<body>
    <div class="m-3">
        <h2 class="text-uppercase text-center my-4">Elenco degli operatori</h2>
        <button class="btn btn-primary mb-3"><a href="add.php">Aggiungi operatore</a></button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Mansione</th>
                    <th scope="col">Username</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Modifica</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("database.php");

                $sql = "SELECT * FROM operators";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // ciclo per stampare gli operatori
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<th scope='row'>" . (isset($row["id"]) ? $row["id"] : "") . "</th>";
                        echo "<td>" . (isset($row["nome"]) ? $row["nome"] : "") . "</td>";
                        echo "<td>" . (isset($row["cognome"]) ? $row["cognome"] : "") . "</td>";
                        echo "<td>" . (isset($row["mansione"]) ? $row["mansione"] : "") . "</td>";
                        echo "<td>" . (isset($row["username"]) ? $row["username"] : "") . "</td>";
                        echo "<td>" . (isset($row["stato"]) ? $row["stato"] : "") . "</td>";
                        echo "<td><button class='btn btn-danger'><a href='edit.php?editid=" . (isset($row["id"]) ? $row["id"] : "") . "'> Modifica </a> </button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nessun risultato trovato.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>