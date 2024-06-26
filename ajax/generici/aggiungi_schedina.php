<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_schedina'){

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

            $insert ="  INSERT INTO
                            hospitality_checkin
                            (
                                idsito,
                                Prenotazione,
                                NumeroPersone,
                                TipoComponente,
                                TipoDocumento,
                                NumeroDocumento,
                                ComuneEmissione,
                                StatoEmissione,
                                DataRilascio,
                                DataScadenza,
                                Nome,
                                Cognome,
                                Sesso,
                                Cittadinanza,
                                Provincia,
                                Citta,
                                Indirizzo,
                                Cap,
                                ProvinciaBis,
                                CittaBis,
                                DataNascita,
                                LuogoNascita,
                                StatoNascita,
                                LuogoNascitaBis,
                                ProvinciaNascitaBis,
                                Note
                            ) 
                        VALUE (
                                '".$idsito."',
                                '".$Prenotazione."',
                                '".$NumeroPersone."',
                                '".$TipoComponente."',
                                '".$TipoDocumento."',
                                '".$NumeroDocumento."',
                                '".$ComuneEmissione."',
                                '".$StatoEmissione."',
                                '".$DataRilascio."',
                                '".$DataScadenza."',
                                '".$Nome."', 
                                '".$Cognome."',
                                '".$Sesso."',
                                '".$Cittadinanza."',
                                '".$Provincia."',
                                '".$Citta."',
                                '".$Indirizzo."',
                                '".$Cap."',
                                '".$ProvinciaBis."',
                                '".$CittaBis."',
                                '".$DataNascita."', 
                                '".$LuogoNascita."',
                                '".$StatoNascita."',
                                '".$LuogoNascitaBis."',
                                '".$ProvinciaNascitaBis."',
                                '".$Note."'
                                    )" ;

            $dbMysqli->query($insert);

	}

?>