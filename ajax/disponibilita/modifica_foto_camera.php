<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_foto_camera'){

            $idsito = $_REQUEST['idsito'];
            $Id     = $_REQUEST['Id'];

            if($_REQUEST['Foto']==''){
                $select = "SELECT Foto FROM hospitality_gallery_camera WHERE Id = ".$Id;
                $img = $dbMysqli->query($select);
                $rec = $img[0];
                $Foto = $rec['Foto'];
            }else{
                $Foto = $_REQUEST['Foto'];
            }

            $update ="UPDATE hospitality_gallery_camera SET Foto =  '".$Foto."' WHERE Id = ".$Id ." AND idsito = ".$idsito;
            $dbMysqli->query($update);
	}
?>