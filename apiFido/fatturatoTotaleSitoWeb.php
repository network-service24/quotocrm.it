<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/class/MysqliDb.php");

$dbMysqli  = new MysqliDb (HOST, DB_USER, DB_PASSWORD, DATABASE);

if($_REQUEST['action']=='auth'){

    $usr 	   = $_REQUEST["usr"];
    $pws 	   = $_REQUEST["pws"];
	$idSito    = $_REQUEST["idsito"];
	$startDate = $_REQUEST["dal"];
	$endDate   = $_REQUEST["al"];

    if($usr == "TOKEN2024nws#" && $pws == "apiServiceNWS"){ 


        $sql = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                    FROM hospitality_guest
                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    WHERE 1=1
                    AND hospitality_guest.idsito = ".$idSito."
                    AND hospitality_guest.FontePrenotazione = 'Sito Web'
                    AND hospitality_guest.NoDisponibilita = 0
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.TipoRichiesta = 'Conferma'
                    AND ((hospitality_guest.DataRichiesta >= '".$startDate."' AND hospitality_guest.DataRichiesta <= '".$endDate."')
                    OR (DATE(hospitality_guest.DataChiuso) >= '".$startDate."' AND DATE(hospitality_guest.DataChiuso) <= '".$endDate."'))";

        $rw = $dbMysqli->query($sql);

		if(sizeof($rw) > 0 ){

			echo number_format($rw[0]['fatturato'],2,',','.');;

		}else{

			echo 0;

		}						



                
    }else{ 

        echo 'XXXXAccesso non autorizzato | API QUOTO! | by Network Service srl';
        exit;
    }

}else{ 

	echo 'Accesso non autorizzato | API QUOTO! | by Network Service srl';
	exit;
}