<?php  
    require '../utils/autoloader.php';
    $request = $_SERVER['REQUEST_URI'];
    
    switch($request){
     
        case '/Registrarse':
            if($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('Registrarse');  
            if($_SERVER['REQUEST_METHOD'] === 'POST') UsuarioControlador::AltaDeUsuario();  
            break;
      
    }