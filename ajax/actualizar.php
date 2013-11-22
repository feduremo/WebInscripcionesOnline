<?php

// Creamos las clases necesarias
$Usuarios = new Usuario();

// Obtenemos los datos
if(Security::is_logged_in('usuario')){

    $user = _session('user');
    $id_usuario = $user['usuario_id'];
    
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
        
    $paso=true;

    // Validaciones
    if(!Check::email($mail)){ $paso = false; echo "El email ingresado no es correcto."; }
    if($clave!=""){ if(strlen($clave)<8){ $paso = false; echo "La clave ingresada debe tener al menos 8 caracteres.<br/>"; } }
    
    if($paso)
    {
        // Guardamos efectivamente el registro
        $data = array();
        
        $data['mail'] = $mail;
        if($clave!=""){ $data['clave'] = $clave; }
        $data['nombre'] = $nombre;
        $data['apellido'] = $apellido;
        $data['direccion'] = $direccion;
        $data['telefono'] = $telefono;
        $data['ciudad'] = $ciudad;
        $data['empresa'] = $empresa;
        $data['empresa_direccion'] = $direccion_empresa;
        $data['empresa_telefono'] = $telefono_empresa;
        $data['empresa_ciudad'] = $ciudad_empresa;
        $data['modificado'] = time();
        
        $retorno = $Usuarios->update($data, $id_usuario);
        if($retorno==false){ echo "No se pudo modificar los datos del ususario. Inténtelo nuevamente más tarde."; }
        else
        {
            echo "1";
            $_SESSION['user']['mail'] = $data['mail'];
            $_SESSION['user']['nombre'] = $data['nombre'];
            $_SESSION['user']['apellido'] = $data['apellido'];
            $_SESSION['user']['direccion'] = $data['direccion'];
            $_SESSION['user']['telefono'] = $data['telefono'];
            $_SESSION['user']['ciudad'] = $data['ciudad'];
            $_SESSION['user']['empresa'] = $data['empresa'];
            $_SESSION['user']['empresa_direccion'] = $data['empresa_direccion'];
            $_SESSION['user']['empresa_telefono'] = $data['empresa_telefono'];
            $_SESSION['user']['empresa_ciudad'] = $data['empresa_ciudad'];
           
        }
    }
}else
{
    echo "Debe estar logueado para llevar a cabo esta acción.";
}

?>
