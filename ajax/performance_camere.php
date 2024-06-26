<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");

 error_reporting(0);
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$db = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($db, 'utf8');

function colorGen() {

    $caratteri_disponibili ="abcdef1234567890";
    $colore = "";
    for($i = 0; $i<6; $i++){
        $colore .= substr($caratteri_disponibili,rand(0,strlen($caratteri_disponibili)-1),1);
    }
    return '#'.$colore;
}


  $p_data = $_REQUEST['p_data'];
  $s_data = $_REQUEST['s_data'];
  $date   = $_REQUEST['date'];
  $data_tmp = explode("-", trim($date));
  $dataChiusoDa_ = explode("/",trim($data_tmp[0]));
  $dataChiusoA_ = explode("/",trim($data_tmp[1]));
  $dataChiusoDa = $dataChiusoDa_[2].'-'.$dataChiusoDa_[0].'-'.$dataChiusoDa_[1].' 00:00:00';
  $dataChiusoA = $dataChiusoA_[2].'-'.$dataChiusoA_[0].'-'.$dataChiusoA_[1].' 23:59:59';

  $DataRichiesta_dal = $dataChiusoDa_[2].'-'.$dataChiusoDa_[0].'-'.$dataChiusoDa_[1];
  $DataRichiesta_al = $dataChiusoA_[2].'-'.$dataChiusoA_[0].'-'.$dataChiusoA_[1];

  $p_anno = $dataChiusoDa_[2];
  $s_anno = $dataChiusoA_[2];
  $idsito = $_REQUEST['idsito'];

