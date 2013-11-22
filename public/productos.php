<?php
require_once(PUBLIC_HELPERS . "producto.php");
  
$id = _get('cid');

$rst_categoria = $Categoria->get($id);
//if(!$rst_categoria){ header('location: index.php'); }
//if(!$Categoria->es_ultimo_nodo($id)){ header('location: index.php'); }

$Tracking = Tracking::load();
$Tracking->add('index.php?mod=productos&cid='.$id);
$Tracking->save();

$cant_prods = $Producto->count("activo=1 AND producto_id IN (SELECT producto_id FROM producto_categoria WHERE categoria_id=$id)");
$cantidad = 24;

$cant_pags = ceil($cant_prods / $cantidad);
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

$lista_prod = $Producto->get_list($cantidad,$pagina,"activo=1 AND producto_id IN (SELECT producto_id FROM producto_categoria WHERE categoria_id=$id)",'orden');
$cant_prods = $Producto->count("activo=1 AND producto_id IN (SELECT producto_id FROM producto_categoria WHERE categoria_id=$id)");
?>

<script language="javascript">
    
    function paginado(pag)
    {
        $("#pagina").val(pag);
        $('#form_producto').submit();
    }
    
</script>

<div class="main clearfix">
    <div class="container clearfix">
        <form id="form_producto" name="form_producto" method="post" >
            <div class="titulo-pruducto clearfix"> 
                <div class="left">&nbsp;</div>
                <div class="medio">
                    <ul>
                        <li class="izquierda"><?php if($lang=='es'){ echo $rst_categoria['nombre']; } else { echo $rst_categoria['nombre_locale']; } ?></li>
                        <li class="derecha"><img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                    </ul>	
                </div>	
                <div class="right">&nbsp;</div>	
            </div> 
            <div class="content clearfix">
                <input type="hidden" name="pagina" id="pagina" value="" />
                <ul class="productos">
                    <?php
                    $cont = 0;
                    while ($row_producto = Db::fetch_array($lista_prod)) {
                        $cont++;
                        if($cont % 6){ $clase_last = ""; } else { $clase_last = "last"; }
                        $nombre_prod = $row_producto['nombre'];
                        $name_prod = $row_producto['nombre_locale'];
                        $id_prod = $row_producto['producto_id'];
                        $prod_img = $Producto_Imagen->get_list('','',"producto_id=$id_prod",'');
                        $nombre_img = "nodisponible.jpg";
                        while($row_imagen = Db::fetch_array($prod_img)){
                            $nombre_img = $row_imagen['imagen'];
                        }
                        ?>
                        <li class="<?php echo $clase_last;?>">
                            <img alt="foto" src="<?php echo "files/productos/thumb/" . $nombre_img; ?>" />
                            <p><?php if($lang=='es') { echo $nombre_prod; } else { echo $name_prod; } ?></p>
                            <?php if($lang=='es') { echo create_producto_link($row_producto['producto_id']); } ?>
                        </li>
                    <?php } ?>
                </ul>
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