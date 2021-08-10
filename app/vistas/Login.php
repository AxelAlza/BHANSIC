<?php
require '../framework/autoloader.php';
?>

<!DOCTYPE html>
<html lang="en">


<?php generarHtml('header' , 'DetalleConsulta');?>


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
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <?php generarHtml('importarjs' , null);?>
</body>


</html>