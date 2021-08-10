<?php
require '../framework/autoloader.php';
include '../app/rutas/rutasconsultas.class.php';
include '../app/rutas/rutasalumno.class.php';
$request = $_SERVER['REQUEST_URI'];
if (Contenido::esContenidoEstatico($request)) {
    $contenido = Contenido::cargarContenido($request);
    header("Content-Type: " . $contenido['contentType']);
    echo $contenido['contenido'];
}
Rutas::EvaluarRequest($request);


