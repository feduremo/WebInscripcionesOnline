<?php
// Creamos las clases necesarias
$Usuarios = new Usuario();

// Obtenemos los datos
$usuario = trim(_post('usuario'));
$clave = trim(_post('clave'));
$cantidad = $Usuarios->count("usuario='$usuario' and clave='$clave' and activo=1");
if($cantidad==1)
{
    // Logueamos al usuario
    
    $rst_user = $Usuarios->get_list(1, 1, "usuario='$usuario' and clave='$clave' and activo=1");

    $user=Db::fetch_array($rst_user);
    
    if(isset($user['nombre']))
    {
       
        $_SESSION['usuario'] = true;
       
        $_SESSION['user']['usuario_id'] = $user['usuario_id'];
        $_SESSION['user']['usuario'] = $user['usuario'];
        $_SESSION['user']['nombre'] = $user['nombre'];
        $_SESSION['user']['apellido'] = $user['apellido'];
        $_SESSION['user']['mail'] = $user['mail'];
        $_SESSION['user']['direccion'] = $user['direccion'];
        $_SESSION['user']['telefono'] = $user['telefono'];
        $_SESSION['user']['ciudad'] = $user['ciudad'];
        $_SESSION['user']['empresa'] = $user['empresa'];
       
        $_SESSION['user']['empresa_direccion'] = $user['empresa_direccion'];
        $_SESSION['user']['empresa_telefono'] = $user['empresa_telefono'];
        $_SESSION['user']['empresa_ciudad'] = $user['empresa_ciudad'];
        $_SESSION['user']['veterinaria'] = $user['veterinaria'];
        echo 1;
    }
}else
{
    echo 0;
}
?>
