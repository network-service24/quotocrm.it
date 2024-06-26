<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_foto_camere'){

    $delete = "DELETE FROM hospitality_gallery_camera  WHERE Id = ".$_REQUEST['Id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete);

}

?>