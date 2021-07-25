<?php
require '../utils/autoloader.php';

$request = $_SERVER['REQUEST_URI'];

function NecesitaAutenticacion($func, $param)
{
    if (SesionControlador::SeInicioSesion()) {
        return call_user_func($func, $param);
    } else {
        header('Location: /Login');
    }
}


if(Contenido::esContenidoEstatico($request)){
    
    $contenido = Contenido::cargarContenido($request);
    header("Content-Type: *".$contenido['contentType']);
    echo $contenido['contenido'];
}

switch (strtok($request, '?')) {
    case '/prueba':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('Imagen');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') cargarVista('Imagen');
        break;
    case '/':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') NecesitaAutenticacion('cargarVista', 'Inicio');
        break;
    case '/Perfil':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') NecesitaAutenticacion('cargarVista', 'PerfilUsuario');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') NecesitaAutenticacion('UsuarioControlador::ModificacionDeUsuario', null);
        break;

    case '/Desloguearse':
        SesionControlador::CerrarSesion();
        break;
    case '/NuevaConsulta':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') NecesitaAutenticacion('cargarVista', 'NuevaConsulta');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') NecesitaAutenticacion('ConsultaControlador::CrearConsulta', null);
        break;
    case '/ListaConsultas':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') NecesitaAutenticacion('cargarVista', 'ListaConsultas');
        break;
    case '/Registrarse':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('Registrarse');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') UsuarioControlador::AltaDeUsuario();
        break;
    case '/Login':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('Login');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') UsuarioControlador::LoginDeUsuario();
        break;
    case '/DetalleConsulta':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') NecesitaAutenticacion('cargarVista', 'DetalleConsulta');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') NecesitaAutenticacion('ConsultaControlador::AñadirRespuesta', null);
        break;
}
