<?php  
    require '../utils/autoloader.php';
    $request = $_SERVER['REQUEST_URI'];
    
    switch($request){
        case '/':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['USER'])) {
                cargarVista('Inicio');  
            } else{
                header("Location: /Login");
            }
            break;

     
        case '/Registrarse':
            if($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('Registrarse');  
            if($_SERVER['REQUEST_METHOD'] === 'POST') UsuarioControlador::AltaDeUsuario();  
            break;

        case '/Login':
            if($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('Login');  
            if($_SERVER['REQUEST_METHOD'] === 'POST') UsuarioControlador::LoginDeUsuario();  
            break;     

    
      
    }