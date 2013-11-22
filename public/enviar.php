<?php 
function form_mail($sPara, $sAsunto, $sTexto, $sDe)
{ 
$bHayFicheros = 0; 
$sCabeceraTexto = ""; 
$sAdjuntos = "";

if ($sDe)$sCabeceras = "From:".$sDe."\n"; 
else $sCabeceras = ""; 
$sCabeceras .= "MIME-version: 1.0\n"; 

$sTexto .= "<table cellspacing='0' cellpadding='0' style='width:100%'>";
$sTexto .= "<tr>";
$sTexto .= "<td>";
$sTexto .= "<h2 style='color:red;'>Identificaci&oacute;n</h2>";
$sTexto .= "</td>";
$sTexto .= "</tr>";
foreach ($_POST as $sNombre => $sValor){ 
    
    $sTexto .= "<tr>";
    $sTexto .= "<td style='width:20%'>";
    $sTexto .= "<b style='color:gray;'>".$sNombre."</b>";
    $sTexto .= "</td>";
    $sTexto .= "<td style='width:80%'>";
    $sTexto .= "<p style='color:gray; margin:0px;'>".$sValor."</p>";
    $sTexto .= "</td>";
    $sTexto .= "</tr>";
    
    if($sNombre == 'Apellidos'){
        $sTexto .= "<tr>";
        $sTexto .= "<td>";
        $sTexto .= "<h2 style='color:red;'>Solicitud de empleo</h2>";
        $sTexto .= "</td>";
        $sTexto .= "</tr>";
    }
    if($sNombre == 'Cuantos?'){
        $sTexto .= "<tr>";
        $sTexto .= "<td>";
        $sTexto .= "<h2 style='color:red;'>N&uacute;cleo Familiar</h2>";
        $sTexto .= "</td>";
        $sTexto .= "</tr>";
    }
    if($sNombre == 'Otros_Estudios'){
        $sTexto .= "<tr>";
        $sTexto .= "<td>";
        $sTexto .= "<h2 style='color:red;'>Experiencia Laboral</h2>";
        $sTexto .= "</td>";
        $sTexto .= "</tr>";
    }
    if($sNombre == 'Horario?'){
        $sTexto .= "<tr>";
        $sTexto .= "<td>";
        $sTexto .= "<h2 style='color:red;'>Experiencia Anterior</h2>";
        $sTexto .= "</td>";
        $sTexto .= "</tr>";
    }
    
}
$sTexto .= "</table>";

foreach ($_FILES as $vAdjunto)
{ 
if ($bHayFicheros == 0)
{ 
$bHayFicheros = 1; 
$sCabeceras .= "Content-type: multipart/mixed;"; 
$sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";

$sCabeceraTexto = "----_Separador-de-mensajes_--\n"; 
$sCabeceraTexto .= "Content-type: text/html;charset=utf-8\n"; 
//$sCabeceraTexto .= "Content-transfer-encoding: base64\n";

$sTexto = $sCabeceraTexto.$sTexto; 
} 
if ($vAdjunto["size"] > 0)
{ 
$sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n"; 
$sAdjuntos .= "Content-type: ".$vAdjunto["type"].";name=\"".$vAdjunto["name"]."\"\n";; 
$sAdjuntos .= "Content-Transfer-Encoding: BASE64\n"; 
$sAdjuntos .= "Content-disposition: attachment;filename=\"".$vAdjunto["name"]."\"\n\n";

$oFichero = fopen($vAdjunto["tmp_name"], 'r'); 
$sContenido = fread($oFichero, filesize($vAdjunto["tmp_name"])); 
$sAdjuntos .= chunk_split(base64_encode($sContenido)); 
fclose($oFichero); 
} 
}

if ($bHayFicheros) 
$sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n"; 
return(mail($sPara, $sAsunto, $sTexto, $sCabeceras)); 
}

//cambiar aqui el email 
if (form_mail("carolinaleibe@silcom.com.uy", "Curriculum", "Los datos introducidos en el formulario son:\n\n", "La Abundancia")) 

//fernando.olivera@xpantion.com
//carolinaleibe@silcom.com.uy
   header('Location: index.php?&locale=es&snd=1') ;


        
?>