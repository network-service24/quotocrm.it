<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
close_session();
$p_data = $_REQUEST['p_data'];
$s_data = $_REQUEST['s_data'];
$idsito = $_REQUEST['idsito'];

  function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
  {
      $datetime1 = date_create($date_1);
      $datetime2 = date_create($date_2);

      $interval = date_diff($datetime1, $datetime2);

      return $interval->format($differenceFormat);

  }

  function leadtime_prenotazioni(){
    global $dbMysqli,$idsito,$p_data,$s_data;

    $media           = '';
    $numero_valori   = '';
    $colore_leadtime = '';

    if($p_data == ''){
        $dataDal = date('Y').'-01-01';
    }else{
        $dataDal = $p_data;
    }
    if($s_data == ''){
        $dataAl = date('Y').'-12-31';
    }else{
        $dataAl = $s_data;
    }
      $select = '   SELECT  DataRichiesta
                        ,NumeroPrenotazione,
                        DATE(DataChiuso) as DataChiuso
                    FROM hospitality_guest
                    WHERE hospitality_guest.idsito = '.$idsito.'
                    AND hospitality_guest.DataRichiesta >= "'.$dataDal.'"
                    AND hospitality_guest.DataRichiesta <= "'.$dataAl.'"
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.NoDisponibilita = 0
                    AND hospitality_guest.Archivia = 0
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.TipoRichiesta = "Preventivo" ';
      $res = $dbMysqli->query($select);
      $tot = sizeof($res);
      if(($tot)>0){
          foreach ($res as $key => $value) {

              $select2 = "  SELECT  DATE(DataChiuso) as DataChiuso
                            FROM hospitality_guest
                            WHERE hospitality_guest.idsito = ".$idsito."
                            AND ((hospitality_guest.DataRichiesta >= '".$dataDal."' AND hospitality_guest.DataRichiesta <= '".$dataAl."') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '".$dataDal."' AND DATE(hospitality_guest.DataChiuso) <= '".$dataAl."'))
                            AND hospitality_guest.NumeroPrenotazione = ".$value['NumeroPrenotazione']."
                            AND hospitality_guest.Disdetta = 0
                            AND hospitality_guest.Hidden = 0
                            AND hospitality_guest.NoDisponibilita = 0
                            AND hospitality_guest.Archivia = 0
                            AND hospitality_guest.TipoRichiesta = 'Conferma' ";
              $res2 = $dbMysqli->query($select2);
              foreach ($res2 as $key2 => $val) {

                $output[] = dateDifference($value['DataRichiesta'],$val['DataChiuso']);
              }

          }

          if(!empty($output) && !is_null($output)){
              $totale_giorni = '';
              $numero_valori = count($output);
              foreach ($output as $key => $value) {
              @$totale_giorni += $value ;
              }
              $media = ($totale_giorni/$numero_valori);

              ceil( $media );
              $media_  = explode(".",number_format($media,2));
              $giorni_ = ($media_[0]);
              $tempo_  = ($media_[1]);

            if($tempo_ >= 1 && $tempo_ <= 25){

                $_format_ = ' 6 ore ';

            }elseif($tempo_ >= 26 && $tempo_ <= 50){

                $_format_ = '  12 ore ';

            }elseif($tempo_ >= 51 && $tempo_ <= 75){

                $_format_ = ' 18 ore ';

            }elseif($tempo_ >= 76 && $tempo_ <= 99){

                $_format_ = ' 22 ore ';

            }

              if($giorni_ >= '1'){
              $_format = $giorni_ .' giorni'.($tempo_  != 00 ? '  e  '.$_format_:'');
              }else{
                  $_format = ($tempo_  != 00 ?$_format_.' di giorni':'');
              }

              if(($giorni_ == 0 || $giorni_ == 00) && ($tempo_  == 0 || $tempo_  == 00 )){
                  $formato = false;
              }else{
                  $formato = true;
              }

              $media_format = $_format;


              if($formato == true){
                  $valore .= $media_format;
              }else{
                  $valore .= 'No date!';
              }

              return $valore;
          }else{
              return 'Nessun risultato!';
          }
      }else{
          return 'Nessun risultato!';
      }
      //number_format($media,2,',','.')

  }

echo  leadtime_prenotazioni();


?>
