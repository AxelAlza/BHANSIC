<?php
require '../utils/autoloader.php';
class DocenteModelo extends UsuarioModelo
{


    #Sobreescrito
    public function Autenticar()
    {
        $this->prepararAutenticacion();
        parent::Autenticar();
    }
    #Sobreescrito
    public function Guardar(bool $modificar)
    {
        parent::Guardar($modificar);
        $this->prepararInsert();
        $this->sentencia->execute();
        if ($this->sentencia->error) {
            throw new Exception("Hubo un problema al cargar el usuario: " . $this->sentencia->error);
        }
    }
    #Sobreescrito
    private function prepararAutenticacion()
    {
        $sql = "SELECT CedulaDocente,NombreUsuario,ApellidoUsuario,ContraseñaUsuario FROM Docentes INNER JOIN Usuarios on Docentes.CedulaDocente = Usuarios.CedulaUsuario  WHERE CedulaDocente = ?";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param("i", $this->CedulaUsuario);
    }
    #Sobreescrito
    private function prepararInsert()
    {
        $sql = "INSERT INTO Docentes (CedulaDocente) values (?)";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "i",
            $this->CedulaUsuario
        );
    }
}
