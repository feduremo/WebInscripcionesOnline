<?php
if (!Security::is_logged_in()) {
    header('location:adm.php?mod=index');
}

// Traemos el id
$id = _request('id');

// Ejecucion de la accion
$error = false;
$success = false;
$cont = 0;
$accion = _post('accion');
switch ($accion) {
    case 'guardar':
        $data = array();
        $data['nombre'] = _post('nombre');
        $data['nombre_locale'] = _post('nombre_locale');
        $data['descripcion_corta'] = _post('descripcion_corta');
        $data['descripcion_corta_locale'] = _post('descripcion_corta_locale');
        $data['descripcion_larga'] = _post('descripcion_larga');
        $data['descripcion_larga_locale'] = _post('descripcion_larga_locale');
        $data['codigo'] = _post('codigo');
        $data['precio'] = _post('precio');
        $data['precio_anterior'] = _post('precio_anterior');
        $data['precio_promocion'] = _post('precio_promocion');
        $data['es_novedad'] = _post('es_novedad');
        $data['es_oferta'] = _post('es_oferta');
        $data['es_home'] = _post('es_home');
        $data['stock_actual'] = _post('stock_actual');
        $data['stock_inicial'] = _post('stock_inicial');
        $data['moneda_id'] = _post('monedia_id');
        $data['orden'] = _post('orden');
        $data['activo'] = _post('activo');
        $data['modificado'] = time();

        if ($id == "") {
            if ($Receta->add($data) == false) {
                $error = true;
            } else {
                $id = Db::insert_id();
                $success = true;
            }
        } else {
            if ($Receta->update($data, $id) == false) {
                $error = true;
            } else {
                $success = true;
            }
        }
        // Guardamos los productos y las medidas
        if ($success) {
//            // Guardamos los productos relacionados
//            Db::begin_transaction();
//
//            // Borramos las relaciones
//            $Producto_Categoria->delete_by_product($id);
//            $Producto_Producto->delete_by_product($id);
//
//            // Agregamos las relaciones
//            $productos_productos = _post('productos_productos');
//            if($productos_productos!=''){
//                for($i=0; $i<count($productos_productos);$i++)
//                {
//                    $d = array('producto_id'=>$id, 'producto_relacionado_id'=>$productos_productos[$i]);
//                    $retorno = $Producto_Producto->add($d);
//                }
//            }

            //$Receta_Producto->delete_by_product($id);
            $Receta_Producto->delete_by_receta($id);


//            $recetas_productos = _post('recetas_productos');
//            //$parent_recepy = $Categoria->get($productos_categorias);
//            if($parent_recepy !== false)
//            {
//                $d = array('producto_id' => $id, 'categoria_id' => $productos_categorias);
//                $retorno = $Producto_Categoria->add($d);
//            }
            
            
//            $recetas_productos = _post('recetas_productos');
            $recetas_productos = _post('control_1');
            if ($recetas_productos != '') {
                for ($i = 0; $i < count($recetas_productos); $i++) {
                    $d = array('receta_id' => $id, 'producto_id' => $recetas_productos[$i]);
                    $retorno = $Receta_Producto->add($d);
                }
            }            

            Db::end_transaction();
        }

        break;
}

// Inicializamos los datos
$nombre = '';
$nombre_locale = '';
$descripcion_corta = '';
$descripcion_corta_locale = '';
$descripcion_larga = '';                              
$descripcion_larga_locale = '';
$codigo = '';
$precio = '';
$precio_anterior = '';
//$cant_filas = '';
$precio_promocion = '';
$es_novedad = '0';
$es_oferta = '0';
$stock_inicial = '';
$stock_actual = '';
$moneda_id = '';
$es_home = '0';
//$imagen = '';
$orden = '';
$activo = '';
$recetas_productos = '';
$producto = '';
$cant_productos = $Producto->Count('');
$prods = $Producto->get_list($cant_productos, '', '', "producto_id asc");

