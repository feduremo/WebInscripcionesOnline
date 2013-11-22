<?php
ob_start();
// Creamos las clases necesarias
$Categoria = new Categoria();
$Producto = new Producto();
$Producto_Imagen = new Producto_Imagen();
$Producto_Categoria = new Producto_Categoria();
$Novedad = new Novedad();
$Receta = new Receta();
$Receta_Producto = new Receta_Producto();
$Receta_Imagen = new Receta_Imagen();
$Contenido = new Contenido();
$Contenido_Imagen = new Contenido_Imagen();
//$Producto = new Producto();
//$Producto_Producto = new Producto_Producto();
//$Producto_Categoria = new Producto_Categoria();
//$Usuario = new Usuario();

$modulo = _session('public_mod');
//$user_id = _session('id');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>La abundancia</title> 
        <link href="css/jquery.fancybox-1.3.4.css" rel="stylesheet" type ="text/css" media="screen" />
        <link href="css/slider/screen.css" rel="stylesheet" type ="text/css" media="screen" />
        <link href="css/styleAbundancia.css" rel="stylesheet" type ="text/css" media="screen" />
        <link href="css/jquery-ui-1.8.20.custom.css" rel="stylesheet" type ="text/css" media="screen" />
        <!--estos son los scrips de los jquerys y la hoja de estilo styleAbundancia-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
        
        
        <script type="text/javascript" src="js/fileupload/AjaxUpload.2.0.min.js"></script>
        <script type="text/javascript" src="js/fileupload/jquery-1.3.1.min.js"></script>
        
        <script src="js/easytabs.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="js/jquery.js"></script>        
        <script type="text/javascript" src="js/jquery.boxy.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/jquery.lightbox-0.5.min.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.7.3.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
        
        <script type="text/javascript" src="js/autocomplete/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/autocomplete/jquery-ui-1.8.20.custom.min.js"></script>
        <script type="text/javascript" src="js/autocomplete/json2.js"></script>        
               
        <script type="text/javascript" src="js/slider/easySlider1.7.js"></script>
        
        <script type="text/javascript" src="js/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>
        
        <script type="text/javascript" src="js/jquery.cycle.all.js"></script>
        
        

        <script type="text/javascript">
            //$('#slideshow2').slideshow({ timeout: 2000, fadetime: 2000, type: 'sequence' }); 
            
            $("#fade_effect").cycle({fx:'fade', speed:2000, requeueTimeout:5000});
        </script>
        
        <script type="text/javascript">

        $(document).ready(function(){	
                $("#slider").easySlider({
                        auto: true,
                        continuous: true,
                        speed: 1400
                });
        });

        </script>
        
        <script type="text/javascript">
            function mainmenu(){
                $(" #nav ul ").css({display: "none"});
                $(" #nav li").hover(function(){
                    $(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
                },function(){
                    $(this).find('ul:first').slideUp(400);
                });
            }
            $(document).ready(function(){
                mainmenu();
            });
        </script>
        <link href="css/styleMenu.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php if(_get("snd") == "1"){?>
        <script type="text/javascript">
            $(function(){
                alert("El mail ha sido enviado con exito");
            } );
        </script>
        <?php }?>
        <!--Contenido Header-->
        <!--Menu contenido dentro de Header-->
        <?php include_once(PUBLIC_PARTIALS . '_header.php'); ?>
        <!--Fin header-->

        <div class="container">
            <!--Comienza Contenido-->
            <?php include_once($modulo . '.php'); ?>
            <!--Fin Contenido-->

            <!--contenido footer-->
            <?php include_once(PUBLIC_PARTIALS . '_footer.php'); ?>
            <!--fin footer-->
        </div>
    </body>
</html>

<?php
ob_flush();
ob_end_clean();
?>