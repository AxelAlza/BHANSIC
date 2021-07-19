<?php

require '../utils/autoloader.php';

class UsuarioControlador
{

    private static function GenerarUsuarioPorPost()
    {
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
    
        return $usuario;
    }

    public static function ModificacionDeUsuario()
    {
        try {
            $usuario = self::GenerarUsuarioPorPost();
            $usuario->Guardar($mod = true);
            return generarHtml('PerfilUsuario', ['exito' => true]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return generarHtml('PerfilUsuario', ['exito' => false]);
            
        }
    }

    private static function ConsultaAlumno(){
        
    }

    public static function AltaDeConsulta()
    {
        $Tipo = $_POST['Tipo'];
        if ($Tipo == '0') {
            ConsultaAlumno();
        } else {
            ConsultaDocente();
        }
    }



    public static function AltaDeUsuario()
    {
        try {
            $usuario = self::GenerarUsuarioPorPost();
            $usuario->Guardar($mod= false);
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
        $DocumentoUsuario=$usuario->CedulaUsuario;
        $_SESSION['USER'] = $usuario;
    }

    public static function CerrarSesion()
    {
        session_destroy();
        header("Location: /");
    }
}
