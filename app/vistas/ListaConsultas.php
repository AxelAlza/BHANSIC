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
      <h1>Listado de Consultas</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Destinatario</th>
            <th scope="col">Tema</th>
            <th scope="col">Fecha de emision</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $parametros['TablaDeConsultas'];?>
        </tbody>
      </table>
</body>
<?php generarHtml('importarjs', null); ?>

</html>