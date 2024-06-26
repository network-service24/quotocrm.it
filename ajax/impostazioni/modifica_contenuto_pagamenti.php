<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_content_pagamenti'){

            $idsito      = $_REQUEST['idsito'];
            $Lingua      = $_REQUEST['lingue'];
            $Id          = $_REQUEST['Id'];
            $pagamenti_id = $_REQUEST['pagamenti_id'];
            $Pagamento   = $dbMysqli->escape($_REQUEST['Pagamento']);
            $Descrizione = $dbMysqli->escape($_REQUEST['Descrizione']);
            $etichetta   = urlencode($_REQUEST['etichetta']);

            $update ="UPDATE hospitality_tipo_pagamenti_lingua SET  lingue       = '".$Lingua."',
                                                                    Pagamento    = '".$Pagamento."',
                                                                    Descrizione  = '".$Descrizione."'
                                                                    WHERE
                                                                        Id = ".$Id."
                                                                    AND
                                                                        idsito = ".$idsito;
            $dbMysqli->query($update);

	}
    #######################################################################################################################

header('Location:'.BASE_URL_SITO.'impostazioni-configura_contenuti_pagamenti/'. $pagamenti_id .'/'.$etichetta.'/');

#######################################################################################################################
?>