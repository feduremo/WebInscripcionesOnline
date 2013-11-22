<?php
ob_start();
if (!Security::is_logged_in()) {
    Security::redirect_out();
}
$modulo = _session('adm_mod');
$user_id = _session('id');
$config = $Administrador_Permiso->count("administrador_id='" . $user_id . "' AND permiso_id = 1");
$sorteo = $Administrador_Permiso->count("administrador_id='" . $user_id . "' AND permiso_id = 2");
$inscrip = $Administrador_Permiso->count("administrador_id='" . $user_id . "' AND permiso_id = 3");
$remer = $Administrador_Permiso->count("administrador_id='" . $user_id . "' AND permiso_id = 5");
$noti = $Administrador_Permiso->count("administrador_id='" . $user_id . "' AND permiso_id = 4");
$home = $Administrador_Permiso->count("administrador_id='" . $user_id . "' AND permiso_id = 6");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="shortcut icon" href="resources/images/favicon.ico" />
        <title>Inscripciones Online</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

        <!-- stylesheets -->
        <link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="resources/css/boxy.css" />
        <link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />

        <link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/blue.css" />

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
        <script src="js/aca/jquery.bgiframe.min.js" type="text/javascript"></script>
        <script src="js/aca/jquery.multiSelect.js" type="text/javascript"></script>

        <link href="css/aca/jquery.multiSelect.css" rel="stylesheet" type="text/css" />

        <!-- scripts (jquery) -->
