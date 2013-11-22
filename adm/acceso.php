<?php
if(!Security::is_logged_in())
{
    header('location:adm.php?mod=index');
}
// Creamos las clases necesarias
$Acceso = new Acceso();

// Ejecucion de la accion
$error = false;
$success = false;

$id = 1;

$accion = _post('accion');
switch($accion)
{
    case 'guardar':
        $usuario = _post('usuario');
        $clave = _post('clave');

        $data = array();
        $data['usuario'] = $usuario;
        $data['clave'] = $clave;
        $data['modificado'] = time();

        if($Acceso->update($data, $id)==false)
        {
          $error=true;
        }
        else{ $success = true;}

        break;
}

// Traemos los resultados
$resultado = $Acceso->get($id);

?>
<h2><a href="adm.php?mod=acceso">Ajustes</a> &raquo; <a href="adm.php?mod=acceso" class="active">Acceso</a></h2>
<div id="main">
        <form method="post" id="form_listado" name="form_listado" class="jNice">
            <input type="hidden" name="accion" id="accion" value="guardar" />
            <h3>Datos de acceso</h3>
            <?php
            if($error)
            {?>
            <div class="div_error_ext" style="display:block;" id="accion_error">
                <div class="div_error_int">La acci&oacute;n no se ejecut&oacute; correctamente.</div>
            </div>
            <script language="javascript">
                setTimeout("$('#accion_error').fadeOut('slow')", 1500)
            </script>
            <?php
            }
            if($success)
            {?>
            <div class="div_success_ext" style="display:block;" id="accion_correcto">
                <div class="div_success_int">La acci&oacute;n se ejecut&oacute; exitosamente.</div>
            </div>
            <script language="javascript">
                setTimeout("$('#accion_correcto').fadeOut('slow')", 1500)
            </script>
            <?php
            }
            ?>
        <table cellpadding="0" cellspacing="0" id="table_resultados">
            <tr>
                <td width="30%">Nombre</td>
                <td width="70%"><input type="text" name="usuario" id="usuario" value="<?php echo $resultado['usuario'];?>" /> </td>
            </tr>
            <tr class="odd">
                <td width="30%">Clave</td>
                <td width="70%"><input type="text" name="clave" id="clave" value="<?php echo $resultado['clave'];?>" /> </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Guardar"  /></td>
            </tr>
        </table>
    </form>
    <br><br>
</div>
<!-- // #main -->