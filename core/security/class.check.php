<?php
class Check
{
    /*
     * Function number: Verifica que la cadena sea numerica.
     * @param string $value
     * @param int $min
     * @return bool
     */
    public static function number($value, $min = 0)
    {
        if(!preg_match('/'."^[+-]?[0-9]*\.?[0-9]+$".'/', $value))
        {
            return false;
        }
        else
        {
            if(strlen($value) < $min){ return false;}
            else{ return true;}
        }
    }

    /*
     * Function es_email: Verifica que la cadena sea un email valido.
     * @param string $email
     * @return bool
     */
    public static function email($email)
    {
        if(preg_match('/'."^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$".'/', $email))
        {
            if(function_exists('checkdnsrr'))
            {
                list($alias, $domain) = explode("@", $email);

                if(checkdnsrr($domain, "MX")){ return true;}
                else{ return false;}
            }
            else
            {
                return true;
            }
        }else
        {
            return false;
        }
    }
}

?>