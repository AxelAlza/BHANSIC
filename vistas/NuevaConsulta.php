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
  <title>Consultas</title>
</head>

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
        <?php ConsultaControlador::DropDownDocentes(); ?>
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
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="/static/js/bootstrap.bundle.min.js"></script>
</body>

</html>