function tot_fatturato($n_format=null){
	global $db,$idsito,$p_data,$s_data,$dataChiusoDa,$dataChiusoA;
  $p_data = $p_data.' 00:00:00';
  $s_data = $s_data.' 23:59:59';

	$query = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE 1=1
                AND hospitality_guest.idsito = '.$idsito.'
                
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.TipoRichiesta = "Conferma"
                AND (hospitality_guest.DataRichiesta >= "'.$DataRichiesta_dal.'" AND hospitality_guest.DataRichiesta <= "'.$DataRichiesta_al.'")';
    $result = mysqli_query($db,$query);
    $rwc    = mysqli_fetch_assoc($result);

    if($n_format){
        return $rwc['fatturato'];
    }else{
        return number_format($rwc['fatturato'],2,',','.');
    }

}


  function prenotazioni_per_camera(){
      global $db,$idsito,$p_data,$s_data,$p_anno,$s_anno,$date,$$DataRichiesta_dal,$DataRichiesta_al;

      $sel = "SELECT hospitality_tipo_camere.Id as IdCamera, hospitality_tipo_camere.TipoCamere as Camera FROM hospitality_tipo_camere WHERE hospitality_tipo_camere.idsito = ".$idsito." AND hospitality_tipo_camere.Abilitato = 1 ORDER BY TipoCamere ASC";
      $r   = mysqli_query($db,$sel);
      $tot = mysqli_num_rows($r);

      if(($tot)>0){

          $op .=' <table class="xcrud-list table table-striped table-hover table-bordered">
                      <tr>
                          <th class="text-left col-md-3 nowrap"><small>Camere</small></th>
                          <th class="text-center col-md-1 nowrap"><small>Nr.Camere</small></th>
                          <th class="text-right col-md-2 nowrap"><small>Fatturato</small></th>
                          <th class="text-center col-md-1 nowrap"><small>%</small></th>
                  </tr>';

          $percentuale           = '';
          $totale_camere_vendute = '';
          $ADR                   = '';
          $totale_cd             = '';
          $totale                = '';
          $rec                   = '';
          $rec2                  = '';
          $DataApertura          = '';
          $DataChiusura          = '';
          $giorni_totali         = '';
          $tariffa_media         = '';
          $datediff              = '';

          if($date == ''){
              $anno = ' AND YEAR(DataArrivo) >= "'.date('Y').'" AND YEAR(DataPartenza) <= "'.date('Y').'" ';
          }else{
              $anno = ' AND YEAR(DataArrivo) >= "'.$p_anno.'" AND YEAR(DataPartenza) <= "'.$s_anno.'" ';
          }

          $c = 0;
          while ($vl = mysqli_fetch_assoc($r)) {

              $select3 ='SELECT hospitality_guest.DataArrivo as data_apertura
                          FROM hospitality_guest
                          WHERE 1=1
                            '.$anno.'
                          AND hospitality_guest.idsito = '.$idsito.'
                          
                          AND hospitality_guest.Disdetta = 0
                          AND hospitality_guest.Hidden = 0
                          AND hospitality_guest.NoDisponibilita = 0
                          AND hospitality_guest.TipoRichiesta = "Conferma"
                          ORDER BY DataArrivo ASC LIMIT 1';
              $res3  = mysqli_query($db,$select3);
              $rec3 = mysqli_fetch_assoc($res3);
              $DataApertura = strtotime($rec3['data_apertura']);

              $select4 ='SELECT hospitality_guest.DataPartenza as data_chiusura
                          FROM hospitality_guest
                          WHERE 1=1
                          '.$anno.'
                          AND hospitality_guest.idsito = '.$idsito.'
                         
                          AND hospitality_guest.Disdetta = 0
                          AND hospitality_guest.Hidden = 0
                          AND hospitality_guest.NoDisponibilita = 0
                          AND hospitality_guest.TipoRichiesta = "Conferma"
                          ORDER BY DataPartenza DESC LIMIT 1';
              $res4  = mysqli_query($db,$select4);
              $rec4 = mysqli_fetch_assoc($res4);
              $DataChiusura = strtotime($rec4['data_chiusura']);

              $datediff = ($DataChiusura - $DataApertura);
              $giorni_totali = round($datediff / (60 * 60 * 24));

                if($giorni_totali != 0){
                    $giorni_totali_ = false;
                }else{
                    $giorni_totali_ = true;
                }

              $select ='SELECT SUM(hospitality_richiesta.Prezzo) as fatturato, COUNT(hospitality_richiesta.TipoCamere) as nCamere
                          FROM hospitality_guest
                          INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                          INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id
                          WHERE 1=1
                          AND hospitality_richiesta.TipoCamere = '.$vl['IdCamera'].'
                          AND hospitality_guest.idsito = '.$idsito.'
                          
                          AND hospitality_guest.Disdetta = 0
                          AND hospitality_guest.Hidden = 0
                          AND hospitality_guest.NoDisponibilita = 0
                          AND '.($date == ''?' hospitality_guest.DataRichiesta >= "'.date('Y').'-01-01" AND hospitality_guest.DataRichiesta <= "'.date('Y').'-12-31"': ' hospitality_guest.DataRichiesta >= "'.$DataRichiesta_dal.'" AND hospitality_guest.DataRichiesta <= "'.$DataRichiesta_al.'"').'
                          AND hospitality_guest.TipoRichiesta = "Conferma" ';
              $res  = mysqli_query($db,$select);
              $rec  = mysqli_fetch_assoc($res);

              $select2 ='SELECT COUNT(hospitality_richiesta.TipoCamere) as TotCamere
                          FROM hospitality_guest
                          INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                          INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id
                          WHERE 1=1
                          AND hospitality_guest.idsito = '.$idsito.'
                          
                          AND hospitality_guest.Disdetta = 0
                          AND hospitality_guest.NoDisponibilita = 0
                          AND hospitality_guest.Hidden = 0
                          AND '.($date == ''?' hospitality_guest.DataRichiesta >= "'.date('Y').'-01-01" AND hospitality_guest.DataRichiesta <= "'.date('Y').'-12-31"': ' hospitality_guest.DataRichiesta >= "'.$DataRichiesta_dal.'" AND hospitality_guest.DataRichiesta <= "'.$DataRichiesta_al.'"').'
                          AND hospitality_guest.TipoRichiesta = "Conferma" ';
              $res2  = mysqli_query($db,$select2);
              $rec2  = mysqli_fetch_assoc($res2);

              if($rec2['TotCamere']>0){
                  $totale_camere_vendute = $rec2['TotCamere'];

                  $percentuale = ((100*$rec['nCamere'])/$totale_camere_vendute);
                  $percentuale =  number_format($percentuale,2,',','.');
                  $percentuale = str_replace(",00", "",$percentuale).' %';
                  if(tot_fatturato()>0 && $rec['nCamere']>0){
                      $ADR = (tot_fatturato()/$rec['nCamere']);
                  }else{
                      $ADR = 0;
                  }
              }else{
                  $percentuale = 0;
                  $ADR = 0;
              }
              switch($c){
                  case 0:
                      $color = '';
                      $ico   = 'fa fa-bed text-red';
                  break;
                  case 1:
                      $color = '';
                      $ico   = 'fa fa-bed text-green';
                  break;
                  case 2:
                      $color = '';
                      $ico   = 'fa fa-bed text-lime';
                  break;
                  case 3:
                      $color = '';
                      $ico   = 'fa fa-bed text-teal';
                  break;
                  case 4:
                      $color = '';
                      $ico   = 'fa fa-bed text-maroon';
                  break;
                  case 5:
                      $color = '';
                      $ico   = 'fa fa-bed text-blue';
                  break;
                  default:
                      $color =  'style="color:'.colorGen().'"';
                      $ico   = 'fa fa-bed';
                  break;
              }

              if($rec['nCamere']!= 0){
                if($giorni_totali_==true){
					$tariffa_media = ($rec['fatturato']/$giorni_totali/$rec['nCamere']);				
				}else{
					$tariffa_media = ($rec['fatturato']/$rec['nCamere']);
				}
              }else{
                $tariffa_media = 0;
              }

              $op .='<tr>
                          <td class="text-left nowrap"><small><i class="'.$ico.'" '.$color.'></i> &nbsp; '.$vl['Camera'].'</small></td>
                          <td class="text-center nowrap"><small>'.$rec['nCamere'].'</small></td>
                          <td class="text-right nowrap"><small>'.($rec['fatturato']>0?number_format($rec['fatturato'],2,',','.'):'0,00').' <i class="fa fa-euro"></i></small></td>
                          <td class="text-center nowrap"><small>'.$percentuale.'</small></td>
                      </tr>';

            $c++;
          }

          $op .= '</table>';

          return $op;
      }else{
          return 'Nessun risultato!';
      }

  }

echo  prenotazioni_per_camera();

mysqli_close($db);
?>
