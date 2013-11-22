<?php 
$busqueda = trim(_post('busqueda'));
$productosTodos = $Producto->get_list('','','activo=1','');
$dataList = array();

while ($row_producto = Db::fetch_array($productosTodos))
{
    if($lang == 'es' ) { 
        $dataList[] = $row_producto['nombre'];
    } else {
        $dataList[] = $row_producto['nombre_locale'];
    }
}   
?>
<script>
$(function() {
        
        var array_a = new Array();
        array_a = <?php echo json_encode($dataList); ?>
        
        $( "#tags" ).autocomplete({ source: array_a });
    });

</script>

<div class="header">
    <div class="container clearfix">         
        <div class="top clearfix">
            <ul class="logos">
                <li><a href="<?php if($lang=='es'){ echo "index.php?&locale=es"; } else { echo "index.php?&locale=en"; } ?>"><img alt="logoAbundancia" src="images/public/img/logo-abundancia.png" /></a></li>
                <li><img alt="logoSilcom" src="images/public/img/logo-silcom.png" /></li>
            </ul>
            <div class="right">                
                <div class="languages">
                    <?php if($lang!='es'){ ?>
                    <a class="bg" href="<?php echo getLangURL("&locale=es"); ?>">ES</a>
                    <?php } else { ?>
                    <a class="bg" href="<?php echo getLangURL("&locale=en"); ?>">EN</a>
                    <a href="<?php echo getLangURL("&locale=en"); ?>">Short Version</a>
                    <?php } ?>
                </div>
                
                    <div class="search">
                        <form id="form-busqueda" action="index.php?mod=busqueda" method="post">
                        <?php if($lang=='es') {?> 
                        <input id="tags" class="textbox" type="text" onblur="if($(this).val()==''){ $(this).val('Escriba aqui'); }" onfocus="if($(this).val()=='Escriba aqui'){ $(this).val('');}" value="<?php if($busqueda!=""){ echo $busqueda; }else{ echo "Escriba aqui"; } ?>" name="busqueda" id="busqueda"/>
                        <?php } else { ?>
                        <input id="tags" class="textbox" type="text" onblur="if($(this).val()==''){ $(this).val('Write here'); }" onfocus="if($(this).val()=='Write here'){ $(this).val('');}" value="<?php if($busqueda!=""){ echo $busqueda; }else{ echo "Write here"; } ?>" name="busqueda" id="busqueda"/>
                        <?php } ?>
                        <input class="button" type="button" value="<?php if($lang=='es'){ echo "ir!";  } else { echo "go!"; } ?>" onclick="$('#form-busqueda').submit()"/>
                        </form>
                    </div>
                
            </div>
       	</div>
        <!--Contenido Menu-->
        <?php include_once(PUBLIC_PARTIALS . '_menu.php'); ?>
        <!--Fin Menu-->
    </div>
</div>
