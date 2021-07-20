<?php
require '../utils/autoloader.php';
class ConsultaModelo extends Modelo

{
    public $IdConsulta;
    public $CedulaAlumno;
    public $CedulaDocente;
    public $FechaYHora;
    public $Tema;
    public $Estado;


    public function Guardar()
    {
        $this->prepararInsert();
        $this->sentencia->execute();

        if ($this->sentencia->error) {
            throw new Exception("Hubo un problema al cargar el usuario: " . $this->sentencia->error);
        }
    }


    public static function InsertarContenido($CedulaUsuario, $Contenido)
    {

        $conexion = ConexionUtil::RetornarConexion();
        $sql = "INSERT INTO Respuestas (CedulaUsuario,Contenido,FechaYHoraEmision) values (?,?,?)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param(
            "iss",
            $CedulaUsuario,
            $Contenido,
            date("Y-m-d H:i:s")
        );
        $sentencia->execute();
    }

    private function prepararInsert()
    {
        $sql = "INSERT INTO Consultas (CedulaAlumno,CedulaDocente,FechaYHora,Tema,Estado) values (?,?,?,?,?)";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "iisss",
            $this->CedulaAlumno,
            $this->CedulaDocente,
            $this->FechaYHora,
            $this->Tema,
            $this->Estado
        );
    }
}
