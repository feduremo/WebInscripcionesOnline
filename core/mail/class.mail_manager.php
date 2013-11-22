<?php

class Mail_Manager
{

    private static $instance = null;

    public $Mail_Body='';
    public $Mailer = '0'; // 0 = php mail function, 1 = smtp
    
    public $From = "";
    public $FromName = "";

    public $IsHTML = true;
    public $CharSet = 'UTF-8';
    
    //SMTP Settings
    public $Host = '';
    public $SMTPAuth = true;
    public $Username = "";
    public $Password = "";
    public $Port     = 25;
    public $SMTPSecure = "";

    // Content configuration
    public $Mail_Domain = '';
    public $Mail_Logo = '';
    public $Mail_Logo_Style = '';
    public $Mail_Style = 'background-color:#F7F7F7; font-family:Arial,Helvetica,sans-serif;font-size:12px;';
    public $Mail_Width = '350';


    private function __construct()
    {
        
    }

    public static function get_instance()
    {
        if(!self::$instance instanceof self)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function set_mail_body_contents($contenido)
    {
        $mail_body = '<html><head></head><body>
        <table width="'.$this->Mail_Width.'" cellpading="0" cellspacing="3" border="0" style="'.$this->Mail_Style.'">
            <tr>
                <td align="left" style="'.$this->Mail_Logo_Style.'"><a href="'.$this->Mail_Domain.'"><img src="'.$this->Mail_Logo.'" border="0" /></a></td>
            </tr>
            <tr>
                <td height="10"></td>
            </tr>
            <tr>
                <td>'.$contenido.'</td>
            </tr>
            <tr>
                <td heigth="10"></td>
            </tr>
        </table>
        </body></html>';

        $this->Mail_Body = $mail_body;
    }

    public function set_mail_body_full_contents($contenido)
    {
        $this->Mail_Body = $contenido;
    }

    public function send_mail($asunto,$address='')
    {
        if($address!='')
        {
            $mail = new PHPMailer();
            
            if($this->Mailer=='1')
            {
                $mail->Mailer = "smtp";
                $mail->Host = $this->Host;
                $mail->SMTPAuth = $this->SMTPAuth;
                $mail->Username = $this->Username;
                $mail->Password = $this->Password;
                $mail->Port     = $this->Port;
                $mail->SMTPSecure = $this->SMTPSecure;
            }

            $mail->From = $this->From;
            $mail->FromName = $this->FromName;

            if($this->IsHTML){ $mail->IsHTML(true); }
            
            $mail->Body = $this->Mail_Body;
            $mail->CharSet = $this->Mail_Body;
            $mail->Subject = $asunto;

            // Agregamos las direcciones
            $array_address = explode(',', $address);
            for($i=0; $i<count($array_address); $i++)
            {
                $mail->AddAddress($array_address[$i]);
            }

            if($mail->Send())
            {
                return true;
            }else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}
?>
