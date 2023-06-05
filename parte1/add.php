<?php
include("database.php");

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $mansione = $_POST['mansione'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stato = $_POST['stato'];

    $statoInt = $stato === 'true' ? 'Attivo' : 'Non attivo';

    $sql = "INSERT INTO operators (nome, cognome, mansione, username, password, stato) VALUES ('$nome', '$cognome', '$mansione', '$username', '$password', '$statoInt')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="text-center text-danger fs-3 mt-3"> Operatore aggiunto con successo! </div>';
    } else {
        echo '<div class="text-center text-danger fs-3 mt-3"> Errore durante l\'aggiunta dell\'operatore: </div>' . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.scss">
    <title>Aggiungi operatore</title>
</head>

<body>

    <div class="app d-flex flex-column align-items-center py-4">
        <h2 class="text-uppercase">Aggiungi operatore</h2>
        <form id="add-form" method="post" onsubmit="return validatePsw()">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="nome">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="lastname" name="cognome">
            </div>
            <div class="mb-3">
                <!-- <label for="job" class="form-label">Mansione</label>
                <input type="text" class="form-control" id="job" name="mansione"> -->
                <p>Mansione</p>
                <select name="mansione">
                    <option value="" selected>Scegli mansione</option>
                    <option value="SuperAdmin">SuperAdmin</option>
                    <option value="Amministratore">Amministratore</option>
                    <option value="Impiegato">Impiegato</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">User ID</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Conferma Password</label>
                <input type="password" class="form-control" id="password_confirm" name="confirm_password">
            </div>
            <h5>Stato:</h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="stato" id="flexRadioDefault1" value="true">
                <label class="form-check-label" for="flexRadioDefault1">
                    Attivo
                </label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="stato" id="flexRadioDefault2" value="false" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    Non attivo
                </label>
            </div>
            <!-- errore in js -->
            <p id="error"> </p>

            <button type="submit" class="btn btn-primary" value="Add" name="submit">Aggiungi</button>
            <button class='btn btn-danger'><a href='operators.php'>Indietro</a></button>
        </form>
    </div>

    <script>
        let statoAttivo = document.getElementById("flexRadioDefault1");
        let statoNonAttivo = document.getElementById("flexRadioDefault2");

        statoAttivo.addEventListener("change", function () {
            let val = statoAttivo.value;
        });

        statoNonAttivo.addEventListener("change", function () {
            let val = statoNonAttivo.value;
        });

        function validatePsw() {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("password_confirm").value;

            if (password !== confirmPassword) {
                error.innerHTML = "Le password non corrispondono. Riprova.";
                return false;
            }
            return true;
        }
    </script>
</body>

</html>