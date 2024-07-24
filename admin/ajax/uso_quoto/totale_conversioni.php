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

$idsito = $_REQUEST['idsito'];

function totale_invii($idsito){
    global $dbMysqli;

    $select = "SELECT
                COUNT(hospitality_guest.Id) as totale_invii
              FROM
                hospitality_guest
              WHERE
                hospitality_guest.TipoRichiesta = 'Preventivo'
              AND
                hospitality_guest.idsito = ".$idsito."
              AND
                hospitality_guest.Chiuso = 0
              AND
                hospitality_guest.Hidden = 0
              AND
                hospitality_guest.NoDisponibilita = 0
              AND
                hospitality_guest.Accettato = 0
              AND
                hospitality_guest.DataInvio IS NOT NULL
              AND (DataRichiesta >= '".date('Y')."-01-01' AND DataRichiesta <= '".date('Y')."-12-31')";

    $res = $dbMysqli->query($select);
    $rws = $res[0];

    return $rws['totale_invii'];
}

function totale_prenotazioni($idsito){
    global $dbMysqli;

      $select = "SELECT
                  COUNT(hospitality_guest.Id) as totale_prenotazioni
                FROM
                  hospitality_guest
                WHERE
                  hospitality_guest.TipoRichiesta = 'Conferma'
                AND
                  hospitality_guest.idsito = ".$idsito."
                AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Disdetta = 0			
				AND 
					hospitality_guest.Chiuso = 1 
                AND 
                    (hospitality_guest.IdMotivazione IS NULL OR hospitality_guest.DataRiconferma IS NOT NULL)
                AND 
                    hospitality_guest.CheckinOnlineClient = 0
				AND 
					hospitality_guest.NoDisponibilita = 0
                AND (hospitality_guest.DataRichiesta >= '".date('Y')."-01-01' 
                AND hospitality_guest.DataRichiesta <= '".date('Y')."-12-31')";

      $res = $dbMysqli->query($select);
      $rwc = $res[0];

      return $rwc['totale_prenotazioni'];
}

function tot_conversion($totale_invii,$totale_prenotazioni,$tipo=null){
    $conversioni = @((100*$totale_prenotazioni)/$totale_invii);
    if(is_int($conversioni)){
  		$conversioni = $conversioni;
  	}else{
  		$conversioni =	number_format($conversioni,2,',','.');
  	}
    if($conversioni == ''){
      $conversioni = 0;
    }
      if($tipo == 'format'){
        return str_replace(",00", "",$conversioni);
      }else{
        return str_replace(",00", "",$conversioni).' %';
      }
  }

$totale_invii        = totale_invii($idsito);
$totale_prenotazioni = totale_prenotazioni($idsito);
$conversioni         = tot_conversion($totale_invii,$totale_prenotazioni,'');
if($conversioni == 'nan %' || $conversioni == 'inf %'){
    echo '... %';
}else{
    echo $conversioni;
}
