<?php

$nombre = "";
$apellido = "";
$asunto = "";
$telefono = "";

?>

<!--contenido-->
<div class="main clearfix">
    <div class="container clearfix">
        <div class="titulo-pruducto clearfix"> 
            <div class="left">&nbsp;</div>
            <div class="medio">
                <ul>
                    <li class="izquierda"><?php if($lang=='es'){ echo "Contactate con nosotros"; } else { echo "Contact us"; } ?></li>
                    <li class="derecha"><img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                </ul>	
            </div>	
            <div class="right">&nbsp;</div>	
        </div> 
        <div class="content clearfix">
            <div class="contacto clearfix">
                <ul class="chico">
                    <li><h2>La abundancia<br />Silcom S.A.</h2></li>
                    <li><?php echo $site_languages['dir']; ?>: Córdoba 731</li>
                    <li><?php echo $site_languages['zp']; ?>: 11900</li>
                    <li><?php echo $site_languages['phone']; ?>.:+598 2306 0680</li>
                    <li>Fax: 2306 0680 int 203 y 207</li>
                    <li>Mail: silcom@silcom.com.uy</li>
                    <li>Montevideo - Uruguay  </li>
                </ul>
                <ul class="grande">
                    <li class="imagen">
                       
                        
                        <iframe width="479" height="305" frameborder="0" scrolling="no"

marginheight="0" marginwidth="0"

src="https://maps.google.com/maps?q=-34.834871,-56.24975&amp;num=1&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=-34.839626,-56.250257&amp;output=embed"></iframe><br

/><small><a

href="https://maps.google.com/maps?q=-34.834871,-56.24975&amp;num=1&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=-34.839626,-56.250257&amp;source=embed"

style="color:#0000FF;text-align:left"><?php if($lang=='es'){ echo "Ver mapa más grande"; } else { echo "See the map bigger"; } ?></a></small>
                    </li>
                </ul>
            </div>
            <div class="contacto clearfix last">
                <!--Errores-->
                <div style="float:left; margin-right: 20px;">
                    <div id="error" class="div_error_ext" style="width:270px;float:left;margin-bottom:15px;">
                        <div class="div_error_int"><span id="error"></span></div>
                    </div>
                    <div id="success" class="div_success_ext" style="width:270px;float:left;margin-bottom:15px;">
                        <div class="div_success_int"><span id="success"></span></div>
                    </div>
                </div>
                <!--Fin Errores-->
                <ul >
                    <li><label> <?php echo $site_languages['contact1']; ?> </label><input type="text" id="nombre" /></li>
                    <li><label> <?php echo $site_languages['contact2']; ?> </label><input type="text" id="apellido" /></li>
                    <li><label> <?php echo $site_languages['contact3']; ?> </label><input type="text" id="telefono" /></li>
                </ul>
                <ul>
                    <li><label> <?php echo $site_languages['contact4']; ?> </label><input type="text" id="asunto" /></li>
                    <li><label> <?php echo $site_languages['contact5']; ?> </label><input class="mensaje" type="text" id="mensaje" /></li>
                    <li> 
                        <div class="boton-contacto "> 
                            <div class="left">&nbsp;</div>
                            <div class="medio" ><a style="cursor:pointer" onclick="javascript: enviar_comentario()"> <?php if($lang=='es'){ echo "enviar"; } else { echo "send"; } ?></a> </div>	
                            <div class="right">&nbsp;</div>
                        </div> 
                    </li>
                </ul>
            </div>
        </div>  
    </div>  
</div>