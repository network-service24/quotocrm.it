<?php

include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');


$dbMysqli->query("UPDATE hospitality_smtp SET NumberSend = 300");

$myfile = fopen($path_cron.'log/log_contatore.txt', 'w'); 

echo 'azzerati contatori smtp'; 


$txt = date('d-m-Y H:i:s').' - Azzerato contatore settimanale E-Messenger SMTP'."\r\n";			    


fwrite($myfile, $txt);

?>
