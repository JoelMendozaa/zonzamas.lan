<?php

    session_start();


    if (!empty($_GET['paso']))
    {
        //$_SESSION['idioma'] = $_GET['idioma'];

        setcookie("idioma", $_GET['idioma'], time()+ 60*60*24*7);

        header("location: /bienvenida.php");
        exit();

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link type="text/css" href="/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Cambio de idioma</title>
</head>
<body>

<div class="container-sm">


    <form action="/configuracion_idioma.php" method="GET">

        <input type="hidden" name="paso" value="1" />
        <div class="mb-3 row">
            <label for="staticName" class="col-sm-2 col-form-label">Seleciona el idioma</label>

            <select class="form-control" name="idioma">
                <option value="ES">Español</option>
                <option value="EN">Inglés</option>
                <option value="DE">Alemán</option>
                <option value="FR">Francés</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cambio idioma</button>
        
    </form>
    <br />
    <a href="/login.php">Login</a><br/><br/>

</div>
</body>
</html>