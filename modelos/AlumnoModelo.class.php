<?php
require '../utils/autoloader.php';
class AlumnoModelo extends UsuarioModelo
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
        if ($modificar == false) {
            $this->prepararInsert();
            $this->sentencia->execute();
            if ($this->sentencia->error) {
                throw new Exception("Hubo un problema al cargar el usuario: " . $this->sentencia->error);
            }
        }
    }
    #Sobreescrito
    private function prepararInsert()
    {
        $sql = "INSERT INTO Alumnos values (?)";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "i",
            $this->CedulaUsuario
        );
    }

    #Sobreescrito
    private function prepararAutenticacion()
    {
        $sql = "SELECT CedulaUsuario,NombreUsuario,ApellidoUsuario,ContraseñaUsuario,FotoUsuario FROM Alumnos INNER JOIN Usuarios on Alumnos.CedulaAlumno = Usuarios.CedulaUsuario  WHERE CedulaAlumno = ?";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param("i", $this->CedulaUsuario);
    }
}
