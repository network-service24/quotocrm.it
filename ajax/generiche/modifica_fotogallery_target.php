<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_foto'){

            $idsito = $_REQUEST['idsito'];
            $Id     = $_REQUEST['Id'];

            if($_REQUEST['Immagine']==''){
                $select = "SELECT Immagine FROM hospitality_tipo_gallery_target WHERE Id = ".$Id;
                $img = $dbMysqli->query($select);
                $rec = $img[0];
                $Immagine = $rec['Immagine'];
            }else{
                $Immagine = $_REQUEST['Immagine'];
            }

            $update ="UPDATE hospitality_tipo_gallery_target SET Immagine =  '".$Immagine."' WHERE Id = ".$Id ." AND idsito = ".$idsito;
            $dbMysqli->query($update);
	}
?>