<?php 

class ConsultaControlador{


    public static function CrearConsulta(){
        $usuario = $_SESSION['USER'];
        $consulta = new ConsultaModelo();
        $consulta->CedulaAlumno = $usuario->CedulaUsuario;
        $consulta->CedulaDocente = $_POST['Docente'];

    }

}