<?php
if (!Security::is_logged_in()) {
    header('location:adm.php?mod=index');
}

// Traemos el id
$id = 1;

// Ejecucion de la accion
$error = false;
$success = false;
$cont = 0;
$accion = _post('accion');
switch ($accion) {
    case 'guardar':
        $data = array();
        $data['mision_home'] = _post('mision_home');
        $data['mision'] = _post('mision'); 
        $data['nuestra_empresa_home'] = _post('nuestra_empresa_home');               
        $data['nuestra_empresa'] = _post('nuestra_empresa');
        $data['activo'] = _post('activo');
        $data['mision_home_locale'] = _post('mision_home_locale');
        $data['mision_locale'] = _post('mision_locale');
        $data['nuestra_empresa_home_locale'] = _post('nuestra_empresa_home_locale');
        $data['nuestra_empresa_locale'] = _post('nuestra_empresa_locale');

        if ($id == "") {            
            if ($Contenido->add($data) == false) {
                $error = true;
            } else {
                $id = Db::insert_id();
                $success = true;
            }
        } else {
            $Contenido->update($data, $id);
            $success = true;
//            if ($Contenido->update($data, $id) == false) {
//                $error = true;
//            } else {
//                $success = true;
//            }
        }

        if ($success) {

            $contenido_imagen = _post('imagen');
            if ($contenido_imagen != '') {
                $a = array('contenido_id' => $id, 'imagen' => $contenido_imagen);
                //$ret = $Contenido_Imagen->Add($a);
                $ret = $Contenido_Imagen->update($a,1);
            }

            $contenido_imagen2 = _post('imagen2');
            if ($contenido_imagen2 != '') {
                $a2 = array('contenido_id' => $id, 'imagen' => $contenido_imagen2);
                //$ret = $Contenido_Imagen->Add($a2);
                $ret = $Contenido_Imagen->update($a2,2);
            }

            $contenido_imagen3 = _post('imagen3');
            if ($contenido_imagen3 != '') {
                $a3 = array('contenido_id' => $id, 'imagen' => $contenido_imagen3);
                //$ret = $Contenido_Imagen->Add($a3);
                $ret = $Contenido_Imagen->update($a3,3);
            }
            
            $contenido_imagen4 = _post('imagen4');
            if ($contenido_imagen4 != '') {
                $a4 = array('contenido_id' => $id, 'imagen' => $contenido_imagen4);
                //$ret = $Contenido_Imagen->Add($a3);
                $ret = $Contenido_Imagen->update($a4,4);
            }
            
            $contenido_imagen5 = _post('imagen5');
            if ($contenido_imagen4 != '') {
                $a5 = array('contenido_id' => $id, 'imagen' => $contenido_imagen5);
                //$ret = $Contenido_Imagen->Add($a3);
                $ret = $Contenido_Imagen->update($a5,5);
            }

            Db::end_transaction();
        }

        break;
}

// Inicializamos los datos
$mision_home = '';
$nuestra_empresa_home = '';
$mision = '';
$nuestra_empresa = '';
$activo = '';
$mision_home_locale = '';
$mision_locale = '';
$nuestra_empresa_home_locale = '';
$nuestra_empresa_locale = '';

