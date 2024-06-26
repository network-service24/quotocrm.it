<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_schedina'){

            $Id                  = $_REQUEST['Id'];
            $Prenotazione        = $_REQUEST['Prenotazione'];
            $idsito              = $_REQUEST['idsito'];
            $lang                = $_REQUEST['lang'];
            $NumeroPersone       = $_REQUEST['NumeroPersone'];
            $TipoComponente      = $dbMysqli->escape($_REQUEST['TipoComponente']);
            $TipoDocumento       = $dbMysqli->escape($_REQUEST['TipoDocumento']);
            $NumeroDocumento     = $dbMysqli->escape($_REQUEST['NumeroDocumento']);
            $ComuneEmissione     = $dbMysqli->escape($_REQUEST['ComuneEmissione']);
            $StatoEmissione      = $dbMysqli->escape($_REQUEST['StatoEmissione']);
            $DataRilascio        = $_REQUEST['DataRilascio'];
            $DataScadenza        = $_REQUEST['DataScadenza'];
            $Sesso               = $_REQUEST['Sesso'];
            $Nome                = $dbMysqli->escape($_REQUEST['Nome']);
            $Cognome             = $dbMysqli->escape($_REQUEST['Cognome']);
            $Cittadinanza        = $dbMysqli->escape($_REQUEST['Cittadinanza']);
            $Provincia           = $dbMysqli->escape($_REQUEST['Provincia']);
            $Citta               = $dbMysqli->escape($_REQUEST['Citta']);
            $ProvinciaBis        = $dbMysqli->escape($_REQUEST['ProvinciaBis']);
            $CittaBis            = $dbMysqli->escape($_REQUEST['CittaBis']);
            $DataNascita         = $_REQUEST['DataNascita'];
            $LuogoNascita        = $dbMysqli->escape($_REQUEST['LuogoNascita']);
            $StatoNascita        = $dbMysqli->escape($_REQUEST['StatoNascita']);
            $ProvinciaNascitaBis = $dbMysqli->escape($_REQUEST['ProvinciaNascitaBis']);
            $LuogoNascitaBis     = $dbMysqli->escape($_REQUEST['LuogoNascitaBis']);
            $Indirizzo           = $dbMysqli->escape($_REQUEST['Indirizzo']);
            $Cap                 = $_REQUEST['Cap'];
            $Note                = $dbMysqli->escape($_REQUEST['Note']);

            $update ="  UPDATE 
                            hospitality_checkin 
                        SET 
                            TipoComponente      = '".$TipoComponente."', 
                            TipoDocumento       = '".$TipoDocumento."', 
                            NumeroDocumento     = '".$NumeroDocumento."', 
                            ComuneEmissione     = '".$ComuneEmissione."', 
                            StatoEmissione      = '".$StatoEmissione."', 
                            DataRilascio        = '".$DataRilascio."', 
                            DataScadenza        = '".$DataScadenza."', 
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