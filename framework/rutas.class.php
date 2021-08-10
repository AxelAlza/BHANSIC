<?php
require '../framework/autoloader.php';

class Rutas {
    public static $Rutas;
    public static function Añadir($uri, $funcion) {
        self::$Rutas[$uri] = $funcion;
    }
    public static function EvaluarRequest($request) {
        $request = strtok($request, "?");
        $funcion = self::$Rutas[$request];
        if (isset($funcion)) $funcion();
    }
    public static function EsGET() {
        return $_SERVER['REQUEST_METHOD'] == "GET";
    }
    public static function EsPOST() {
        return $_SERVER['REQUEST_METHOD'] == "POST";
    }

    static function NecesitaAutenticacion() {
        if (SesionControlador::SeInicioSesion()) {
            return;
        } else {
            header('Location: /Login');
        }
    }
}