// Recuperamos el registro si es que estamos editando
$objeto = '';
if ($id != '') {
    $objeto = $Receta->get($id);
    if ($objeto == false) {
        header('location:adm.php?mod=recetas');
    } else {
        // Cargamos los datos en variables
        $nombre = $objeto['nombre'];
        $nombre_locale = $objeto['nombre_locale'];
        $activo = $objeto['activo'];

        $descripcion_corta = $objeto['descripcion_corta'];
        $descripcion_corta_locale = $objeto['descripcion_corta_locale'];
        $descripcion_larga = $objeto['descripcion_larga'];
        $descripcion_larga_locale = $objeto['descripcion_larga_locale'];
        $codigo = $objeto['codigo'];
        $precio = $objeto['precio'];
        $precio_anterior = $objeto['precio_anterior'];
        $precio_promocion = $objeto['precio_promocion'];

        $orden = $objeto['orden'];
        $es_novedad = $objeto['es_novedad'];
        $es_oferta = $objeto['es_oferta'];
        $es_home = $objeto['es_home'];
        $moneda_id = $objeto['moneda_id'];
        $stock_inicial = $objeto['stock_inicial'];
        $stock_actual = $objeto['stock_actual'];
        
        //$parent_category_id = "";
        $rst = $Receta_Producto->get_list('',1,"receta_id = $id");        
        $cant = $Receta_Producto->count("receta_id = $id");
        $list_producto = array();
//        for($i=1; $i<$cant;$i++){
//            $list_producto[$i] = "";
//        }
        while($parent = Db::fetch_array($rst))
        {
            $list_producto[] = $parent["producto_id"];
            
        }
    }
}
?>
<script language="javascript">

    function confirmar()
    {
        $("#message-error").fadeOut("slow");
        var retorno = true;

        $("#nombre").removeClass("error");
        $("#nombre_locale").removeClass("error");
        $("#codigo").removeClass("error");
        $("#precio").removeClass("error");
        $("#nombre").removeClass("error");
        $("#nombre").removeClass("error");


        if($("#nombre").val()=="")
        {
            $("#nombre").addClass("error");
            retorno = false;
        }
        if($("#nombre_locale").val()=="")
        {
            $("#nombre_locale").addClass("error");
            retorno = false;
        }
        if($("#codigo").val()=="")
        {
            $("#codigo").addClass("error");
            retorno = false;
        }
        if($("#precio").val()=="")
        {
            $("#precio").addClass("error");
            retorno = false;
        }
        if($("#descripcion_corta").val()=="")
        {
            $("#descripcion_corta").addClass("error");
            retorno = false;
        }
        if($("#descripcion_corta_locale").val()=="")
        {
            $("#descripcion_corta_locale").addClass("error");
            retorno = false;
        }
        if($("#descripcion_larga").val()=="")
        {
            $("#descripcion_larga").addClass("error");
            retorno = false;
        }
        if($("#descripcion_larga_locale").val()=="")
        {
            $("#descripcion_larga_locale").addClass("error");
            retorno = false;
        }
        if (!retorno) {
            $("#message-error").fadeIn("slow");
        }

        return retorno;
    }
    


    $(function(){
        $('#fecha').datepicker();
         
    })
    


</script>
<!-- Comiendo del contenido -->
<div class="box">

    <!-- box / title -->
    <div class="title">
        <h5><?php
if ($objeto == '' || $objeto == false) {
    echo "Nueva receta";
} else {
    echo "Editando...";
}
?></h5>
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
                    <span>No se pudo guardar la Receta</span>
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
                    <span>La Receta se ha guardado exitosamente.</span>
                </div>
                <div class="dismiss">
                    <a href="#message-success"></a>
                </div>
            </div>

        </div>
        <script language="javascript">
            setTimeout('window.location = "adm.php?mod=recetas"', 1500);
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
                <div class="field  field-first">
                    <div class="label">
                        <label for="nombre">*Nombre:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="nombre" value="<?php echo $nombre; ?>" name="nombre" class="medium" />

                    </div>
                </div>
<!--                <div class="field">
                    <div class="label">
                        <label for="nombre_locale">*Nombre Inglés:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="nombre_locale" value="<?php //echo $nombre_locale; ?>" name="nombre_locale" class="medium" />

                    </div>
                </div>-->
<!--                <div class="field">
                    <div class="label">
                        <label for="codigo">*Código:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="codigo" value="<?php //echo $codigo; ?>" name="codigo" class="medium" />

                    </div>
                </div>-->


