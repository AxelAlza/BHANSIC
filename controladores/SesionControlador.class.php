<?php
require '../utils/autoloader.php';

class SesionControlador
{
    public static function CrearSesion($usuario)
    {
        ob_start();
        $_SESSION['USER'] = $usuario;
    }

    public static function CerrarSesion()
    {
        session_destroy();
        header("Location: /");
    }

    public static function ActualizarSesion($usuario){
        $_SESSION['USER'] = $usuario;
    }
}
