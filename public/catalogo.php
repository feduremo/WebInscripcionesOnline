<?php
$cant_prods = $Producto->count();
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
$lista_prod = $Producto->get_list($cantidad, $pagina, '', '');
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
                        <li class="izquierda">Productos</li>
                        <li class="derecha"><img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                    </ul>	
                </div>	
                <div class="right">&nbsp;</div>	
            </div> 
            <div class="content clearfix">
                <input type="hidden" name="pagina" id="pagina" value="" />
                <ul class="productos">
                    <?php
                    while ($row = Db::fetch_array($lista_prod)) {
                        $nombre_prod = $row['nombre'];
                        $id_prod = $row['producto_id'];
                        $prod_img = $Producto_Imagen->get_list(1, 1, 'producto_id=' . $id_prod, '');
                        $nombre_img = "nodisponible.jpg";
                        if ($row_imagen = Db::fetch_array($prod_img)) {
                            $nombre_img = $row_imagen['imagen'];
                        }
                        ?>
                        <li>
                            <img alt="foto" src="<?php echo "images/public/img/" . $nombre_img; ?>" />
                            <p><?php echo $nombre_prod; ?></p>
                            <a href="#">ir</a>
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