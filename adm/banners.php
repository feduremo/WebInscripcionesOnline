<?php
if (!Security::is_logged_in()) {
    header('location:adm.php?mod=index');
}
// Ejecucion de la accion
$error = false;
$success = false;
$cont = 0;
$accion = _post('accion');
switch ($accion) {
    case 'eliminar':
        $eliminados = _post('eliminados');
        if ($eliminados != '') {
            for ($i = 0; $i < count($eliminados); $i++) {
                $cont++;
                // Eliminamos la categoria
                $retorno = $Banner->delete($eliminados[$i]);
                if ($retorno == false) {
                    $error = $error && true;
                    $success = $success && false;
                } else {
                    if ($cont == 1) {
                        $success = true;
                    } else {
                        $success = $success && true;
                    }
                }
            }
        }
        break;
    case 'activar':
        $activados = _post('eliminados');
        if ($activados != '') {
            for ($i = 0; $i < count($activados); $i++) {
                $cont++;
                // Activamos la categoria
                $data['activo'] = 1;
                $retorno = $Banner->update($data, $activados[$i]);
                if ($retorno == false) {
                    $error = $error && true;
                    $success = $success && false;
                } else {
                    if ($cont == 1) {
                        $success = true;
                    } else {
                        $success = $success && true;
                    }
                }
            }
        }
        break;
    case 'desactivar':
        $desactivados = _post('eliminados');
        if ($desactivados != '') {
            for ($i = 0; $i < count($desactivados); $i++) {
                $cont++;
                // Activamos la categoria
                $data['activo'] = 0;
                $retorno = $Banner->update($data, $desactivados[$i]);
                if ($retorno == false) {
                    $error = $error && true;
                    $success = $success && false;
                } else {
                    if ($cont == 1) {
                        $success = true;
                    } else {
                        $success = $success && true;
                    }
                }
            }
        }
        break;
    case 'ordenar':
        echo "ordenar";
        $desactivados = _post('eliminados');
        if ($desactivados != '') {
            for ($i = 0; $i < count($desactivados); $i++) {
                $cont++;
                // Guardamos el orden de la categoria
                $orden = _post('orden_' . $desactivados[$i]);
                $data['orden'] = $orden;
                $retorno = $Banner->update($data, $desactivados[$i]);
                if ($retorno == false) {
                    $error = $error && true;
                    $success = $success && false;
                } else {
                    if ($cont == 1) {
                        $success = true;
                    } else {
                        $success = $success && true;
                    }
                }
            }
        }
        break;
}

// Paginado y Cantidad de

$activo_noactivo = _post('activo_noactivo');
if ($activo_noactivo != '') {
    $where = 'activo=' . $activo_noactivo;
} else {
    $where = '';
}

$count = $Banner->count($where);


$cantidad = _post('cantidad');
if ($cantidad == "") {
    $cantidad = 20;
}
$cant_paginas = ceil($count / $cantidad);
if ($cant_paginas == 0) {
    $cant_paginas = 1;
}

$pagina = _request('pagina');
if ($pagina == '' || $pagina == '0' || $pagina < 0) {
    $pagina = 1;
}


if ($pagina > $cant_paginas) {
    $pagina = $cant_paginas;
}
$order = _post('order');
if ($order == "") {
    $order = 'nombre';
}
$asc_desc = _post('asc_desc');
if ($asc_desc == "") {
    $asc_desc = '';
}

$ordenamiento = $order . " " . $asc_desc;

// Traemos los resultados
$resultados = $Banner->get_list($cantidad, $pagina, $where, $ordenamiento);

?>
<script language="javascript">

    function paginado(pag)
    {
        $("#pagina").val(pag);
        $('#form_listado').submit();
    }

    function selectAction()
    {
        var s = document.getElementById('selectAccion');
         if (s.selectedIndex == 0) {
            activar('form_listado');
        }else{
            desactivar('form_listado');
        }

    }

    function eliminar(form)
    {
        $("#accion").val("eliminar");
        $('#form_listado').submit();
    }

    function desactivar(form)
    {
          $("#accion").val("desactivar");
          $('#form_listado').submit();
    }

    function guardar_orden(form)
    {
        seleccionar_todos('table_resultados');
        _set_property('value','accion','ordenar');
        _submit_form('form_listado');
    }

    function activar(form)
    {
          $("#accion").val("activar");
        $('#form_listado').submit();
    }

    $(function() {
        $('#confirm-actuator').click(function() {
            Boxy.confirm("Los elementos seleccionadas se eliminarán por completo. <br/> ¿Desea continuar con la acción?", function() { eliminar('form_listado'); }, {title: 'Confirmar: Eliminar los elementos seleccionados.'});
            return false;
        });
    });

