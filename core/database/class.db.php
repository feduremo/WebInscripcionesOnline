<?php
class Db
{
    /*
     * Function connect: Se conecta a la base de datos
     * @return resource
     */
    public static function connect()
    {
        global $db;
        if(!$db = mysql_connect(DB_HOST, DB_USER, DB_PASS))
        {
            return false;
        }
        if(!mysql_select_db(DB_NAME))
        {
            return false;
        }
        mysql_query("SET NAMES 'utf8'");
        return true;
    }
    
    /*
     * Function num_rows: Devuelve la cantidad de rows de un resultado
     * @param resource $rst
     * @return integer
     */
    public static function num_rows($rst)
    {
        return mysql_num_rows($rst);
    }

    /*
     * Function affected_rows: Devuelve la cantidad de rows afectadas
     * @return integer
     */
    public static function affected_rows()
    {
        global $db;
        return mysql_affected_rows($db);
    }

    /*
     * Function insert_id: Devuelve el ultimo id insertado
     * @return integer
     */
    public static function insert_id()
    {
        global $db;
        return mysql_insert_id($db);
    }
    
    /*
     * Function fetch_array: Devuelve un array con los resultados de una row traida de la bd
     * @param resource
     * @return array
     */
    public static function fetch_array($rst)
    {
        return mysql_fetch_array($rst);
    }

    /*
     * Function quote
     * @param string $value
     * @return string
     */
    public static function quote($value)
    {
        global $db;
        if(get_magic_quotes_gpc())
        {
            $value = stripslashes($value);
        }
        if(!is_numeric($value) || $value[0] == '0')
        {
            $value = "'" . mysql_real_escape_string($value, $db) . "'";
        }
        return $value;
    }

    /*
     * Function ftquote
     * @param string $value
     * @return string
     */
    public static function ftquote($value)
    {
        global $db;
        if(get_magic_quotes_gpc())
        {
            $value = stripslashes($value);
        }
        if(!is_numeric($value) || $value[0] == '0')
        {
            $value = "`" . mysql_real_escape_string($value, $db) . "`";
        }
        return $value;
    }

    /*
     * Function query: Ejecuta una consulta y devuelve el resultado
     * @param string $sql
     * @return mysql_resource
     */
    public static function query($sql)
    {
        global $db;
        $rst = mysql_query($sql, $db);
        if(!$rst)
        {
            return false;
        }
        return $rst;
    }

    /*
     * Function begin_transaction: Comienza una transaccion
     * @return void
     */
    public static function begin_transaction()
    {
        global $db;
        mysql_query("begin", $db);
    }

    /*
     * Function begin_transaction: Finaliza una transaccion. Devulve true si se hizo commit. False en otro caso.
     * @return bool
     */
    public static function end_transaction()
    {
        global $db;
        if(mysql_error())
        {
            mysql_query("rollback", $db);
            return false;
        }
        else
        {
            mysql_query("commit", $db);
            return true;
        }
    }
}
?>