<?php
$Tracking = Tracking::load();
$link = $Tracking->get_last();

if(isset($link) && $link!=''){ header('location:'.$link); }
else{ header('location:index.php'); }

?>
