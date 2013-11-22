<?php

// Obtenemos los datos
$nombres = trim(_post('nombres'));
$apellidos = trim(_post('apellidos'));
$doc_identidad = trim(_post('doc_identidad'));
$correo = trim(_post('correo'));

$id1 = trim(_post('id1'));
$id2 = trim(_post('id2'));
$id3 = trim(_post('id3'));
$id4 = trim(_post('id4'));
$id5 = trim(_post('id5'));
$id6 = trim(_post('id6'));
$id7 = trim(_post('id7'));
$id8 = trim(_post('id8'));
$id9 = trim(_post('id9'));
$id10 = trim(_post('id10'));
$id11 = trim(_post('id11'));
$id12 = trim(_post('id12'));
$id13 = trim(_post('id13'));
$id14 = trim(_post('id14'));
$id15 = trim(_post('id15'));
$id16 = trim(_post('id16'));
$id17 = trim(_post('id17'));
$id18 = trim(_post('id18'));
$id19 = trim(_post('id19'));
$id20 = trim(_post('id20'));
$id21 = trim(_post('id21'));
$id22 = trim(_post('id22'));
$id23 = trim(_post('id23'));
$id24 = trim(_post('id24'));
$id25 = trim(_post('id25'));
$id26 = trim(_post('id26'));
$id27 = trim(_post('id27'));
$id28 = trim(_post('id28'));
$id29 = trim(_post('id29'));
$id30 = trim(_post('id30'));
$id31 = trim(_post('id31'));
$id32 = trim(_post('id32'));
$id33 = trim(_post('id33'));


$paso = true;

if($paso)
{
    $mail_body = '<table>
                    <tr>
                        <td>
                            Ha recibido un mail de trabaje con nosotros. Los datos enviados son los siguientes:<br/><br/>
                            <strong>Nombres: </strong>'.$nombres.'<br/>
                            <strong>Apellidos: </strong>'.$apellidos.'<br/>  
                            <strong>CI: </strong>'.$doc_identidad.'<br/>
                            <strong>Correo: </strong>'.$correo.'<br/><br/>
                            Solicitud de Empleo <br/>
                            <strong>Fecha Nacimiento: </strong>'.$id1.'<br/>
                            <strong>Dirección: </strong>'.$id2.'<br/>
                            <strong>Barrio: </strong>'.$id3.'<br/>
                            <strong>Depto: </strong>'.$id4.'<br/>
                            <strong>Celular: </strong>'.$id5.'<br/>
                            <strong>Teléfono: </strong>'.$id6.'<br/>
                            <strong>Estado Civil: </strong>'.$id7.'<br/>
                            <strong>Hijos: </strong>'.$id8.'<br/>
                            <strong>Cuantos? </strong>'.$id9.'<br/><br/>
                            Núcleo Familiar <br/>    
                            <strong>Nombre y Apellido: </strong>'.$id10.'<br/>
                            <strong>Relación: </strong>'.$id11.'<br/>
                            <strong>Actividad: </strong>'.$id12.'<br/>
                            <strong>Empresa: </strong>'.$id13.'<br/>
                            <strong>Teléfono: </strong>'.$id14.'<br/>
                            <strong>Institución Primaria: </strong>'.$id15.'<br/>
                            <strong>Institución Secunadria: </strong>'.$id16.'<br/>
                            <strong>Institución Terciaria: </strong>'.$id17.'<br/>
                            <strong>Carrera/Oficio: </strong>'.$id18.'<br/>
                            <strong>Años completos: </strong>'.$id19.'<br/>
                            <strong>Otros Estudios: </strong>'.$id20.'<br/><br/>
                            Experiencia Laboral <br/>
                            <strong>Está trabajando actualmente?: </strong>'.$id21.'<br/>
                            <strong>Tarea? </strong>'.$id22.'<br/>
                            <strong>Donde? </strong>'.$id23.'<br/>
                            <strong>Horario? </strong>'.$id24.'<br/><br/>
                            Experiencia Anterior <br/>
                            <strong>Empresa: </strong>'.$id25.'<br/>
                            <strong>Fecha Ingreso: </strong>'.$id26.'<br/>
                            <strong>Telefono: </strong>'.$id27.'<br/>
                            <strong>Dirección: </strong>'.$id28.'<br/>
                            <strong>Fecha Egreso: </strong>'.$id29.'<br/>
                            <strong>Cargo Ocupado: </strong>'.$id30.'<br/>
                            <strong>Tareas Realizadas: </strong>'.$id31.'<br/>
                            <strong>Voluntario? </strong>'.$id32.'<br/>
                            <strong>Causal: </strong>'.$id33.'<br/>
                        </td>
                    </tr>
                    <tr>
                        <td heigth="10"></td>
                    </tr>
                  </table>';

    // Envio de mail al usuario
    $Mail_Manager = Mail_Manager::get_instance();
    $Mail_Manager->set_mail_body_contents($mail_body);
    if($Mail_Manager->send_mail(SITE_NAME." /// Mail de Contacto", MAIL_TO_CONTACT2))
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
