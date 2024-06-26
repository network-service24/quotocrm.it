<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_foto_camera'){

            $idsito   = $_REQUEST['idsito'];
            $IdCamera = $_REQUEST['IdCamera'];
            $Foto     = $_REQUEST['Foto'];

            $insert ="INSERT INTO hospitality_gallery_camera(IdCamera, idsito, Foto) VALUES ('".$IdCamera."', '".$idsito."', '". $Foto."')";
            $dbMysqli->query($insert);
	}
?>