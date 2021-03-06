<?php
require '../framework/autoloader.php';

abstract class UsuarioModelo extends Modelo {
    public $CedulaUsuario;
    public $NombreUsuario;
    public $NickNameUsuario;
    public $ContraseñaUsuario;
    public $ApellidoUsuario;
    public $FotoUsuario;

    public function asignarDatosDeUsuario($resultado) {
        $this->CedulaUsuario = $resultado['CedulaUsuario'];
        $this->NombreUsuario = $resultado['NombreUsuario'];
        $this->ApellidoUsuario = $resultado['ApellidoUsuario'];
        $this->FotoUsuario = $resultado['FotoUsuario'];
        $this->NicknameUsuario = $resultado['NicknameUsuario'];
        $this->ContraseñaUsuario = "";
    }

    //Es lo que hay
    public function Modificar() {
        $this->prepararUpdate();
        $this->sentencia->execute();
        if ($this->sentencia->error) {
            throw new Exception("Hubo un problema al modificar el usuario: " . $this->sentencia->error);
        }
    }
    public function Guardar() {
        $this->prepararInsert();
        $this->sentencia->execute();
        if ($this->sentencia->error) {
            throw new Exception("Hubo un problema al insertar el usuario: " . $this->sentencia->error);
        }
    }

    private function prepararInsert() {
        $this->FotoUsuario = "static/img/default.jpg";
        $this->ContraseñaUsuario = $this->hashearPassword($this->ContraseñaUsuario);
        $sql = "INSERT INTO Usuarios(CedulaUsuario,NombreUsuario,ApellidoUsuario,ContraseñaUsuario,FotoUsuario,NicknameUsuario) VALUES (?,?,?,?,?,?)";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "isssss",
            $this->CedulaUsuario,
            $this->NombreUsuario,
            $this->ApellidoUsuario,
            $this->ContraseñaUsuario,
            $this->FotoUsuario,
            $this->NicknameUsuario
        );
    }

    private function prepararUpdate() {
        $sql = "UPDATE Usuarios set NombreUsuario = ?, ApellidoUsuario = ?, FotoUsuario = ? , NicknameUsuario = ? where CedulaUsuario = ?";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "ssssi",
            $this->NombreUsuario,
            $this->ApellidoUsuario,
            $this->FotoUsuario,
            $this->CedulaUsuario,
            $this->NicknameUsuario
        );
    }

    public function hashearPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function compararPasswords($passwordHasheado) {
        return password_verify($this->ContraseñaUsuario, $passwordHasheado);
    }
    public function Autenticar() {
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
}
