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
        $data['nombre'] = _post('nombre');
        $data['nombre_locale'] = _post('nombre_locale');
        $data['descripcion_corta'] = _post('descripcion_corta');
        $data['descripcion_corta_locale'] = _post('descripcion_corta_locale');
        $data['descripcion_larga'] = _post('descripcion_larga');
        $data['descripcion_larga_locale'] = _post('descripcion_larga_locale');
        $data['categoria_padre_id'] = _post('padre');
        $data['activo'] = _post('activo');
        $data['orden'] = _post('orden');
        $data['modificado'] = time();

        // Validaciones
        if($data['categoria_padre_id'] != "0" && $Categoria->existe_categoria($data['categoria_padre_id']) == false ){
            
            $error = true;
            break;
        }


        if($id==""){
            // Nuevo
            if($Categoria->add($data)==false){ $error=true; }
            else{
                $id = Db::insert_id();
                $success = true;
            }
        }
        else
        {
            // Editar
            if($Categoria->update($data, $id)==false){ $error=true; }
            else{ $success = true; }
        }
        break;
}

// Inicializamos los datos
$nombre = '';
$nombre_locale = '';
$descripcion_corta = '';
$descripcion_corta_locale = '';
$descripcion_larga = '';
$descripcion_larga_locale = '';
$categoria_padre_id = '0';
$activo = '0';
$orden = '';

// Recuperamos el registro si es que estamos editando
$objeto = '';
if($id!='')
{
    $objeto = $Categoria->get($id);
    if($objeto==false)
    {
        header('location:adm.php?mod=categorias');
    }else
    {
        // Cargamos los datos en variables
        $nombre = $objeto['nombre'];
        $nombre_locale = $objeto['nombre_locale'];
        $descripcion_corta = $objeto['descripcion_corta'];
        $descripcion_corta_locale = $objeto['descripcion_corta_locale'];
        $descripcion_larga = $objeto['descripcion_larga'];
        $descripcion_larga_locale = $objeto['descripcion_larga_locale'];
        $categoria_padre_id = $objeto['categoria_padre_id'];
        $orden = $objeto['orden'];
        $activo = $objeto['activo'];
    }
}
?>
<script language="javascript">

function confirmar()
{
     $("#message-error").fadeOut("slow");
    var retorno = true;

    $("#nombre").removeClass("error");
     $("#nombre_locale").removeClass("error");
       $("#orden").removeClass("error");


    if($("#nombre").val()=="")
    {
        $("#nombre").addClass("error");
        retorno = false;
    }
    if($("#nombre_locale").val()=="")
    {
        $("#nombre_locale").addClass("error");
        retorno = false;
    }
    if($("#orden").val()=="")
    {
        $("#orden").addClass("error");
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
						<h5><?php  if($objeto=='' || $objeto==false){ echo "Nueva categoria"; }else{ echo "Editando..."; }?></h5>
                                                </div>
                                                <?php
                                                if($error)
                                                {?>
                                                 <div id="message-error" class="message message-error" style="display:none">
								<div class="image">
									<img src="resources/images/icons/error.png" alt="Error" height="32" />
								</div>
								<div class="text">
									<h6>Error</h6>
									<span>No se pudo guardar la Categoría</span>
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
									<span>La Categoría se ha guardado exitosamente.</span>
								</div>
								<div class="dismiss">
									<a href="#message-success"></a>
								</div>
							</div>
                                                    </div>
                                                <script language="javascript">
                                                    setTimeout('window.location = "adm.php?mod=categorias"', 1500);
                                                </script>
                                                <?php
                                                }
                                                ?>
					
					<!-- end box / title -->
                                        
                                        
					<form id="form" method="post" onsubmit="return confirmar()">
                                            <input type="hidden" name="accion" id="accion" value="guardar" />
                                            <input type="hidden" name="id" id="id" value="<?php echo $id?>" />
					<div class="form">
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
						<div class="fields">
							<div class="field  field-first">
                                                            <div class="label">
									<label for="nombre">*Nombre:</label>
								</div>
								<div class="input">
									<input type="text" id="nombre" value="<?php echo $nombre;?>" name="nombre" class="medium" />
                                                                        
								</div>
							</div>
                                                        <div class="field">
                                                            <div class="label">
									<label for="nombre_locale">*Nombre Inglés:</label>
								</div>
								<div class="input">
									<input type="text" id="nombre_locale" value="<?php echo $nombre_locale;?>" name="nombre_locale" class="medium" />
                                                                        
								</div>
							</div>
                                                        <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_corta">*Descripción Corta:</label>
                                                                    </div>
                                                                    <div class="textarea textarea-editor">
									<textarea id="descripcion_corta" name="descripcion_corta"  cols="50" rows="12" class="editor"><?php echo $descripcion_corta;?></textarea>
                                                                    </div>
                                                        </div>
                                                        <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_corta_locale">*Descripción Corta Inglés:</label>
                                                                    </div>
                                                                    <div class="textarea textarea-editor">
									<textarea id="descripcion_corta_locale" name="descripcion_corta_locale"  cols="50" rows="12" class="editor"><?php echo $descripcion_corta;?></textarea>
                                                                    </div>
                                                        </div>
                                                        <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_larga">*Descripción Larga:</label>
                                                                    </div>
                                                                    <div class="textarea textarea-editor">
									<textarea id="descripcion_larga" name="descripcion_larga"  cols="50" rows="12" class="editor"><?php echo $descripcion_larga;?></textarea>
                                                                    </div>
                                                        </div>
                                                        <div class="field">
                                                                <div class="label">
                                                                            <label for="descripcion_larga_locale">*Descripción Larga Inglés:</label>
                                                                </div>
                                                                <div class="textarea textarea-editor">
									<textarea id="descripcion_larga_locale" name="descripcion_larga_locale"  cols="50" rows="12" class="editor"><?php echo $descripcion_larga;?></textarea>
                                                                </div>
                                                        </div>
                                                        <div class="field">
								<div class="label">
									<label for="padre">Categoría Padre:</label>
								</div>
								<div class="select">
									<select id="padre" name="padre">
										<option value="0" selected="selected">Seleccione una categor&iacute;a...</option>
                                                                                    <?php
                                                                                    if($id==""){ $rst_categorias = $Categoria->get_list('','','activo=1'); }
                                                                                    else{ $rst_categorias = $Categoria->get_list('','','activo=1 AND categoria_id<>'.$id); }
                                                                                    while($categoria = db::fetch_array($rst_categorias)){
                                                                                    ?>
                                                                                    <option value="<?php echo $categoria['categoria_id'];?>" <?php if($categoria_padre_id==$categoria['categoria_id']){ echo 'selected="selected"'; }?> ><?php echo $Categoria->get_nombre($categoria['categoria_id']);?></option>
                                                                                    <?php }?>
									</select>
								</div>
							</div>
                                                        <div class="field">
                                                            <div class="label">
									<label for="orden">*Orden:</label>
								</div>
								<div class="input">
									<input type="text" id="orden" value="<?php echo $orden;?>" name="orden" class="small" />
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
