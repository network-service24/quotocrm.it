<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/class/MysqliDb.php");

$dbMysqli  = new MysqliDb (HOST, DB_USER, DB_PASSWORD, DATABASE);

if($_REQUEST['action']=='auth'){

    $usr 	   = $_REQUEST["usr"];
    $pws 	   = $_REQUEST["pws"];
	$idsito    = $_REQUEST["idsito"];
	$startdate = $_REQUEST["dal"];
	$enddate   = $_REQUEST["al"];

    if($usr == "TOKEN2024nws#" && $pws == "apiServiceNWS"){ 

            $sel = $dbMysqli->query('SELECT COUNT(Id) as tot_preventivi FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = '.$idsito.'  AND Hidden = 0 AND  DataRichiesta >= "'.$startdate.'" AND DataRichiesta <= "'.$enddate.'"');
            $rw  = $sel[0];
            $tot_preventivi =  $rw['tot_preventivi'];

            $sel = $dbMysqli->query('SELECT COUNT(Id) as tot_invii FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = '.$idsito.' AND Chiuso = 0 AND Hidden = 0 AND DataInvio != "" AND DataRichiesta >= "'.$startdate.'" AND DataRichiesta <= "'.$enddate.'"');
            $rws = $sel[0];
            $tot_invii =  $rws['tot_invii'];

            $sel = $dbMysqli->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.$idsito.' AND Hidden = 0 AND Chiuso = 1 AND Archivia = 1 AND DataRichiesta >= "'.$startdate.'" AND DataRichiesta <= "'.$enddate.'"');
            $rwc = $sel[0];
            $tot_preno_archiviateR =  $rwc['tot_prenotazioni'];

            $sel = $dbMysqli->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = '.$idsito.' AND Disdetta = 0  AND Hidden = 0 AND DataRichiesta >= "'.$startdate.'" AND DataRichiesta <= "'.$enddate.'"');
            $rwc = $sel[0];
            $tot_prenotazioniR = $rwc['tot_prenotazioni'];

            $sel = $dbMysqli->query('SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                    FROM hospitality_guest
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                    WHERE 1=1
                                    AND hospitality_guest.idsito = '.$idsito.'
                                    AND hospitality_guest.NoDisponibilita = 0
                                    AND hospitality_guest.Hidden = 0
                                    AND hospitality_guest.Disdetta = 0
                                    AND hospitality_guest.TipoRichiesta = "Conferma"
                                    AND ((hospitality_guest.DataRichiesta >= "'.$startdate.'" AND hospitality_guest.DataRichiesta <= "'.$enddate.'") OR (DATE(hospitality_guest.DataChiuso)>= "'.$startdate.'" AND DATE(hospitality_guest.DataChiuso) <= "'.$enddate.'"))');
            $rwc = $sel[0];
            $tot_fatturatoR = number_format($rwc['fatturato'],2,',','.');

			function tot_conversioniR($tot_invii,$tot_prenotazioni){
				$conversioni = @((100*$tot_prenotazioni)/$tot_invii);
				if(is_int($conversioni)){
					$conversioni = $conversioni;
				}else{
					$conversioni =	number_format($conversioni,2,',','.');
				}
				return str_replace(",00", "",$conversioni).' %';
			}

            $tot_conversioniR = tot_conversioniR($tot_invii,($tot_prenotazioniR+$tot_preno_archiviateR));

            $select = "SELECT FontePrenotazione, Abilitato FROM hospitality_fonti_prenotazione WHERE idsito = ".$idsito."";
            $rws = $dbMysqli->query($select);
            $tot = sizeof($rws);
            if($tot>0){
                foreach ($rws as $key => $value) {

                    $select2 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                            FROM hospitality_guest
                                            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                            WHERE hospitality_guest.FontePrenotazione = '".$value['FontePrenotazione']."'
                                            AND((hospitality_guest.DataRichiesta >= '".$startdate."' AND hospitality_guest.DataRichiesta <= '".$enddate."') OR (DATE(hospitality_guest.DataChiuso)>= '".$startdate."' AND DATE(hospitality_guest.DataChiuso) <= '".$enddate."'))
                                            AND hospitality_guest.idsito = ".$idsito."
                                            AND hospitality_guest.NoDisponibilita = 0
                                            AND hospitality_guest.Disdetta = 0
                                            AND hospitality_guest.Hidden = 0
                                            AND hospitality_guest.TipoRichiesta = 'Conferma' ";
                    $res2 = $dbMysqli->query($select2);
                    $rws2 = $res2[0];
                    $fatturato = $rws2['fatturato'];
                    if($fatturato == '')$fatturato = 0;
                    $array_fatturato[$value['FontePrenotazione'].'_'.$value['Abilitato']]  = $fatturato;

                }





                $td_fonti .= '<tr><td class="col-md-6 font20Bold text-center"><b>TOTALE</b></td><td class="col-md-6"><input type="text" name="totale_fatturato_fonti"  class=" form-control no_border_input font20Bold text-center" value="'.number_format($totale,2,',','.').'" /></td></tr>';
            }

            //PROVENINEZA DA SITO Web

                $sel = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                            FROM hospitality_guest
                            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                            WHERE 1=1
                            AND hospitality_guest.idsito = ".$idsito."
                            AND hospitality_guest.FontePrenotazione = 'Sito Web'
                            AND hospitality_guest.NoDisponibilita = 0
                            AND hospitality_guest.Hidden = 0
                            AND hospitality_guest.Disdetta = 0
                            AND hospitality_guest.TipoRichiesta = 'Conferma'
                            AND ((hospitality_guest.DataRichiesta >= '".$startdate."' AND hospitality_guest.DataRichiesta <= '".$enddate."') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$startdate' AND DATE(hospitality_guest.DataChiuso) <= '$enddate'))";
                $rw = $dbMysqli->query($sel);
                $rwc = $rw[0];

                $fatturatoTotaleSitoWeb =  $rwc['fatturato'];


            $sel = "SELECT SUM(fatturato) as fatt,
                            sorgente,
                            media
                    FROM (
                        SELECT 
                            CASE 
                                WHEN TipoRichiesta = 'Conferma' THEN
                                    hospitality_proposte.PrezzoP
                                ELSE
                                    0
                            END as fatturato,
                                hospitality_utm_ads.utm_source as sorgente,
                                hospitality_utm_ads.utm_medium as media
                        FROM hospitality_guest
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                    INNER JOIN 
                                    hospitality_utm_ads 
                                ON 
                                    (hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                                AND
                                    hospitality_utm_ads.idsito = hospitality_guest.idsito)                   
                        WHERE 1 = 1
                        AND ((hospitality_guest.DataRichiesta >= '$startdate' AND hospitality_guest.DataRichiesta <= '$enddate') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$startdate' AND DATE(hospitality_guest.DataChiuso) <= '$enddate'))
                            AND hospitality_guest.idsito = " . $idsito . "
                            AND hospitality_guest.FontePrenotazione = 'Sito Web'
                            AND hospitality_guest.Disdetta = 0
                            AND hospitality_guest.NoDisponibilita = 0
                            AND hospitality_guest.Hidden = 0
                            AND hospitality_utm_ads.idsito = " . $idsito . "
                    ) as sub
                GROUP BY sorgente, media";

            $rws_ = $dbMysqli->query($sel);

            foreach ($rws_ as $y => $va) {
                if($va['sorgente']!=''){
                    $array_fatturatoS[] = array('fatturato' => $va['fatt'],'source' => $va['sorgente'], 'medium' => $va['media']);
                }
            }




            // FATTURATO PER OPERATORI
            //
            // Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
            $select15 = "SELECT * FROM hospitality_operatori WHERE idsito = ".$idsito."";
            $rws15 = $dbMysqli->query($select15);

            $totOperatore = sizeof($rws15);
            if($totOperatore>0){

                $operatore = '';
                $abilitatoOP = '';

                foreach ($rws15 as $key15 => $value15) {

                    $operatore = trim(addslashes($value15['NomeOperatore']));
                    $abilitatoOP = $value15['Abilitato'];


                            $select16  = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                                    FROM hospitality_guest
                                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                                    WHERE hospitality_guest.ChiPrenota = '".$operatore."'
                                                    AND ((hospitality_guest.DataRichiesta >= '".$startdate."' AND hospitality_guest.DataRichiesta <= '".$enddate."') OR (DATE(hospitality_guest.DataChiuso)>= '".$startdate."' AND DATE(hospitality_guest.DataChiuso) <= '".$enddate."'))
                                                    AND hospitality_guest.idsito = ".$idsito."
                                                    AND hospitality_guest.NoDisponibilita = 0
                                                    AND hospitality_guest.DataRichiesta IS NOT NULL
                                                    AND hospitality_guest.Disdetta = 0
                                                    AND hospitality_guest.Hidden = 0
                                                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
                            $res16 = $dbMysqli->query($select16);
                            $rws16 = $res16[0];
                            $fatturatoOperatore = $rws16['fatturato'];
                            if($fatturatoOperatore == '')$fatturatoOperatore = 0;
                            $array_fatturatoOperatore[$operatore.'_'.$abilitatoOP]  = $fatturatoOperatore;
                }
            }
            //PER TARGET CLIENTE
            $select18 = "SELECT Target FROM hospitality_target WHERE idsito = ".$idsito." ORDER BY Id ASC";
            $rws18 = $dbMysqli->query($select18);

            $totTARGET = sizeof($rws18);
            if($totTARGET>0){
                foreach ($rws18 as $key18 => $value18) {

                    $select19 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                            FROM hospitality_guest
                                            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                            WHERE hospitality_guest.TipoVacanza = '".$value18['Target']."'
                                            AND ((hospitality_guest.DataRichiesta >= '".$startdate."' AND hospitality_guest.DataRichiesta <= '".$enddate."') OR (DATE(hospitality_guest.DataChiuso)>= '".$startdate."' AND DATE(hospitality_guest.DataChiuso) <= '".$enddate."'))
                                            AND hospitality_guest.idsito = ".$idsito."
                                            AND hospitality_guest.NoDisponibilita = 0
                                            AND hospitality_guest.Disdetta = 0
                                            AND hospitality_guest.Hidden = 0
                                            AND hospitality_guest.TipoRichiesta = 'Conferma' ";
                    $res19 = $dbMysqli->query($select19);
                    $rws19 = $res19[0];
                    $fatturatoTARGET = $rws19['fatturato'];
                    if($fatturatoTARGET == '')$fatturatoTARGET = 0;
                    if($fatturatoTARGET != '' || $fatturatoTARGET != 0){

                            $array_fatturatoTARGET[$value18['Target']]  = $fatturatoTARGET;
                    }

                }

            }
                    

            $json_data = array(
                                "tot_preventivi"           => $tot_preventivi,
                                "tot_invii"                => $tot_invii ,
                                "tot_preno_archiviateR"    => $tot_preno_archiviateR ,
                                "tot_prenotazioniR"        => $tot_prenotazioniR,
                                "tot_fatturatoR" 	       => $tot_fatturatoR,
                                "tot_conversioniR" 		   => $tot_conversioniR,
                                "array_fatturatoFonti"     => $array_fatturato,
                                "fatturatoTotaleSitoWeb"   => $fatturatoTotaleSitoWeb,
                                "array_fatturatoSitoWeb"   => $array_fatturatoS,
                                "array_fatturatoOperatori" => $array_fatturatoOperatore,
                                "array_fatturatoTarget"    => $array_fatturatoTARGET,
                                ); 
            $json_data = json_encode($json_data);
            
            echo $json_data; 
            
                
    }else{ 

        echo 'Accesso non autorizzato | API QUOTO! | by Network Service srl';
        exit;
    }

}else{ 

	echo 'Accesso non autorizzato | API QUOTO! | by Network Service srl';
	exit;
}