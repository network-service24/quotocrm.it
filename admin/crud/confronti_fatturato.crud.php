<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

$data   = array();
$start  = $_REQUEST['start'];
$start_ = $_REQUEST['start_'];
$end    = $_REQUEST['end'];
$end_   = $_REQUEST['end_'];

function tot_fatturato_anno($idsito,$format=null,$start,$end){
    global $dbMysqli;

    $select = "SELECT
                SUM(hospitality_proposte.PrezzoP) as fatturato
              FROM
                hospitality_guest
              INNER JOIN
                hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
              WHERE
                1 = 1
                AND ((hospitality_guest.DataRichiesta >= '$start' AND hospitality_guest.DataRichiesta <= '$end') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$start' AND DATE(hospitality_guest.DataChiuso) <= '$end'))
              AND
                hospitality_guest.idsito = ".$idsito."
              AND
                hospitality_guest.NoDisponibilita = 0
              AND
                hospitality_guest.Disdetta = 0
              AND
                  hospitality_guest.Hidden = 0
              AND
                hospitality_guest.TipoRichiesta = 'Conferma'";

    $res = $dbMysqli->query($select);
    $rwc = $res[0];

    if($format==1){
      return $rwc['fatturato'];
    }else{
      return number_format($rwc['fatturato'],2,',','.');
    }  

}

function tot_fatturato_scorsoanno($idsito,$format=null,$start_,$end_){
  global $dbMysqli;

   $select = "SELECT
              SUM(hospitality_proposte.PrezzoP) as fatturato
            FROM
              hospitality_guest
            INNER JOIN
              hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
            WHERE
              1 = 1
              AND ((hospitality_guest.DataRichiesta >= '$start_' AND hospitality_guest.DataRichiesta <= '$end_') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$start_' AND DATE(hospitality_guest.DataChiuso) <= '$end_'))
            AND
              hospitality_guest.idsito = ".$idsito."
            AND
              hospitality_guest.NoDisponibilita = 0
            AND
              hospitality_guest.Disdetta = 0
            AND
                hospitality_guest.Hidden = 0
            AND
              hospitality_guest.TipoRichiesta = 'Conferma'";

  $res = $dbMysqli->query($select);
  $rwc = $res[0];

  if($format==1){
    return $rwc['fatturato'];
  }else{
    return number_format($rwc['fatturato'],2,',','.');
  }  

}



    $quy  = 'SELECT siti.idsito
                    , siti.web
                    , siti.data_start_hospitality
                    , siti.data_end_hospitality
                FROM siti
                WHERE siti.idsito NOT IN(1740,1987)
                AND siti.hospitality = 1
                AND siti.servizi_attivi LIKE "%Quoto%"
                AND siti.data_start_hospitality <= "'.date('Y-m-d').'"
                AND siti.data_end_hospitality > "'.date('Y-m-d').'"
                ORDER BY siti.data_start_hospitality'; 

    $rec  = $dbMysqli->query($quy);
    $n = 1;
	foreach($rec as $key => $value){

        $anno       = tot_fatturato_anno($value['idsito'],1,$start,$end);
        $passato    = tot_fatturato_scorsoanno($value['idsito'],1,$start_,$end_);
        $differenza = number_format(($anno - $passato),2,',','.');
        $percentuale_ = @((100*($anno - $passato))/$anno);
        $percentuale = number_format($percentuale_,2,',','.');
		
		
        $data[] = array(
            "cliente"         => '<span class="f-11 p-r-10">'.$n.')</span> '.$value['web'].' <span class="f-10 p-l-10">[attivo dal '.gira_data($value['data_start_hospitality']).']</span>',
            "periodo"         => '<span class="ordinamento">'.$anno.'</span>€ <span class="text-blue">'.tot_fatturato_anno($value['idsito'],'',$start,$end).'</span>',
            "confronto"       => '<span class="ordinamento">'.$passato.'</span>€ <span class="text-orange">'.tot_fatturato_scorsoanno($value['idsito'],'',$start_,$end_).'</span>',
            "andamento"       => (strstr($differenza,'-')?'<i class="fa fa-arrow-down text-red"></i>':'<i class="fa fa-arrow-up text-green"></i>'),
            "percentuale"     => '<span class="ordinamento">'.$percentuale_.'</span>'.(strstr($differenza,'-')?'<span class="text-red f-11">' .$percentuale.'%</span>':'<span class="text-green f-11"> +' .$percentuale.'%</span>'),
            "differenza"      => '<span class="ordinamento">'.($anno - $passato).'</span>€ '.(strstr($differenza,'-')?'<span class="text-red">'.$differenza.'</span>':'<span class="text-green">'.$differenza.'</span>')
        );

        $n++;
	}

 	$json_data = array(
						"draw"            => 1,
						"recordsTotal"    => sizeof($rec) ,
						"recordsFiltered" => sizeof($rec),
						"data" 			  => $data
						); 



if(empty($json_data) || is_null($json_data)){
	$json_data = NULL;
}else{
	$json_data = json_encode($json_data);
}
	  echo $json_data; 
