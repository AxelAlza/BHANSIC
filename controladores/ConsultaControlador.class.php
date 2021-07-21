<?php

class ConsultaControlador
{


    public static function CrearConsulta()
    {
        try {
            $usuario = $_SESSION['USER'];
            $consulta = new ConsultaModelo();
            $consulta->CedulaAlumno = $usuario->CedulaUsuario;
            $consulta->CedulaDocente = $_POST['CedulaDocente'];
            $consulta->FechaYHora = date("Y-m-d H:i:s");
            $consulta->Tema = $_POST['Tema'];
            $consulta->Estado = "Realizada";
            $consulta->Contenidos = $_POST['Contenido'];
            $consulta->Guardar();
            Informes::InformarExito("Se envio la consulta correctamente", "NuevaConsulta");
        } catch (Exception $e) {
            Informes::InformarErrores("Hubo un error al enviar la consulta", "NuevaConsulta");
        }
    }

    


    public static function DropDownDocentes()

    {
        $html = <<<HTML
        <div class="col-3 ">
        <label for ="Select">Destinatario</label> 
        <select id ="Select" name ="CedulaDocente" class="form-select" aria-label="Seleccionar">
        HTML;
        foreach (DocenteModelo::TraerDocentes() as $docente) {
            $html .= "\n<option value=' {$docente->CedulaUsuario} '> {$docente->NombreUsuario} {$docente->ApellidoUsuario} </option>";
        }
        $html .= <<<HTML
        </select>
        </div>
        HTML;
        echo $html;
    }
}
