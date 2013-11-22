<?php 
require_once(PUBLIC_HELPERS . "categoria.php");
?>                  

<div class="menu-rounded" id="menu">
    <div class="left"></div>
    <ul class="middle" id="nav">        
        <li class="<?php if($modulo == "home"){ echo "active"; } else { echo ""; } ?>"><a href="index.php"><?php echo $site_languages['menu_atrib1']; ?></a></li>
        <li class="<?php if($modulo == "nosotros"){ echo "active"; } else { echo ""; } ?>"><a href="index.php?mod=nosotros"><?php echo $site_languages['menu_atrib2']; ?></a></li>
        <?php
        $lista_categoria_principal = $Categoria->get_list(2,'','activo=1 AND categoria_padre_id=0','');                    
        ?>
        <li class="<?php if($modulo == "productos" || $modulo == "producto"){ echo "active"; } else { echo ""; } ?>">
            <a href="#">
                <?php
                $row_categoria_padre = Db::fetch_array($lista_categoria_principal);
                if($lang=='es'){ echo $row_categoria_padre['nombre']; } else { echo $row_categoria_padre['nombre_locale']; }
                    ?>
            </a>
            <ul class="submenu">
                   <?php                    
                   $id_cat_paquete = $row_categoria_padre['categoria_id'];
                   $lista_categorias_paquete = $Categoria->get_list('','',"activo=1 AND categoria_padre_id='$id_cat_paquete'",'orden');                   
                   while ($row_categoria_paquete = Db::fetch_array($lista_categorias_paquete)) {
                       ?>
                <li>
                    <?php if($lang=='es'){ 
                    echo create_category_link_menu_vertical_es($row_categoria_paquete['categoria_id']); 
                } else { 
                    echo create_category_link_menu_vertical_en($row_categoria_paquete['categoria_id']);
                }
                    ?>
                </li>
            <?php } ?>
            </ul>
        </li>
        <li class="<?php if($modulo == "granels"){ echo "active"; } else { echo ""; } ?>">
            <a href="#">
                <?php
                $row_categoria_padre = Db::fetch_array($lista_categoria_principal);
                if($lang=='es'){ echo $row_categoria_padre['nombre']; } else { echo $row_categoria_padre['nombre_locale']; }
                    ?>
            </a>
            <ul class="submenu">
                   <?php                    
                   $id_cat_granel = $row_categoria_padre['categoria_id'];
                   $lista_categorias_granel = $Categoria->get_list('','',"activo=1 AND categoria_padre_id='$id_cat_granel'",'orden');                   
                   while ($row_categoria_granel = Db::fetch_array($lista_categorias_granel)) {
                       ?>
                <li>
                <?php if($lang=='es'){
                    echo create_category_link_granel_es($row_categoria_granel['categoria_id']);
                } else {
                    echo create_category_link_granel_en($row_categoria_granel['categoria_id']);
                }
                ?>
                </li>
            <?php } ?>
            </ul>
        </li>
        <?php if($lang=='es'){ ?>    
        <li class="<?php if($modulo == "recetario"){ echo "active"; } else { echo ""; } ?>"><a href="index.php?mod=recetario">Recetario</a></li>        
        <li class="<?php if($modulo == "novedades"){ echo "active"; } else { echo ""; } ?>"><a href="index.php?mod=novedades">Novedades</a></li>
        <?php } ?>
        <li class="<?php if($modulo == "contacto"){ echo "active"; } else { echo ""; } ?>"><a href="index.php?mod=contacto"><?php echo $site_languages['menu_atrib5']; ?></a></li>
    </ul>
    <div class="right"></div>
</div>
