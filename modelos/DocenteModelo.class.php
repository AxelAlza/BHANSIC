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
        $sql = "SELECT CedulaUsuario,NombreUsuario,ApellidoUsuario,ContraseñaUsuario FROM Docentes INNER JOIN Usuarios on Docentes.CedulaDocente = Usuarios.CedulaUsuario  WHERE CedulaDocente = ?";
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

    public static function TraerDocentes()
    {
        $docentes = array();
        $conexion = ConexionUtil::RetornarConexion();
        $sql = "SELECT CedulaUsuario,NombreUsuario,ApellidoUsuario FROM Docentes inner join Usuarios on Usuarios.CedulaUsuario = Docentes.CedulaDocente";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        if ($sentencia->error) {
            throw new Exception("Error al traer los docentes: " . $sentencia->error);
        }
        while ($docente = mysqli_fetch_object($resultado , "DocenteModelo")) {
            array_push($docentes, $docente);
        }
        return $docentes;
    }
}
