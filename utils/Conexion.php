<?php

class ConexionUtil
{

    public static function RetornarConexion()

    {
        $IpDB = IP_DB;
        $NombreUsuarioDB = USUARIO_DB;
        $PasswordDB = PASSWORD_DB;
        $NombreDB = NOMBRE_DB;
        $PuertoDB = PUERTO_DB;
        $conexion = new mysqli(
            $IpDB,
            $NombreUsuarioDB,
            $PasswordDB,
            $NombreDB,
            $PuertoDB
        );
        mysqli_set_charset($conexion, 'utf8');
        return $conexion;
    }
 }