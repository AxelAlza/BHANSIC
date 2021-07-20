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
      <div class="row ">
        <div class="col-3">
          <label for="Tema" class="form-label">Tema</label>
          <input type="text" class="form-control" name="Tema" id="Tema">
        </div>
      </div>
      <div class="row form-group">
        <?php echo ConsultaControlador::DropDownDocentes(); ?>
      </div>

      <div class="row form-group">
        <div class="col-12 align-self-center">
          <div class="form-floating">
            <label for="Contenido">Consulta</label>
            <textarea class="form-control" placeholder="Escriba el contenido de la consulta" id="Contenido" name="Contenido"></textarea>
          </div>
        </div>
      </div>

      <button class="btn btn-primary" type="submit">Hacer consulta</button>
  </div>

  </form>
</body>

</html>