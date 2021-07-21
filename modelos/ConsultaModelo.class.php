<?php
require '../utils/autoloader.php';
$_SESSION['USER'];

class ConsultaModelo extends Modelo
{
    public $IdConsulta;
    public $CedulaAlumno;
    public $CedulaDocente;
    public $FechaYHora;
    public $Tema;
    public $Estado;
    public $Contenidos;


    public function Guardar()
    {
        $this->prepararInsert();
        $this->sentencia->execute();

        if ($this->sentencia->error) {
            throw new Exception("Hubo un problema al cargar el usuario: " . $this->sentencia->error);
        }
    }

    private function prepararInsert(){
        $sql = "CALL CrearConsulta(?,?,?,?,?,?)";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "iissss",
            $this->CedulaAlumno,
            $this->CedulaDocente,
            $this->FechaYHora,
            $this->Tema,
            $this->Estado,
            $this->Contenidos
        );
    }

    public static function TraerConsultas($cedula)
    {
        $consultas = array();
        $conexion = ConexionUtil::RetornarConexion();
        $sql= "SELECT Consultas.CedulaDocente,IdConsulta,Consultas.CedulaAlumno,NombreUsuario,ApellidoUsuario,Tema,FechaYHora,Estado from Consultas INNER join Usuarios on Consultas.CedulaDocente = Usuarios.CedulaUsuario where CedulaAlumno = ? or CedulaDocente = ?";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bind_param(
            "ii",
            $cedula,
            $cedula
        );
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        while ($consulta = mysqli_fetch_object($resultado)) {
            array_push($consultas, $consulta);
        }
        return $consultas;

    }

    


}
