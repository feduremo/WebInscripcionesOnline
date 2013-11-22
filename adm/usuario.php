<?php
if (!Security::is_logged_in()) {
    header('location:adm.php?mod=index');
}

// Traemos el id
$id = _request('id');

// Ejecucion de la accion
$error = false;
$success = false;
$accion = _post('accion');
switch ($accion) {
    case 'guardar':

        $data = array();
        $data['nombre'] = _post('nombre');
        $data['apellido'] = _post('apellido');
        $data['mail'] = _post('mail');
        $data['usuario'] = _post('usuario');
        if (trim(_post('clave')) != "") {
            $data['clave'] = _post('clave');
        }
        $data['activo'] = _post('activo');
        $data['modificado'] = time();

        if ($id == "") {
            // Nuevo
            //$data['creado'] = date('Y-m-d');
            if ($Administrador->add($data) == false) {
                $error = true;
            } else {
                $id = Db::insert_id();
                $success = true;
            }
        } else {
            // Editar
            if ($Administrador->update($data, $id) == false) {
                $error = true;
            } else {
                $success = true;
            }
        }
        break;
}

// Inicializamos los datos
$nombre = '';
$apellido = '';
$mail = '';
$usuario = '';
$clave = '';
$activo = '0';

// Recuperamos el registro si es que estamos editando
$objeto = '';
if ($id != '') {
    $objeto = $Administrador->get($id);
    if ($objeto == false) {
        header('location:adm.php?mod=usuarios');
    } else {
        // Cargamos los datos en variables
        $nombre = $objeto['nombre'];
        $apellido = $objeto['apellido'];
        $mail = $objeto['mail'];
        $usuario = $objeto['usuario'];
        $activo = $objeto['activo'];
    }
}
?>
<script language="javascript">

    function confirmar()
    {

        $("#message-error").fadeOut("slow");
        var retorno = true;

        $("#nombre").removeClass("error");
        $("#apellido").removeClass("error");
        $("#usuario").removeClass("error");
        $("#clave").removeClass("error");
        $("#mail").removeClass("error");


        if ($("#nombre").val() == "")
        {
            $("#nombre").addClass("error");
            retorno = false;
        }
        if ($("#apellido").val() == "")
        {
            $("#apellido").addClass("error");
            retorno = false;
        }
        if ($("#usuario").val() == "")
        {
            $("#usuario").addClass("error");
            retorno = false;
        }

        if ($("#clave").val() == "")
        {
            $("#clave").addClass("error");
            retorno = false;
        }
        if ($("#mail").val() == "")
        {
            $("#mail").addClass("error");
            retorno = false;
        }
        if (!retorno) {
            $("#message-error").fadeIn("slow");
        }
        $("#accion").val("guardar");
        return retorno;

    }

    $(function() {
        $('#fecha').datepicker();
    })
</script>
<div class="box">

    <!-- box / title -->
    <div class="title">
        <h5><?php if ($objeto == '' || $objeto == false) {
    echo "Nuevo Usuario";
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
                    <span>No se pudo guardar el Usuario</span>
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
                    <span>El Usuario se ha guardado exitosamente.</span>
                </div>
                <div class="dismiss">
                    <a href="#message-success"></a>
                </div>
            </div>
        </div>
        <script language="javascript">
            setTimeout('window.location = "adm.php?mod=usuarios"', 1500);
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
                <span>Ingrese todos los datos marcados con (*)</span>
            </div>

        </div>
    </div>

    <form id="form" method="post" onsubmit="return confirmar()">
        <input type="hidden" name="accion" id="accion" value="guardar" />
        <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
        <div class="form">
            <div class="fields">
                <div class="field  field-first">
                    <div class="label">
                        <label for="nombre">*Nombre:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="nombre" value="<?php echo $nombre; ?>" name="nombre" class="medium" />

                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="apellido">*Apellido:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="apellido" value="<?php echo $apellido; ?>" name="apellido" class="medium" />

                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="usuario">*Nombre de Usuario:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="usuario" value="<?php echo $usuario; ?>" name="usuario" class="medium" />

                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="clave">*Password:</label>
                    </div>
                    <div class="input">
                        <input type="password" id="clave" value="<?php echo $clave; ?>" name="clave" class="medium" />

                    </div>
                </div>

                <div class="field ">
                    <div class="label">
                        <label for="mail">*E-mail:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="mail" value="<?php echo $mail; ?>" name="mail" class="medium" />

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