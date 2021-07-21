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


    public function Guardar()
    {
        $this->prepararInsert();
        $this->sentencia->execute();

        if ($this->sentencia->error) {
            throw new Exception("Hubo un problema al cargar el usuario: " . $this->sentencia->error);
        }
    }


    public static function InsertarContenido($CedulaUsuario, $Contenido)
    {

        $conexion = ConexionUtil::RetornarConexion();
        $sql = "INSERT INTO Respuestas (CedulaUsuario,Contenido,FechaYHoraEmision) values (?,?,?)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param(
            "iss",
            $CedulaUsuario,
            $Contenido,
            date("Y-m-d H:i:s")
        );
        $sentencia->execute();
    }

    private function prepararInsert()
    {
        $sql = "INSERT INTO Consultas (CedulaAlumno,CedulaDocente,FechaYHora,Tema,Estado) values (?,?,?,?,?)";
        $this->sentencia = $this->conexion->prepare($sql);
        $this->sentencia->bind_param(
            "iisss",
            $this->CedulaAlumno,
            $this->CedulaDocente,
            $this->FechaYHora,
            $this->Tema,
            $this->Estado
        );
    }

    public static function TraerConsultas()
    {
        $consultas = array();
        $conexion = ConexionUtil::RetornarConexion();
        $sql= "SELECT NombreUsuario,ApellidoUsuario,Tema,FechaYHora,Estado from Consultas INNER join Usuarios on Consultas.CedulaDocente = Usuarios.CedulaUsuario where CedulaAlumno = ?";
        $consulta  = mysql_query ($sql,$conexion);
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->get_result();
        
    
        while ($consulta = mysqli_fetch_array($consulta)) {
            array_push($consultas, $consulta);
        }
        
        return $consultas;
    }

    public static function ListaConsultas()

    {
       
     foreach (self::TraerConsultas() as $elemento) {
     $html .= "\n<p> {$elemento->NombreUsuario} '> {$elemento->ApellidoUsuario} {$elemento->Tema} </p>";
        }
        $html .= <<<HTML
        </select>
        </div>
        HTML;
        echo $html;
    }


}
