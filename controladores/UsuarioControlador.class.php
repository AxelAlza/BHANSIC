<?php

require '../utils/autoloader.php';

class UsuarioControlador {
    private static function GenerarUsuarioPorPost() {
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
        $usuario->HorarioDeConsultasDesde = $_POST['HorarioDeConsultasDesde'];
        $usuario->HorarioDeConsultasHasta = $_POST['HorarioDeConsultasHasta'];
        $usuario->Tipo = $Tipo;
        return $usuario;
    }

    public static function ModificacionDeUsuario() {
        try {
            $foto = $_FILES['foto'];
            $usuario = self::GenerarUsuarioPorPost();
            if ($foto['error'] == UPLOAD_ERR_OK) {
                $ruta = Contenido::GuardarImagen($foto);
            }
            if ($foto['error'] == UPLOAD_ERR_NO_FILE) {
                $ruta = "static/img/default.jpg";
            }
            $usuario->FotoUsuario = $ruta;

            $usuario->Guardar(true);
            SesionControlador::ActualizarSesion($usuario);
            Informes::InformarExito("Se modifico el usuario correctamente", "PerfilUsuario");
        } catch (Exception $e) {
            error_log($e->getMessage());
            Informes::InformarErrores("Hubo un error al modificar al usuario" . $e->getMessage(), "PerfilUsuario");
        }
    }

    public static function AltaDeUsuario() {
        try {
            $usuario = self::GenerarUsuarioPorPost();
            $usuario->Guardar(false);
            Informes::InformarExito("Se registro con exito", "Registrarse");
        } catch (Exception $e) {
            error_log($e->getMessage());
            Informes::InformarErrores("Hubo un error al registrarse", "Registrarse");
        }
    }

    public static function LoginDeUsuario() {
        try {
            $usuario = self::GenerarUsuarioPorPost();
            $usuario->Autenticar();
            SesionControlador::CrearSesion($usuario);
            header("Location: /");
        } catch (Exception $e) {
            error_log($e->getMessage());
            Informes::InformarErrores("Hubo un error al autenticarse", "Login");
        }
    }
}
