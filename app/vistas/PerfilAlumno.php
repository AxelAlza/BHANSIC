<?php
require '../framework/autoloader.php';
$usuario = $_SESSION['USER'];
?>
<!DOCTYPE html>
<html lang="en">


<?php generarHtml('header', 'DetalleConsulta'); ?>

<body>

  <?php generarHtml("NavBar", null); ?>

  <div class="container">
    <?php Informes::EspacioInformes($parametros); ?>
    <form method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-4">
          <label for="CedulaUsuario" class="form-label">Documento</label>
          <input type="number" class="form-control" name="CedulaUsuario" readonly id="CedulaUsuario" value=<?= $usuario->CedulaUsuario ?>>
        </div>
        <div class="col-md-4">
          <label for="formFileSm" class="form-label">Foto</label>
          <input class="form-control form-control-sm" id="foto" name="foto" type="file">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label for="NombreUsuario" class="form-label">Nombre</label>
          <input type="text" class="form-control" name="NombreUsuario" id="NombreUsuario" value=<?= $usuario->NombreUsuario ?>>
        </div>
        <div class="col-md-4">
          <img src="<?= $usuario->FotoUsuario ?>" class="img-thumbnail img-fluid" style="height: 100px; width:100px; position:fixed">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label for="ApellidoUsuario" class="form-label">Apellido</label>
          <input type="text" class="form-control" name="ApellidoUsuario" id="ApellidoUsuario" value=<?= $usuario->ApellidoUsuario ?>>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <button class="btn btn-primary " type="submit">Modificar</button>
        </div>
      </div>
    </form>
  </div>
</body>
<?php generarHtml('importarjs' , null);?>

</html>