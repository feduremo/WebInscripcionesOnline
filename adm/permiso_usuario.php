<?php
if (!Security::is_logged_in()) {
    header('location:adm.php?mod=index');
}

// Traemos el id
// Ejecucion de la accion
$error = false;
$success = false;
$accion = _post('accion');
switch ($accion) {
    case 'guardar':

        $permisos = _post("permisos");
        if ($permisos == null) {
            $error = true;
        } else {
            $data = array();
            $data['administrador_id'] = _post('administrador_id');
            $cant_p = count($permisos);

            for ($i = 0; $i < $cant_p; $i++) {
                $data['permiso_id'] = $permisos[$i];
                if ($Administrador_Permiso->add($data) == false) {
                    $success = true;
                } else {
                    $success = true;
                }
            }
        }


        // Nuevo
        //$data['creado'] = date('Y-m-d');


        break;
}

// Inicializamos los datos
$administrador_id = 0;
$permiso_id = '';
$descripcion = '';

// Recuperamos el registro si es que estamos editando

$cant_usuarios = $Administrador->Count('');
$admins = $Administrador->get_list($cant_usuarios, '', '', "administrador_id asc");
$cant_permisos = $Permiso->Count('');
$perms = $Permiso->get_list($cant_permisos, '', '', "permiso_id asc");
?>
<script language="javascript">

    function confirmar()
    {

        var retorno = true;

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
        <h5>Asignar permiso</h5>
    </div>
<?php
if ($error) {
    ?>
        <div class="messages">
            <div id="message-error" class="message message-error">
                <div class="image">
                    <img src="resources/images/icons/error.png" alt="Error" height="32" />
                </div>
                <div class="text">
                    <h6>Error</h6>
                    <span>No se pudieron asignar los Permisos</span>
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
                    <span>El Permiso se ha guardado exitosamente.</span>
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
                        <label for="administrador_id">Usuario:</label>
                    </div>
                    <div class="select">
                        <select id="administrador_id" name="administrador_id">
<?php
if ($cant_usuarios > 0) {

    while ($row = db::fetch_array($admins)) {
        ?>
                                    <option value="<?php echo $row["administrador_id"]; ?>"><?php echo $row["nombre"] . " " . $row["apellido"]; ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>

                </div>
                <div class="field">

                    <div class="label label-checkbox">
                        <label for="permiso_id">Permisos:</label>
                    </div>
                    <div class="checkboxes">

                        <?php
                        if ($cant_permisos > 0) {

                            while ($row = db::fetch_array($perms)) {
                                ?>
                                <div class="checkbox">
                                    <input type="checkbox" id="permisos[]" name="permisos[]" value="<?php echo $row["permiso_id"]; ?>" />
                                    <label for="<?php echo "check" . $row["permiso_id"]; ?>"><?php echo $row["nombre"]; ?></label>
                                </div>
                            <?php }
                        } ?>

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