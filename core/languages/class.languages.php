<?php
class Languages
{
    public $lang;

    function __construct($lang="")
    {
        if($lang==""){ $this->lang = "es";}
        else{ $this->lang = $lang; }
    }

    public function dyn_att($objeto, $att, $default="")
    {
        // Verificamos el idioma dado el distinto comportamiento
        if($this->lang == "es")
        {
            if( isset ($objeto[$att]) )
            {
                return $objeto[$att];
            }else
            {
                return $default;
            }
        }
        else
        {
            if( isset ($objeto[$att."_".$this->lang]) )
            {
                return $objeto[$att."_".$this->lang];
            }else
            {
                return $default;
            }
        }
        
    }
}
?>
