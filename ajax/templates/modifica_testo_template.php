<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_content_template'){

            $idsito    = $_REQUEST['idsito'];
            $Id        = $_REQUEST['Id'];

            if($_REQUEST['Immagine']==''){
                $select = "SELECT Immagine FROM hospitality_contenuti_web WHERE Id = ".$Id;
                $img = $dbMysqli->query($select);
                $rec = $img[0];
                $Immagine = $rec['Immagine'];
            }else{
                $Immagine = $_REQUEST['Immagine'];
            }

            $Testo = $dbMysqli->escape($_REQUEST['Testo']);


            $update ="UPDATE hospitality_contenuti_web SET Immagine = '".$Immagine."', Testo = '".$Testo."' WHERE Id = ".$Id." AND idsito = ".$idsito."";
            $dbMysqli->query($update);

	}

#######################################################################################################################

header('Location:'.BASE_URL_SITO.'templates-contenuti_template/');

#######################################################################################################################
?>