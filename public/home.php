<?php

require_once(PUBLIC_HELPERS . "receta.php");
require_once(PUBLIC_HELPERS . "producto.php");

$Tracking = Tracking::load();
$Tracking->add('index.php?mod=home');
$Tracking->save();
?>

<?php if($lang=='es'){ ?>

<div class="main clearfix">
    <div class="container clearfix">
        <?php   $lista_img_cont = $Contenido_Imagen->get_list(5,'','','');
                $img = array();
                while($row_img_cont = Db::fetch_array($lista_img_cont)){
                    $img[] = $row_img_cont['imagen'];
                }
        ?>
        <div style="min-height:383px;margin-bottom:20px">
            <div id="fade_effect" class="banner clearfix">
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[0];?>" />
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[1];?>" />
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[2];?>" />
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[3];?>" />
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[4];?>" />
            </div>
        </div>
        
        <div class="content clearfix">
            <div class="columna">
                <?php 
                $cont = $Contenido->get_list(1,'','activo = 1','');
                $row_cont = Db::fetch_array($cont);
                ?>
                <?php if($lang=='es'){ ?>
                <div class="amarillo">
                    <h2>
                        <?php                        
                        $lista_recetas = $Receta->get_list(2, 1, 'activo = 1 AND es_home = 1', '');
                        $row_receta = Db::fetch_array($lista_recetas);
                        $id_receta1 = $row_receta['receta_id'];
                        $prod1 = $Producto->get_list('', '', "activo=1 AND producto_id IN (SELECT producto_id FROM receta_producto WHERE receta_id=$id_receta1)", '');
                        $row_producto1 = Db::fetch_array($prod1);
                        echo $row_receta['nombre'];
                        ?>
                    </h2>
                     <?php echo $row_receta['descripcion_corta']; ?> 
                    <div class="boton-amarillo">
                        <div class="left">&nbsp;</div>
                        <div class="medio"><?php echo create_receta_link_home($row_producto1['producto_id'], $id_receta1); ?> </div>
                        <div class="right">&nbsp;</div>
                    </div>
                </div>
                <?php } ?>
                <div class="text clearfix">
                    <h2><?php echo $site_languages['nuestra_empresa']; ?></h2>
                    <p><?php  echo $row_cont['nuestra_empresa_home'];  ?></p>
                    <div class="boton-gris">
                        <div class="left">&nbsp;</div>
                        <div class="medio"><a href="index.php?mod=nosotros"> ver mas </a> </div>
                        <div class="right">&nbsp;</div>
                    </div>
                </div>
            </div>
            <!-- naranja-->
            <div class="columna">
                <?php if($lang=='es'){ ?>
                <div class="naranja">
                    <h2>
                        <?php
                        $row_receta = Db::fetch_array($lista_recetas);
                        $id_receta2 = $row_receta['receta_id'];
                        $prod2 = $Producto->get_list('', '', "activo=1 AND producto_id IN (SELECT producto_id FROM receta_producto WHERE receta_id=$id_receta2)", '');
                        $row_producto2 = Db::fetch_array($prod2);
                        echo $row_receta['nombre'];
                        ?>
                    </h2>                    
                     <?php echo $row_receta['descripcion_corta']; ?>          
                    <div class="boton-amarillo">
                        <div class="left">&nbsp;</div>
                        <div class="medio"><?php echo create_receta_link_home($row_producto2['producto_id'], $id_receta2); ?> </div>                        
                        <div class="right">&nbsp;</div>
                    </div>

                </div>
                <?php } ?>
                <div class="text clearfix">
                    <h2><?php echo $site_languages['mision']; ?></h2>
                    <p><?php echo $row_cont['mision_home'];  ?></p>
                    <div class="boton-gris">
                        <div class="left">&nbsp;</div>
                        <div class="medio" ><a href="index.php?mod=nosotros"> ver mas </a> </div>
                        <div class="right">&nbsp;</div>
                    </div>
                </div>
            </div>
            <!--gris-->
            <div class="gris">
                <div class="up">&nbsp;</div>
                <div class="medio">
                    <h2><?php echo $site_languages['prods_destacados']; ?></h2>
                    <ul>
                        <?php
                        $lista_producto = $Producto->get_list(4, "", "es_home = 1", "");
                        $cont = 0;
                        while ($row_producto = Db::fetch_array($lista_producto)) {
                            $cont++;
                            ?>                        
                            <li class="<?php if ($cont == 4) { echo "last"; } else { echo ""; } ?>">                                
                                <h4><?php echo create_prod_link_home($row_producto['producto_id']); ?></h4>
                                <?php echo $row_producto['descripcion_corta']; ?>                               
                            </li>
                            <?php                            
                            }
                            ?>
                    </ul>
                </div>
                <div class="button">&nbsp;</div>
            </div>
        </div>
    </div>
</div>

<?php } else { ?>
<div class="main clearfix">
    <div class="container clearfix">
        <?php   $lista_img_cont = $Contenido_Imagen->get_list(5,'','','');
        $img = array();
        while($row_img_cont = Db::fetch_array($lista_img_cont)){
            $img[] = $row_img_cont['imagen'];
        }
        ?>
        <div style="min-height:383px;margin-bottom:20px">
            <div id="fade_effect" class="banner clearfix">
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[0];?>" />
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[1];?>" />
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[2];?>" />
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[3];?>" />
                <img alt="banner" style="width:940px;height:383px;" src="<?php echo 'files/banners/'.$img[4];?>" />
            </div>
        </div>
        
        <div class="content clearfix">
            <div class="clearfix one">
                <div class="clearfix">
                    <div class="columna">
                        <?php 
                        $cont = $Contenido->get_list(1,'','activo = 1','');
                        $row_cont = Db::fetch_array($cont);
                        ?>
                        <div class="text clearfix">
                            <h2><?php echo $site_languages['nuestra_empresa']; ?></h2>
                            <p><?php echo $row_cont['nuestra_empresa_home_locale']; ?></p>
                            <div class="boton-gris eng">
                                <div class="left">&nbsp;</div>
                                <div class="medio">
                                    <a href="index.php?mod=nosotros">see more</a> </div>
                                <div class="right">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <!-- naranja-->
                    <div class="columna">
                        <div class="text clearfix">
                            <h2><?php echo $site_languages['mision']; ?></h2>
                            <p><?php echo $row_cont['mision_home_locale']; ?></p>
                            <div class="boton-gris eng">
                                <div class="left">&nbsp;</div>
                                <div class="medio"><a href="index.php?mod=nosotros" >see more</a></div>
                                <div class="right">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-img clearfix"><img alt="fachada la abundancia" src="images/public/img/la-abundancia-fachada.jpg" /></div>
            </div>
            <!--gris-->
            <div class="gris">
                <div class="up">&nbsp;</div>
                <div class="medio">
                    <h2><?php echo $site_languages['prods_destacados']; ?></h2>
                    <ul class="eng"> 
                        <?php
                        $lista_producto = $Producto->get_list(4, "", "es_home = 1", "");
                        $cont = 0;
                        while ($row_producto = Db::fetch_array($lista_producto)) {
                            $cont++;
                            ?>  
                        <li class="<?php if ($cont == 4) { echo "last"; } else { echo ""; } ?>">
                            <div class="image"><a href="#"><img src="<?php echo 'files/productos/destacado/'.$row_producto['imagen4'];?>" alt="<?php echo $row_producto['nombre_locale']; ?>"/></a></div>
                            <div class="text-product">
                                <h4><a href="#"><?php echo $row_producto['nombre_locale']; ?></a></h4>
                                <a href="#"><?php echo $row_producto['descripcion_corta_locale']; ?></a> 
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="button">&nbsp;</div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

