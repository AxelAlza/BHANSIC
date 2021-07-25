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
    <title>Login</title>
</head>

<body>

    <div class="container">
        <a href="/Registrarse">
            <p>Registrarse</p>
        </a>
        <?php Informes::EspacioInformes($parametros); ?>
        <form method="POST">
            <div class="mb-3">
                <label for="CedulaUsuario" class="form-label">Cedula</label>
                <input type="number" class="form-control" name="CedulaUsuario" id="CedulaUsuario">
            </div>
            <div class="mb-3">
                <label for="ContraseñaUsuario" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="ContraseñaUsuario" id="ContraseñaUsuario">
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
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="/static/js/bootstrap.bundle.min.js"></script>
</body>


</html>