<div class="field">
    <div class="label">
        <label for="no_c">Producto:</label>
    </div>
    <div class="select">
        <select id="control_1" name="control_1[]" multiple="multiple" size="5">
<!--            id="control_1" name="control_1[]" multiple="multiple" size="5"-->
            <option value=""></option>
                <?php
                if ($cant_productos > 0) {
                    while ($row = db::fetch_array($prods)) {
                ?>
                <option value="<?php echo $row["producto_id"]; ?>" <?php for($j=0 ; $j<count($list_producto) ; $j++) { if ($list_producto[$j] == $row["producto_id"]) { echo "selected=selected"; } } ?> ><?php echo $row["producto_id"]; echo "-"; echo $row["nombre"]; ?></option>
                <?php } } ?>
        </select>
    </div>
</div>



<!--                <div class="field">
                    <div class="label">
                        <label for="precio">*Precio:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="precio" value="<?php //echo $precio; ?>" name="precio" class="medium" />

                    </div>
                </div>-->
<!--                <div class="field">
                    <div class="label">
                        <label for="precio_anterior">Precio Anterior:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="precio_anterior" value="<?php //echo $precio_anterior; ?>" name="precio_anterior" class="medium" />

                    </div>
                </div>-->
                <div class="field">
                    <div class="label">
                        <label for="descripcion_corta">*Descripción Corta:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="descripcion_corta" name="descripcion_corta"  cols="50" rows="12" class="editor"><?php echo $descripcion_corta; ?></textarea>
                    </div>
                </div>
<!--                <div class="field">
                    <div class="label">
                        <label for="descripcion_corta_locale">*Descripción Corta Inglés:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="descripcion_corta_locale" name="descripcion_corta_locale"  cols="50" rows="12" class="editor"><?php //echo $descripcion_corta_locale; ?></textarea>
                    </div>
              </div>-->
                  <!--  <div class="field">
                        <div class="label">
                            <label for="cant_filas_tabla">Cantidad Filas:</label>
                        </div>
                        <div class="input">
                            <input type="text" id="cant_filas_tabla" value="<?php //echo $cant_filas; ?>" name="cant_filas_tabla" class="medium" />
                        </div>
                        <script type="text/javascript">
                        function dofunction2()
                        {
                            var cont = 0;
                            var cantidad = $("#cant_filas_tabla").val();
                            while(cantidad > cont){
                                cont++;
                                tr = document.createElement("tr");
                                td1 = document.createElement("td");
                                td2 = document.createElement("td");
                                td3 = document.createElement("td");
                                
                                td1.className="border";
                                td2.className="border";
                            
                                td1.innerHTML = "Columna 1";
                                td2.innerHTML = "Columna 2";
                                td3.innerHTML = "Columna 3";
                            
                                tr.appendChild(td1);
                                tr.appendChild(td2);
                                tr.appendChild(td3);
                            
                                var iframe = document.getElementById('descripcion_larga_ifr');
                                var frameDoc = iframe.contentDocument || iframe.contentWindow.document;
                                var el = frameDoc.getElementById("tablaComposicion");
                                el.appendChild(tr);
                            }
                            
                            tr2 = document.createElement("tr");
                            tdf = document.createElement("td");
                            
                            tdf.setAttribute("colspan","3");
                            tdf.className="border";
                            
                            tdf.innerHTML = "* % Valores diario con base a una dieta de 2000 Kcal u 8400 KJ.  Sus valores diarios pueden ser mayores o menores dependiendo de sus nececisdades enérgenticas";
                            
                            tr2.appendChild(tdf);
                            
                            var iframe2 = document.getElementById('descripcion_larga_ifr');
                            var frameDoc2 = iframe2.contentDocument || iframe2.contentWindow.document;
                            var el2 = frameDoc2.getElementById("tablaComposicion");
                            el2.appendChild(tr2);
                            
                        }
                        </script>
                        <div class="buttons">
                            <input style="float: right;" type="submit" name="submit" onclick="dofunction2();" value="Agregar" />
                        </div>
                        
                    </div> -->
                <div class="field">
                    <div class="label">
                        <label for="descripcion_larga">*Descripción Larga:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="descripcion_larga" name="descripcion_larga"  cols="50" rows="12" class="editor"><?php echo $descripcion_larga; ?></textarea>
                    </div>
                </div>
