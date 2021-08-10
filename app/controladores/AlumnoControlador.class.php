<?php

require '../framework/autoloader.php';

class AlumnoControlador {
    private static function ConseguirDatosDeAlumno() {
        $Alumno = new AlumnoModelo();
        $Alumno->CedulaUsuario = isset($_POST['CedulaUsuario']) ? $_POST['CedulaUsuario'] : $_SESSION['USER']->CedulaUsuario;
        $Alumno->NombreUsuario = isset($_POST['NombreUsuario']) ? $_POST['NombreUsuario'] : $_SESSION['USER']->NombreUsuario;
        $Alumno->ApellidoUsuario = isset($_POST['ApellidoUsuario']) ? $_POST['ApellidoUsuario'] : $_SESSION['USER']->ApellidoUsuario;
        $Alumno->ContraseñaUsuario = isset($_POST['ContraseñaUsuario']) ? $_POST['ContraseñaUsuario'] : $_SESSION['USER']->ContraseñaUsuario;
        $Alumno->NicknameUsuario = isset($_POST['NicknameUsuario']) ? $_POST['NicknameUsuario'] : $_SESSION['USER']->NicknameUsuario;
        $Alumno->FotoUsuario = $_SESSION['USER']->FotoUsuario;
        return $Alumno;
    }

    public static function ModificacionDeAlumno() {
        try {
            $foto = $_FILES['foto'];
            $Alumno = self::ConseguirDatosDeAlumno();
            if ($foto['error'] == UPLOAD_ERR_OK) {
                $ruta = Contenido::GuardarImagen($foto);
            }
            if ($foto['error'] == UPLOAD_ERR_NO_FILE || !isset($Alumno->FotoUsuario)) {
                $ruta = "/static/img/default.jpg";
            }
            $Alumno->Fotoalumno = $ruta;
            $Alumno->Modificar();
            SesionControlador::ActualizarSesion($Alumno);
            Informes::InformarExito("Se modifico el Alumno correctamente", "PerfilAlumno");
        } catch (Exception $e) {
            error_log($e->getMessage());
            Informes::InformarErrores("Hubo un error al modificar al Alumno" . $e->getMessage(), "PerfilAlumno");
        }
    }
    public static function AltaDeAlumno() {
        try {
            $Alumno = self::ConseguirDatosDeAlumno();
            $Alumno->Guardar();
            Informes::InformarExito("Se registro con exito", "Registrarse");
        } catch (Exception $e) {
            error_log($e->getMessage());
            Informes::InformarErrores("Hubo un error al registrarse", "Registrarse");
        }
    }
    public static function LoginDeAlumno() {
        try {
            $Alumno = self::ConseguirDatosDeAlumno();
            $Alumno->Autenticar();
            SesionControlador::CrearSesion($Alumno);
            header("Location: /");
        } catch (Exception $e) {
            error_log($e->getMessage());
            Informes::InformarErrores("Hubo un error al autenticarse", "Login");
        }
    }
}