// Recuperamos el registro si es que estamos editando
$objeto = '';
if ($id != '') {
    $objeto = $Contenido->get($id);
    if ($objeto == false) {
        header('location:adm.php?mod=contenido');
    } else {
        // Cargamos los datos en variables
        $mision_home = $objeto['mision_home'];
        $nuestra_empresa_home = $objeto['nuestra_empresa_home'];
        $mision = $objeto['mision'];
        $nuestra_empresa = $objeto['nuestra_empresa'];
        $activo = $objeto['activo'];
        $mision_home_locale = $objeto['mision_home_locale'];
        $mision_locale = $objeto['mision_locale'];
        $nuestra_empresa_home_locale = $objeto['nuestra_empresa_home_locale'];
        $nuestra_empresa_locale = $objeto['nuestra_empresa_locale'];
//        $lista_img = $Contenido_Imagen->get_list('','',"contenido_id=$id",'');
//        while($row_img = Db::fetch_array($lista_img)){
//            $id_img = $row_img['contenido_imagen_id'];
//            $Contenido_Imagen->update($id_img);        
//        }
    }
}
?>
<script language="javascript">

    function confirmar()
    {
        $("#message-error").fadeOut("slow");
        var retorno = true;

        $("#mision_home").removeClass("error");
        $("#nuestra_empresa_home").removeClass("error");
        $("#mision").removeClass("error");
        $("#nuestra_empresa").removeClass("error");
        $("#mision_home_locale").removeClass("error");
        $("#nuestra_empresa_home_locale").removeClass("error");
        $("#mision_locale").removeClass("error");
        $("#nuestra_empresa_locale").removeClass("error");


        if($("#mision_home").val()=="")
        {
            $("#mision_home").addClass("error");
            retorno = false;
        }
        if($("#nuestra_empresa_home").val()=="")
        {
            $("#nuestra_empresa_home").addClass("error");
            retorno = false;
        }
        if($("#mision").val()=="")
        {
            $("#mision").addClass("error");
            retorno = false;
        }
        if($("#nuestra_empresa").val()=="")
        {
            $("#nuestra_empresa").addClass("error");
            retorno = false;
        }
        if($("#nuestra_empresa_locale").val()=="")
        {
            $("#nuestra_empresa_locale").addClass("error");
            retorno = false;
        }
        if($("#nuestra_empresa_home_locale").val()=="")
        {
            $("#nuestra_empresa_home_locale").addClass("error");
            retorno = false;
        }
        if($("#mision_locale").val()=="")
        {
            $("#mision_locale").addClass("error");
            retorno = false;
        }
        if($("#mision_home_locale").val()=="")
        {
            $("#mision_home_locale").addClass("error");
            retorno = false;
        }
        if (!retorno) {
            $("#message-error").fadeIn("slow");
        }

        return retorno;
    }



