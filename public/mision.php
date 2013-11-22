<?php
$cont = $Contenido->get_list(1,'','activo = 1','');
$row_cont = Db::fetch_array($cont);
?>

<!--Contenido main-->
<div class="main clearfix">
    <div class="container clearfix">                    
        <div class="titulo-pruducto clearfix"> 
            <div class="left">&nbsp;</div>
            <div class="medio">
                <ul>
                    <li class="izquierda"><?php echo $site_languages['mision']; ?></li>
                    <li class="derecha"><img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                </ul>	
            </div>	
            <div class="right">&nbsp;</div>	
        </div> 
        <div class="content clearfix">
            <?php if($lang=='es') { echo $row_cont['mision']; } else { echo $row_cont['mision_locale']; } ?>
        </div>            
    </div>  
</div>
<!--Fin main-->