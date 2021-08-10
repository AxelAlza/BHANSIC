<?php
require '../framework/autoloader.php';

function generarHtml($vista, $parametros) {
    if (file_exists("../app/vistas/$vista.php")) return require "../app/vistas/$vista.php";
    if (file_exists("../app/vistas/componentes/$vista.php")) return require "../app/vistas/componentes/$vista.php";
    return false;
}

function cargarVista($vista) {
    generarHtml($vista, null);
}
