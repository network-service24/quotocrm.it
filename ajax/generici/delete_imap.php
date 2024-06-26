<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_im'){
    $delete = "DELETE FROM hospitality_imap_email  WHERE Id = ".$_REQUEST['id'];
    $dbMysqli->query($delete);
}


?>