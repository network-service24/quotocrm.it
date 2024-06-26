<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
close_session();
$p_data = $_REQUEST['p_data'];
$s_data = $_REQUEST['s_data'];
$idsito = $_REQUEST['idsito'];


  function bw_prenotazioni(){
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
      $select = '   SELECT   SUM(DATEDIFF(DataArrivo,DATE(DataChiuso))) as giorni,
                            COUNT(NumeroPrenotazione) as n
                    FROM hospitality_guest
                    WHERE hospitality_guest.idsito = '.$idsito.'
                    AND ((hospitality_guest.DataRichiesta >= "'.$dataDal.'" AND hospitality_guest.DataRichiesta <= "'.$dataAl.'") OR (DATE(hospitality_guest.DataChiuso) >= "'.$dataDal.'" AND DATE(hospitality_guest.DataChiuso) <= "'.$dataAl.'"))
                    AND hospitality_guest.DataChiuso IS NOT NULL
                    AND hospitality_guest.Chiuso = 1
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.NoDisponibilita = 0
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.TipoRichiesta = "Conferma" ';
      $res   = $dbMysqli->query($select);
      $tot   = sizeof($res);
      $value = $res[0];
      if(($tot)>0){

        $media = ($value['giorni']/$value['n']);

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
                  $valore = $media_format;
              }else{
                  $valore = 'No date!';
              }  

              return $valore;
          }else{
              return 'Nessun risultato!';
          }


  }

echo  bw_prenotazioni();

?>
