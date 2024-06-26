<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_foto_target'){

            $idsito        = $_REQUEST['idsito'];
            $Immagine      = $_REQUEST['Immagine'];
            $IdTipoGallery = $_REQUEST['IdTipoGallery'];

            $insert ="INSERT INTO hospitality_tipo_gallery_target(IdTipoGallery,idsito, Immagine, Abilitato) VALUES ('".$IdTipoGallery."','".$idsito."','". $Immagine."','1')";
            $dbMysqli->query($insert);
	}
?>