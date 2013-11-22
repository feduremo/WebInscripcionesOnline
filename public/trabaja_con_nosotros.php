<?php
$Tracking = Tracking::load();
$Tracking->add('index.php?mod=trabaja_con_nosotros');
$Tracking->save();

$e_mail = "";
$doc_identidad = "";
$nombres = "";
$apellidos = "";
?>

<script type="text/javascript">
    function validar_form_abundancia(){
        if($("#email").val() == ''){ alert("Debe escribir el Email"); return false; }
        if($("#doc_identidad").val() == ''){ alert("Debe escribir la CI"); return false; }
        if($("#nombres").val() == ''){ alert("Debe escribir el nombre"); return false; }
        if($("#apellidos").val() == ''){ alert("Debe escribir el apellido"); return false; }
        if($("#id1").val() == ''){ alert("Debe escribir la fecha de nacimiento"); return false; }
        if($("#id2").val() == ''){ alert("Debe escribir la direcci&oacute;n"); return false; }
        if($("#id3").val() == ''){ alert("Debe escribir el barrio"); return false; }
        if($("#id4").val() == ''){ alert("Debe escribir el departamento"); return false; }
        if($("#id5").val() == ''){ alert("Debe escribir el celular"); return false; }
        if($("#id6").val() == ''){ alert("Debe escribir el telefono"); return false; }
        if($("#id7").val() == ''){ alert("Debe escribir el estado civil"); return false; }
        if($("#id8").val() == ''){ alert("Debe nombrar los hijos"); return false; }
        if($("#id9").val() == ''){ alert("Debe nombrar la cantidad de hijos"); return false; }
        if($("#id10").val() == ''){ alert("Debe escribir el nombre y apellido"); return false; }
        if($("#id11").val() == ''){ alert("Debe escribir la relacion"); return false; }
        if($("#id12").val() == ''){ alert("Debe escribir la actividad"); return false; }
        if($("#id13").val() == ''){ alert("Debe escribir la empresa"); return false; }
        if($("#id14").val() == ''){ alert("Debe escribir el tel&eacute;fono"); return false; }
        if($("#id15").val() == ''){ alert("Debe escribir la institucion primaria"); return false; }
        if($("#id16").val() == ''){ alert("Debe escribir la institucion secundaria"); return false; }
        if($("#id17").val() == ''){ alert("Debe escribir la institucion terciaria"); return false; }
        if($("#id18").val() == ''){ alert("Debe escribir la carrera"); return false; }
        if($("#id19").val() == ''){ alert("Debe escribir los a&ntilde;os completos"); return false; }
        if($("#id20").val() == ''){ alert("Debe escribir otros estudios"); return false; }
        if($("#id21").val() == ''){ alert("Debe escribir si esta trabajando actualmente"); return false; }
        if($("#id22").val() == ''){ alert("Debe escribir la tarea que realiza"); return false; }
        if($("#id23").val() == ''){ alert("Debe escribir donde trabaja"); return false; }
        if($("#id24").val() == ''){ alert("Debe escribir el horario que realiza"); return false; }
        if($("#id25").val() == ''){ alert("Debe escribir la empresa"); return false; }
        if($("#id26").val() == ''){ alert("Debe escribir la fecha de ingreso"); return false; }
        if($("#id27").val() == ''){ alert("Debe escribir el tel&eacute;fono"); return false; }
        if($("#id28").val() == ''){ alert("Debe escribir la direcci&oacute;n"); return false; }
        if($("#id29").val() == ''){ alert("Debe escribir la fecha de egreso"); return false; }
        if($("#id30").val() == ''){ alert("Debe escribir el cargo ocupado"); return false; }
        if($("#id31").val() == ''){ alert("Debe escribir las tareas realizadas"); return false; }
        if($("#id32").val() == ''){ alert("Debe escribir voluntario"); return false; }
        if($("#id33").val() == ''){ alert("Debe escribir causal"); return false; }
        return true;
    }
    
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
            <p>Si usted est&aacute; interesado en trabajar con nosotros, por favor llene el siguiente formulario.<br />
               El mismo consta de 4 (cuatro) partes seg&uacute;n la informaci&oacute;n que es solicitada.<br />
               En cada una de las partes, los datos que son obligatorios se identificar&aacute;n con un asterisco al lado del titulo.<br />
               En la &uacute;ltima parte del formulario usted tendr&aacute; la opción de adjuntar un archivo con informaci&oacute;n adicional.
            </p>
            <form name='formulario' id='formulario' method='post' onsubmit="return validar_form_abundancia()" action='index.php?mod=enviar' target='_self' enctype="multipart/form-data">
            <div class="contacto clearfix last">
                <br />
                <h3 class="form">Identificaci&oacute;n</h3>
                <br />                
                <ul >
                    <li><label>*Correo Electr&oacute;nico:</label><input type="text" id="email" name="Email"/></li>
                    <li><label>*Documento de Identidad:</label><input type="text" id="doc_identidad" name="Documento de Identidad" /></li>
                </ul>
                <ul>
                    <li><label>*Nombres:</label><input type="text" id="nombres" name="Nombres"/></li>
                    <li><label>*Apellidos:</label><input type="text" id="apellidos" name="Apellidos" /></li>                    
                </ul>
                <h3 class="form">Solicitud de Empleo</h3>
                <br />
                <ul >
                    <li><label>*Fecha Nacimiento:</label><input type="text" id="id1" name="Fecha de Nacimiento" /></li>
                    <li><label>*Direcci&oacute;n:</label><input type="text" id="id2" name="Direccion" /></li>
                    <li><label>*Barrio:</label><input type="text" id="id3" name="Barrio" /></li>
                    <li><label>*Depto:</label><input type="text" id="id4" name="Depto" /></li>
                    <li><label></label></li>
                    
                </ul>
                <ul>
                    <li><label>*Celular:</label><input type="text" id="id5" name="Celular" /></li>
                    <li><label>*Tel&eacute;fono:</label><input type="text" id="id6" name="Tel" /></li>
                    <li><label>*Estado Civil:</label><input type="text" id="id7" name="Estado Civil" /></li>
                    <li><label>*Hijos:</label><input type="text" id="id8" name="Hijos" /></li>
                    <li><label>*Cuantos?</label><input type="text" id="id9" name="Cuantos?" /></li>
                </ul>
                <h3 class="form">N&uacute;cleo Familiar</h3>
                <br />
                <ul >
                    <li><label>*Nombre y Apellido:</label><input type="text" id="id10" name="Nombre y Apellido" /></li>
                    <li><label>*Relaci&oacute;n:</label><input type="text" id="id11" name="Relacion" /></li>
                    <li><label>*Actividad:</label><input type="text" id="id12" name="Actividad" /></li>
                    <li><label>*Empresa:</label><input type="text" id="id13" name="Empresa" /></li>
                    <li><label>*Tel&eacute;fono:</label><input type="text" id="id14" name="Tel" /></li>
                    <li><label></label></li>
                    
                </ul>
                <ul>                  
                    <li><label>*Instituci&oacute;n Primaria:</label><input type="text" id="id15" name="Institucion Primaria" /></li>
                    <li><label>*Instituci&oacute;n Secunadria:</label><input type="text" id="id16" name="Institucion Secunadria" /></li>
                    <li><label>*Instituci&oacute;n Terciaria:</label><input type="text" id="id17" name="Institucion Terciaria"/></li>
                    <li><label>*Carrera/Oficio:</label><input type="text" id="id18" name="Carrera/Oficio" /></li>
                    <li><label>*A&ntilde;os completos:</label><input type="text" id="id19" name="Años Completos" /></li>
                    <li><label>*Otros Estudios:</label><input type="text" id="id20" name="Otros Estudios"/></li>
                </ul>
                <h3 class="form">Experiencia Laboral</h3>
                <br />
                <ul >
                    <li><label>*Est&aacute; trabajando actualmente?</label><input type="text" id="id21" name="Esta trabajando actualmente"/></li>
                    <li><label>*Tarea?</label><input type="text" id="id22" name="Tarea?"/></li>
                </ul>
                <ul>
                    <li><label>*Donde?</label><input type="text" id="id23" name="Donde?"/></li>
                    <li><label>*Horario?</label><input type="text" id="id24" name="Horario?" /></li>
                </ul>
                <h3 class="form">Experiencia Anterior</h3>
                <br />
                <ul >
                    <li><label>*Empresa:</label><input type="text" id="id25" name="Empresa" /></li>
                    <li><label>*Fecha Ingreso:</label><input type="text" id="id26" name="Fecha Ingreso"/></li>
                    <li><label>*Tel&eacute;fono:</label><input type="text" id="id27" name="Tel" /></li>
                    <li><label>*Direcci&oacute;n:</label><input type="text" id="id28" name="Direccion"/></li>
                    <li><label>Adjuntar archivo:</label><input type='file' name='archivo1' id='archivo1'></li>
                </ul>
                <ul>                    
                    <li><label>*Fecha Egreso:</label><input type="text" id="id29" name="Fecha Egreso"/></li>
                    <li><label>*Cargo Ocupado:</label><input type="text" id="id30" name="Cargo Ocupado"/></li>
                    <li><label>*Tareas Realizadas:</label><input type="text" id="id31" name="Tareas realizadas"/></li>
                    <li><label>*Voluntario?</label><input type="text" id="id32" name="Voluntario?"/></li>
                    <li><label>*Causal:</label><input type="text" id="id33" name="Causal"/></li>
                    <br />
                    <li> 
                        <div class="boton-contacto "> 
                            <div class="left">&nbsp;</div>
                            <div class="medio" ><input class="curriculum" type='submit' value='Enviar'></div>	
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
            </form>
        </div>  
    </div>  
</div>