<?php

$Tracking = Tracking::load();
$Tracking->add('index.php?mod=busqueda2');
$Tracking->save();

$busqueda = trim(_post('busqueda2'));
$where = ' activo=1 ';
if ($busqueda != '') {
    $where .= "AND (nombre like '%$busqueda%' OR descripcion_corta like '%$busqueda%' OR descripcion_larga like '%$busqueda%')";
}

$cantidadBusqueda = $Receta->count($where);

$cantidad = 5;

$cant_pags = ceil($cantidadBusqueda / $cantidad);
if ($cant_pags == 0) {
    $cant_pags = 1;
}

$pagina = _post('pagina');
if ($pagina == '' || $pagina == '0' || $pagina < 0) {
    $pagina = 1;
}
if ($pagina > $cant_pags) {
    $pagina = $cant_pags;
}
$recetasBusqueda = $Receta->get_list($cantidad, $pagina, $where, '');
?>

<script language="javascript">
    
    function paginado(pag)
    {
        $("#pagina").val(pag);
        $('#form_busqueda2').submit();
    }
    
</script>

<!--Contenido main-->
<div class="main clearfix">
    <div class="container clearfix">
        <form id="form_busqueda2" name="form_busqueda2" method="post" >
            <input type="hidden" name="busqueda2" id="busqueda2" value="<?php echo $busqueda; ?>" />
            <div class="titulo-pruducto clearfix"> 
                <div class="left">&nbsp;</div>
                <div class="medio">
                    <ul>
                        <li class="izquierda">Resultado de b&uacute;squeda</li>
                        <li class="derecha"><img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                    </ul>	
                </div>	
                <div class="right">&nbsp;</div>	
            </div> 
            <div class="content clearfix">
                <input type="hidden" name="pagina" id="pagina" value="" />
                <?php if ($cantidadBusqueda == 0) { ?>
                    <div class="resultados texto">
                        <h2><?php echo $busqueda; ?></h2>
                        <p><?php echo "No se han encontrado productos que contentan la palabra de b&uacute;squeda. (" . $busqueda . ")"; ?></p>
                    </div>
                    <?php
                } else {
                    $cont = 0;
                    while ($row_receta = Db::fetch_array($recetasBusqueda)) {
                        $id_receta = $row_receta['receta_id'];
                        $prod = $Producto->get_list(1,'',"activo=1 AND producto_id IN (SELECT producto_id FROM receta_producto WHERE receta_id=$id_receta)");
                        $row_prod = Db::fetch_array($prod);
                        $id_prod = $row_prod['producto_id'];
                        $cat = $Categoria->get_list(1,'',"activo=1 AND categoria_id IN (SELECT categoria_id FROM producto_categoria WHERE producto_id=$id_prod)");
                        $row_cat = Db::fetch_array($cat);
                        //$receta_prod = $Receta_Producto->get_list(1,'',"receta_id=$id_receta",'');
                        //$row_receta_prod = Db::fetch_array($receta_prod);
                        $cont++;
                        ?>
                        <div class="resultados texto <?php if ($cont % $cantidad) { echo ""; } else { echo "last"; } ?>">
                            <h2><?php echo $row_receta['nombre']; ?></h2>
                            <p><?php echo $row_receta['descripcion_corta']; ?></p>
                            <div class="texto">
                                <a href=<?php echo "index.php?mod=recetas&pid=".$row_prod['producto_id']. '&cid='.$row_cat['categoria_id']; ?> >ir a receta</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>                
            </div>
            <ul class="paginado clearfix">
                <?php
                for ($i = 1; $i <= $cant_pags; $i++) {
                    ?>
                    <li onclick="paginado(<?php echo $i; ?>)" > <?php if ($pagina != $i) { ?> <a href="#"> <?php echo $i; ?> </a> 
                            <?php
                        } else {
                            echo $i;
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
            </ul>  
        </form>
    </div>  
</div>
<!--Fin main-->