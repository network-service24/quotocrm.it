<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_t_soggiorni'){

    $delete = "DELETE FROM hospitality_tipo_soggiorno_lingua  WHERE Id = ".$_REQUEST['Id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete);
}


?>