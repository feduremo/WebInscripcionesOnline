<?php

class Tracking
{
    public $tracking_items = array();
    public $default = '';

    private function __construct()
    {
        if(session_id()==''){ session_start(); }
    }

    public function get_last()
    {
        $last = count($this->tracking_items);
        if($last>0)
        {
            $last--;
            return $this->tracking_items[$last];
        }
        else
        {
            return $this->default;
        }
    }

    public function add($link='')
    {
        if($link!='')
        {
            array_push($this->tracking_items, $link);
        }
    }
    public static function load()
    {
        $retorno = _session("tracking");
        if($retorno=='')
        {
            $retorno = new Tracking();
        }
        return $retorno;
    }

    public function save()
    {
        $_SESSION['tracking'] = $this;
    }
}
?>
