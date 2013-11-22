<?php

function create_receta_link($id, $categoria_id = '') {  
    $retorno = '';
    $Producto = new Producto();
    $Categoria = new Categoria();
    $prod = $Producto->get($id);

    if ($prod != null) {
        if ($categoria_id == '') {
            // Seteamos el categoria id con la primera
            $rst_matching = $Categoria->get_list(1, 1, "activo=1 AND categoria_id IN (SELECT categoria_id FROM producto_categoria WHERE producto_id=$id)", 'orden');
            $cant_rst = $Categoria->count("activo=1 AND categoria_id IN (SELECT categoria_id FROM producto_categoria WHERE producto_id=$id)");
            if ($cant_rst > 0) {
                while ($rst = Db::fetch_array($rst_matching)) {
                    // Obtenemos la categoria
                    $categoria_id = $rst['categoria_id'];
                    break;
                }
            }
        }
        $retorno = '<a class="btn-recetas" href="index.php?mod=recetas&pid=' . $prod['producto_id'] . '&cid=' . $categoria_id . ' ">VER RECETAS</a>';
    }
    return $retorno;
}

function create_receta_link_home($idprod, $idreceta, $categoria_id = '') {  
    $retorno = '';
    $Producto = new Producto();
    $Categoria = new Categoria();
    $Receta = new Receta();
    $prod = $Producto->get($idprod);
    $rec = $Receta->get($idreceta);

    if ($prod != null) {
        if ($categoria_id == '') {
            // Seteamos el categoria id con la primera
            $rst_matching = $Categoria->get_list(1, 1, "activo=1 AND categoria_id IN (SELECT categoria_id FROM producto_categoria WHERE producto_id=$idprod)", 'orden');
            $cant_rst = $Categoria->count("activo=1 AND categoria_id IN (SELECT categoria_id FROM producto_categoria WHERE producto_id=$idprod)");
            if ($cant_rst > 0) {
                while ($rst = Db::fetch_array($rst_matching)) {
                    // Obtenemos la categoria
                    $categoria_id = $rst['categoria_id'];
                    break;
                }
            }
        }
        $retorno = '<a href="index.php?mod=recetas&pid=' . $prod['producto_id'] . '&cid=' . $categoria_id .'&rid='.$rec['receta_id']. ' ">ver receta</a>';
    }
    return $retorno;
}

//function create_receta_link($id, $producto_id = '') {
//    $retorno = '';
//    $Receta = new Receta();
//    $Producto = new Producto();
//    $receta = $Receta->get($id);
//
//    if ($receta != null) {
//        if ($producto_id == '') {
//            // Seteamos el categoria id con la primera
//            $rst_matching = $Producto->get_list(1, 1, "activo=1 AND producto_id IN (SELECT producto_id FROM receta_producto WHERE receta_id=$id)", 'orden');
//            $cant_rst = $Producto->count("activo=1 AND producto_id IN (SELECT producto_id FROM receta_producto WHERE receta_id=$id)");
//            if ($cant_rst > 0) {
//                while ($rst = Db::fetch_array($rst_matching)) {
//                    // Obtenemos la categoria
//                    $producto_id = $rst['producto_id'];
//                    break;
//                }
//            }
//        }
//        $retorno = '<a class="btn-recetas" href="index.php?mod=receta&rid=' . $receta['receta_id'] . '&pid=' . $producto_id . ' ">VER RECETAS</a>';
//    }
//    return $retorno;
//}

?>
