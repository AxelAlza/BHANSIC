<?php 

    require '../utils/autoloader.php';

    class UsuarioControlador{
       
        public static function AltaDeUsuario(){
            try{
            $usuario = new UsuarioModelo();
            $usuario->CedulaUsuario = $_POST['CedulaUsuario'];
            $usuario->NombreUsuario = $_POST['NombreUsuario'];
            $usuario->ApellidoUsuario = $_POST['ApellidoUsuario'];
            $usuario->ContraseñaUsuario = $_POST['ContraseñaUsuario'];
            $usuario->Guardar();
            return generarHtml('Registrarse',['exito' => true]);
        }
        catch(Exception $e){
            error_log($e -> getMessage());
            return generarHtml('Registrarse',['exito' =>false]);
        }    
    }
}