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
    <link href="/static/css/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <?php generarHtml('NavBar', null); ?>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <?php Informes::EspacioInformes($parametros); ?>
            <h1 class="display-5 fw-bold">Bienvenido</h1>
            <?php if ($u->Tipo == "0") : ?>
                <p class="col-md-8 fs-4">Alumno</p>
            <?php endif; ?>
            <?php if ($u->Tipo == "1") : ?>
                <p class="col-md-8 fs-4">Docente</p>
            <?php endif; ?>
            <p><?= $u->NombreUsuario . " " . $u->ApellidoUsuario ?></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="/static/js/bootstrap.bundle.min.js"></script>
</body>

</html>