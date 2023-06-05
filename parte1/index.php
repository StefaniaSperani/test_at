<?php
include("database.php");
include("login.php")
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="style.scss">
    <title>Login</title>
</head>

<body>

    <div class="app py-4">
        <form id="login-form" action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">User ID</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" value="Login" name="submit">Accedi</button>
            <div id="login-message" class="mt-2"></div>
        </form>
    </div>


    <!-- SCRIPT JS -->
    <!-- <script src="script.js"></script> -->
</body>

</html>