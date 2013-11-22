<?php

function create_producto_link($id, $categoria_id = '') {
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
        $retorno = '<a href="index.php?mod=producto&pid=' . $prod['producto_id'] . '&cid=' . $categoria_id . ' ">ir</a>';
    }
    return $retorno;
}

function create_prod_link_home($id, $categoria_id = '') {
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
        $prodi = $prod['producto_id'];
        $nombre = $prod['nombre'];
        $retorno = "<a href=index.php?mod=producto&pid=$prodi&cid=$categoria_id>$nombre</a>";
    }
    return $retorno;
}

function create_producto_link_menu_vertical($id, $categoria_id = '') {
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
        $retorno = '<a href="index.php?mod=producto&pid=' . $prod['producto_id'] . '&cid=' . $categoria_id . ' ">' . $prod['nombre'] . '</a>';
    }
    return $retorno;
}

function create_granel_link_menu_vertical($id, $categoria_id = '') {
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
        $retorno = '<a href="index.php?mod=granels&pid=' . $prod['producto_id'] . '&cid=' . $categoria_id . ' ">' . $prod['nombre'] . '</a>';
    }
    return $retorno;
}

function create_producto_link_receta($id, $categoria_id = '') {
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
        $retorno = '<a class="btn-recetas" href="index.php?mod=producto&pid=' . $prod['producto_id'] . '&cid=' . $categoria_id . ' ">Ver detalle de producto</a>';
    }
    return $retorno;
}

?>