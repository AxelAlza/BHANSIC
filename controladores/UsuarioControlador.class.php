<?php

require '../utils/autoloader.php';

class UsuarioControlador
{

    private static function GenerarUsuarioPorPost()
    {
        if (!isset($_POST['Tipo'])){
            throw new Exception("No se selecciono un tipo de usuario");
        }
        $Tipo = $_POST['Tipo'];
        if ($Tipo == '0') {
            $usuario = new AlumnoModelo();
        } else {
            $usuario = new DocenteModelo();
        }
        $usuario->CedulaUsuario = $_POST['CedulaUsuario'];
        $usuario->NombreUsuario = $_POST['NombreUsuario'];
        $usuario->ApellidoUsuario = $_POST['ApellidoUsuario'];
        $usuario->ContraseñaUsuario = $_POST['ContraseñaUsuario'];
        $usuario->Tipo = $Tipo;
        return $usuario;
    }

    public static function AltaDeUsuario()
    {
        try {
            $usuario = self::GenerarUsuarioPorPost();
            $usuario->Guardar(false);
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

    private static function CrearSesion($usuario)
    {
        ob_start();
        $usuario->ContraseñaUsuario = "";
        $_SESSION['USER'] = $usuario;
    }

    public static function CerrarSesion()
    {
        session_destroy();
        header("Location: /");
    }
}
