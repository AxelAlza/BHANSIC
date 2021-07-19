<?php
require '../utils/autoloader.php';
$usuario = $_SESSION['USER'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/static/css/bootstrap.min.css" rel="stylesheet" />
  <title>PerfilUsuario</title>
</head>

<body>


  <div class="container">
    <?php if (isset($parametros['exito']) && $parametros['exito'] == true) : ?>
      <div style="color: #00FF00"> La persona se guardo con exito </div>
    <?php endif; ?>

    <?php if (isset($parametros['exito']) && $parametros['exito'] == false) : ?>
      <div style="color: #FF0000"> Hubo un problema al guardar la persona </div>
    <?php endif; ?>
    <a href="/">
    <p> Volver al inicio</p>
    </a>
    <form method="POST">
      <div class="col-md-4">
        <label for="NombreUsuario" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="NombreUsuario" id="NombreUsuario" value=<?= $usuario->NombreUsuario ?>>

      </div>
      <div class="col-md-4">
        <label for="ApellidoUsuario" class="form-label">Apellido</label>
        <input type="text" class="form-control" name="ApellidoUsuario" id="ApellidoUsuario" value=<?= $usuario->ApellidoUsuario ?>>

      </div>
      <div class="col-md-4">
        <label for="CedulaUsuario" class="form-label">Documento</label>

        <input type="number" class="form-control" name="CedulaUsuario" id="CedulaUsuario" value=<?= $usuario->CedulaUsuario ?>>


      </div>
      <div class="col-md-4">
        <label for="ContraseñaUsuario" class="form-label">Contraseña</label>

        <input type="password" class="form-control" name="ContraseñaUsuario" id="ContraseñaUsuario">

      </div>

      <div class="col-12">
        <button class="btn btn-primary" type="submit">Submit form</button>
      </div>
    </form>
</body>

</html>