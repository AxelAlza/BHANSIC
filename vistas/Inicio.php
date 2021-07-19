<?php
require '../utils/autoloader.php';
var_dump($u = $_SESSION['USER']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>BHANSIC</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!--NavBar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/vistas/Inicio.html">BHANSIC</a>
        <button aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarNavDropdown" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link">Chat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Perfil">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Consultas">Consultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Desloguearse">Desloguearse</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="jumbotron">
        <h1 class="display-4">Bienvenido</h1>
        <p class="lead"></p>
        <hr class="my-4">
        <p><?=$u->NombreUsuario." ".$u->ApellidoUsuario?></p>
    </div>
    <!--NavBar-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="static/js/bootstrap.bundle.min.js"></script>
</body>

</html>