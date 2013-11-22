<?php
class Captcha
{
    public $bgimage = 'back-green.gif';
    public $textred = '0';
    public $textgreen = '0';
    public $textblue = '0';
    public $cantchars = '5';
    public $fontid = '5';
    public $textxstart = '16';
    public $textystart = '7';

    /*
     * Constructor
     */
    public function Captcha()
    {
        if(session_id()=='')
        {
            session_start();
        }
    }

    /*
     * Function generate_image: Genera una imagen a partir de los valores en los atributos de la clase
     * @return resource image/gif
     */
    public function generate_image()
    {
        set_session('tmptxt',get_rand_id($this->cantchars));
        $captcha = imagecreatefromgif("images/".$this->bgimage);
        $colText = imagecolorallocate($captcha, $this->textred, $this->textgreen, $this->textblue);
        imagestring($captcha, $this->fontid, $this->textxstart, $this->textystart, _session('tmptxt'), $colText);
        return imagegif($captcha);
    }

    /*
     * Function validate_word: Verifica si el texto recibido es el generado
     * @param string texto
     * @return bool
     */
    public function validate_word($texto)
    {
        if($texto == _session('tmptxt'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>
