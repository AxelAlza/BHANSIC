<?php
require '../utils/autoloader.php';
$u = $_SESSION['USER'];
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

   <?php generarHtml("NavBar",null);?>
   
    <div class="jumbotron">
        <h1 class="display-4">Bienvenido</h1>
      
        <hr class="my-4">
        <?php if ($u->Tipo == "0"):?>
            <p class="lead">Alumno</p>
        <?php endif; ?>
        <?php if ($u->Tipo == "1"):?>
            <p class="lead">Docente</p>
        <?php endif; ?>
        <p><?=$u->NombreUsuario." ".$u->ApellidoUsuario?></p>
    </div>
    <!--NavBar-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="static/js/bootstrap.bundle.min.js"></script>
</body>

</html>