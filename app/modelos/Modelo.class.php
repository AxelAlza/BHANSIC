<?php

require '../framework/autoloader.php';

class Modelo {
    protected $IpDB;
    protected $NombreUsuarioDB;
    protected $PasswordDB;
    protected $NombreDB;
    protected $PuertoDB;
    protected $conexion;
    protected $sentencia;

    public function __construct() {
        $this->inicializarParametrosDeConexion();
        $this->conexion = new mysqli(
            $this->IpDB,
            $this->NombreUsuarioDB,
            $this->PasswordDB,
            $this->NombreDB,
            $this->PuertoDB
        );
        mysqli_set_charset($this->conexion, 'utf8');

        if ($this->conexion->connect_error) {
            throw new Exception("No se pudo conectar");
        }
    }

    protected function inicializarParametrosDeConexion() {
        $this->IpDB = IP_DB;
        $this->NombreUsuarioDB = USUARIO_DB;
        $this->PasswordDB = PASSWORD_DB;
        $this->NombreDB = NOMBRE_DB;
        $this->PuertoDB = PUERTO_DB;
    }
}
