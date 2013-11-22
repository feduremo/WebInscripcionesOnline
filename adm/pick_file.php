<?php
if(!Security::is_logged_in())
{
    //Security::redirect_out();
}
/*
 * Ejemplo de llamada:
 * <a href="#" onclick="window.open('adm.php?mod=pick_file&target=imagen', 'Imagenes', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Pick Image</a>
 */

// Parametros iniciales
$target = _request('target');
if($target==''){ $target = "imagen";}
$path = _request('path');
if($path==''){ $path = 'files/images/';}
$page=_request('page');

// Inicializacion manejador de archivos
$file_manager = new File_Manager();


// Accion
$error = false;
$success = false;
$accion = _post('accion');
if($accion=='subir')
{
    // Subimos el archivo
    $archivo = $_FILES['archivo'];    
    //echo $archivo['tmp_name'];
    $res = $file_manager->upload_file($archivo, $path);
    if($res){ $success = true;}
    else{ $error = true;}
}

$filtro = _post('filtro');

// Traemos los archivos
$files = $file_manager->list_files($path,$filtro);
$cantidad_archivos = count($files);
$files = array_chunk($files, 12, true);
$pages = count($files);
if($page < 0 || $page > $pages || $page=='')
{
    $page = 0;
}
if(count($files) != 0)
{
    $files = $files[$page];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Abundancia - Selecci&oacute;n de archivo</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<link rel="stylesheet" type="text/css" href="css/adm.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<script language="javascript">
function subir_archivo()
{
    _set_property('value','accion','subir');
    _submit_form('form_archivos');
}
function filtrar()
{
    _set_property('value','accion','filtrar');
    _submit_form('form_archivos');
}
function go_to(page)
{
    _set_property('value','page',page);
    _submit_form('form_archivos');
}

    window.resizeTo('520', '660')
</script>
</head>
<body class="body2">
    <form method="post" name="form_archivos" id="form_archivos" enctype="multipart/form-data">
    <input type="hidden" name="accion" id="accion"/>
    <input type="hidden" name="page" id="page" value="<?php echo $page?>"/>
    <input type="hidden" name="target" id="target" value="<?php echo $target?>"/>
    <input type="hidden" name="path" id="path" value="<?php echo $path?>"/>
    <div id="container" style="padding:10px 10px 10px 10px;">
        <div style="width:100%;"><span class="titulo_negro">Administrador de archivos</span></div>
        <div style="width:100%; text-align:left; padding-top:20px;">
            <table width="100%" cellpadding="0" cellspacing="3" border="0" >
                <tr>
                    <td style="width:25%"><strong>Directorio actual</strong>:</td>
                    <td style="width:60%"><?php echo $path; ?></td>
                    <td style="width:15%"></td>
                </tr>
                <tr>
                    <td style="width:25%"><strong>Cdad. de archivos</strong>:</td>
                    <td style="width:60%"><?php echo $cantidad_archivos;?></td>
                    <td style="width:15%"></td>
                </tr>
                <tr>
                    <td style="width:25%"><strong>Nuevo archivo</strong>:</td>
                    <td style="width:60%"><input type="file" name="archivo" id="archivo" /></td>
                    <td style="width:15%"><input type="button" value="Subir" onclick="subir_archivo()" /></td>
                </tr>
                <tr>
                    <td style="width:25%"><strong>Filtro</strong>:</td>
                    <td style="width:60%"><input type="text" name="filtro" id="filtro" value="<?php echo $filtro;?>"/></td>
                    <td style="width:15%"><input type="button" value="Filtrar" onclick="filtrar()" /></td>
                </tr>
            </table>
            <br/>
            <?php
            if($error)
            {
            ?>
            <div class="div_error_ext" style="display:block;">
                <div class="div_error_int">No se ha podido subir el archivo.</div>
            </div>
            <?php
            }?>
            <?php
            if($success)
            {
            ?>
            <div class="div_success_ext" style="display:block;">
                <div class="div_success_int">El archivo se ha subido exitosamente.</div>
            </div>
            <?php
            }?>
            <br/>
            <table width="95%" cellpadding="0" cellspacing="0" border="0">
                <tr class="cabezal">
                    <td width="10%" class="primera">Selec.</td>
                    <td width="50%" class="primera">Archivo</td>
                    <td width="15%" class="primera">Tama&ntilde;o</td>
                    <td width="25%" align="center" class="primera">Preview</td>
                </tr>
                <?php
                if($files)
                {
                    foreach($files as $file)
                    {
                        if(is_file($path . $file))
                        {
                            $file_info = stat($path . $file);
                            if($file_info['size']/1024/1024 > 1){ $size = round($file_info['size']/1024/1024,1).' MB';}
                            else{ $size = round($file_info['size'] / 1024, 1).' KB';}
                            ?>
                            <tr class="comun" style="padding:5px 5px 5px 5px;">
                                <td class="tdlistado"><a href="#" onclick="window.opener.document.getElementById('<?php echo $target;?>').value = '<?php echo $file;?>'; window.close();"><img src="images/si.gif" /></a></td>
                                <td class="tdlistado"><?php echo $file;?></td>
                                <td class="tdlistado"><?php echo $size;?></td>
                                <td class="tdlistado2"><a href="<?php echo $path.$file;?>" target="_blank"><img width="30" src="<?php echo $path.$file;?>" border="0" /></a></td>
                            </tr>
                            <?php
                        }
                    }
                }else
                {?>
                <tr>
                    <td colspan="4">No hay archivos que mostrar.</td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="4" height="10">&nbsp;</td>
                </tr>
            </table>
            <div style="text-align:center; padding-top:20px;">
                <?php  for($i=0;$i<$pages;$i++)
                {
                    if($i!=$page){
                    ?>
                <a href="#" class="nuevo" onclick="go_to('<?php echo $i;?>')"><?php echo $i+1;?></a>
                <?php
                    }else
                    {
                    ?>
                    <?php echo $i+1;?>
                    <?php
                    }
                }?>
            </div>
        </div>
    </div>
    </form>
</body>
</html>


