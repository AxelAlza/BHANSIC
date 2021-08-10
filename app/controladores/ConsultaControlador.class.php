<?php
require '../framework/autoloader.php';
class ConsultaControlador {

    static ConsultaModelo $consulta;

    public static function CrearConsulta() {
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

    public static function AñadirRespuesta() {
        try {
            self::$consulta = new ConsultaModelo();
            self::$consulta->CedulaAlumno = intval($_POST['CedulaAlumno']);
            self::$consulta->CedulaDocente = intval($_POST['CedulaDocente']);
            self::$consulta->IdConsulta = intval($_POST['IdConsulta']);
            self::$consulta->Contenidos = $_POST['respuesta'];
            self::$consulta->AñadirRespuesta($_SESSION['USER']->CedulaUsuario);
            Informes::InformarExito("Se envio la respuesta", "DetalleConsulta");
        } catch (Exception $e) {
            Informes::InformarErrores("No se pudo enviar la respuesta", "DetalleConsulta");
        }
    }

    public static function ListarConsultas() {
        $html = "";
        $CedulaDeUsuario = $_SESSION['USER']->CedulaUsuario;
        $Tipo = $_SESSION['USER']->Tipo;
        $Con = new ConsultaModelo();
        $consultas = $Con->TraerConsultas($CedulaDeUsuario, $Tipo);
        foreach ($consultas as $consulta) {
            $html = <<<HTML
            <tr>
                <td>{$consulta->NombreUsuario} {$consulta->ApellidoUsuario}</td>
                <td>{$consulta->Tema}</td>
                <td>{$consulta->FechaYHora}</td>
                <td>{$consulta->Estado}</td>
                <td>
                    <a href = "/DetalleConsulta?CedulaAlumno={$consulta->CedulaAlumno}&CedulaDocente={$consulta->CedulaDocente}&IdConsulta={$consulta->IdConsulta} "> 
                        <button type="button" class="btn btn-primary -btn-sm ">Ver</button> 
                    </a> 
                </td>
            </tr>
            HTML;
            return $html;
        }
    }

    public static function SacarConsultaViaGET() {
        try {
            self::$consulta = new ConsultaModelo();
            self::$consulta->CedulaAlumno = intval($_GET['CedulaAlumno']);
            self::$consulta->CedulaDocente = intval($_GET['CedulaDocente']);
            self::$consulta->IdConsulta = intval($_GET['IdConsulta']);
            self::$consulta->TraerDatos($_SESSION['USER']->Tipo);
            self::$consulta->TraerDetalleDeConsulta();
            if (self::$consulta->Estado == "Contestada") {
                self::$consulta->ActualizarEstado();
            }
        } catch (Exception $e) {
            Informes::InformarErrores("Hubo un error al traer los contenidos", "DetalleConsulta");
        }
    }

    public static function DropDownDocentes() {
        $html = <<<HTML
        <div class="col-3">
        <label for ="Select">Destinatario</label> 
        <select id ="Select" name ="CedulaDocente" class="form-select" aria-label="Seleccionar">
        HTML;
        $Doc = new DocenteModelo();
        foreach ($Doc->TraerDocentes() as $docente) {
            $html .= "\n<option value=' {$docente->CedulaUsuario} '> {$docente->NombreUsuario} {$docente->ApellidoUsuario} </option>";
        }
        $html .= <<<HTML
        </select>
        </div>
        HTML;
        return $html;
    }

    public static function DisplayInfoConsulta() {    
        $consulta = self::$consulta;
        $html = <<<HTML
        <h5> Tema : $consulta->Tema </h5>
        <h6>Para : {$consulta->Emisor} | {$consulta->FechaYHora} </h6>
        <input hidden name ="CedulaAlumno" value="{$consulta->CedulaAlumno}">
        <input hidden name ="CedulaDocente" value="{$consulta->CedulaDocente}">
        <input hidden name ="IdConsulta" value="{$consulta->IdConsulta}">
        HTML;
        return $html;
    }

    public static function DisplayContenidos() {
        $consulta = self::$consulta;
        $html = "";
        foreach ($consulta->Contenidos as $content) {
            $html .= <<<HTML
                <div class = "container">
                <img src="{$content->FotoUsuario}" class="img-thumbnail img-fluid" style="height: 50px; width:50px;">
                <label>{$content->FechaYHoraEmision}</label>
                <label>{$content->NombreUsuario} {$content->ApellidoUsuario} Dijo: </label>
                <textarea class = "form-control" readonly style="resize: none;"  >{$content->Contenido}</textarea>
                </div>
         
            HTML;
        }
        return $html;
    }
}
