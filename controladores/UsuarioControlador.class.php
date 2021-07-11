<?php

require '../utils/autoloader.php';

class UsuarioControlador
{

    private static function GenerarUsuarioPorPost()
    {
        $usuario = new UsuarioModelo();
        $usuario->CedulaUsuario = $_POST['CedulaUsuario'];
        $usuario->NombreUsuario = $_POST['NombreUsuario'];
        $usuario->ApellidoUsuario = $_POST['ApellidoUsuario'];
        $usuario->ContraseñaUsuario = $_POST['ContraseñaUsuario'];
        return $usuario;
    }

    public static function AltaDeUsuario()
    {
        try {
            $usuario = self::GenerarUsuarioPorPost();
            $usuario->Guardar();
            return generarHtml('Registrarse', ['exito' => true]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return generarHtml('Registrarse', ['exito' => false]);
        }
    }

    public static function LoginDeUsuario()
    {
        try {
            $usuario = self::GenerarUsuarioPorPost();
            $usuario->Autenticar();
            self::CrearSesion($usuario);
            header("Location: /");
           
        } catch (Exception $e) {
            error_log($e->getMessage());
            return generarHtml('Login', ['exito' => false]);
            
        }
    }

    private static function CrearSesion(UsuarioModelo $usuario)
    {
        ob_start();
            $usuario->ContraseñaUsuario = "";
            $_SESSION['USER'] = $usuario;
    }
}
