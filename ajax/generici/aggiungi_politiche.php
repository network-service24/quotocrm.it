<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_po'){

			$idsito = $_REQUEST['idsito'];
            $tipo   = $_REQUEST['tipo'];
			$etichetta  = $dbMysqli->escape($_REQUEST['etichetta']);

            $insert ="INSERT INTO hospitality_politiche(idsito,
                                                        Lingua,
                                                        etichetta,
                                                        tipo) 
                                                        VALUES ('".$idsito."',
                                                        'it',
                                                        '".$etichetta."',
                                                        '".$tipo."')";

            $dbMysqli->query($insert);

	}

?>