<!--	<script src="resources/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
        -->
        <!--    [if IE]><script language="javascript" type="text/javascript" src="resources/scripts/excanvas.min.js"></script><![endif]
        -->
        <script src="resources/scripts/jquery-ui-1.8.custom.min.js" type="text/javascript"></script>
        <script src="resources/scripts/jquery.ui.selectmenu.js" type="text/javascript"></script>
        <script src="resources/scripts/jquery.flot.min.js" type="text/javascript"></script>
        <script src="resources/scripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
        <script src="resources/scripts/tiny_mce/jquery.tinymce.js" type="text/javascript"></script>

        <!-- scripts (custom) -->
        <script src="resources/scripts/smooth.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.menu.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.table.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.form.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.dialog.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.autocomplete.js" type="text/javascript"></script>
        <script src="resources/scripts/jquery.boxy.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // Default options
                $("#control_1").multiSelect();
            });
        </script>                
        <?php /*
          <script type="text/javascript">
          $(document).ready(function () {
          style_path = "resources/css/colors";
          $("#date-picker").datepicker();
          $("#box-tabs, #box-left-tabs").tabs();
          });
          </script> */ ?>
    </head> <!-- head -->
    <body>
        <div id="header"> <!-- header -->
            <div id="logo"> <!-- logo -->
                <h1>
                    <a href="" title="Inscripciones Online">
                        <img src="resources/images/logo.png" alt="Smooth Admin" />
                    </a>
                </h1>
            </div> <!-- end logo -->
            <ul id="user"> <!-- user -->
                <li><a href="adm.php?mod=logout">Salir</a></li>
                <li class="highlight last"><a href="index.php">Ver Sitio FUR</a></li>
            </ul><!-- end user -->
            <div id="header-inner">
                <div id="home">
                    <a href="adm.php?mod=principal" title="Home"></a>
                </div>
                <ul id="quick"> <!-- quick -->
                    <?php if ($home > 0) { ?>
                        <li>
                            <a href="adm.php?mod=contenido" title="Contenido Home">
                                <span class="icon"><img src="resources/images/icons/Homeicon.png" alt="Contenido" /></span>
                                <span>Contenido Home</span>
                            </a>
                        </li> 
                    <?php }
                    if ($noti > 0) {
                        ?>
                        <li>
                            <a href="#" title="Noticias">
                                <span class="icon"><img src="resources/images/icons/newsicon.png" alt="Settings" /></span>
                                <span>Noticias</span>
                            </a>
                            <ul>
                                <li><a href="adm.php?mod=novedades">Listado de Noticias</a></li>
                                <li class="last"><a href="adm.php?mod=novedad">Nueva Noticia</a></li>
                            </ul>
                        </li>
                    <?php }
                    if ($remer > 0) {
                        ?>
                        <li>
                            <a href="#" title="Remeros">
                                <span class="icon"><img src="resources/images/icons/peopleicon.png" alt="Recetas" /></span>
                                <span>Remeros</span>
                            </a>
                            <ul>
                                <li><a href="adm.php?mod=recetas">Listado de Remeros</a></li>
                                <li class="last"><a href="adm.php?mod=banner">Nuevo Remero</a></li>
                            </ul>
                        </li>                                   
                    <?php }
                    if ($inscrip > 0) {
                        ?>
                        <li>
                            <a href="#" title="Inscripci&oacute;n">
                                <span class="icon"><img src="resources/images/icons/rowingicon.png" alt="Products" /></span>
                                <span>Inscripci&oacute;n</span>
                            </a>
                        </li>
<?php }
if ($sorteo > 0) {
    ?>
                        <li>
                            <a href="#" title="Sorteo">
                                <span class="icon"><img src="resources/images/icons/gamesicon.png" alt="Settings" /></span>
                                <span>Sorteo</span>
                            </a>
                        </li>
<?php }
if ($config > 0) {
    ?>
                        <li>
                            <a href="#" title="Configuraci&oacute;n">
                                <span class="icon"><img src="resources/images/icons/Settingsicon2.png" alt="Settings" /></span>
                                <span>Configuraci&oacute;n</span>
                            </a>
                            <ul>
                                <li>
                                    <a>Usuario</a>
                                    <ul>
                                        <li><a href="adm.php?mod=usuarios">Lista de Usuario</a></li>
                                        <li class="last"><a href="adm.php?mod=usuario">Nuevo Usuario</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a>Permiso</a>
                                    <ul>
                                        <li><a href="adm.php?mod=permisos">Listado de Permisos</a></li>
                                        <li><a href="adm.php?mod=permiso_usuario">Asignar Permisos</a></li>
                                        <li class="last"><a href="adm.php?mod=permiso">Nuevo Permiso</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a>Clubes</a>
                                    <ul>
                                        <li><a href="adm.php?mod=clubes">Lista de Clubes</a></li>
                                        <li class="last"><a href="adm.php?mod=club">Nuevo Club</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a>Pista</a>
                                    <ul>
                                        <li><a href="adm.php?mod=permiso_usuario">Lista de Pistas</a></li>
                                        <li><a href="adm.php?mod=permiso_usuario">Asignar Pista</a></li>
                                        <li class="last"><a href="adm.php?mod=permiso_usuario">Nueva Pista</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a>Botes</a>
                                    <ul>
                                        <li><a href="adm.php?mod=permiso_usuario">Lista de Botes</a></li>
                                        <li><a href="adm.php?mod=permiso_usuario">Asignar Botes a Programa</a></li>
                                        <li class="last"><a href="adm.php?mod=permiso_usuario">Nuevo Bote</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a>Programas</a>
                                    <ul>
                                        <li><a href="adm.php?mod=permiso_usuario">Lista de Programas</a></li>
                                        <li class="last"><a href="adm.php?mod=permiso_usuario">Nuevo Programa</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a>Campeonato</a>
                                    <ul>
                                        <li><a href="adm.php?mod=permiso_usuario">Lista de Campeonatos</a></li>
                                        <li><a href="adm.php?mod=permiso_usuario">Nuevo Campeonatos</a></li>
                                        <li><a href="adm.php?mod=permiso_usuario">Lista de Fechas</a></li>
                                        <li><a href="adm.php?mod=permiso_usuario">Asignar Fecha</a></li>
                                        <li><a href="adm.php?mod=permiso_usuario">Nueva Fecha</a></li>
                                        <li><a href="adm.php?mod=permiso_usuario">Lista de Puntos</a></li>
                                        <li class="last"><a href="adm.php?mod=permiso_usuario">Nuevo Punto</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
<?php }
?>
                </ul> <!-- end quick -->
                <div class="corner tl"></div>
                <div class="corner tr"></div>
            </div>
        </div> <!-- end header -->
        <div id="content"> <!-- content -->
            <div id="left">  <!--content / left -->
                <div id="menu">
                    <div id="dataUser">
                        <img id="logUser" src="images/nodisponible.jpg"/>
                        <span><h3>asd</h3></span>
                        <span><h3>HOLA</h3></span> 
                    </div>
                </div><!--END SIDEBAR-->
                <div id="date-picker"></div>
            </div> <!-- end content / left -->
            <div id="right"> <!-- content / right -->
