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
  <title>PerfilUsuario</title>
</head>

<body>

  <?php generarHtml("NavBar", null); ?>

  <div class="container">
    <?php Informes::EspacioInformes($parametros); ?>
    <form method="POST">
      
    <h1>Listado de Consultas</h1>

<table>
<tr>
  <td><strong>Docente</strong></td>
  <td><strong>Alumno</strong></td>
  <td><strong>Horario</strong></td>
</tr>

<tr>
  <td><?php ConsultaModelo::ListaConsultas(); ?></td>
  
</tr>



    </form>
  </div>
</body>

</html>