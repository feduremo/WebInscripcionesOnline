<?php

$cid = _get('cid');

$cant_cats = $Categoria->count();
$cantidad = 24;

$cant_pags = ceil($cant_cats / $cantidad);
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
$lista_cats = $Categoria->get_list('', '', "categoria_padre_id='$cid'", '');
?>

<script language="javascript">
    
    function pagina(pag)
    {
        $("#pagina").val(pag);
        $('#form_categoria').submit();
    }
    
</script>
<div class="main clearfix">
    <div class="container clearfix">
        <form id="form_producto" name="form_categoria" method="post" >
            <div class="titulo-pruducto clearfix"> 
                <div class="left">&nbsp;</div>
                <div class="medio">
                    <ul>
                        <li class="izquierda">Granel</li>
                        <li class="derecha"><img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                    </ul>	
                </div>	
                <div class="right">&nbsp;</div>	
            </div> 
            <div style="width:955px !important;" class="content clearfix">
                <input type="hidden" name="pagina" id="pagina" value="" />
                <ul class="productos">
                    <?php
                    while ($row_categoria = Db::fetch_array($lista_cats)) {
                        $nombre_categoria = $row_categoria['nombre'];
                        ?>
                        <li>
                            <img alt="foto" src="files/categorias/<?php if($nombre_categoria==''){ echo "nodisponible.jpg"; } else { echo $nombre_categoria.'.jpg'; } ; ?>" />
                            <p><?php echo $nombre_categoria; ?></p>
                            <?php echo create_category_link($row_categoria['categoria_id']); ?>
                        </li>
                    <?php } ?>
                </ul>	

            </div>
            <!--<ul class="paginado clearfix">
                <?php
                /*for ($i = 1; $i <= $cant_pags; $i++) {
                    ?>
                    <li onclick="pagina(<?php echo $i; ?>)" > <?php if ($pagina != $i) { ?> <a href="#"> <?php echo $i; ?> </a> 
                            <?php
                        } else {
                            echo $i;
                        }
                        ?>
                    </li>
                    <?php
                }*/
                ?>
            </ul>--> 
        </form>
    </div>  
</div>