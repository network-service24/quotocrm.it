<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_contenuto_template'){

            $id            = $_REQUEST['id'];
            $idsito        = $_REQUEST['idsito'];
            $id_dizionario = $_REQUEST['id_dizionario'];
            $etichetta     = $_REQUEST['etichetta'];
            $testo         = $dbMysqli->escape($_REQUEST['testo']);

            $update ="  UPDATE hospitality_dizionario_lingua  SET testo = '".$testo."' WHERE id = ".$id." AND idsito =  ".$idsito;
                           
            $dbMysqli->query($update);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'templates-altri_contenuti_template/'. $id_dizionario .'/'. $etichetta .'/');

#######################################################################################################################
?>