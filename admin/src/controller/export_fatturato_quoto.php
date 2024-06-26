<?
include_once($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include_once($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include_once($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');

if ($_REQUEST['date']) {

  $date_tmp         = explode("-",$_REQUEST['date']);
  $data_1_tmp       = trim($date_tmp[0]);
  $data_2_tmp       = trim($date_tmp[1]);
  $prima_data_tmp   = explode("/",$data_1_tmp);
  $seconda_data_tmp = explode("/",$data_2_tmp);
  $start            = $prima_data_tmp[2].'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
  $end              = $seconda_data_tmp[2].'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];
  $start_           = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
  $end_             = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];
  $prima_data_it    = $prima_data_tmp[0].'/'.$prima_data_tmp[1].'/'.($prima_data_tmp[2]-1);
  $seconda_data_it  = $seconda_data_tmp[0].'/'.$seconda_data_tmp[1].'/'.($seconda_data_tmp[2]-1);


}else{

  $dal = mktime(0,0,0,01,01,date('Y'));
  $al  = mktime(0,0,0,date('m'),date('d'),date('Y'));

  $start = date('Y-m-d',$dal);
  $end = date('Y-m-d',$al);

  $data_1_tmp = date('d-m-Y',$dal);
  $data_2_tmp = date('d-m-Y',$al);

  $dal_ = mktime(0,0,0,01,01,(date('Y')-1));
  $al_ = mktime(0,0,0,date('m'),date('d'),(date('Y')-1));

  $start_ = date('Y-m-d',$dal_);
  $end_ = date('Y-m-d',$al_);

  $prima_data_it = date('d-m-Y',$dal_);
  $seconda_data_it = date('d-m-Y',$al_);
}

$filter_query = " AND ((hospitality_guest.DataRichiesta >= '$start' AND hospitality_guest.DataRichiesta <= '$end') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$start' AND DATE(hospitality_guest.DataChiuso) <= '$end'))";

$filter_query_ = " AND ((hospitality_guest.DataRichiesta >= '$start_' AND hospitality_guest.DataRichiesta <= '$end_') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$start_' AND DATE(hospitality_guest.DataChiuso) <= '$end_'))";

function tot_fatturato_anno($idsito,$format=null){
    global $dbMysqli,$filter_query;

    $select = "SELECT
                SUM(hospitality_proposte.PrezzoP) as fatturato
              FROM
                hospitality_guest
              INNER JOIN
                hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
              WHERE
                1 = 1
                ".$filter_query."
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

function tot_fatturato_scorsoanno($idsito,$format=null){
  global $dbMysqli,$filter_query_;

  $select = "SELECT
              SUM(hospitality_proposte.PrezzoP) as fatturato
            FROM
              hospitality_guest
            INNER JOIN
              hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
            WHERE
              1 = 1
              ".$filter_query_."
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

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=export_fatturato_quoto.csv');
header('Pragma: no-cache');
// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Cliente', 'Quoto attivo dal', $data_1_tmp.' / '.$data_2_tmp, $prima_data_it.' / '.$seconda_data_it, 'Percentuale', 'Differenza'),';');

 
    $quy    = 'SELECT siti.idsito
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

    $rec        = $dbMysqli->query($quy);


    $oggiMenoAnno = ((date('Y')-1).'-'.date('m-d'));

    $anno         = '';
    $passato      = '';
    $differenza   = '';
    $percentuale_ = '';
    $percentuale  = '';

    foreach ($rec as $ky  => $value) {
      
      $anno         = tot_fatturato_anno($value['idsito'],1);
      $passato      = tot_fatturato_scorsoanno($value['idsito'],1);
      $differenza   = number_format(($anno - $passato),2,',','.');
      $percentuale_ = ((100*($anno - $passato))/$anno);
      $percentuale  = number_format($percentuale_,2,',','.');

        fputcsv($output, array($value['web'],gira_data($value['data_start_hospitality']),tot_fatturato_anno($value['idsito'],''),tot_fatturato_scorsoanno($value['idsito'],''),$percentuale.'%',$differenza),';');

    }

    $anno         = '';
    $passato      = '';
    $differenza   = '';
    $percentuale_ = '';
    $percentuale  = '';

fclose($output);