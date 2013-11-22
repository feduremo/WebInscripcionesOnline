<?php
class Security
{
    /*
     * Constructor
     */
    function Security()
    {
        if(session_id()=='')
        {
            session_start();
        }
    }
    
    /*
     * Function logout: Destruye la session y redirige
     */
    public static function logout($destino='')
    {
        session_destroy();
        if($destino!=''){
            Security::redirect_out($destino);
        }else
        {
            Security::redirect_out();
        }
    }

    /*
     * Function is_logged: Verifica que el usuario este logueado
     * @param string $sesion_name
     * @return bool
     */
    public static function is_logged_in($sesion_name='')
    {
        if($sesion_name=='')
        {
            $sesion_name = 'administrador';
        }
        if(_session($sesion_name)==true){ return true; }
        else{ return false; }
    }

    public static function redirect_out($destino='')
    {
        if($destino!='')
        {
            header('location:'.$destino);
        }else{
            header('location:'.BASE_ADM_FILE);
        }
    }
}
?>
