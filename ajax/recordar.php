<?php

// Creamos las clases necesarias
$Usuarios = new Usuario();

// Obtenemos los datos
$email = trim(_post('mail'));

$cantidad = $Usuarios->count("mail='$email' and activo=1");
if($cantidad==1)
{
    // Mandamos mail con link para que entre y se cambie la clave
    $token = md5("retribuir_password".$email);

    $mail_body = '<table>
        <tr>
            <td>Usted ha solicitado modificar su clave. Para continuar con la acci&oacute;n, haga click en el siguiente enlace: <a style="color:#47988D; text-decoration:none;" href="'.URL_SITE.'ajax.php?action=reset&ml='.$email.'&tk='.$token.'">recuperar</a>.<br/><br/>
                Se le enviará una nueva clave a esta direcci&oacute;n de correo luego de continuar.
            </td>
        </tr>
        <tr>
            <td heigth="10"></td>
        </tr>
    </table>
    </body></html>';
    
    
    // Envio de mail al usuario
    $Mail_Manager = Mail_Manager::get_instance();
    $Mail_Manager->set_mail_body_contents($mail_body_usuario);
    if($Mail_Manager->send_mail(SITE_NAME." /// Recuperar Password", $mail))
    {
        echo "1";
    }else
    {
        echo "No se pudo recuperar su clave. Inténtelo nuevamente o de lo contrario comunique su inconveniente.";
    }
}else
{
    echo "El email ingresado no se encuentra registrado.";
}
?>
