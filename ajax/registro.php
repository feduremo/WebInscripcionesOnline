<?php

// Creamos las clases necesarias
$Usuarios = new Usuario();

// Obtenemos los datos
$usuario = trim(_post('usuario'));
$mail = trim(_post('mail'));
$clave = trim(_post('clave'));
$nombre = trim(_post('nombre'));
$apellido = trim(_post('apellido'));
$telefono = trim(_post('telefono'));
$direccion = trim(_post('direccion'));
$ciudad = trim(_post('ciudad'));
$empresa = trim(_post('empresa'));
$telefono_empresa = trim(_post('telefono_empresa'));
$direccion_empresa = trim(_post('direccion_empresa'));
$ciudad_empresa = trim(_post('ciudad_empresa'));

$paso = true;

// Validaciones
if($usuario==''){ $paso = false; echo "El usuario ingresado no es correcto.<br/>"; }

$cantidad = $Usuarios->count("usuario='$usuario'");
if($cantidad>0){ $paso = false; echo "El nombre de usuario seleccionado no está disponible.<br/>"; }

$cantidad = $Usuarios->count("mail='$mail'");
if($cantidad>0){ $paso = false; echo "El email ingresado ya se encuentra registrado.<br/>"; }
if(strlen($clave)<8){ $paso = false; echo "La clave ingresada debe tener al menos 8 caracteres.<br/>"; }

if(!Check::email($mail)){ $paso = false; echo "El email ingresado no es correcto."; }

// Guardamos efectivamente el registro
$data = array();
$data['usuario'] = $usuario;
$data['mail'] = $mail;
$data['clave'] = $clave;
$data['nombre'] = $nombre;
$data['apellido'] = $apellido;
$data['direccion'] = $direccion;
$data['telefono'] = $telefono;
$data['ciudad'] = $ciudad;
$data['empresa'] = $empresa;
$data['empresa_direccion'] = $direccion_empresa;
$data['empresa_telefono'] = $telefono_empresa;
$data['empresa_ciudad'] = $ciudad_empresa;
$data['activo'] = 1;
$data['creado'] = date('Y-m-d');
$data['modificado'] = time();

if($paso)
{
    $retorno = $Usuarios->add($data);
    if($retorno==false)
    {
        echo "No se pudo registrar el ususario. Por favor, inténtelo nuevamente más tarde.";
    }else
    {
        $mail_body_usuario = '<table>
                <tr>
                    <td>
                        Gracias por registrarte en 
                        <a style="color:#47988D; text-decoration:none;" href="'.URL_SITE.'">'.SITE_NAME.'</a>.<br/><br/> Tus datos de acceso son:<br/><br/>
                        <strong>Usuario: </strong>'.$usuario.'<br/>
                        <strong>Clave:&nbsp;&nbsp;</strong>'.$clave.'<br/>
                    </td>
                </tr>
                <tr>
                    <td heigth="10"></td>
                </tr>
            </table>';

        $mail_body_empresa = '<table>
                <tr>
                    <td>
                        Se ha registrado un nuevo usuario en 
                        <a style="color:#47988D; text-decoration:none;" href="'.URL_SITE.'">'.SITE_NAME.'</a>.<br/><br/> Los datos del usuario son los siguientes:<br/><br/>
                        <strong>Usuario: </strong>'.$usuario.'<br/>
                        <strong>Mail: </strong>'.$mail.'<br/><br/>
                        <strong>Nombre: </strong>'.$nombre.'<br/>
                        <strong>Apellido: </strong>'.$apellido.'<br/>
                        <strong>Direccion: </strong>'.$direccion.'<br/>
                        <strong>Ciudad: </strong>'.$ciudad.'<br/>
                        <strong>Telefono: </strong>'.$telefono.'<br/><br/>
                        <strong>Empresa: </strong>'.$empresa.'<br/>
                        <strong>Direccion Empresa: </strong>'.$direccion_empresa.'<br/>
                        <strong>Telefono Empresa: </strong>'.$telefono_empresa.'<br/>
                        <strong>Ciudad Empresa: </strong>'.$ciudad_empresa.'<br/>
                    </td>
                </tr>
                <tr>
                    <td heigth="10"></td>
                </tr>
            </table>';

        // Envio de mail al usuario
        $Mail_Manager = Mail_Manager::get_instance();
        $Mail_Manager->set_mail_body_contents($mail_body_usuario);
        $Mail_Manager->send_mail(SITE_NAME." /// Datos de Registro", $mail);
        
        
        // Envio de mail a la Empresa
        $mailer2 = new PHPMailer();
        $Mail_Manager->set_mail_body_contents($mail_body_empresa);
        $Mail_Manager->send_mail(SITE_NAME." /// Nuevo Usuario Registrado", MAIL_TO_USER_REGISTRATION);

        // Envio de mail al Admin
         // Envio de mail a la Empresa
        $mailer3 = new PHPMailer();
        $Mail_Manager->set_mail_body_contents($mail_body_empresa);
        $Mail_Manager->send_mail(SITE_NAME." /// Nuevo Usuario Registrado", "contacto@mrpet.com.uy");
        

        // Registro en la session
        $_SESSION['usuario'] = true;
        $user = $Usuarios->get(Db::insert_id());
        $_SESSION['user']['usuario_id'] = $user['usuario_id'];
        $_SESSION['user']['usuario'] = $user['usuario'];
        $_SESSION['user']['mail'] = $user['mail'];
        $_SESSION['user']['nombre'] = $user['nombre'];
        $_SESSION['user']['apellido'] = $user['apellido'];        
        $_SESSION['user']['direccion'] = $user['direccion'];
        $_SESSION['user']['ciudad'] = $user['ciudad'];
        $_SESSION['user']['telefono'] = $user['telefono'];
        $_SESSION['user']['empresa'] = $user['empresa'];
        $_SESSION['user']['empresa_direccion'] = $user['empresa_direccion'];
        $_SESSION['user']['empresa_telefono'] = $user['empresa_telefono'];
        $_SESSION['user']['empresa_ciudad'] = $user['empresa_ciudad'];
        
        echo "1";
    }
}

?>
