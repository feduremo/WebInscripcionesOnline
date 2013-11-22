<?php
// Vemos si viene de alguna categoria
$id = _get('id');

function create_submenu($categoria_id, $categoria_id_activo = "", $last=false)
{
    $Categoria = new Categoria();

    $submenu = "";
    $categoria = $Categoria->get($categoria_id);

    $css_last = "";
    if($last){ $css_last = "last"; }
    
    if($categoria != null)
    {
        // Generamos el codigo para los hijos
        $children       = $Categoria->get_list('','',"activo=1 AND categoria_padre_id = $categoria_id",'orden');
        $count_children = $Categoria->count("activo=1 AND categoria_padre_id = $categoria_id");

        // Link de la categoria, si es nodo hoja
        $link_categoria = "#";
        if($count_children == 0){ $link_categoria = "index.php?mod=productos&id=".$categoria_id; }

        // Estilo seleccionado
        $style_selected = "";
        if($categoria_id == $categoria_id_activo){ $style_selected = "color:Red";}

        $submenu = '<li style="margin-bottom:0px;" class="menuv '.$css_last.'"><a style="'.$style_selected.'" href="'.$link_categoria.'">'.$categoria['nombre'].'</a>';

        if($count_children > 0)
        {
            // Vemos de ocultar el div o no
            $style_display = "display:none;";
            if($Categoria->encontrar_nodo($categoria_id_activo, $categoria_id)) { $style_display = ""; }

            $submenu .= '<div style="border-top: thin solid #B8B8B8;margin-top:10px;'.$style_display.'"><ul>';

            $contador = 0;
            while($child = db::fetch_array($children))
            {
                $contador++;
                if($contador==$count_children){ $submenu .= create_submenu($child['categoria_id'],$categoria_id_activo, true); }
                else{ $submenu .= create_submenu($child['categoria_id'],$categoria_id_activo); }
            }
            
            $submenu .= '</ul></div>';
        }

        $submenu .= '</li>';
    }
    return $submenu;
}
?>