</script>

<div class="box">
    <!-- box / title -->
    <div class="title">
        <h5>Banners</h5>
        <div class="search">
            <form action="#" method="post">
                <div class="input">
                    <input type="text" id="search" name="search" />
                </div>
                <div class="button">
                    <input type="submit" name="submit" value="Search" />
                </div>
            </form>
        </div>
    </div>
    <!-- end box / title -->
    <div class="table">
        <form id="form_listado" name="form_listado" method="post" >
              <ul>
               <li>
                  <div class="link-nuevo"><a href="adm.php?mod=banner">Nueva</a></div>
               </li>
              </ul>
               <br />

             <input type="hidden" name="pagina" id="pagina" value="<?php echo $pagina ?>"/>
            <input type="hidden" name="accion" id="accion" value="" />
            <table>
                <thead>
                    <tr>

                        <th >Nombre</th>
                        <th>Fecha Comienzo</th>
                        <th>Fecha Fin</th>
                        <th>Activo</th>
                        <th>Modificar</th>
                        <th class="selected last"><input type="checkbox" class="checkall" /></th>
                    </tr>
                </thead>

                <tbody>
                            <?php
                            $cuenta = 0;
                            $class_tr = "";
                            if ($count > 0) {
                                while ($row = db::fetch_array($resultados)) {
                                    $cuenta++;
                                    if ($cuenta % 2 == 0) {
                                        $class_tr = "odd";
                                    } else {
                                        $class_tr = "";
                                    }
                            ?>
                                    <tr class="<?php echo $class_tr; ?>">
                                        <td><?php echo $row['nombre']; ?></td>
                                        <td><?php echo $row['fecha_comienzo']; ?></td>
                                        <td><?php echo $row['fecha_fin']; ?></td>
                                        <td ><?php if ($row['activo'] == '1') { ?><img src="images/si.gif" alt="Si" /><?php } else { ?><img src="images/no.gif" alt="No" /><?php } ?></td>
                                        <td><a href="adm.php?mod=banner&id=<?php echo $row['id']; ?>"><img src="images/modificar.gif" alt="Modificar"></a></td>
                                        <td><input type="checkbox" name="eliminados[]" id="eliminados[]" value="<?php echo $row['id']; ?>"/> </td>

                                    </tr>
<?php
                                }
                            } else {
?>
                                <tr>
                                    <td colspan="5">No se encontraron registros. Puede crear uno nuevo <a href="adm.php?mod=banner" class="blue">aqu&iacute;</a>.</td>
                                </tr>
<?php } ?>

                </tbody>
            </table>
            <!-- pagination -->
    <div class="pagination pagination-left">
                <div class="results">
                    <span>Mostrando resultados <?php if ($pagina==1) {
    echo "1";
}else{
    echo ($pagina-1)*10;
} echo "-";if ($pagina==1) {
    if ($count < ($pagina)*10) {
        echo $count;
    }else{
        echo ($pagina)*10;
    }
}else
    {
        if ($count < ($pagina+1)*10) {
        echo $count;
    }else{
        echo ($pagina+1)*10;
    }
    }
?> de <?php echo $count ?></span>
                </div>
                <ul class="pager">
                    <?php if ($count<10 || $pagina==1) {?>
                    <li class="disabled">&laquo; previo</li>
                    <?php } else{?>
                     <li onclick="paginado(<?php echo $pagina-1; ?>)"><a href="#">&laquo; previo </a></li>
                    <?php }
                     for ($i = 1; $i <= $cant_paginas; $i++) { ?>
                        <li value="<?php echo $i; ?>" class="<?php if ($pagina == $i) { echo "current"; } ?>" onclick="paginado(<?php echo $i; ?>)"><?php if ($pagina != $i) {   ?> <a href="#"><?php echo $i; ?></a><?php }else{ echo $i; } ?></li>
                    <?php } ?>
                    <?php if ($pagina == $cant_paginas) {?>
                        <li class="disabled">sig &raquo;</li>
                        <?php }else{ ?>
                    <li onclick="paginado(<?php echo $pagina+1; ?>)"><a href="#">sig &raquo;</a></li>
                    <?php } ?>
                </ul>
            </div>
            <!-- end pagination -->
            <!-- table action -->
<div class="action">
                <select name="selectAccion" id="selectAccion">
                    <option value="activar" class="unlocked">Activar</option>
                    <option value="activar" class="locked">Desactivar</option>
                </select>
                <div class="button">
                    <input type="button" class="ui-state-default" name="button" value="Aplicar a la selección" onclick="selectAction()" />
                </div>
            </div>
            <!-- end table action -->
        </form>
    </div>
</div>
