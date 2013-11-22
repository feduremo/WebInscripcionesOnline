<?php

$Tracking = Tracking::load();
$Tracking->add('index.php?mod=busqueda');
$Tracking->save();

$busqueda = trim(_post('busqueda'));
$where = ' activo=1 ';
if ($busqueda != '') {
    $where .= "AND (nombre_locale like '%$busqueda%' OR descripcion_corta_locale like '%$busqueda%' OR nombre like '%$busqueda%' OR descripcion_corta like '%$busqueda%' OR descripcion_larga like '%$busqueda%')";
}

$cantidadBusqueda = $Producto->count($where);

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
$productosBusqueda = $Producto->get_list($cantidad, $pagina, $where, '');

?>

<script language="javascript">
    
    function paginado(pag)
    {
        $("#pagina").val(pag);
        $('#form_busqueda').submit();
    }

</script>

<!--Contenido main-->
<div class="main clearfix">
    <div class="container clearfix">
        <form id="form_busqueda" name="form_busqueda" method="post" >
            <input type="hidden" name="busqueda" id="busqueda" value="<?php echo $busqueda; ?>" />
            <div class="titulo-pruducto clearfix"> 
                <div class="left">&nbsp;</div>
                <div class="medio">
                    <ul>
                        <li class="izquierda"><?php echo $site_languages['busqueda']; ?></li>
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
                        <p><?php if($lang=='es'){ echo "No se han encontrado productos que contentan la palabra de b&uacute;squeda. (" . $busqueda . ")"; } else { echo "Sorry, no results found"; }?></p>
                    </div>
                    <?php
                } else {
                    
                    /*$lista_categoria_principal = $Categoria->get_list(2,'','activo=1 AND categoria_padre_id=0','');
                        $row_categoria_padre = Db::fetch_array($lista_categoria_principal);
                        $row_categoria_padre = Db::fetch_array($lista_categoria_principal);
                        $id_cat_granel = $row_categoria_padre['categoria_id'];*/
                    
                    $cont = 0;
                    while ($row_producto = Db::fetch_array($productosBusqueda)) {
                        $id_prod = $row_producto['producto_id'];
                        $categoria_prod = $Producto_Categoria->get_list(1,'',"producto_id=$id_prod",'');
                        $row_cat_prod = Db::fetch_array($categoria_prod);
                        $category = $Categoria->get($row_cat_prod['categoria_id']);
                        $cont++;
                        $categoria_pa = $category['categoria_padre_id'];
                        if($categoria_pa==1){
                        ?>
                
                        <div class="resultados texto <?php if ($cont % $cantidad) { echo ""; } else { echo "last"; } ?>">
                            <h2><?php if($lang=='es'){ echo $row_producto['nombre']; } else { echo $row_producto['nombre_locale']; } ?></h2>
                            <p><?php if($lang=='es'){ echo $row_producto['descripcion_corta']; } else { echo $row_producto['descripcion_corta_locale']; } ?></p>
                            <div class="texto">
                                <a href=<?php echo "index.php?mod=producto&pid=".$row_producto['producto_id']."&cid=".$row_cat_prod['categoria_id']; ?> >ir a producto</a>
                            </div>
                        </div>
                        <?php
                        } else { ?>
                        <div class="resultados texto <?php if ($cont % $cantidad) { echo ""; } else { echo "last"; } ?>">
                            <h2><?php if($lang=='es'){ echo $row_producto['nombre']; } else { echo $row_producto['nombre_locale']; } ?></h2>
                            <p><?php if($lang=='es'){ echo $row_producto['descripcion_corta']; } else { echo $row_producto['descripcion_corta_locale']; } ?></p>
                            <div class="texto">
                                <a href=<?php echo "index.php?mod=granels&pid=".$row_producto['producto_id']."&cid=".$row_cat_prod['categoria_id']; ?> >ir a producto</a>
                            </div>
                        </div>
                <?php
                        }
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