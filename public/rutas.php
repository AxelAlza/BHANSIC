<?php
require '../utils/autoloader.php';
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['USER'])) {
            cargarVista('Inicio');
        } else {
            header("Location: /Login");
        }
        break;
    case '/Perfil':  
        if ($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('PerfilUsuario');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') UsuarioControlador::ModificacionDeUsuario();
        break;

    case '/Desloguearse':
        SesionControlador::CerrarSesion();
        break;
    case '/Consultas':
  
        if ($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('NuevaConsulta');
        break;
    case '/Registrarse':
     
        if ($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('Registrarse');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') UsuarioControlador::AltaDeUsuario();
        break;

    case '/Login':
      
        if ($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('Login');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') UsuarioControlador::LoginDeUsuario();
        break;
}
