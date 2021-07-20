<?php

require '../utils/autoloader.php';

class UsuarioControlador
{
    private static function GenerarUsuarioPorPost()
    {
        isset($_SESSION['USER']) ? $Tipo = $_SESSION['USER']->Tipo : $Tipo = $_POST['Tipo'];
        if (!isset($Tipo)) {
            throw new Exception("No se pudo conseguir el tipo de usuario");
        }
        if ($Tipo == '0') {
            $usuario = new AlumnoModelo();
        } else {
            $usuario = new DocenteModelo();
        }
        $usuario->CedulaUsuario = isset($_POST['CedulaUsuario']) ? $_POST['CedulaUsuario'] : $_SESSION['USER']->CedulaUsuario;
        $usuario->NombreUsuario = isset($_POST['NombreUsuario']) ? $_POST['NombreUsuario'] : $_SESSION['USER']->NombreUsuario;
        $usuario->ApellidoUsuario = isset($_POST['ApellidoUsuario']) ? $_POST['ApellidoUsuario'] : $_SESSION['USER']->ApellidoUsuario;
        $usuario->ContraseñaUsuario = isset($_POST['ContraseñaUsuario']) ? $_POST['ContraseñaUsuario'] : $_SESSION['USER']->ContraseñaUsuario;
        $usuario->Tipo = $Tipo;
        return $usuario;
    }

    public static function ModificacionDeUsuario()
    {
        try {
            $usuario = self::GenerarUsuarioPorPost();
            $usuario->Guardar(true);
            SesionControlador::ActualizarSesion($usuario);
            return generarHtml('PerfilUsuario', ['exito' => true]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return generarHtml('PerfilUsuario', ['exito' => false]);
        }
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
            SesionControlador::CrearSesion($usuario);
            header("Location: /");
        } catch (Exception $e) {
            error_log($e->getMessage());
            return generarHtml('Login', ['exito' => false]);
        }
    }
}
