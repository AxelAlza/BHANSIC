<?php
require '../utils/autoloader.php';

abstract class UsuarioModelo extends Modelo
{
    public $CedulaUsuario;
    public $NombreUsuario;
    public $ContraseñaUsuario;
    public $ApellidoUsuario;
    public $FotoUsuario;
    public $AvatarUsuario;
    public $Tipo;

    public function Guardar(bool $modificar)
    {
        $modificar ? $this->prepararUpdate() : $this->prepararInsert();
        $this->sentencia->execute();
        if ($this->sentencia->error) {
            throw new Exception("Hubo un problema al cargar el usuario: " . $this->sentencia->error);
        }
    }
    private function prepararInsert()
    {
        if(empty($this->FotoUsuario)){
            $this->FotoUsuario = "/default.jpg";
        }
        $this->ContraseñaUsuario = $this->hashearPassword($this->ContraseñaUsuario);
        $sql = "INSERT INTO Usuarios(CedulaUsuario,NombreUsuario,ApellidoUsuario,ContraseñaUsuario,FotoUsuario,AvatarUsuario) VALUES (?,?,?,?,?,?)";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "isssss",
            $this->CedulaUsuario,
            $this->NombreUsuario,
            $this->ApellidoUsuario,
            $this->ContraseñaUsuario,
            $this->FotoUsuario,
            $this->AvatarUsuario

        );
    }



    public function Autenticar()
    {
        $this->sentencia->execute();
        $resultado = $this->sentencia->get_result()->fetch_assoc();
        if ($this->sentencia->error) {
            throw new Exception("Error al obtener el usuario: " . $this->sentencia->error);
        }
        if ($resultado) {
            $comparacion = $this->compararPasswords($resultado['ContraseñaUsuario']);
            if ($comparacion) {
                $this->asignarDatosDeUsuario($resultado);
            } else {
                throw new Exception("Error al iniciar sesion");
            }
        } else throw new Exception("Error al iniciar sesion");
    }



    private function prepararUpdate()
    {
        $sql = "UPDATE Usuarios set NombreUsuario = ?, ApellidoUsuario = ?, FotoUsuario = ?, AvatarUsuario = ? where CedulaUsuario = ?";
        $stmt=$this->sentencia = $this->conexion->prepare($sql);
        $stmt=$stmt->bind_param(
            "ssssi",
            $this->NombreUsuario,
            $this->ApellidoUsuario,
            $this->FotoUsuario,
            $this->AvatarUsuario,
            $this->CedulaUsuario
        );
    }


    public function compararPasswords($passwordHasheado)
    {
        return password_verify($this->ContraseñaUsuario, $passwordHasheado);
    }


    public function asignarDatosDeUsuario($resultado)
    {
        $this->CedulaUsuario = $resultado['CedulaUsuario'];
        $this->NombreUsuario = $resultado['NombreUsuario'];
        $this->ApellidoUsuario = $resultado['ApellidoUsuario'];
        $this->FotoUsuario = $resultado['FotoUsuario'];
        $this->AvatarUsuario = $resultado['AvatarUsuario'];
        $this->ContraseñaUsuario = "";
    }

    public function hashearPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
