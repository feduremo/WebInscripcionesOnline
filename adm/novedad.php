<?php
if(!Security::is_logged_in())
{
    header('location:adm.php?mod=index');
}

// Traemos el id
$id = _request('id');

// Ejecucion de la accion
$error = false;
$success = false;
$accion = _post('accion');
switch($accion)
{
    case 'guardar':
        $data = array();
        $data['titulo'] = _post('titulo');
        $data['titulo_locale'] = _post('titulo_locale');
        $data['texto_corto'] = _post('texto_corto');
        $data['texto_corto_locale'] = _post('texto_corto_locale');
        $data['texto_largo'] = _post('texto_largo');
        $data['texto_largo_locale'] = _post('texto_largo_locale');
        $data['imagen'] = _post('imagen');
        $data['activo'] = _post('activo');
        $data['link'] = _post('link');
        $data['modificado'] = time();

        if($id=="")
        {
            // Nuevo
            if($Novedad->add($data)==false){ $error=true; }
            else{ $id = Db::insert_id(); $success = true; }
        }
        else
        {
            // Editar
            if($Novedad->update($data, $id)==false){ $error=true; }
            else{ $success = true; }
        }
        break;
}

// Inicializamos los datos
$titulo = '';
$titulo_locale = '';
$texto_corto='';
$texto_corto_locale='';
$texto_largo='';
$texto_largo_locale='';
$imagen = '';
$activo = '0';
$link = '';

// Recuperamos el registro si es que estamos editando
$objeto = '';
if($id!='')
{
    $objeto = $Novedad->get($id);
    if($objeto==false)
    {
        header('location:adm.php?mod=novedades');
    }else
    {
        // Cargamos los datos en variables
        $titulo = $objeto['titulo'];
        $titulo_locale = $objeto['titulo_locale'];
        $activo = $objeto['activo'];
        $texto_corto = $objeto['texto_corto'];
        $texto_corto_locale = $objeto['texto_corto_locale'];
        $texto_largo = $objeto['texto_largo'];
        $texto_largo_locale = $objeto['texto_largo_locale'];
        $imagen = $objeto['imagen'];
        $link = $objeto['link'];
    }
}
?>
<script language="javascript">

function confirmar()
{

    $("#message-error").fadeOut("slow");
    var retorno = true;

    $("#titulo").removeClass("error");
     $("#titulo_locale").removeClass("error");
      $("#imagen").removeClass("error");
        

    if($("#titulo").val()=="")
    {
        $("#titulo").addClass("error");
        retorno = false;
    }
    if($("#titulo_locale").val()=="")
    {
        $("#titulo_locale").addClass("error");
        retorno = false;
    }

    if($("#imagen").val()=="")
    {
        $("#imagen").addClass("error");
        retorno = false;
    }
    if($("#descripcion_corta").val()=="")
    {
        $("#descripcion_corta").addClass("error");
        retorno = false;
    }
    if($("#descripcion_corta_locale").val()=="")
    {
        $("#descripcion_corta_locale").addClass("error");
        retorno = false;
    }
    if($("#descripcion_larga").val()=="")
    {
        $("#descripcion_larga").addClass("error");
        retorno = false;
    }
    if($("#descripcion_larga_locale").val()=="")
    {
        $("#descripcion_larga_locale").addClass("error");
        retorno = false;
    }
     if (!retorno) {
        $("#message-error").fadeIn("slow");
    }

        return retorno;
}


