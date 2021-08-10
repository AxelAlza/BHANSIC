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
    <form method="POST">
      <div class="row p-3">
        <div class="col-3">
          <label for="Tema" class="form-label">Tema</label>
          <input type="text" class="form-control" name="Tema" id="Tema">
        </div>
      </div>
      <div class="row p-3">
        <?php echo $parametros['DropdownDocentes'];?>
      </div>
      <div class="row p-3">
        <div class="mb-3">
          <label for="Contenido">Contenido</label>
          <textarea class="form-control" placeholder="Escriba el contenido de la consulta" id="Contenido" name="Contenido"></textarea>
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Hacer consulta</button>
    </form>
  </div>
  <?php generarHtml('importarjs', null); ?>
</body>

</html>