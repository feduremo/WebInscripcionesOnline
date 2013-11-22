<?php

function create_category_link_menu_vertical_es($id, $categoria_id = '') {
    $retorno = '';
    $Categoria = new Categoria();
    $categoria = $Categoria->get($id);

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

    $retorno = '<a href="index.php?mod=productos&cid=' . $categoria['categoria_id'] . '">' . $categoria['nombre'] . '</a>';

return $retorno;

}

function create_category_link_menu_vertical_en($id, $categoria_id = '') {
    $retorno = '';
    $Categoria = new Categoria();
    $categoria = $Categoria->get($id);

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

    $retorno = '<a href="index.php?mod=productos&cid=' . $categoria['categoria_id'] . '">' . $categoria['nombre_locale'] . '</a>';

return $retorno;

}

function create_category_link_granel_es($id, $categoria_id = '') {
    $retorno = '';
    $Categoria = new Categoria();
    $categoria = $Categoria->get($id);

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

    $retorno = '<a href="index.php?mod=granels&cid=' . $categoria['categoria_id'] . '">' . $categoria['nombre'] . '</a>';

return $retorno;

}

function create_category_link_granel_en($id, $categoria_id = '') {
    $retorno = '';
    $Categoria = new Categoria();
    $categoria = $Categoria->get($id);

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

    $retorno = '<a href="index.php?mod=granels&cid=' . $categoria['categoria_id'] . '">' . $categoria['nombre_locale'] . '</a>';

return $retorno;

}


function create_category_link($id, $categoria_id = '') {
    $retorno = '';
    $Categoria = new Categoria();
    $categoria = $Categoria->get($id);

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

    $retorno = '<a href="index.php?mod=productos&cid=' . $categoria['categoria_id'] . '"> ir </a>';

return $retorno;

}
?>