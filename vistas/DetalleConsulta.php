<?php
require '../utils/autoloader.php';
$consulta = ConsultaControlador::DetalleConsulta();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/static/css/bootstrap.min.css" rel="stylesheet" />
  <title>Consultas</title>
</head>

<body>
  <?php generarHtml("NavBar", null); ?>
  <div class="container">
    <form method="POST">
      <?php
      Informes::EspacioInformes($parametros);
      ConsultaControlador::DisplayInfoConsulta()
      ?>
      <div style="position:fixed; height: 100px" class="container">
        <div class="overflow-auto" style="height:35vw">
          <?php ConsultaControlador::DisplayContenidos(); ?>
        </div>
      </div>
      <div class="form-floating fixed-bottom container gy-5">
        <span class="border-top"></span>
        <textarea class="form-control" placeholder="Escriba su respuesta" style="resize: none;" id="Contenido" name="respuesta"></textarea>
        <button type="submit" class="btn btn-primary form-control">Responder</button>
      </div>
  </div>
  </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="/static/js/bootstrap.bundle.min.js"></script>

</body>

</html>