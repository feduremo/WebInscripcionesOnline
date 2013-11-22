<?php
if (!Security::is_logged_in()) {
    header('location:adm.php?mod=index');
}

// Traemos el id
$id = _request('id');
echo $id . "lalala";
// Ejecucion de la accion
$error = false;
$success = false;
$accion = _post('accion');
switch ($accion) {
    case 'guardar':
        $data = array();
        $data['nombre'] = _post('nombre');
        $data['imagen'] = _post('imagen');
        $data['fecha_comienzo'] = Fecha::get_fecha_english(_post('fecha_comienzo'));
        $data['fecha_fin'] = Fecha::get_fecha_english(_post('fecha_fin'));
        $data['activo'] = _post('activo');
        $data['link'] = _post('link');

        // Validaciones

        if ($id == "") {
            // Nuevo
            if ($Banner->add($data) == false) {
                $error = true;
            } else {
                $id = Db::insert_id();
                $success = true;
            }
        } else {
            // Editar
            if ($Banner->update($data, $id) == false) {
                $error = true;
            } else {
                $success = true;
            }
        }
        break;
}

// Inicializamos los datos
$nombre = '';
$fecha_comienzo = '';
$fecha_fin = '';
$activo = '';
$link = '';
$imagen = '';

// Recuperamos el registro si es que estamos editando
$objeto = '';
if ($id != '') {
    $objeto = $Banner->get($id);
    if ($objeto == false) {
        header('location:adm.php?mod=banners');
    } else {
        // Cargamos los datos en variables
        $nombre = $objeto["nombre"];
        $fecha_comienzo = $objeto["fecha_comienzo"];
        $fecha_fin = $objeto["fecha_fin"];
        $activo = $objeto["activo"];
        $link = $objeto["link"];
        $imagen = $objeto["imagen"];
    }
}
?>
<script language="javascript">

    function guardar(form)
    {
        if (_get_property('value', 'nombre') == "")
        {
            _set_property('innerHTML', 'campo', 'Nombre');
            $('#mensaje_error').fadeIn('slow');
            return;
        }

        _set_property('value', 'accion', 'guardar');
        $('#mensaje_error').fadeOut('slow');
        _submit_form(form);
    }

    function confirmar()
    {
        $("#message-error").fadeOut("slow");
        var retorno = true;

        $("#nombre").removeClass("error");
        $("#fecha_comienzo").removeClass("error");
        $("#fecha_fin").removeClass("error");
        $("#imagen").removeClass("error");
        $("#link").removeClass("error");



        if ($("#nombre").val() == "")
        {
            $("#nombre").addClass("error");
            retorno = false;
        }
        if ($("#link").val() == "")
        {
            $("#link").addClass("error");
            retorno = false;
        }
        if ($("#fecha_comienzo").val() == "")
        {
            $("#fecha_comienzo").addClass("error");
            retorno = false;
        }
        if ($("#imagen").val() == "")
        {
            $("#imagen").addClass("error");
            retorno = false;
        }

        if ($("#fecha_fin").val() == "")
        {
            $("#fecha_fin").addClass("error");
            retorno = false;
        }
        if (!retorno) {
            $("#message-error").fadeIn("slow");
        }

        return retorno;

    }

</script>

<div class="box">

    <!-- box / title -->
    <div class="title">
        <h5><?php if ($objeto == '' || $objeto == false) {
    echo "Nuevo banner";
} else {
    echo "Editando...";
} ?></h5>
    </div>
    <?php
    if ($error) {
        ?>
        <div class="messages">
            <div id="message-error" class="message message-error" style="display:none">
                <div class="image">
                    <img src="resources/images/icons/error.png" alt="Error" height="32" />
                </div>
                <div class="text">
                    <h6>Error</h6>
                    <span>No se pudo guardar el Banner</span>
                </div>
                <div class="dismiss">
                    <a href="#message-error"></a>
                </div>
            </div>
        </div><br>
        <?php
    }
    if ($success) {
        ?>
        <div class="messages">
            <div id="message-success" class="message message-success">
                <div class="image">
                    <img src="resources/images/icons/success.png" alt="Success" height="32" />
                </div>
                <div class="text">
                    <h6>Aviso</h6>
                    <span>La Página se ha guardado exitosamente.</span>
                </div>
                <div class="dismiss">
                    <a href="#message-success"></a>
                </div>
            </div>
        </div>
        <script language="javascript">
            setTimeout('window.location = "adm.php?mod=banners"', 1500);
        </script>
        <?php
    }
    ?>

    <!-- end box / title -->


    <form id="form" method="post" onsubmit="return confirmar()">
        <input type="hidden" name="accion" id="accion" value="guardar" />
        <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
        <div class="form">
            <div class="messages">
                <div id="message-error" class="message message-error" style="display:none">
                    <div class="image">
                        <img src="resources/images/icons/error.png" alt="Error" height="32" />
                    </div>
                    <div class="text">
                        <h6>Error</h6>
                        <span>Ingrese todos los datos marcados con (*)</span>
                    </div>
                    <div class="dismiss">
                        <a href="#message-error"></a>
                    </div>
                </div>
            </div>
            <div class="fields">
                <div class="field  field-first">
                    <div class="label">
                        <label for="nombre">*Nombre:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="nombre" value="<?php echo $nombre; ?>" name="nombre" class="small" />

                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="fecha_comienzo">*Fecha de Inicio:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="fecha_comienzo" name="fecha_comienzo" class="date" value="<?php echo $fecha_comienzo; ?>" />
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="fecha_fin">*Fecha de Fin:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="fecha_fin" name="fecha_fin" class="date" value="<?php echo $fecha_fin; ?>" />
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="imagen">*Imagen:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="imagen" name="imagen" size="40" /><div class="link-imagen"><a  onclick="window.open('adm.php?mod=pick_file&target=imagen&path=files/banners/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');" >Seleccionar Imagen</a></div>
                    </div>
                </div>

                <div class="field">
                    <div class="label">
                        <label for="link">*Link:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="link" value="<?php echo $link; ?>" name="link" class="small" />

                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="activo">Activo:</label>
                    </div>
                    <div class="select">
                        <select id="activo" name="activo">
                            <option value="1" <?php if ($activo == '1') {
        echo "selected=selected";
    } ?>>Si</option>
                            <option value="0" <?php if ($activo == '0') {
        echo "selected=selected";
    } ?>>No</option>

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
