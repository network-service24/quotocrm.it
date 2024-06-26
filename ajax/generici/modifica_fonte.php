<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_ft'){


			$fonte_ = $fun->clean($_REQUEST['Fonte']);
			$fonte  = $dbMysqli->escape($fonte_ );

				$update ="UPDATE hospitality_fonti_prenotazione SET                                                   
														    FontePrenotazione   = '".$fonte."'
														WHERE
                                                            Id =  ".$_REQUEST['id']."
                                                        AND
                                                            idsito = ".$_REQUEST['idsito'];

				$dbMysqli->query($update);



	}

?>