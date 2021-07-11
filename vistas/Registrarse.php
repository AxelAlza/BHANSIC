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
        <?php if(isset($parametros['exito']) && $parametros['exito'] == true): ?>
        <div style="color: #00FF00"> La persona se guardo con exito </div>
        <?php endif; ?>

        <?php if(isset($parametros['exito']) && $parametros['exito'] == false): ?>
        <div style="color: #FF0000"> Hubo un problema al guardar la persona </div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="CedulaUsuario" class="form-label">Cedula</label>
                <input type="number" class="form-control" id="CedulaUsuario" name="CedulaUsuario">
            </div>
            <div class="mb-3">
                <label for="ContraseñaUsuario" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="ContraseñaUsuario" id="ContraseñaUsuario">
            </div>
            <div class="mb-3">
                <label for="NombreUsuario" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="NombreUsuario" name="NombreUsuario">
            </div>
            <div class="mb-3">
                <label for="ApellidoUsuario" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="ApellidoUsuario" name="ApellidoUsuario">
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="static/js/bootstrap.bundle.min.js"></script>

</html>