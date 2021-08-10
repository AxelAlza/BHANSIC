<?php
require '../framework/autoloader.php';
?>
<!DOCTYPE html>
<html lang="en">

<?php generarHtml('header' , 'DetalleConsulta');?>
<?php generarHtml('importarjs' , null);?>
<body>
  <?php generarHtml("NavBar", null); ?>
  <div class="container" style="height:100%">
    <form method="POST">
      <?php
      Informes::EspacioInformes($parametros);
      echo $parametros['DisplayInfo'];
      ?>
      <div style="position:fixed; height: 80%" class="container">
        <div class="overflow-auto" style="height:80%">
          <?php echo $parametros['DisplayContenido']; ?>
        </div>
        <div class="fixed-bottom container" style="position:sticky;">
          <span class="border-top"></span>
          <textarea class="form-control" placeholder="Escriba su respuesta" style="resize: none;" id="Contenido" name="respuesta"></textarea>
          <button type="submit" class="btn btn-primary form-control">Responder</button>
        </div>
      </div>
  </div>
  </form>
  </div>

</body>

</html>