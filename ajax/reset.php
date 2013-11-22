<?php
$Usuarios = new Usuario();

$token = _get('token');
$email = _get('mail');

$paso = false;

$tk = md5("retribuir_password".$email);
if($tk==$token)
{
    $nueva_clave = get_rand_id(8);
    $cantidad = $Usuarios->count("activo=1 and mail='$email'");
    if($cantidad>0){
        $users = $Usuarios->get_list(1, 1, "activo=1 and mail='$email'");
        $row = Db::fetch_array($users);
        if(isset($row['nombre']))
        {
            // Update de la clave
            $data = array();
            $data['clave'] = $nueva_clave;
            $retorno = $Usuarios->update($data, $row['id_usuario']);
            if($retorno==false)
            {
                // Patear
            }else
            {
                // Mandar mail y avisar
                $mail_body = '<table>
                    <tr>
                        <td>Su clave ha sido modificada correctamente. Sus datos de acceso son los siguientes:
                            <br/><br/><strong>Usuario:</strong> '.$row['usuario'].'<br/><strong>Clave:</strong> '.$nueva_clave.'
                        </td>
                    </tr>
                    <tr>
                        <td heigth="10"></td>
                    </tr>
                </table>';

                // Envio de mail al usuario
                $Mail_Manager = Mail_Manager::get_instance();
                $Mail_Manager->set_mail_body_contents($mail_body_usuario);
                if($Mail_Manager->send_mail(SITE_NAME." /// Cambio de Password", $mail))
                {
                    $paso = true;
                }
            }
        }else
        {
            // Patear
        }
    }else
    {
        // Patear
    }
}else
{
    // Patear
}

if($paso)
{
    header('location:index.php?rst=true');
}
else
{
    header('location:index.php?rst=false');
}
?>