<!--                <div class="field">
                    <div class="label">
                        <label for="descripcion_larga_locale">*Descripción Larga Inglés:</label>
                    </div>
                    <div class="textarea textarea-editor">
                        <textarea id="descripcion_larga_locale" name="descripcion_larga_locale"  cols="50" rows="12" class="editor"><?php //echo $descripcion_larga_locale; ?></textarea>
                    </div>
                </div>-->
 <!--
                <div class="field">
                    <div class="label">
                        <label for="imagen">Imagen Thumb:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="imagen" name="imagen" size="40" /><div class="link-imagen"><a onclick="window.open('adm.php?mod=pick_file&target=imagen&path=files/productos/thumb/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Seleccionar Imagen</a></div>
                    </div>
                </div>
                 
                <div class="field">
                    <div class="label">
                        <label for="imagen">Imagen Media:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="imagen2" name="imagen2" size="40" /><div class="link-imagen"><a onclick="window.open('adm.php?mod=pick_file&target=imagen2&path=files/productos/media/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Seleccionar Imagen</a></div>
                    </div>
                </div>
                <div class="field">
                    <div class="label">
                        <label for="imagen">Imagen Big:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="imagen3" name="imagen3" size="40" /><div class="link-imagen"><a onclick="window.open('adm.php?mod=pick_file&target=imagen3&path=files/productos/big/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Seleccionar Imagen</a></div>
                    </div>
                </div> -->
<!--                <div class="field">
                    <div class="label">
                        <label for="stock_inicial">Stock Inicial:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="stock_inicial" value="<?php // echo $stock_inicial; ?>" name="stock_inicial" class="medium" />

                    </div>
                </div>-->

<!--                <div class="field">
                    <div class="label">
                        <label for="stock_actual">Stock Actual:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="stock_actual" value="<?php // echo $stock_actual; ?>" name="stock_actual" class="medium" />

                    </div>
                </div>-->



                <div class="field">
                    <div class="label">
                        <label for="activo">Activo:</label>
                    </div>
                    <div class="select">
                        <select id="activo" name="activo">
                            <option value="1" <?php if ($activo == '1') { echo "selected=selected"; } ?>>Si</option>
                            <option value="0" <?php if ($activo == '0') { echo "selected=selected"; } ?>>No</option>

                        </select>
                    </div>
                </div>
<!--                <div class="field">
                    <div class="label">
                        <label for="es_oferta">Oferta:</label>
                    </div>
                    <div class="select">
                        <select id="es_oferta" name="es_oferta">
                            <option value="1" <?php //if ($es_oferta == '1') { echo "selected=selected"; } ?>>Si</option>
                            <option value="0" <?php //if ($es_oferta == '0') { echo "selected=selected"; } ?>>No</option>

                        </select>
                    </div>
                </div>-->
<!--                <div class="field">
                    <div class="label">
                        <label for="precio_promocion">Precio Oferta:</label>
                    </div>
                    <div class="input">
                        <input type="text" id="precio_promocion" value="<?php //echo $precio_promocion; ?>" name="precio_promocion" class="medium" />

                    </div>
                </div>-->
<!--                <div class="field">
                    <div class="label">
                        <label for="es_novedad">Novedad:</label>
                    </div>
                    <div class="select">
                        <select id="es_novedad" name="es_novedad">
                            <option value="1" <?php //if ($es_novedad == '1') { echo "selected=selected"; } ?>>Si</option>
                            <option value="0" <?php //if ($es_novedad == '0') { echo "selected=selected"; } ?>>No</option>

                        </select>
                    </div>
                </div>-->
                <div class="field">
                    <div class="label">
                        <label for="es_home">Home:</label>
                    </div>
                    <div class="select">
                        <select id="es_home" name="es_home">
                            <option value="1" <?php if ($es_home == '1') { echo "selected=selected"; } ?>>Si</option>
                            <option value="0" <?php if ($es_home == '0') { echo "selected=selected"; } ?>>No</option>

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
