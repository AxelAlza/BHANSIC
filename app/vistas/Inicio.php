<?php
require '../framework/autoloader.php';
$u = $_SESSION['USER'];
?>
<!DOCTYPE html>
<html lang="en">
<?php generarHtml('header', "Inicio"); ?>
<body>
    <?php generarHtml('NavBar', null); ?>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <?php Informes::EspacioInformes($parametros); ?>
            <h1 class="display-5 fw-bold">Bienvenido</h1>
            <p class="col-md-8 fs-4">Alumno</p>
            <p><?= $u->NombreUsuario . " " . $u->ApellidoUsuario ?></p>
        </div>
    </div>
<?php generarHtml('importarjs' , null);?>
</body>
</html>