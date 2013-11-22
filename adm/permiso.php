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
        $data['nombre_clave'] = _post('nombre_clave');
        $data['descripcion'] = _post('descripcion');

        if($id=="")
        {
            // Nuevo
            //$data['creado'] = date('Y-m-d');
            if($Permiso->add($data)==false){ $error=true; }
            else{ $id = Db::insert_id(); $success = true; }
        }
        else
        {
            // Editar
            if($Permiso->update($data, $id)==false){ $error=true; }
            else{ $success = true; }
        }
        break;
}

// Inicializamos los datos
$nombre = '';
$nombre_clave = '';
$descripcion='';

// Recuperamos el registro si es que estamos editando
$objeto = '';
if($id!='')
{
    $objeto = $Permiso->get($id);
    if($objeto==false)
    {
        header('location:adm.php?mod=permisos');
    }else
    {
        // Cargamos los datos en variables
        $nombre = $objeto['nombre'];
        $nombre_clave = $objeto['nombre_clave'];
        $descripcion=$objeto['descripcion'];
    }
}
?>
<script language="javascript">

function confirmar()
{

    $("#message-error").fadeOut("slow");
    var retorno = true;

    $("#nombre").removeClass("error");
     $("#nombre_clave").removeClass("error");
       $("#descripcion").removeClass("error");


    if($("#nombre").val()=="")
    {
        $("#nombre").addClass("error");
        retorno = false;
    }
    if($("#nombre_clave").val()=="")
    {
        $("#nombre_clave").addClass("error");
        retorno = false;
    }
    if($("#descripcion").val()=="")
    {
        $("#descripcion").addClass("error");
        retorno = false;
    }

    if (!retorno) {
        $("#message-error").fadeIn("slow");
    }
        $("#accion").val("guardar");
        return retorno;

}

$(function(){
    $('#fecha').datepicker();
})
</script>
<div class="box">

					<!-- box / title -->
					<div class="title">
						<h5><?php  if($objeto=='' || $objeto==false){ echo "Nuevo permiso"; }else{ echo "Editando..."; }?></h5>
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
									<span>No se pudo guardar el Permiso</span>
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
									<span>El Permiso se ha guardado exitosamente.</span>
								</div>
								<div class="dismiss">
									<a href="#message-success"></a>
								</div>
							</div>
                                                    </div>
                                                <script language="javascript">
                                                    setTimeout('window.location = "adm.php?mod=permiso"', 1500);
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

							</div>
                                            </div>

					<form id="form" method="post" onsubmit="return confirmar()">
                                            <input type="hidden" name="accion" id="accion" value="guardar" />
                                            <input type="hidden" name="id" id="id" value="<?php echo $id?>" />
					<div class="form">
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
									<label for="nombre_clave">*Nombre Clave:</label>
								</div>
								<div class="input">
									<input type="text" id="nombre_clave" value="<?php echo $nombre_clave;?>" name="nombre_clave" class="medium" />

								</div>
							</div>
                                                         <div class="field">
                                                            <div class="label">
									<label for="descripcion">*Descripción:</label>
								</div>
								<div class="textarea textarea-editor">
                                                                    <textarea  id="descripcion" name="descripcion" cols="50" rows="12" class="editor" ><?php echo $descripcion;?></textarea>

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