</script>
<!-- Comiendo del contenido -->
<div class="box">

    <!-- box / title -->
    <div class="title">
        <h5><?php if ($objeto == '' || $objeto == false) { echo "Nuevo producto"; } else { echo "Editando..."; } ?></h5>
    </div>
    <?php if ($error) { ?>
        <div class="messages">
            <div id="message-error" class="message message-error">
                <div class="image">
                    <img src="resources/images/icons/error.png" alt="Error" height="32" />
                </div>
                <div class="text">
                    <h6>Error</h6>
                    <span>No se pudo guardar el Contenido </span>
                </div>
                <div class="dismiss">
                    <a href="#message-error"></a>
                </div>
            </div>
        </div><br />
        <?php } if ($success) { ?>
        <div class="messages">
            <div id="message-success" class="message message-success">
                <div class="image">
                    <img src="resources/images/icons/success.png" alt="Success" height="32" />
                </div>
                <div class="text">
                    <h6>Aviso</h6>
                    <span>El Contenido se ha guardado exitosamente.</span>
                </div>
                <div class="dismiss">
                    <a href="#message-success"></a>
                </div>
            </div>

        </div>
        <script language="javascript">
            setTimeout('window.location = "adm.php?mod=principal"', 1500);
        </script>
        <?php
    }
    ?>

    <!-- end box / title -->
    
    <div class="messages">
        <div id="message-error" class="message message-error" style="display:none">
            <div class="image">
                <img src="resources/images/icons/error.png" alt="Error" height="32" />
            </div>
            <div class="text">
                <h6>Error</h6>
                <span>Ingrese todos los datos</span>
            </div>
            <div class="dismiss">
                <a href="#message-error"></a>
            </div>
        </div>
    </div>
    
    <form id="form" method="post" onsubmit="return confirmar()">
        <input type="hidden" name="accion" id="accion" value="guardar" />
        <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
        <div class="form">
            <div class="fields">         
                <div class="field field-first">
                    <div class="label">
                        <label for="mision_home">Mision Home:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="mision_home" name="mision_home"  cols="50" rows="12" class="editor"><?php echo $mision_home; ?></textarea>
                    </div>
                </div>
                <div class="field field-first">
                    <div class="label">
                        <label for="mision_home_locale">Mision Home Ingles:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="mision_home_locale" name="mision_home_locale"  cols="50" rows="12" class="editor"><?php echo $mision_home_locale; ?></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="nuestra_empresa_home">Nuestra Empresa Home:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="nuestra_empresa_home" name="nuestra_empresa_home"  cols="50" rows="12" class="editor"><?php echo $nuestra_empresa_home; ?></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="nuestra_empresa_home_locale">Nuestra Empresa Home Ingles:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="nuestra_empresa_home_locale" name="nuestra_empresa_home_locale"  cols="50" rows="12" class="editor"><?php echo $nuestra_empresa_home_locale; ?></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="mision">Mision:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="mision" name="mision"  cols="50" rows="12" class="editor"><?php echo $mision; ?></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="mision_locale">Mision Ingles:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="mision_locale" name="mision_locale"  cols="50" rows="12" class="editor"><?php echo $mision_locale; ?></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="nuestra_empresa">Nuestra Empresa:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="nuestra_empresa" name="nuestra_empresa"  cols="50" rows="12" class="editor"><?php echo $nuestra_empresa; ?></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="nuestra_empresa_locale">Nuestra Empresa Ingles:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="nuestra_empresa_locale" name="nuestra_empresa_locale"  cols="50" rows="12" class="editor"><?php echo $nuestra_empresa_locale; ?></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="imagen">Imagen Banner 1:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="imagen" name="imagen" size="40" /><div class="link-imagen"><a onclick="window.open('adm.php?mod=pick_file&target=imagen&path=files/banners/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Seleccionar Imagen</a></div>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="imagen">Imagen Banner 2:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="imagen2" name="imagen2" size="40" /><div class="link-imagen"><a onclick="window.open('adm.php?mod=pick_file&target=imagen2&path=files/banners/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Seleccionar Imagen</a></div>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="imagen">Imagen Banner 3:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="imagen3" name="imagen3" size="40" /><div class="link-imagen"><a onclick="window.open('adm.php?mod=pick_file&target=imagen3&path=files/banners/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Seleccionar Imagen</a></div>
                    </div>
                </div>    
                <div class="field">
                    <div class="label">
                        <label for="imagen">Imagen Banner 4:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="imagen4" name="imagen4" size="40" /><div class="link-imagen"><a onclick="window.open('adm.php?mod=pick_file&target=imagen4&path=files/banners/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Seleccionar Imagen</a></div>
                    </div>
                </div>  
                <div class="field">
                    <div class="label">
                        <label for="imagen">Imagen Banner 5:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="imagen5" name="imagen5" size="40" /><div class="link-imagen"><a onclick="window.open('adm.php?mod=pick_file&target=imagen5&path=files/banners/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Seleccionar Imagen</a></div>
                    </div>
                </div>  
                <div class="field">
                    <div class="label">
                        <label for="activo">Activo:</label>
                    </div>
                    <div class="select">
                        <select id="activo" name="activo">
                            <option value="1" <?php if ($activo == '1') { echo "selected=selected"; } ?> >Si</option>
                            <option value="0" <?php if ($activo == '0') { echo "selected=selected"; } ?> >No</option>
                        </select>
                    </div>
                </div>
                <div class="buttons">
                    <div class="highlight">
                        <input type="submit" name="submit" value="Aceptar" />
                    </div>
                    <input type="reset" name="reset" value="Resetear" />
                </div>
            </div>
        </div>


    </form>
</div>
