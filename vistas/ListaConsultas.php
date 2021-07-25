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
      <table class="table">
        <thead>
          <tr>
            <?php if ($_SESSION['USER']->Tipo == "0") : ?>
              <th scope="col">Destinatario</th>
            <?php else : ?>
              <th scope="col">Emisor</th>
            <?php endif; ?>
            <th scope="col">Tema</th>
            <th scope="col">Fecha de emision</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php ConsultaControlador::ListaConsultas(); ?>
        </tbody>
      </table>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="/static/js/bootstrap.bundle.min.js"></script>

</html>