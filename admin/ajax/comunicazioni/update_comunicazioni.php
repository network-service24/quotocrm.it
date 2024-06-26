<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

    $action    =      $_REQUEST['action'];
    
    if($action=='update'){
      
			$Id                     = $_REQUEST['Id'];
            $Abilitato              = $_REQUEST['Abilitato'];
            $Visibile               = $_REQUEST['Visibile'];
            $DataInizio             = $_REQUEST['DataInizio'];
            $DataFine               = $_REQUEST['DataFine'];
            $Titolo                 = $dbMysqli->escape($_REQUEST['Titolo']);
            $Testo                  = $dbMysqli->escape($_REQUEST['Testo']);


			$update = " UPDATE  comunicazioni 
                        SET DataInizio = '".$DataInizio."', 
                            DataFine  = '".$DataFine."',
                            Titolo    = '".$Titolo."',
                            Testo     = '".$Testo."',
                            Abilitato = '".$Abilitato."', 
                            Visibile  = '".$Visibile."' 
                        WHERE Id = ".$Id;
			$dbMysqli->query($update); 


    }
#######################################################################################################################

header('Location:'.BASE_URL_ADMIN.'comunicazioni/');

#######################################################################################################################

?>
