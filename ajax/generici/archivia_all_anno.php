<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$action = $_REQUEST['action'];
	$idsito = $_REQUEST['idsito'];
    $anno   = $_REQUEST['anno'];

	if($action == 'archiviaAnno'){

        $update = " UPDATE
                        hospitality_guest
                    SET 
                        Archivia = 1
                    WHERE 
                        idsito = $idsito
                    AND 
                        DataArrivo >= '".$anno."-01-01'
                    AND 
                        DataPartenza <= '".$anno."-12-31' ";

                        $dbMysqli->query($update);
		
	}

?>