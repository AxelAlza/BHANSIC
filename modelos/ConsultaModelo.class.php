<?php
require '../utils/autoloader.php';
$_SESSION['USER'];

class ConsultaModelo extends Modelo {
    public $Emisor;
    public $IdConsulta;
    public $CedulaAlumno;
    public $CedulaDocente;
    public $FechaYHora;
    public $Tema;
    public $Estado;
    public $Contenidos;


    public function Guardar() {
        $this->prepararInsert();
        $this->sentencia->execute();

        if ($this->sentencia->error) {
            throw new Exception("Hubo un problema al cargar el usuario: " . $this->sentencia->error);
        }
    }
    public function AñadirRespuesta($ciuser) {
        $sql = "CALL AñadirRespuesta(?,?,?,?,?,?)";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "issiii",
            $ciuser,
            $this->Contenidos,
            date("Y-m-d H:i:s"),
            $this->CedulaAlumno,
            $this->CedulaDocente,
            $this->IdConsulta
        );
        $this->sentencia->execute();
    }

    public function ActualizarEstado() {
        $estado = "";
        $tipo = $_SESSION['USER']->Tipo;
        $sql = <<<SQL
            update Consultas set Estado = ?
            where IdConsulta = ? and CedulaAlumno = ? and CedulaDocente = ?;
            SQL;
        $this->sentencia = $this->conexion->prepare($sql);
        if ($tipo == "1") {
            $estado = "Contestada";
        } else {
            $estado = "Recibida";
        }
        $this->sentencia->bind_param(
            "siii",
            $estado,
            $this->IdConsulta,
            $this->CedulaAlumno,
            $this->CedulaDocente
        );
        $this->sentencia->execute();
    }

    private function prepararInsert() {
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


    public function TraerDetalleDeConsulta() {
        $this->Contenidos = array();
        $sql = <<<SQL
        Select FotoUsuario,Respuestas.CedulaUsuario,Contenido,NombreUsuario,ApellidoUsuario,FechaYHoraEmision 
        from RespuestasConsulta 
        inner join Respuestas 
        on RespuestasConsulta.IdRespuesta = Respuestas.IdRespuesta
        inner join Usuarios
        on Respuestas.CedulaUsuario = Usuarios.CedulaUsuario
        where CedulaAlumno = ? and CedulaDocente = ? and IdConsulta = ?;
        SQL;

        $sentencia = $this->conexion->prepare($sql);
        $sentencia->bind_param(
            "iii",
            $this->CedulaAlumno,
            $this->CedulaDocente,
            $this->IdConsulta
        );
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        while ($contenido = mysqli_fetch_object($resultado)) {
            array_push($this->Contenidos, $contenido);
        }
    }


    public static function TraerConsultas($cedula, $tipo) {
        $consultas = array();
        $conexion = ConexionUtil::RetornarConexion();
        $sql = <<<SQL
        SELECT Consultas.CedulaDocente,IdConsulta,Consultas.CedulaAlumno,NombreUsuario,ApellidoUsuario,Tema,FechaYHora,Estado 
        from Consultas INNER join Usuarios on
        SQL;
        if ($tipo == '0') {
            $sql .= " CedulaDocente = CedulaUsuario";
        } else {
            $sql .= " CedulaAlumno = CedulaUsuario";
        }
        $sql .= " where CedulaAlumno = ? or CedulaDocente = ?;";
        $sentencia = $conexion->prepare($sql);
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
        $conexion->close();
        return $consultas;
    }

    public function TraerDatos($tipo) {
        $sql = <<<SQL
        select NombreUsuario,ApellidoUsuario,Tema,FechaYHora,Estado 
        from Consultas INNER join Usuarios on
        SQL;
        if ($tipo == '0') {
            $sql .= " Consultas.CedulaDocente = Usuarios.CedulaUsuario";
        } else {
            $sql .= " Consultas.CedulaAlumno = Usuarios.CedulaUsuario";
        }
        $sql .= " where CedulaAlumno = ? and CedulaDocente = ? and IdConsulta = ?";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "iii",
            $this->CedulaAlumno,
            $this->CedulaDocente,
            $this->IdConsulta
        );
        $this->sentencia->execute();
        $resultado = $this->sentencia->get_result()->fetch_assoc();
        $this->AsignarDatosConsulta($resultado);
    }

    private function AsignarDatosConsulta($resultado) {
        $this->Emisor = $resultado['NombreUsuario'] . " " . $resultado['ApellidoUsuario'];
        $this->Tema = $resultado['Tema'];
        $this->FechaYHora = $resultado['FechaYHora'];
        $this->Estado = $resultado['Estado'];
    }
}
