function abrir_formulario()
{
    centerPopup();
    loadPopup();
}
function abrir_formulario_login()
{
    centerPopup2();
    loadPopup2();
}
function registrar_usuario()
{
    var usuario = $("#usuario").val();
    var mail = $("#mail").val();
    var clave = $("#clave").val();
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var telefono = $("#telefono").val();
    var direccion = $("#direccion").val();
    var ciudad = $("#ciudad").val();
    var empresa = $("#empresa").val();
    var telefono_empresa = $("#telefono_empresa").val();
    var direccion_empresa = $("#direccion_empresa").val();
    var ciudad_empresa = $("#ciudad_empresa").val();
    
    if(usuario==""){ $("#usuario").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(mail==""){ $("#mail").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(clave==""){ $("#clave").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(nombre==""){ $("#nombre").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(apellido==""){ $("#apellido").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
        
    // Spinner
    $('#success_registro').hide();
    $('#error_registro').hide();
    $('.spinner').show();

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: "action=registro&usuario="+usuario+'&clave='+clave+'&nombre='+nombre+'&apellido='+apellido+'&ciudad='+ciudad+'&telefono_empresa='+telefono_empresa+'&direccion_empresa='+direccion_empresa+'&ciudad_empresa='+ciudad_empresa+'&mail='+mail+'&direccion='+direccion+'&telefono='+telefono+'&empresa='+empresa,
        success: function(data){
            if(data == 1){
                $('#success').html("Su registro se ha realizado correctamente.");
                $('.spinner').hide();
                $('#success_registro').fadeIn('slow');
                setTimeout('go_to("index.php?mod=redirect")', 1500);
            }else{
                $('#error').html(data);
                $('.spinner').hide();
                $('#error_registro').fadeIn('slow');
            }
        }
    });

}

function actualizar_usuario()
{
    var mail = $("#mail").val();
    var clave = $("#clave").val();
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var telefono = $("#telefono").val();
    var direccion = $("#direccion").val();
    var ciudad = $("#ciudad").val();
    var empresa = $("#empresa").val();
    var telefono_empresa = $("#telefono_empresa").val();
    var direccion_empresa = $("#direccion_empresa").val();
    var ciudad_empresa = $("#ciudad_empresa").val();
    
    if(mail==""){ $("#mail").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(nombre==""){ $("#nombre").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(apellido==""){ $("#apellido").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }

    // Spinner
    $('#success_registro').hide();
    $('#error_registro').hide();
    $('.spinner').show();

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: "action=actualizar&clave="+clave+'&nombre='+nombre+'&apellido='+apellido+'&mail='+mail+'&ciudad='+ciudad+'&telefono_empresa='+telefono_empresa+'&direccion_empresa='+direccion_empresa+'&ciudad_empresa='+ciudad_empresa+'&direccion='+direccion+'&telefono='+telefono+'&empresa='+empresa,
        success: function(data){
            if(data == 1){
                $('#success').html("Los datos se modificaron correctamente.");
                $('.spinner').hide();
                $('#success_registro').fadeIn('slow');
            }else{
                $('#error').html(data);
                $('.spinner').hide();
                $('#error_registro').fadeIn('slow');
            }
        }
    });

}


function recordar()
{
    var mail = $("#recordar_mail").val();

    if(mail==""){ $("#recordar_mail").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    
    // Quitamos el mensaje
    $('#success_registro_recordar').hide();
    $('#error_registro_recordar').hide();
    $("#spinner_recuperar").show();
    
    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: "action=recordar&mail="+mail,
        success: function(data){
            if(data == 1){
                $('#success_recordar').html("Se ha enviado un mail a su casilla.");
                $("#spinner_recuperar").hide();
                $('#success_registro_recordar').fadeIn('slow');
            }else{
                $('#error_recordar').html(data);
                $("#spinner_recuperar").hide();
                $('#error_registro_recordar').fadeIn('slow');
            }
        }
    });
}

function login()
{
    var usuario = $("#log_usuario").val();
    var clave = $("#log_clave").val();

    if(usuario==""){ $("#log_usuario").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(clave==""){ $("#log_clave").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    
    
    // Quitamos el mensaje
    $('#success_registro_log').hide();
    $('#error_registro_log').hide();
    $(".spinner").show();

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: "action=login&usuario="+usuario+'&clave='+clave,
        success: function(data){
            if(data == 1){
                $(".spinner").hide();
                $('#success_log').html("Datos correctos.");
                $('#success_registro_log').fadeIn('slow');
                setTimeout('go_to("index.php?mod=redirect")', 1000);
            }else{
                $(".spinner").hide();
                $('#error_log').html("Datos incorrectos.");
                $('#error_registro_log').fadeIn('slow');
            }
        }
    });
}

function go_to(link)
{
    if(link!='')
    {
        window.location.href=link;
    }
}


function enviar_comentario()
{
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var telefono = $("#telefono").val();
    var direccion = $("#direccion").val();
    var ciudad = $("#ciudad").val();
    var comentario = $("#comentario").val();
    
    if(nombre==""){ $("#nombre").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(apellido==""){ $("#apellido").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(comentario==""){ $("#comentario").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    
    // Spinner
    $('#success_contacto').hide();
    $('#error_contacto').hide();
    $('.spinner').show();

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: "action=contacto"+'&nombre='+nombre+'&apellido='+apellido+'&direccion='+direccion+'&ciudad='+ciudad+'&comentario='+comentario+'&telefono='+telefono,
        success: function(data){
            if(data == 1){
                $('#success').html("Su mensaje se ha enviado correctamente.");
                $('.spinner').hide();
                $('#success_contacto').fadeIn('slow');
            }else{
                $('#error').html(data);
                $('.spinner').hide();
                $('#error_contacto').fadeIn('slow');
            }
        }
    });
}

function enviar_comentario2()
{
    var nombres = $("#nombres").val();
    var apellidos = $("#apellidos").val();
    var doc_identidad = $("#doc_identidad").val();
    var correo = $("#correo").val();
    
    var id1 = $("#id1").val();
    var id2 = $("#id2").val();
    var id3 = $("#id3").val();
    var id4 = $("#id4").val();
    var id5 = $("#id5").val();
    var id6 = $("#id6").val();
    var id7 = $("#id7").val();
    var id8 = $("#id8").val();
    var id9 = $("#id9").val();
    var id10 = $("#id10").val();
    var id11 = $("#id11").val();
    var id12 = $("#id12").val();
    var id13 = $("#id13").val();
    var id14 = $("#id14").val();
    var id15 = $("#id15").val();
    var id16 = $("#id16").val();
    var id17 = $("#id17").val();
    var id18 = $("#id18").val();
    var id19 = $("#id19").val();
    var id20 = $("#id20").val();
    var id21 = $("#id21").val();
    var id22 = $("#id22").val();
    var id23 = $("#id23").val();
    var id24 = $("#id24").val();
    var id25 = $("#id25").val();
    var id26 = $("#id26").val();
    var id27 = $("#id27").val();
    var id28 = $("#id28").val();
    var id29 = $("#id29").val();
    var id30 = $("#id30").val();
    var id31 = $("#id31").val();
    var id32 = $("#id32").val();
    var id33 = $("#id33").val();
    
    if(nombres==""){ $("#nombres").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(apellidos==""){ $("#apellidos").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(doc_identidad==""){ $("#doc_identidad").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }
    if(correo==""){ $("#correo").effect("bounce", { times:3 }, 300, function(){ $(this).focus();} ); return; }

    // Spinner
    $('#success_contacto').hide();
    $('#error_contacto').hide();
    $('.spinner').show();
    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: "action=contacto2"+'&nombres='+nombres+'&apellidos='+apellidos+'&doc_identidad='+doc_identidad+'&correo='+correo+'&id1='+id1+'&id2='+id2+'&id3='+id3+'&id4='+id4+'&id5='+id5+'&id6='+id6+'&id7='+id7+'&id8='+id8+'&id9='+id9+'&id10='+id10+'&id11='+id11+'&id12='+id12+'&id13='+id13+'&id14='+id14+'&id15='+id15+'&id16='+id16+'&id17='+id17+'&id18='+id18+'&id19='+id19+'&id20='+id20+'&id21='+id21+'&id22='+id22+'&id23='+id23+'&id24='+id24+'&id25='+id25+'&id26='+id26+'&id27='+id27+'&id28='+id28+'&id29='+id29+'&id30='+id30+'&id31='+id31+'&id32='+id32+'&id33='+id33,
        success: function(data){
            if(data == 1){
                $('#success').html("Su mensaje se ha enviado correctamente.");
                $('.spinner').hide();
                $('#success_contacto').fadeIn('slow');
            }else{
                $('#error').html(data);
                $('.spinner').hide();
                $('#error_contacto').fadeIn('slow');
            }
        }
    });
}