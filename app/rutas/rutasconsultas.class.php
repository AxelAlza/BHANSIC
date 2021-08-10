<?php
require '../framework/autoloader.php';

Rutas::Añadir('/NuevaConsulta', function () {
    Rutas::NecesitaAutenticacion();
    if (Rutas::EsGET()) generarHtml('NuevaConsulta' , ['DropdownDocentes' => ConsultaControlador::DropDownDocentes()]);
    if (Rutas::EsPOST()) ConsultaControlador::CrearConsulta();
});

Rutas::Añadir("/ListaConsultas", function () {
    Rutas::NecesitaAutenticacion();
    if (Rutas::EsGET()) generarHtml("ListaConsultas" , ['TablaDeConsultas' => ConsultaControlador::ListarConsultas()]);
});

Rutas::Añadir("/DetalleConsulta", function () {
    Rutas::NecesitaAutenticacion();
    if (Rutas::EsGET()){
        ConsultaControlador::SacarConsultaViaGET();
        generarHtml('DetalleConsulta' , ['DisplayInfo' =>ConsultaControlador::DisplayInfoConsulta() , 'DisplayContenido' => ConsultaControlador::DisplayContenidos()]);
    } 
    if (Rutas::EsPOST()) ConsultaControlador::AñadirRespuesta();
});  
