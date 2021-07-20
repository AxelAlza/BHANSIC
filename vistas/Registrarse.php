<?php
require '../utils/autoloader.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/static/css/bootstrap.min.css" rel="stylesheet" />
    <title>Registrarse</title>
</head>

<body>


    <div class="container">
        <?php Informes::EspacioInformes($parametros); ?>
        <a href="/Login">
            <p>Ir al inicio de sesion</p>
        </a>
        <form class="row g-3" method="POST">
            <div class="col-md-6">
                <label for="CedulaUsuario" class="form-label">Cedula</label>
                <input type="number" class="form-control" id="CedulaUsuario" name="CedulaUsuario" placeholder="8 digitos sin guion">
            </div>
            <div class="col-md-6">
                <label for="ContraseñaUsuario" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="ContraseñaUsuario" name="ContraseñaUsuario">
            </div>
            <div class="col-md-6">
                <label for="NombreUsuario" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario">
            </div>
            <div class="col-md-6">
                <label for="ApellidoUsuario" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="ApellidoUsuario" name="ApellidoUsuario">
            </div>
            <div class="col-md-12">
                <label for="Alumno">Tipo :</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Tipo" id="Alumno" value="0">
                    <label class="form-check-label" for="Alumno">Alumno</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Tipo" id="Docente" value="1">
                    <label class="form-check-label" for="Docente">Docente</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js "></script>
<script src="static/js/bootstrap.bundle.min.js "></script>

</html>