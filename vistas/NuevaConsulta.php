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

    <form method="POST">
      <div class="col-md-4">
        <label for="Tema" class="form-label">Tema</label>
        <input type="text" class="form-control" name="Tema" id="Tema">
      </div>

      <div class="col-md-12">
        <select class="form-select" aria-label="Seleccione docente">
          <?php
            foreach (DocenteModelo::TraerDocentes() as $docente) {
            echo "<option>" . $docente->NombreUsuario." ".$docente->ApellidoUsuario."</option>";
          } ?>
        </select>
      </div>
      <div class="col-md-4">
        <label for="Consulta" class="form-label">Contenido de la consulta</label><br>
        <textarea class="input" name="Consulta" id="Consulta" rows="10" cols="30"></textarea>
      </div>

      <div class="col-12">
        <button class="btn btn-primary" type="submit">Submit form</button>
      </div>
    </form>
</body>

</html>