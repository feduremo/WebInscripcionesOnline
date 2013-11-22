<?php
$Tracking = Tracking::load();
$Tracking->add('index.php?mod=novedades');
$Tracking->save();
$where = "activo = 1";
$cantidad_novedades = $Novedad->count();

$cantidad = 5;

$cant_pags = ceil($cantidad_novedades / $cantidad);
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

$novedades = $Novedad->get_list($cantidad, $pagina, $where, 'fecha desc');
?>

<script language="javascript">
    
    function paginado(pag)
    {
        $("#pagina").val(pag);
        $('#form_novedades').submit();
    }
    
</script>

<!--Contenido main-->
<div class="main clearfix">
    <div class="container clearfix">
        <form id="form_novedades" name="form_novedades" method="post" >            
            <div class="titulo-pruducto clearfix"> 
                <div class="left">&nbsp;</div>
                <div class="medio">
                    <ul>
                        <li class="izquierda">Novedades</li>
                        <li class="derecha"><img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                    </ul>	
                </div>	
                <div class="right">&nbsp;</div>	
            </div> 
            <div class="content clearfix">
                <input type="hidden" name="pagina" id="pagina" value="" />
                <?php if ($cantidad_novedades == 0) { ?>
                    <div class="resultados texto">
                        <br />
                        <p><?php echo "No existen novedades actualmentes."; ?></p>
                    </div>
                    <?php
                } else {
                    $cont = 0;
                    while ($row = Db::fetch_array($novedades)) {
                        $cont++;
                        ?>
                        <div class="resultados texto 
                        <?php
                        if ($cont % $cantidad) {
                            echo "";
                        } else {
                            echo "last";
                        }
                        ?>">
                            <h2><?php echo $row['titulo']; ?></h2>
                            <p><?php echo $row['texto_corto']; ?></p>
                            <a href="<?php echo $row['link']; ?>"><?php echo $row['link']; ?></a>
                            <img alt="flecha" src="files/novedades/<?php echo $row['imagen']; ?>" />
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