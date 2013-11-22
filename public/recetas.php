<script type="text/javascript">
    $(document).ready(function() {
        $("a#example1").fancybox();
        //$("#accordion").accordion({'active':2});
    });


</script>

<?php
require_once(PUBLIC_HELPERS . "producto.php");
//require_once(PUBLIC_HELPERS . "receta.php");

$pid = _get('pid');
$cid = _get('cid');

$producto = $Producto->get($pid);
$categoria = $Categoria->get($cid);

if (!$producto) {
    header('location: index.php');
}
if ($producto['activo'] != '1') {
    header('location: index.php');
}

$Tracking = Tracking::load();
$Tracking->add('index.php?mod=producto&pid=' . $pid);
$Tracking->save();
?>

<div class="main clearfix">
    <div class="container clearfix">
        <div class="titulo-pruducto clearfix">
            <div class="left">&nbsp;</div>
            <div class="medio">
                <ul>
                    <li class="izquierda">Desayuno</li>
                    <li class="derecha">
                        <img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                </ul>
            </div>
            <div class="right">&nbsp;</div>
        </div>
        <div class="content clearfix">
            <ul class="breadcrumb clearfix">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Paquetes</a></li>
                <li><?php echo create_category_link_menu_vertical_es($categoria['categoria_id']); ?></li>
                <li><?php echo $producto['nombre']; ?></li>
            </ul>
            <div class="clearfix">
                <div class="left-column">
                    <div class="title">
                        <div class="border-rounded">&nbsp;</div>
                        <h3>Productos</h3>
                    </div>
                    <ul class="menu-vertical">
                        <?php
                        $lista_prod = $Producto->get_list('', '', "activo=1 AND producto_id IN (SELECT producto_id FROM producto_categoria WHERE categoria_id=$cid)", '');
                        while ($row_producto = Db::fetch_array($lista_prod)) {
                            ?>
                            <li><?php echo create_producto_link_menu_vertical($row_producto['producto_id']); ?></li>
                        <?php } ?>
                    </ul>
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
                <div class="right-column">
                    <h1><?php echo $producto['nombre']; ?></h1>
                    <div class="clearfix">
                        <div class="box">
                            <a id="example1" href="<?php echo "files/productos/big/" . $nombre_img; ?>" ><img src="<?php echo "files/productos/media/" . $nombre_img; ?>" alt="foto producto" /></a>
                            <?php echo create_producto_link_receta($id_producto); ?>
                            <!--                            <a class="btn-recetas" href="#">Ver detalle de producto</a>-->
                        </div>
                        <?php
                        $lista_receta = $Receta->get_list('', '', "activo=1 AND receta_id IN (SELECT receta_id FROM receta_producto WHERE producto_id=$pid)", '');
                        $cant_recetas = $Receta->count("activo=1 AND receta_id IN (SELECT receta_id FROM receta_producto WHERE producto_id=$pid)");
                        if ($cant_recetas == 0) { ?>
                            <div class="box-content">
                                <div class="box-receta last">
                                    <h2>No hay recetas para este producto</h2>
                                </div>
                            </div>
                        <?php                         
                        } else { ?>
                            <div id="accordion" class="box-content">
                            <?php
                                $aux = true;
                                $cont = 0;
                                while ($row_receta = Db::fetch_array($lista_receta)) {
                                    if($aux){
                                        $cont++;
                                        if($row_receta["receta_id"] == _get("rid")){ $aux = false; }
                                    }
                                    
                                    ?>
<!--                                    <div class="box-receta <?php //if ($cant_recetas == $cont) { "last"; } else { echo ""; } ?>">-->
                                        <h3><a href="<?php echo $row_receta['nombre']; ?>"><? echo $row_receta['nombre']; ?></a></h3>
                                        <div><p><?php echo $row_receta['descripcion_larga']; ?></p></div>
<!--                                    </div>-->
                                    <?php } ?>
                            </div>
                                    <?php
                                }
                            ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#accordion").accordion({'active':<?php echo $cont-1;?>});
    });
</script>