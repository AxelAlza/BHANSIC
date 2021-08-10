<?php
require '../framework/autoloader.php';
Rutas::Añadir("/", function () {
    Rutas::NecesitaAutenticacion();
    if (Rutas::EsGET()) cargarVista('Inicio');
});
Rutas::Añadir('/Login', function () {
    if (Rutas::EsGET()) cargarVista('Login');
    if (Rutas::EsPOST()) AlumnoControlador::LoginDealumno();
});
Rutas::Añadir("/Perfil", function () {
    Rutas::NecesitaAutenticacion();
    if (Rutas::EsGET()) cargarVista('PerfilAlumno');
    if (Rutas::EsPOST()) AlumnoControlador::ModificacionDealumno();
});
Rutas::Añadir("/Desloguearse", 'SesionControlador::CerrarSesion');

Rutas::Añadir("/Registrarse", function () {
    if (Rutas::EsGET()) cargarVista('Registrarse');
    if (Rutas::EsPOST()) AlumnoControlador::AltaDealumno();
});
