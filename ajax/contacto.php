<?php

// Obtenemos los datos
$nombre = trim(_post('nombre'));
$apellido = trim(_post('apellido'));
$telefono = trim(_post('telefono'));
$mensaje = trim(_post('mensaje'));
$asunto = trim(_post('asunto'));

$paso = true;

if($paso)
{
    $mail_body = '<table>
                    <tr>
                        <td>
                            Ha recibido un mail de contacto. Los datos enviados son los siguientes:<br/><br/>
                            <strong>Nombre: </strong>'.$nombre.'<br/>
                            <strong>Apellido: </strong>'.$apellido.'<br/>  
                            <strong>Telefono: </strong>'.$telefono.'<br/>
                            <strong>Asunto: </strong>'.$asunto.'<br /><br />
                            <strong>Mensaje: </strong>'.$mensaje.'<br/>
                        </td>
                    </tr>
                    <tr>
                        <td heigth="10"></td>
                    </tr>
                  </table>';

    // Envio de mail al usuario
    $Mail_Manager = Mail_Manager::get_instance();
    $Mail_Manager->set_mail_body_contents($mail_body);
    if($Mail_Manager->send_mail(SITE_NAME." /// Mail de Contacto", MAIL_TO_CONTACT))
    {
        echo "1";
    }
    else{
        echo "No se ha podido enviar su mensaje. Intente nuevamente m&aacute;s tarde.";
    }
}else
{
    echo "Los datos recibidos no son correctos.";
}

?>
