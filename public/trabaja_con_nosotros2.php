<?php
$Tracking = Tracking::load();
$Tracking->add('index.php?mod=trabaja_con_nosotros');
$Tracking->save();

$e_mail = "";
$doc_identidad = "";
$nombres = "";
$apellidos = "";
?>
<script language="javascript">
$(document).ready(function(){
    var button = $('#upload_button'), interval;
    new AjaxUpload('#upload_button', {
        action: 'upload.php',
        onSubmit : function(file , ext){
        if (! (ext && /^(jpg|png|jpeg|gif|txt)$/.test(ext))){
            // extensiones permitidas
            alert('Error: Solo se permiten imagenes');
            // cancela upload
            return false;
        } else {
             //Cambio el texto del boton y lo deshabilito
            button.text('Uploading');
            this.disable();
        }
        },
        onComplete: function(file, response){
            button.text('Upload');
            // habilito upload button                       
            this.enable();          
            // Agrega archivo a la lista
            $('#lista').appendTo('.files').text(file);
        }   
    });
});
</script>
<!--contenido-->
<div class="main clearfix">
    <div class="container clearfix">
        <div class="titulo-pruducto clearfix"> 
            <div class="left">&nbsp;</div>
            <div class="medio">
                <ul>
                    <li class="izquierda">Trabajar con Nosotros</li>
                    <li class="derecha"><img alt="flecha" src="images/public/img/flecha-prod.png" /></li>
                </ul>	
            </div>	
            <div class="right">&nbsp;</div>	
        </div> 
        <div class="content clearfix">
            <p>Si usted está interesado en trabajar con nosotros, por favor llene el siguiente formulario.<br />
               El mismo consta de 4 (cuatro) partes según la información que es solicitada.<br />
               En cada una de las partes, los datos que son obligatorios se identificarán con fondo color crema y borde rojo.<br />
               En la última parte del formulario usted tendrá la opción de adjuntar un archivo con información adicional.
            </p>
            <div class="contacto clearfix last">
                <br />
                <h3 class="form">Identificaci&oacute;n</h3>
                <br />                
                <ul >
                    <li><label>Correo Electr&oacute;nico:</label><input type="text" id="correo" /></li>
                    <li><label>Documento de Identidad:</label><input type="text" id="doc_identidad" /></li>
                </ul>
                <ul>
                    <li><label>Nombres:</label><input type="text" id="nombres" /></li>
                    <li><label>Apellidos:</label><input type="text" id="apellidos" /></li>                    
                </ul>
                <h3 class="form">Solicitud de Empleo</h3>
                <br />
                <ul >
                    <li><label>Fecha Nacimiento:</label><input type="text" id="id1" /></li>
                    <li><label>Dirección:</label><input type="text" id="id2" /></li>
                    <li><label>Barrio:</label><input type="text" id="id3" /></li>
                    <li><label>Depto:</label><input type="text" id="id4" /></li>
                    <li><label></label></li>
                    
                </ul>
                <ul>
                    <li><label>Celular:</label><input type="text" id="id5" /></li>
                    <li><label>Teléfono:</label><input type="text" id="id6" /></li>
                    <li><label>Estado Civil:</label><input type="text" id="id7" /></li>
                    <li><label>Hijos:</label><input type="text" id="id8" /></li>
                    <li><label>Cuantos?</label><input type="text" id="id9" /></li>
                </ul>
                <h3 class="form">Núcleo Familiar</h3>
                <br />
                <ul >
                    <li><label>Nombre y Apellido:</label><input type="text" id="id10" /></li>
                    <li><label>Relación:</label><input type="text" id="id11" /></li>
                    <li><label>Actividad:</label><input type="text" id="id12" /></li>
                    <li><label>Empresa:</label><input type="text" id="id13" /></li>
                    <li><label>Teléfono:</label><input type="text" id="id14" /></li>
                    <li><label></label></li>
                    
                </ul>
                <ul>                  
                    <li><label>Institución Primaria:</label><input type="text" id="id15" /></li>
                    <li><label>Institución Secunadria:</label><input type="text" id="id16" /></li>
                    <li><label>Institución Terciaria:</label><input type="text" id="id17" /></li>
                    <li><label>Carrera/Oficio:</label><input type="text" id="id18" /></li>
                    <li><label>Años completos:</label><input type="text" id="id19" /></li>
                    <li><label>Otros Estudios:</label><input type="text" id="id20" /></li>
                </ul>
                <h3 class="form">Experiencia Laboral</h3>
                <br />
                <ul >
                    <li><label>Está trabajando actualmente?</label><input type="text" id="id21" /></li>
                    <li><label>Tarea?</label><input type="text" id="id22" /></li>
                </ul>
                <ul>
                    <li><label>Donde?</label><input type="text" id="id23" /></li>
                    <li><label>Horario?</label><input type="text" id="id24" /></li>
                </ul>
                <h3 class="form">Experiencia Anterior</h3>
                <br />
                <ul >
                    <li><label>Empresa:</label><input type="text" id="id25" /></li>
                    <li><label>Fecha Ingreso:</label><input type="text" id="id26" /></li>
                    <li><label>Teléfono:</label><input type="text" id="id27" /></li>
                    <li><label>Dirección:</label><input type="text" id="id28" /></li>
<!--                    <form name="form" action="" method="POST" enctype="multipart/form-data">-->
<!--                    <li><input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input"><button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">Adjuntar</button></li>-->
<!--                    </form>-->
<div id="upload_button">Upload</div>
<ul id="lista">
</ul>
                </ul>
                <ul>                    
                    <li><label>Fecha Egreso:</label><input type="text" id="id29" /></li>
                    <li><label>Cargo Ocupado:</label><input type="text" id="id30" /></li>
                    <li><label>Tareas Realizadas:</label><input type="text" id="id31" /></li>
                    <li><label>Voluntario?</label><input type="text" id="id32" /></li>
                    <li><label>Causal:</label><input type="text" id="id33" /></li>
                    <br />
                    <li> 
                        <div class="boton-contacto "> 
                            <div class="left">&nbsp;</div>
                            <div class="medio" ><a style="cursor:pointer" onclick="javascript: enviar_comentario2()"> enviar</a> </div>	
                            <div class="right">&nbsp;</div>
                        </div> 
                    </li>
                </ul>
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
            </div>
        </div>  
    </div>  
</div>