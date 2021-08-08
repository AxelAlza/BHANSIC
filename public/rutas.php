<?php
require '../utils/autoloader.php';
$request = $_SERVER['REQUEST_URI'];
class Rutas {
    public static $Rutas = array();
    public static function Añadir($uri, $funcion) {
        self::$Rutas[$uri] = $funcion;
    }
    public static function EvaluarRequest($request) {
        $request = strtok($request, "?");
        $funcion = self::$Rutas[$request];
        if (isset($funcion)) $funcion();
    }
    public static function EsGET() {
        return $_SERVER['REQUEST_METHOD'] === "GET";
    }
    public static function EsPOST() {
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }
}
if (Contenido::esContenidoEstatico($request)) {
    $contenido = Contenido::cargarContenido($request);
    header("Content-Type: " . $contenido['contentType']);
    echo $contenido['contenido'];
}

## Ruteo, Parametros: una ruta , y una funcion que responde a la ruta;

Rutas::Añadir('/Login', function () {
    if (Rutas::EsGET() === 'GET') cargarVista('Login');
    if (Rutas::EsPOST()) UsuarioControlador::LoginDeUsuario();
});
Rutas::Añadir("/", function () {
    NecesitaAutenticacion();
    if (Rutas::EsGET()) cargarVista('Inicio');
});
Rutas::Añadir("/Perfil", function () {
    NecesitaAutenticacion();
    if (Rutas::EsGET()) cargarVista('PerfilUsuario');
    if (Rutas::EsPOST()) UsuarioControlador::ModificacionDeUsuario();
});
Rutas::Añadir("/Desloguearse", 'SesionControlador::CerrarSesion');
Rutas::Añadir('/NuevaConsulta', function () {
    NecesitaAutenticacion();
    if (Rutas::EsGET()) cargarVista('NuevaConsulta');
    if (Rutas::EsPOST()) ConsultaControlador::CrearConsulta();
});
Rutas::Añadir("/ListaConsultas", function () {
    NecesitaAutenticacion();
    if (Rutas::EsGET()) cargarVista("ListaConsultas");
});
Rutas::Añadir("/Registrarse", function () {
    if (Rutas::EsGET()) cargarVista('Registrarse');
    if (Rutas::EsPOST()) UsuarioControlador::AltaDeUsuario();
});
Rutas::Añadir("/DetalleConsulta", function () {
    NecesitaAutenticacion();
    if (Rutas::EsGET()) cargarVista('DetalleConsulta');
    if (Rutas::EsPOST()) ConsultaControlador::AñadirRespuesta();
});

Rutas::EvaluarRequest($request);

function NecesitaAutenticacion() {
    if (SesionControlador::SeInicioSesion()) {
        return;
    } else {
        header('Location: /Login');
    }
}
