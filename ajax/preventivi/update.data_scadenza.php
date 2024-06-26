<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action']=='send_data'){

        $query = "UPDATE hospitality_guest SET DataScadenza = '".$_REQUEST['DataScadenza']."'  WHERE Id = '".$_REQUEST['idrichiesta']."'";
        $dbMysqli->query($query);

}

?>