<?php include_once($modulo . '.php'); ?>
                <!--				 table
                                                <div class="box">
                                                         box / title 
                                                        <div class="title">
                                                                <h5>Products</h5>
                                                                <div class="search">
                                                                        <form action="#" method="post">
                                                                                <div class="input">
                                                                                        <input type="text" id="search" name="search" />
                                                                                </div>
                                                                                <div class="button">
                                                                                        <input type="submit" name="submit" value="Search" />
                                                                                </div>
                                                                        </form>
                                                                </div>
                                                        </div>
                                                         end box / title 
                                                        <div class="table">
                                                                <form action="" method="post">
                                                                <table>
                                                                        <thead>
                                                                                <tr>
                                                                                        <th class="left">Title</th>
                                                                                        <th>Price</th>
                                                                                        <th>Added</th>
                                                                                        <th>Category</th>
                                                                                        <th class="selected last"><input type="checkbox" class="checkall" /></th>
                                                                                </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                                <tr>
                                                                                        <td class="title">24" LED Monitor</td>
                                                                                        <td class="price">$110.00</td>
                                                                                        <td class="date">April 25th, 2010 at 4:15 PM</td>
                                                                                        <td class="category">Monitors</td>
                                                                                        <td class="selected last"><input type="checkbox" /></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td class="title">27" LCD Flat Panel</td>
                                                                                        <td class="price">$150.00</td>
                                                                                        <td class="date">April 25th, 2010 at 4:15 PM</td>
                                                                                        <td class="category">Monitors</td>
                                                                                        <td class="selected last"><input type="checkbox" /></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td class="title">6GB 240-Pin DDR3 SDRAM DDR3 1600</td>
                                                                                        <td class="price">$80.00</td>
                                                                                        <td class="date">April 25th, 2010 at 4:15 PM</td>
                                                                                        <td class="category">Memory</td>
                                                                                        <td class="selected last"><input type="checkbox" /></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td class="title">500GB 7200 RPM 16MB Cache SATA 3.0Gb/s 3.5</td>
                                                                                        <td class="price">$92.00</td>
                                                                                        <td class="date">April 25th, 2010 at 4:15 PM</td>
                                                                                        <td class="category">Hard Drives</td>
                                                                                        <td class="selected last"><input type="checkbox" /></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td class="title">2GB 240-Pin DDR3 SDRAM DDR3 1600</td>
                                                                                        <td class="price">$52.00</td>
                                                                                        <td class="date">April 25th, 2010 at 4:15 PM</td>
                                                                                        <td class="category">Memory</td>
                                                                                        <td class="selected last"><input type="checkbox" /></td>
                                                                                </tr>
                                                                        </tbody>
                                                                </table>
                                                                 pagination 
                                                                <div class="pagination pagination-left">
                                                                        <div class="results">
                                                                                <span>showing results 1-10 of 207</span>
                                                                        </div>
                                                                        <ul class="pager">
                                                                                <li class="disabled">&laquo; prev</li>
                                                                                <li class="current">1</li>
                                                                                <li><a href="">2</a></li>
                                                                                <li><a href="">3</a></li>
                                                                                <li><a href="">4</a></li>
                                                                                <li><a href="">5</a></li>
                                                                                <li class="separator">...</li>
                                                                                <li><a href="">20</a></li>
                                                                                <li><a href="">21</a></li>
                                                                                <li><a href="">next &raquo;</a></li>
                                                                        </ul>
                                                                </div>
                                                                 end pagination 
                                                                 table action 
                                                                <div class="action">
                                                                        <select name="action">
                                                                                <option value="" class="locked">Set status to Deleted</option>
                                                                                <option value="" class="unlocked">Set status to Published</option>
                                                                                <option value="" class="folder-open">Move to Category</option>
                                                                        </select>
                                                                        <div class="button">
                                                                                <input type="submit" name="submit" value="Apply to Selected" />
                                                                        </div>
                                                                </div>
                                                                 end table action 
                                                                </form>
                                                        </div>
                                                </div>
                                                 end table 
                                                <div class="box">
                                                         box / title 
                                                        <div class="title">
                                                                <h5>Product Sales</h5>
                                                                <ul class="links">
                                                                        <li><a href="">Full Report</a></li>
                                                                </ul>
                                                        </div>
                                                         end box / title 
                                                        <div class="sales">
                                                                <div class="legend">
                                                                        <h6>Units Sold (April 1st to April 15th)</h6>
                                                                        <ul>
                                                                                <li class="monitors">Monitors</li>
                                                                                <li class="memory">Memory</li>
                                                                        </ul>
                                                                </div>
                                                                <div id="sales"></div>
                                                        </div>
                                                </div>
                                                 messages 
                                                <div id="box-tabs" class="box">
                                                         box / title 
                                                        <div class="title">
                                                                <h5>Content Box</h5>
                                                                <ul class="links">
                                                                        <li><a href="#box-messages">Messages</a></li>
                                                                        <li><a href="#box-other">Typography</a></li>
                                                                        <li><a href="#box-dialogs">Dialogs</a></li>
                                                                </ul>
                                                        </div>
                                                         box / title 
                                                        <div id="box-messages">
                                                                <div class="messages">
                                                                        <div id="message-error" class="message message-error">
                                                                                <div class="image">
                                                                                        <img src="resources/images/icons/error.png" alt="Error" height="32" />
                                                                                </div>
                                                                                <div class="text">
                                                                                        <h6>Error Message</h6>
                                                                                        <span>This is the error message.</span>
                                                                                </div>
                                                                                <div class="dismiss">
                                                                                        <a href="#message-error"></a>
                                                                                </div>
                                                                        </div>
                                                                        <div id="message-warning" class="message message-warning">
                                                                                <div class="image">
                                                                                        <img src="resources/images/icons/warning.png" alt="Warning" height="32" />
                                                                                </div>
                                                                                <div class="text">
                                                                                        <h6>Warning Message</h6>
                                                                                        <span>This is the warning message.</span>
                                                                                </div>
                                                                                <div class="dismiss">
                                                                                        <a href="#message-warning"></a>
                                                                                </div>
                                                                        </div>
                                                                        <div id="message-notice" class="message message-notice">
                                                                                <div class="image">
                                                                                        <img src="resources/images/icons/notice.png" alt="Notice" height="32" />
                                                                                </div>
                                                                                <div class="text">
                                                                                        <h6>Notice Message</h6>
                                                                                        <span>This is the notice message.</span>
                                                                                </div>
                                                                                <div class="dismiss">
                                                                                        <a href="#message-notice"></a>
                                                                                </div>
                                                                        </div>
                                                                        <div id="message-success" class="message message-success">
                                                                                <div class="image">
                                                                                        <img src="resources/images/icons/success.png" alt="Success" height="32" />
                                                                                </div>
                                                                                <div class="text">
                                                                                        <h6>Success Message</h6>
                                                                                        <span>This is the success message.</span>
                                                                                </div>
                                                                                <div class="dismiss">
                                                                                        <a href="#message-success"></a>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div id="box-other">
                                                                 paragraphs 
                                                                <p class="start"><img src="resources/images/misc/ginger.jpg" alt="Ginger" class="right" />Lorem ipsum dolor sit amet, consectetur <a href="">adipisicing</a> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                 end paragraphs 
                                                                 headings 
                                                                <h5>Heading</h5>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                <blockquote><p>Lorem ipsum dolor sit amet, consectetur <a href="">adipisicing</a> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></blockquote>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                 end headings 
                                                        </div>
                                                        <div id="box-dialogs">
                                                                <p><a id="dialog-open" href="#">Open Dialog</a></p>
                                                                <p><a id="dialog-modal-open" href="#">Open Modal Dialog</a></p>
                                                                <p><a id="dialog-message-open" href="#">Open Modal Message Dialog</a></p>
                                                                <p><a id="dialog-confirm-open" href="#">Open Modal Confirmation Dialog</a></p>
                                                                <p><a id="dialog-form-open" href="#">Open Form Dialog</a></p>
                                                        </div>
                                                </div>
                                                 end messages 
                                                 forms 
                                                <div class="box">
                                                         box / title 
                                                        <div class="title">
                                                                <h5>Forms</h5>
                                                        </div>
                                                         end box / title 
                                                        <form id="form" action="" method="post">
                                                        <div class="form">
                                                                <div class="fields">
                                                                        <div class="field  field-first">
                                                                                <div class="label">
                                                                                        <label for="input-small">Small Input:</label>
                                                                                </div>
                                                                                <div class="input">
                                                                                        <input type="text" id="input-small" name="input.small" class="small" />
                                                                                        <div class="button highlight">
                                                                                                <input type="submit" name="submit.highlight" value="Submit Empathized" />
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label">
                                                                                        <label for="input-medium">Medium Input:</label>
                                                                                </div>
                                                                                <div class="input">
                                                                                        <input type="text" id="input-medium" name="input.medium" class="medium" />
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label">
                                                                                        <label for="input-large">Large Input:</label>
                                                                                </div>
                                                                                <div class="input">
                                                                                        <input type="text" id="input-large" name="input.large" class="large" />
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label">
                                                                                        <label for="autocomplete">Auto Complete:</label>
                                                                                </div>
                                                                                <div class="input">
                                                                                        <input type="text" id="autocomplete" name="input.autocomplete" value="start typing for example: java" class="small focus" />
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label">
                                                                                        <label for="date">Date Picker:</label>
                                                                                </div>
                                                                                <div class="input">
                                                                                        <input type="text" id="date" name="input.date" class="date" />
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label">
                                                                                        <label for="input-error">Error Input:</label>
                                                                                </div>
                                                                                <div class="input">
                                                                                        <input type="text" id="input-error" name="input.error" class="small error" />
                                                                                        <span class="error">This is a required field.</span>
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label">
                                                                                        <label for="input-valid">Valid Input:</label>
                                                                                </div>
                                                                                <div class="input">
                                                                                        <input type="text" id="input-valid" name="input.valid" class="small valid" />
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label">
                                                                                        <label for="select">Select:</label>
                                                                                </div>
                                                                                <div class="select">
                                                                                        <select id="select" name="select">
                                                                                                <option value="1">Option #1</option>
                                                                                                <option value="2">Option #2</option>
                                                                                                <option value="3">Option #3</option>
                                                                                        </select>
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label label-checkbox">
                                                                                        <label>Checkboxes:</label>
                                                                                </div>
                                                                                <div class="checkboxes">
                                                                                        <div class="checkbox">
                                                                                                <input type="checkbox" id="checkbox-1" name="checkboxex" />
                                                                                                <label for="checkbox-1">Option #1</label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                                <input type="checkbox" id="checkbox-2" name="checkboxex" />
                                                                                                <label for="checkbox-2">Option #2</label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                                <input type="checkbox" id="checkbox-3" name="checkboxex" />
                                                                                                <label for="checkbox-3">Option #3</label>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label label-radio">
                                                                                        <label>Radios:</label>
                                                                                </div>
                                                                                <div class="radios">
                                                                                        <div class="radio">
                                                                                                <input type="radio" id="radio-1" name="radioex" />
                                                                                                <label for="radio-1">Option #1</label>
                                                                                        </div>
                                                                                        <div class="radio">
                                                                                                <input type="radio" id="radio-2" name="radioex" />
                                                                                                <label for="radio-2">Option #2</label>
                                                                                        </div>
                                                                                        <div class="radio">
                                                                                                <input type="radio" id="radio-3" name="radioex" />
                                                                                                <label for="radio-3">Option #3</label>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label">
                                                                                        <label for="file">File:</label>
                                                                                </div>
                                                                                <div class="input input-file">
                                                                                        <input type="file" id="file" name="file" size="40" />
                                                                                </div>
                                                                        </div>
                                                                        <div class="field">
                                                                                <div class="label label-textarea">
                                                                                        <label for="textarea">Textarea:</label>
                                                                                </div>
                                                                                <div class="textarea textarea-editor">
                                                                                        <textarea id="textarea" name="textarea" cols="50" rows="12" class="editor"></textarea>
                                                                                </div>
                                                                        </div>
                                                                        <div class="buttons">
                                                                                <input type="submit" name="submit" value="Submit" />
                                                                                <input type="reset" name="reset" value="Reset" />
                                                                                <div class="highlight">
                                                                                        <input type="submit" name="submit.highlight" value="Submit Empathized" />
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        </form>
                                                </div>
                                                 end forms 
                                                 box / left 
                                                <div id="box-left-tabs" class="box box-left box-padding">
                                                         box / title 
                                                        <div class="title">
                                                                <h5>Left Column</h5>
                                                                <ul class="links">
                                                                        <li><a href="#box-left-forms">Tab #1</a></li>
                                                                        <li><a href="#box-left-other">Tab #2</a></li>
                                                                </ul>
                                                        </div>
                                                         end box / title 
                                                        <div id="box-left-forms">
                                                                <form action="" method="post">
                                                                <div class="form">
                                                                        <div class="fields">
                                                                                <div class="field field-first">
                                                                                        <div class="label">
                                                                                                <label for="input">Textbox:</label>
                                                                                        </div>
                                                                                        <div class="input">
                                                                                                <input type="text" id="input" name="input" />
                                                                                        </div>
                                                                                </div>
                                                                                <div class="field">
                                                                                        <div class="label label-textarea">
                                                                                                <label for="textarea">Textarea:</label>
                                                                                        </div>
                                                                                        <div class="textarea">
                                                                                                <textarea id="textarea1" name="textarea" cols="50" rows="8"></textarea>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="buttons">
                                                                                        <input type="submit" name="submit" value="Submit" />
                                                                                        <input type="reset" name="reset" value="Reset" />
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                </form>
                                                        </div>
                                                        <div id="box-left-other">
                                                                 paragraphs 
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p></blockquote>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                 end paragraphs 
                                                        </div>
                                                </div>
                                                 end box / left 
                                                 box / right 
                                                <div class="box box-right">
                                                         box / title 
                                                        <div class="title">
                                                                <h5>Right Column</h5>
                                                        </div>
                                                         end box / title 
                                                         paragraphs 
                                                        <p class="start"><img src="resources/images/misc/ginger.jpg" alt="Ginger" class="right" />Lorem ipsum dolor sit amet, consectetur <a href="">adipisicing</a> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                         end paragraphs 
                                                         headings 
                                                        <h1>Heading</h1>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                        <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p></blockquote>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                        <h2>Heading</h2>
                                                        <ol class="decimal">
                                                                <li>List Item 1</li>
                                                                <li>List Item 2</li>
                                                                <li>List Item 3</li>
                                                        </ol>
                                                        <h3>Heading</h3>
                                                        <ul class="disc">
                                                                <li>List Item 1</li>
                                                                <li>List Item 2</li>
                                                                <li>List Item 3</li>
                                                        </ul>
                                                        <h4>Heading</h4>
                                                        <ul class="square">
                                                                <li>List Item 1</li>
                                                                <li>List Item 2</li>
                                                                <li>List Item 3</li>
                                                        </ul>
                                                        <h5>Heading</h5>
                                                        <dl>
                                                                <dt>Definition List Title</dt>
                                                                <dd>This is a definition list division.</dd>
                                                        </dl>
                                                         end headings 
                                                </div>
                                                 end box / right -->
            </div>
            <!-- end content / right -->
        </div>
        <!-- end content -->
        <!-- footer -->
        <div id="footer">
            <p>Copyright &copy; 2000-2010 Your Company. All Rights Reserved.</p>
        </div>
        <!-- end footert -->
    </body>
</html>
<?php
ob_flush();
ob_end_clean();
?>