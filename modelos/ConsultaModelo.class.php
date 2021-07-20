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

    private function prepararInsert()
    {
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
}
