<?php
require '../framework/autoloader.php';
?>

<!DOCTYPE html>
<html lang="en">


<?php generarHtml('header', 'DetalleConsulta'); ?>


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
            <div class="col-md-6">
                <label for="NicknameUsuario" class="form-label">NickName</label>
                <input type="text" class="form-control" id="NicknameUsuario" name="NicknameUsuario">
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
    </div>
</body>
<?php generarHtml('importarjs', null); ?>
</html>