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
        $data['texto'] = _post('texto');
        $data['texto_locale'] = _post('texto_locale');
        $data['nombre_clave'] = _post('nombre_clave');
        
        // Validaciones
     
        if($id==""){
            // Nuevo
            if($Pagina->add($data)==false){ $error=true; }
            else{
                $id = Db::insert_id();
                $success = true;
            }
        }
        else
        {
            // Editar
            if($Pagina->update($data, $id)==false){ $error=true; }
            else{ $success = true; }
        }
        break;
}

// Inicializamos los datos
$titulo = '';
$texto_locale = '';
$titulo_locale = '';
$texto = '';
$nombre_clave = '';

// Recuperamos el registro si es que estamos editando
$objeto = '';
if($id!='')
{
    $objeto = $Pagina->get($id);
    if($objeto==false)
    {
        header('location:adm.php?mod=paginas');
    }else
    {
        // Cargamos los datos en variables
        $titulo = $objeto['titulo'];
        $titulo_locale = $objeto['titulo_locale'];
        $texto = $objeto['texto'];
        $texto_locale = $objeto['texto_locale'];
        $nombre_clave = $objeto['nombre_clave'];
         }
}
?>
<script language="javascript">



function confirmar()
{
    $("#message-error").fadeOut("slow");
    $("#titulo").removeClass("error");
    $("#titulo_locale").removeClass("error");
    $("#nombre_clave").removeClass("error");
    var ret = true;
    if($("#titulo").val()=="")
    {
        $("#titulo").addClass("error");

        ret = false;
    }
    if($("#titulo_locale").val()=="")
    {
        $("#titulo_locale").addClass("error");

        ret = false;
    }
     if($("#nombre_clave").val()=="")
    {
        $("#nombre_clave").addClass("error");

        ret = false;
    }
    if (!ret) {
        $("#message-error").fadeIn("slow");
    }

    return ret;
}

</script>

<div class="box">

					<!-- box / title -->
					<div class="title">
						<h5><?php  if($objeto=='' || $objeto==false){ echo "Nueva página"; }else{ echo "Editando..."; }?></h5>
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
                                                    setTimeout('window.location = "adm.php?mod=paginas"', 1500);
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
									<label for="nombre">*Título:</label>
								</div>
								<div class="input">
									<input type="text" id="titulo" value="<?php echo $titulo;?>" name="titulo" class="medium" />

								</div>
							</div>
                                                        <div class="field">
                                                            <div class="label">
									<label for="titulo_locale">*Título Inglés:</label>
								</div>
								<div class="input">
									<input type="text" id="titulo_locale" value="<?php echo $titulo_locale;?>" name="titulo_locale" class="medium" />

								</div>
							</div>
                                                        <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_corta">*Texto:</label>
                                                                    </div>
                                                                    <div class="textarea textarea-editor">
									<textarea id="texto" name="texto"  cols="50" rows="12" class="editor"><?php echo $texto;?></textarea>
                                                                    </div>
                                                        </div>
                                                        <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_corta_locale">*Texto Inglés:</label>
                                                                    </div>
                                                                    <div class="textarea textarea-editor">
									<textarea id="texto_locale" name="texto_locale"  cols="50" rows="12" class="editor"><?php echo $texto_locale;?></textarea>
                                                                    </div>
                                                        </div>
                                                        <div class="field">
                                                            <div class="label">
                                                                            <label for="nombre_clave">*Nombre Clave:</label>
                                                                    </div>
								<div class="input">
									<input type="text" id="nombre_clave" value="<?php echo $nombre_clave;?>" name="nombre_clave" class="medium" />
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
