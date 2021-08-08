<?php
spl_autoload_register(function ($clase) {
    if (file_exists("../modelos/$clase.class.php"))
        require "../modelos/$clase.class.php";

    if (file_exists("../controladores/$clase.class.php"))
        require "../controladores/$clase.class.php";
});
date_default_timezone_set("America/Argentina/Buenos_Aires");
require '../config.php';
require_once '../utils/Conexion.php';
require_once 'render.php';
require_once '../utils/Utils.php';
require_once '../utils/ChromePhp.php';

session_start();