</script>
<div class="box">

					<!-- box / title -->
					<div class="title">
						<h5><?php  if($objeto=='' || $objeto==false){ echo "Nueva novedad"; }else{ echo "Editando..."; }?></h5>
                                                </div>
                                                <?php
                                                if($error)
                                                {?>
                                                 <div class="messages">
                                            <div id="message-error" class="message message-error" style="display:none">
								<div class="image">
									<img src="resources/images/icons/error.png" alt="Error" height="32" />
								</div>
								<div class="text">
									<h6>Error</h6>
									<span>No se pudo guardar el Producto</span>
								</div>
								<div class="dismiss">
									<a href="#message-error"></a>
								</div>
							</div>
                                            </div><br>
                                                <?php
                                                }
                                                if($success)
                                                {?>
                                                <div class="messages">
                                                <div id="message-success" class="message message-success">
								<div class="image">
									<img src="resources/images/icons/success.png" alt="Success" height="32" />
								</div>
								<div class="text">
									<h6>Aviso</h6>
									<span>La Página se ha guardado exitosamente.</span>
								</div>
								<div class="dismiss">
									<a href="#message-success"></a>
								</div>
							</div>
                                                    </div>
                                                <script language="javascript">
                                                    setTimeout('window.location = "adm.php?mod=novedades"', 1500);
                                                </script>
                                                <?php
                                                }
                                                ?>
					
					<!-- end box / title -->
                                         <div class="messages">
                                            <div id="message-error" class="message message-error" style="display:none">
								<div class="image">
									<img src="resources/images/icons/error.png" alt="Error" height="32" />
								</div>
								<div class="text">
									<h6>Error</h6>
									<span>Ingrese todos los datos marcados con (*)</span>
								</div>
								<div class="dismiss">
									<a href="#message-error"></a>
								</div>
							</div>
                                            </div>


					<form id="form" method="post" onsubmit="return confirmar()">
                                            <input type="hidden" name="accion" id="accion" value="guardar" />
                                            <input type="hidden" name="id" id="id" value="<?php echo $id?>" />
					<div class="form">
						<div class="fields">
							<div class="field  field-first">
                                                            <div class="label">
									<label for="titulo">Título:</label>
								</div>
								<div class="input">
									<input type="text" id="titulo" value="<?php echo $titulo;?>" name="titulo" class="medium" />

								</div>
							</div>
                                                        <div class="field">
								<div class="label">
									<label for="titulo_locale">Título Inglés:</label>
								</div>
								<div class="input">
									<input type="text" id="titulo_locale" name="titulo_locale" class="medium" value="<?php echo $titulo_locale;?>" />
								</div>
							</div>
                                                     <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_corta">Descripción Corta:</label>
                                                                    </div>
                                                                    <div class="textarea textarea-editor">
									<textarea id="texto_corto" name="texto_corto"  cols="50" rows="12" class="editor"><?php echo $texto_corto;?></textarea>
                                                                    </div>
                                                        </div>
                                                        <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_corta_locale">Descripción Corta Inglés:</label>
                                                                    </div>
                                                                    <div class="textarea textarea-editor">
									<textarea id="texto_corto_locale" name="texto_corto_locale"  cols="50" rows="12" class="editor"><?php echo $texto_corto_locale;?></textarea>
                                                                    </div>
                                                        </div>
                                                        <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_larga">Descripción Larga:</label>
                                                                    </div>
                                                                    <div class="textarea textarea-editor">
									<textarea id="texto_largo" name="texto_largo"  cols="50" rows="12" class="editor"><?php echo $texto_largo;?></textarea>
                                                                    </div>
                                                        </div>
                                                        <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_larga_locale">Descripción Larga Inglés:</label>
                                                                </div>
                                                                <div class="textarea textarea-editor">
									<textarea id="texto_largo_locale" name="texto_largo_locale"  cols="50" rows="12" class="editor"><?php echo $texto_largo_locale;?></textarea>
                                                                </div>
                                                        </div>
                                                    <div class="field">
								<div class="label">
									<label for="link">Link:</label>
								</div>
								<div class="input">
									<input type="text" id="link" name="link" class="medium" value="<?php echo $link;?>" />
								</div>
							</div>
                                                        
                                                        <div class="field">
								<div class="label">
									<label for="imagen">Imagen:</label>
								</div>
								<div class="input">
									<input type="text" id="imagen" name="imagen" size="40" value="<?php echo $imagen; ?>" /><div class="link-imagen"><a onclick="window.open('adm.php?mod=pick_file&target=imagen&path=files/novedades/', 'Seleccionar Archivos', 'width=500,height=510,scrollbars=0,resizable=0,location=NO,menubar=0,status=NO,titlebar=0,toolbar=0');">Seleccionar Imagen</a></div>
								</div>
							</div>

                                                        <div class="field">
                                                        <div class="label">
									<label for="activo">Activo:</label>
								</div>
								<div class="select">
									<select id="activo" name="activo">
										<option value="1" <?php  if($activo=='1'){ echo "selected=selected";}?>>Si</option>
                                                                                <option value="0" <?php  if($activo=='0'){ echo "selected=selected";}?>>No</option>

									</select>
								</div>
                                                    </div>

                                                    <div class="buttons">
                                                      <div class="highlight">
                                                         <input type="submit" name="submit" value="Aceptar" />
                                                      </div>
                                                        <input type="reset" name="reset" value="Resetear" />
                                                    </div>
                                                </div>
                                        </div>


                                        </form>


</div>
