<?php
if (Security::is_logged_in('administrador')) {
    header('location:adm.php?mod=principal');
}

$accion = _post('accion');
$error_login = false;
if ($accion == 'login') {
    $usuario = _post('username');
    $password = _post('password');

    $cantidad = $Administrador->count("activo=1 AND usuario='" . $usuario . "' AND clave='" . $password . "'");

    if ($cantidad > 0) {
        $id = $Administrador->get_by_name("activo=1 AND usuario='" . $usuario . "' AND clave='" . $password . "'");
        set_session('administrador', true);
        set_session('id', $id);
        header('location:adm.php?mod=principal');
    } else {
        $error_login = true;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Inscripciones Online</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <!-- stylesheets -->
        <link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
        <link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/blue.css" />
        <!-- scripts (jquery) -->
        <script src="resources/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
        <script src="resources/scripts/jquery-ui-1.8.custom.min.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.js" type="text/javascript"></script>
        <script type="text/javascript">
            function ingresar()
            {
                $("#error-incorrecto").hide();
                if ($("#username").val() == "" || $("#password").val() == "")
                {
                    $('#error-vacio').fadeIn('slow');
                    return false;
                }
                $('#error-vacio').fadeOut('slow');
            }
            $(document).ready(function() {
                $("input.focus").focus(function() {
                    if (this.value == this.defaultValue) {
                        this.value = "";
                    }
                    else {
                        this.select();
                    }
                });

                $("input.focus").blur(function() {
                    if ($.trim(this.value) == "") {
                        this.value = (this.defaultValue ? this.defaultValue : "");
                    }
                });

                $("input:submit, input:reset").button();

<?php if ($error_login) { ?>
                    $('#error-incorrecto').fadeIn('slow');
<?php } ?>
            });
        </script>
    </head>
    <body>
        <div id="login">
            <!-- login -->
            <div class="title">
                <h5>Ingreso a Inscripciones Online</h5>
                <div class="corner tl"></div>
                <div class="corner tr"></div>
            </div>
            <div class="messages" id="error-vacio" style="display: none">
                <div id="message-error" class="message message-error" >
                    <div class="image">
                        <img src="resources/images/icons/error.png" alt="Error" height="32" />
                    </div>
                    <div class="text">
                        <h6>Error</h6>
                        <span>Ingrese el nombre de usuario y contraseña.</span>
                    </div>

                </div>
            </div>
            <div class="messages" id="error-incorrecto" style="display: none">
                <div id="message-error" class="message message-error">
                    <div class="image">
                        <img src="resources/images/icons/error.png" alt="Error" height="32" />
                    </div>
                    <div class="text">
                        <h6>Error</h6>
                        <span>Los datos ingresados son incorrectos</span>
                    </div>

                </div>
            </div>
            <div class="inner">
                <form action="adm.php?mod=index" method="post" onsubmit="return ingresar()">
                    <input type="hidden" name="accion" id="accion" value="login" />
                    <div class="form" >
                        <!-- fields -->
                        <div class="fields">
                            <div class="field">
                                <div class="label">
                                    <label for="username">Usuario:</label>
                                </div>
                                <div class="input">
                                    <input type="text" id="username" name="username"  size="40" class="focus" />
                                </div>
                            </div>
                            <div class="field">
                                <div class="label">
                                    <label for="password">Contrase&ntilde;a:</label>
                                </div>
                                <div class="input">
                                    <input type="password" id="password" name="password" size="40" class="focus" />
                                </div>
                            </div>
                            <div class="field">
                                <div class="checkbox">
                                    <input type="checkbox" id="remember" name="remember" />
                                    <label for="remember">Recordarme</label>
                                </div>
                            </div>
                            <div class="buttons">
                                <input type="submit" value="Ingresar" onclick="ingresar()" />
                            </div>
                        </div>
                        <!-- end fields -->
                        <!-- links -->
                        <div class="links">
                            <a href="index.html">Se ha olvidado de su contrase&ntilde;a?</a>
                        </div>
                        <!-- end links -->
                    </div>
                </form>
            </div>
            <div style="width:310px; text-align:right; margin-left:auto; margin-right:auto; font-size:11px;">
                Desarrollado por <a href="" target="_blank" style="color:#646464;font-size:11px;">ABWebServices</a>
            </div>
            <!-- end login -->

        </div>
    </body>
</html>

