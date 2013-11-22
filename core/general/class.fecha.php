<?php
class Fecha
{
    /*
     * Function get_fecha: Recibe una fecha en formato Y-m-d y devuelve la fecha en d/m/Y
     */
    public static function get_fecha($fecha)
    {
        $retorno = '';

        if($fecha!='')
        {
            list($y,$m,$d) = explode("-",$fecha);
            $retorno = $d."/".$m."/".$y;
        }

        return $retorno;
    }

    /*
     * Function get_fecha_english: Recibe una fecha en formato d/m/Y y devuelve la fecha en Y-m-d
     */
    public static function get_fecha_english($fecha)
    {
        $retorno = '';

        if($fecha!='')
        {
            //list($d,$m,$y) = explode("/",$fecha);
            list($m,$d,$y) = explode("/",$fecha);
            $retorno = $y."-".$m."-".$d;
        }

        return $retorno;
    }

    /*
     * Function get_fecha_hora: Recibe una fecha en formato Y-m-d H:i:s y devuelve la fecha en d/m/Y H:i:s
     */
    public static function get_fecha_hora($fecha)
    {
        $retorno = '';

        if($fecha!='')
        {
            list($f,$h) = explode(' ', $fecha);
            list($y,$m,$d) = explode("-",$f);
            $retorno = $d."/".$m."/".$y." ".$h;
        }

        return $retorno;
    }

    /*
     * Function get_fecha_english: Recibe una fecha en formato d/m/Y H:i:s y devuelve la fecha en Y-m-d H:i:s
     */
    public static function get_fecha_hora_english($fecha)
    {
        $retorno = '';

        if($fecha!='')
        {
            list($f,$h) = explode(' ', $fecha);
            list($d,$m,$y) = explode("/",$f);
            $retorno = $y."-".$m."-".$d." ".$h;
        }

        return $retorno;
    }

    public static function get_fecha_text($fecha)
    {
        $retorno = '';

        if($fecha!='')
        {
            list($y,$m,$d) = explode("-",$fecha);

            $retorno = $d." de ".Fecha::get_mes_nombre($m)." de ".$y;
        }

        return $retorno;
    }

    public static function get_dia_nombre($fecha)
    {
        $retorno = '';
        list($y,$m,$d) = explode("-", $fecha);
        $h = mktime(0, 0, 0, $m, $d, $y);
        $w= date("l", $h);
        switch($w)
        {
            case 'Monday':
                $retorno = "Lunes";
                break;
            case 'Tuesday':
                $retorno = "Martes";
                break;
            case 'Wednesday':
                $retorno = "Miercoles";
                break;
            case 'Thursday':
                $retorno = "Jueves";
                break;
            case 'Friday':
                $retorno = "Viernes";
                break;
            case 'Saturday':
                $retorno = "Sabado";
                break;
            case 'Sunday':
                $retorno = "Domingo";
                break;
        }
        return $retorno;
    }

    public static function get_mes_nombre($mes)
    {
        $retorno = '';
        if(strlen($mes)==1)
        {
            $mes = '0'.$mes;
        }
        switch($mes)
        {
            case '01';
                $retorno = 'Enero';
                break;
            case '02';
                $retorno = 'Febrero';
                break;
            case '03';
                $retorno = 'Marzo';
                break;
            case '04';
                $retorno = 'Abril';
                break;
            case '05';
                $retorno = 'Mayo';
                break;
            case '06';
                $retorno = 'Junio';
                break;
            case '07';
                $retorno = 'Julio';
                break;
            case '08';
                $retorno = 'Agosto';
                break;
            case '09';
                $retorno = 'Setiembre';
                break;
            case '10';
                $retorno = 'Octubre';
                break;
            case '11';
                $retorno = 'Noviembre';
                break;
            case '12';
                $retorno = 'Diciembre';
                break;
        }
        return $retorno;
    }

    public static function get_mes($fecha)
    {
        if(strpos($fecha, '-'))
        {
            $lista = explode('-', $fecha);
            return $lista[1];
        }
        if(strpos($fecha, '/'))
        {
            $lista = explode('/', $fecha);
            return $lista[1];
        }
    }

    public static function get_ano($fecha)
    {
        if(strpos($fecha, '-'))
        {
            $lista = explode('-', $fecha);
            return $lista[0];
        }
        if(strpos($fecha, '/'))
        {
            $lista = explode('/', $fecha);
            return $lista[2];
        }
    }

    public static function distinto_mes($fecha, $fecha2)
    {
        if(strpos($fecha, '-'))
        {
            $lista = explode('-', $fecha);
            $lista2 = explode('-', $fecha2);

            if($lista[1]==$lista2[1]){ return false; }
            else{ return true;}

        }elseif(strpos($fecha, '/'))
        {
            $lista = explode('/', $fecha);
            $lista2 = explode('/', $fecha2);

            if($lista[1]==$lista2[1]){ return false; }
            else{ return true; }

        }else
        {
            return "";
        }
    }
}


?>
