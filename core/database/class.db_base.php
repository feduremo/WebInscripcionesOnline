<?php
class Db_Base
{
    public $table;
    public $primary_key;
    public $debug = false;
    public $condicion;
    
    public $logic_delete = false;
    public $logic_delete_attribute = "eliminado";
    public $show_deleted = false;
    
	
    /*
     * Constructor
     */
    function __construct()
    {
        if(DEBUG_DB)
        {
            $this->debug = true;
        }
        $condicion='';
    }
		
    /*
     * Function add: Agrega a partir de un arreglo, un nuevo registro en la bd
     * @param array $data
     * @return integer
     */
    public function add($data)
    {
        foreach($data as $key => $value)
        {
            $arr_fields[] = Db::ftquote($key);
            $arr_values[] = Db::quote($value);
        }
        $fields = implode(", ", $arr_fields);
        $values = implode(", ", $arr_values);

        $sql = "INSERT INTO " . Db::ftquote($this->table) . " (" . $fields . ") VALUES (" . $values .  ")";

       

        if($this->debug){ $this->show_debug($sql); }

        $rst = Db::query($sql);
        if(!$rst)
        {
            return false;
        }
        if(Db::affected_rows() != 1)
        {
            return false;
        }
        $id = Db::insert_id();
        return $id;
    }

    /*
     * Function show_debug: Muestra por pantalla la consulta sql
     * @params string $sql
     */
    public function show_debug($sql)
    {
        echo '<div class="sql_debug">' . $sql . '</div>';
    }

    /*
     * Function update: Actualiza un registro en la bd
     * @param array $data
     * @param integer $id
     * @return bool
     */
    public function update($data, $id)
    {
     
        $sql = "UPDATE " . Db::ftquote($this->table) . " SET ";
        $update = array();
          
        foreach($data as $key => $value)
        {

            $update[] = Db::ftquote($key) . " = " . Db::quote($value);

        }

        $sql .= implode(", ", $update);
        $sql .= " WHERE " . Db::ftquote($this->primary_key)  . " = " . Db::quote($id) .  " LIMIT 1";


        if($this->debug){ $this->show_debug($sql); }
        $rst = Db::query($sql);
        if(Db::affected_rows()!=1)
        {

            return false;
        }else
        {

            return $rst;
        }
    }

    /*
     * Function delete: Elimina un registro de la bd
     * @param integer $id
     * @return bool
     */
    public function delete($id)
    {
        if($this->logic_delete)
        {
            $data[$this->logic_delete_attribute] = 1;
            $this->update($data, $id);
        }else
        {
            $sql = "DELETE FROM " . Db::ftquote($this->table) . " WHERE " . Db::ftquote($this->primary_key) . " = " . Db::quote($id) . " LIMIT 1";

            echo $sql;
            if($this->debug){ $this->show_debug($sql); }
            $rst = Db::query($sql);
            return $rst;
        }
    }

    

    /*
     * Function get: Recupera un registro de la bd
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        $sql = "SELECT " . Db::ftquote($this->table) . ".* ";
        $sql .= ' FROM ' . Db::ftquote($this->table) . ' ';
        $sql .= " WHERE " . Db::ftquote($this->table) . '.' . Db::ftquote($this->primary_key) . " = " . Db::quote($id) . " LIMIT 1";

        if($this->debug){ $this->show_debug($sql); }

        $rst = Db::query($sql);
        if(!$rst)
        {
            return false;
        }
        if(Db::num_rows($rst) != 1)
        {
            return false;
        }
        $data = Db::fetch_array($rst);
        
        // Validaciones de eliminado logico
        if($this->show_deleted == false)
        {
            if($this->logic_delete == true)
            {
                if($data[$this->logic_delete_attribute] == "1")
                {
                    return false;
                }
            }
        }
        return $data;
    }

    /*
     * Function get_list: Devuelve la lista de objetos
     * @param integer $max
     * @param integer $pag
     * @param string $where
     * @param string $order
     * @return mysql_resource
     */
    public function get_list($max = 0, $pag = 1, $where = '', $order = '')
    {
        $max = (int) $max;
        if(is_numeric($pag))
        {
            $pag = ((int) $pag) - 1;
        }
        else
        {
            $pag = 0;
        }
        // Agregamos condicion de eliminado logico
        if($this->show_deleted == false)
        {
            if($this->logic_delete == true)
            {
                if($where != ''){
                    $where = $this->logic_delete_attribute." <> 1 AND ".$where;
                }else
                {
                    $where = $this->logic_delete_attribute." <> 1 ";
                }
            }
        }

        if($where!='')
        {
            if($this->condicion !='')
            {
                $where = $this->condicion."AND ".$where;
            }
        }
        
        else{ $where = $this->condicion; }
        $sql = "SELECT " . Db::ftquote($this->table) . ".* ";
        $sql .= ' FROM ' . Db::ftquote($this->table) . ' ';
        if($where != '')
        {
            $sql .= " WHERE " . $where;
        }
        if($order != '')
        {
            $sql .= " ORDER BY " . $order;
        }
        if($max != 0)
        {
            $from = $max * $pag;
            $sql .= " LIMIT " . $from . ", " . $max;
        }
        if($this->debug){ $this->show_debug($sql); }

        
        $rst = Db::query($sql);

        if(!$rst)
        {
            return false;
        }
        return $rst;
    }

    /*
     * Function count: Devuelve la cantidad de elementos en la tabla
     * @param string $where
     * @return integer
     */
    public function count($where = '')
    {
        $sql = "SELECT COUNT(*) AS `count` FROM " . Db::ftquote($this->table) . ' ';
        
        // Agregamos condicion de eliminado logico
        if($this->show_deleted == false)
        {
            if($this->logic_delete == true)
            {
                if($where != ''){
                    $where = $this->logic_delete_attribute." <> 1 AND ".$where;
                }else
                {
                    $where = $this->logic_delete_attribute." <> 1 ";
                }
            }
        }
        
        if($where!='')
        {
            if($this->condicion !='')
            {
                $where = $this->condicion."AND ".$where;
            }
        }
        else
        {
            $where = $this->condicion;
        }
        if($where != '')
        {
            $sql .= " WHERE " . $where;
        }
        if($this->debug){ $this->show_debug($sql); }

        $rst = Db::query($sql);
        if(!$rst)
        {
            return false;
        }
        
        $count = Db::fetch_array($rst);

	return $count['count'];
    }
}
?>