<script type="text/javascript">
    $(document).ready(function() {
        $("a#example1").fancybox();
    });
    
   
</script>

<?php
require_once(PUBLIC_HELPERS . "producto.php");
require_once(PUBLIC_HELPERS . "receta.php");

$pid = _get('pid');
$cid = _get('cid');

$producto = $Producto->get($pid);
$categoria = $Categoria->get($cid);

if (!$producto) {
    $lista_prod = $Producto->get_list('', '', "activo=1 AND producto_id IN (SELECT producto_id FROM producto_categoria WHERE categoria_id=$cid)", '');
    $producto = Db::fetch_array($lista_prod);
}
if ($producto['activo'] != '1') {
    header('location: index.php');
}

$Tracking = Tracking::load();
$Tracking->add('index.php?mod=granels&cid=' . $cid);
$Tracking->save();
?>

<div class="main clearfix">
    <div class="container granel clearfix">
        <div class="titulo-pruducto clearfix">
            <div class="left">&nbsp;</div>
            <div class="medio">
                <ul>
                    <li class="izquierda"><?php if($lang=='es'){ echo $categoria['nombre']; } else { echo $categoria['nombre_locale']; } ?></li>
                    <li class="derecha">
                    <img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                </ul>
            </div>
            <div class="right">&nbsp;</div>
        </div>
        <div class="content clearfix">
            <ul class="breadcrumb clearfix">
                <li><a href="index.php">Home</a></li>
                <li><a href="#"><?php if($lang=='es'){ echo "Granel"; } else { echo "In bulk"; } ?></a></li>
                <li><?php if($lang=='es'){ echo create_category_link_menu_vertical_es($categoria['categoria_id']); } else { echo create_category_link_menu_vertical_en($categoria['categoria_id']); } ?></li>
                <li><?php if($lang=='es'){ echo $producto['nombre']; } else { echo $producto['nombre_locale']; } ?></li>
            </ul>
            <div class="clearfix">
                <div class="left-column">
                    <div class="title">
                        <div class="border-rounded">&nbsp;</div>
                        <h3><?php if($lang=='es'){ echo "Productos"; } else { echo "Categorys In Bulk"; } ?></h3>
                    </div>
                    <?php if($lang=='es'){ ?>
                    <ul class="menu-vertical">
                        <?php
                        $lista_prod = $Producto->get_list('', '', "activo=1 AND producto_id IN (SELECT producto_id FROM producto_categoria WHERE categoria_id=$cid)", '');
                        while ($row_producto = Db::fetch_array($lista_prod)) {
                            ?>
                            <li><?php echo create_granel_link_menu_vertical($row_producto['producto_id']); ?></li>
                        <?php } ?>
                    </ul>
                    <?php } else { ?>
                    <ul class="menu-vertical">
                        <?php
                        $lista_categoria_principal = $Categoria->get_list(2,'','activo=1 AND categoria_padre_id=0','');
                        $row_categoria_padre = Db::fetch_array($lista_categoria_principal);
                        $row_categoria_padre = Db::fetch_array($lista_categoria_principal);
                        $id_cat_granel = $row_categoria_padre['categoria_id'];
                        $lista_categorias_granel = $Categoria->get_list('','',"activo=1 AND categoria_padre_id='$id_cat_granel'",'orden');                   
                            while ($row_categoria_granel = Db::fetch_array($lista_categorias_granel)) { ?>
                                <li>
                                    <?php echo create_category_link_granel_en($row_categoria_granel['categoria_id']); ?>
                                </li>
                            <?php } ?>
                    </ul>
                    <?php } ?>
                    <div class="border-rounded">&nbsp;</div>
                </div>
                <?php 
                $id_producto = $producto['producto_id'];
                $producto_img = $Producto_Imagen->get_list(1, 1, 'producto_id=' . $id_producto, '');
                $nombre_img = "nodisponible.jpg";
                if ($row_imagen = Db::fetch_array($producto_img)) {
                    $nombre_img = $row_imagen['imagen'];
                }
                ?>    
                <?php if($lang=='es'){ ?>
                <div class="right-column">
                    <h1><?php echo $producto['nombre']; ?></h1>					
                    <div class="clearfix">						
                        <div class="box-content">
                            <?php echo $producto['descripcion_larga']; ?>
                        </div>
                    </div>
                    <?php //echo create_receta_link($id_producto); ?>
                </div>
                <?php } else { ?>
                <div class="right-column">
                    <h1><?php echo $categoria['nombre_locale']; ?></h1>
                    <ul class="list-granel">
                        <?php
                        $lista_prod = $Producto->get_list('', '', "activo=1 AND producto_id IN (SELECT producto_id FROM producto_categoria WHERE categoria_id=$cid)", '');
                        while ($row_producto = Db::fetch_array($lista_prod)) {
                            ?>
                            <li><?php echo $row_producto['nombre_locale']; ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>