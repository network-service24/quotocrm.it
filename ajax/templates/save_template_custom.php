<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='save_template_custom'){

            $Id           = $_REQUEST['Id'];
            $idsito       = $_REQUEST['idsito'];
            $TemplateName = $dbMysqli->escape($fun->clean_tolower($_REQUEST['TemplateName']));
            $Font         = $dbMysqli->escape($_REQUEST['Font']);
            $Pulsante     = $_REQUEST['Pulsante'];
            $Video        = $_REQUEST['Video'];

            if($_REQUEST['Immagine']==''){
                $select = "SELECT Immagine FROM hospitality_template_background WHERE Id = ".$Id;
                $img = $dbMysqli->query($select);
                $rec = $img[0];
                $Immagine = $rec['Immagine'];
            }else{
                $Immagine = $_REQUEST['Immagine'];
            }

            if($_REQUEST['Immagine2']==''){
                $select2 = "SELECT Immagine2 FROM hospitality_template_background WHERE Id = ".$Id;
                $img2 = $dbMysqli->query($select2);
                $rec2 = $img2[0];
                $Immagine2 = $rec2['Immagine2'];
            }else{
                $Immagine2 = $_REQUEST['Immagine2'];
            }

            if($_REQUEST['Background']==''){
                $select3 = "SELECT Background FROM hospitality_template_background WHERE Id = ".$Id;
                $rec = $dbMysqli->query($select3);
                $record = $rec[0];
                $Background = $record['Background'];
            }else{
                $Background = $_REQUEST['Background'];
            }

            $update ="UPDATE hospitality_template_background  SET TemplateName = '".$TemplateName."', Font = '".$Font."', Background = '".$Background."', Pulsante = '".$Pulsante."', Immagine = '".$Immagine."', Immagine2 = '".$Immagine2."', Video = '".$Video."' WHERE Id = ".$Id." AND idsito =  ".$idsito;                         
            $dbMysqli->query($update);

            $query = "SELECT * FROM hospitality_template_background WHERE Id = ".$Id." AND idsito =  ".$idsito;
            $result = $dbMysqli->query($query);
            $record = $result[0];

            $update2 ="UPDATE hospitality_tipo_gallery SET TargetGallery =  '".$TemplateName."' WHERE idsito = ".$idsito." AND TargetType = '".$record['TemplateType']."'";
            $dbMysqli->query($update2);
	}
?>