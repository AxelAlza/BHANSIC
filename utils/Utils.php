<?php
require '../utils/autoloader.php';
class Informes
{
    public static function InformarErrores($msg, $vista)
    {
        return generarHtml($vista, ['exito' => false, 'msg' => $msg]);
    }

    public static function InformarExito($msg, $vista)
    {
        return generarHtml($vista, ['exito' => true, 'msg' => $msg]);
    }

    public static function EspacioInformes($parametros)
    {
       
        $exito = $parametros['exito'];
        $msg = $parametros['msg'];
        if (isset($exito) && $exito == false) {
            echo <<<HTML
            <div style="color: #FF0000">{$msg}</div>
            HTML;
        } else if (isset($exito) && $exito == true) {
            echo <<<HTML
            <div style="color: #00FF00">{$msg}</div>
            HTML;
        }
    }
}
