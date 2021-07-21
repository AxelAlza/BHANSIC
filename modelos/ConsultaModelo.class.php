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
        $sql = "INSERT INTO Consultas (CedulaAlumno,CedulaDocente,FechaYHora,Tema,Estado) values (?,?,?,?,?)";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "iiiss",
            $this->CedulaAlumno,
            $this->CedulaDocente,
            $this->FechaYHora,
            $this->Tema,
            $this->Estado
        );
    }

    public function TraerConsultas()
    {
        

        $sql= "Select NombreUsuario,ApellidoUsuario,Tema,FechaYHora,Estado from Consultas INNER join Usuarios on Consultas.CedulaDocente = Usuarios.CedulaUsuario where CedulaUsuario = ?";
        $sentencia=$conexion->prepare($sql);
        $sentencia->execute();
        $sentencia->bind_param(
            "ii",
            $this->CedulaDocente,
            $this->CedulaAlumno
        );
    }

    


}
