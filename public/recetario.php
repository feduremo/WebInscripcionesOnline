<?php 
$busqueda = trim(_post('busqueda2'));
$recetasTodas = $Receta->get_list('','','activo=1','');
$dataList = array();

while ($row_receta = Db::fetch_array($recetasTodas))
{
    $dataList[] = $row_receta['nombre'];
}   

//$cant_prods = $Producto->count();
//$cantidad = 24;
//
//$cant_pags = ceil($cant_prods / $cantidad);
//if ($cant_pags == 0) {
//    $cant_pags = 1;
//}
//$pagina = _post('pagina');
//if ($pagina == '' || $pagina == '0' || $pagina < 0) {
//    $pagina = 1;
//}
//if ($pagina > $cant_pags) {
//    $pagina = $cant_pags;
//}
//$lista_prod = $Producto->get_list($cantidad, $pagina, '', '');
?>
<script>
$(function() {
        
        var array_a = new Array();
        array_a = <?php echo json_encode($dataList); ?>
        
        $( "#tags2" ).autocomplete({ source: array_a });
    });

</script>
<script language="javascript">
    
    function pagina(pag)
    {
        $("#pagina").val(pag);
        $('#form_busqueda2').submit();
    }
    
</script>

<div class="main clearfix">
    <div class="container clearfix">
        <div class="recetas banner clearfix">
            <div class="search">
                <form id="form_busqueda2" action="index.php?mod=busqueda2" method="post">
                    <input id="tags2" class="textbox" type="text" onblur="if($(this).val()==''){ $(this).val('Escriba aqu&iacute;, qu&eacute; ingrediente quiere usar de La Abundancia'); }" onfocus="if($(this).val()=='Escriba aqu&iacute;, qu&eacute; ingrediente quiere usar de La Abundancia'){ $(this).val('');}" value="<?php if ($busqueda != "") { echo $busqueda; } else { echo "Escriba aqu&iacute;, qu&eacute; ingrediente quiere usar de La Abundancia"; } ?>" name="busqueda2" id="busqueda2"/>
                    <input class="button" type="button" value="Buscar" onclick="$('#form_busqueda2').submit()"/>
                </form>
            </div>
        </div>
        <p>La Abundancia quiere compartir con ustedes las mejores recetas que usted puede cocinar con nuestros productos</p>
    </div>
</div>