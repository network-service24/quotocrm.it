<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_target_gallery'){

            $idsito        = $_REQUEST['idsito'];
            $Id            = $_REQUEST['Id'];
            $TargetGallery = $dbMysqli->escape($fun->clean_tolower($_REQUEST['TargetGallery']));
            $TargetType    = $dbMysqli->escape($fun->clean_tolower($_REQUEST['TargetType']));
    
            $update ="UPDATE hospitality_tipo_gallery SET TargetGallery =  '".$TargetGallery."' WHERE Id = ".$Id ." AND idsito = ".$idsito;
            $dbMysqli->query($update);
            
            $update2 = 'UPDATE hospitality_template_background SET TemplateName = "'.$TargetGallery.'" WHERE idsito = '.$idsito.' AND TemplateType = "'.$TargetType.'"';
            $dbMysqli->query($update2);
    }
?>