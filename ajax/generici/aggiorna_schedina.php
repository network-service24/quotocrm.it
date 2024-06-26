<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='aggiorna_schedina'){

            $Id                  = $_REQUEST['Id'];
            $idsito              = $_REQUEST['idsito'];
            $Sesso               = $_REQUEST['Sesso'];
            $Nome                = $dbMysqli->escape($_REQUEST['Nome']);
            $Cognome             = $dbMysqli->escape($_REQUEST['Cognome']);
            $Cittadinanza        = $dbMysqli->escape($_REQUEST['Cittadinanza']);
            $Provincia           = $dbMysqli->escape($_REQUEST['Provincia']);
            $Citta               = $dbMysqli->escape($_REQUEST['Citta']);
            $ProvinciaBis        = $dbMysqli->escape($_REQUEST['ProvinciaBis']);
            $CittaBis            = $dbMysqli->escape($_REQUEST['CittaBis']);
            $DataNascita         = $_REQUEST['DataNascita'];      
            $ProvinciaNascitaBis = $dbMysqli->escape($_REQUEST['ProvinciaNascitaBis']);
            $LuogoNascitaBis     = $dbMysqli->escape($_REQUEST['LuogoNascitaBis']);
            $LuogoNascita        = $dbMysqli->escape($_REQUEST['LuogoNascita']);
            $StatoNascita        = $dbMysqli->escape($_REQUEST['StatoNascita']);
            $Indirizzo           = $dbMysqli->escape($_REQUEST['Indirizzo']);
            $Cap                 = $_REQUEST['Cap'];
            $Note                = $dbMysqli->escape($_REQUEST['Note']);

            $update ="  UPDATE 
                            hospitality_checkin 
                        SET 
                            Nome                = '".$Nome."', 
                            Cognome             = '".$Cognome."',
                            Sesso               = '".$Sesso."',
                            Cittadinanza        = '".$Cittadinanza."',
                            Provincia           = '".$Provincia."',
                            Citta               = '".$Citta."',
                            Indirizzo           = '".$Indirizzo."',
                            Cap                 = '".$Cap."',
                            ProvinciaBis        = '".$ProvinciaBis."',
                            CittaBis            = '".$CittaBis."',
                            DataNascita         = '".$DataNascita."', 
                            LuogoNascita        = '".$LuogoNascita."',
                            StatoNascita        = '".$StatoNascita."',
                            ProvinciaNascitaBis = '".$ProvinciaNascitaBis."',
                            LuogoNascitaBis     = '".$LuogoNascitaBis."',
                            Note                = '".$Note."'
                        WHERE 
                            Id =  ".$Id." 
                        AND 
                            idsito = ".$idsito;

            $dbMysqli->query($update);

	}

?>