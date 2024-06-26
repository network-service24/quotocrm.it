<?php
    if($_REQUEST['action']=='sync' && $_REQUEST['dal'] != '' && $_REQUEST['al'] != ''){
      $_SESSION['D'] = $_REQUEST['dal'];
      $_SESSION['A'] = $_REQUEST['al'];
      $DataA_tmp     = explode("/",$_REQUEST['dal']);
      $Dal           = $DataA_tmp[2].'-'.$DataA_tmp[1].'-'.$DataA_tmp[0];
      $DataP_tmp     = explode("/",$_REQUEST['al']);
      $Al            = $DataP_tmp[2].'-'.$DataP_tmp[1].'-'.$DataP_tmp[0];


      $Squery    = "SELECT * FROM hospitality_parityrate WHERE idsito = ".IDSITO."  AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
      $Rquery    = $db->query($Squery);
      $records   = $db->row($Rquery);

      if(is_array($records)) {
        if($records > count($records))
          $PARITYcheck = count($records);
      }else{
        $PARITYcheck = 0;
      }

      if($PARITYcheck > 0){

        $Apikey         = $records['ApiKey'];
        $Url            = $records['UrlApi'];
        $HotelId        = $records['HotelId'];
        $UserParity     = $records['UserParity'];
        $PasswordParity = $records['PasswordParity'];

        $xml_post_stringView = '<?xml version="1.0" encoding="utf-8"?>
                                    <Request  userName="'.$UserParity.'" password="'.$PasswordParity.'" apikey="'.$Apikey.'">
                                      <view hotelId="'.$HotelId.'" startDate="'.$Dal.'" endDate="'.$Al.'"/>
                                    </Request>';

        $headers = array(
          "Content-Type: text/xml; charset=utf-8",
          "Content-Length: ".strlen($xml_post_stringView)
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_stringView);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $responseView = curl_exec($ch);
        curl_close($ch);


        $parserView = simplexml_load_string($responseView);

          $array_listino = array();

          $n    = 1;
          $AL   = '';
          $data = '';
          foreach($parserView->availability as $ky => $val){

            foreach($val->rate as $k => $v){

                $data = explode('-',$val['day']);
                $AL_  = mktime(0,0,0,$data[1],($data[2]+1),$data[0]);
                $AL   = date('Y-m-d',$AL_);

                $array_listino[] = array('IDCAMERA' => $val['roomId'],'IDTRATTAMENTO' => $v['rateId'],'DAL' => $val['day'],'AL' => $AL, 'PREZZO' => $v['price']);

            }
            $n++;
          }

          $Lquery       = "SELECT * FROM hospitality_numero_listini WHERE idsito = ".IDSITO."  AND Listino LIKE '%Listino ParityRate%' AND Abilitato = 1";
          $REquery      = $db->query($Lquery);
          $record       = $db->row($REquery);

          if(is_array($record)) {
            if($record > count($record))
              $LISTINOcheck = count($record);
          }else{
            $LISTINOcheck = 0;
          }
          if($LISTINOcheck > 0){
            $IdListino = $record['Id'];
          }else{
            $idquery   = $db->query("INSERT INTO hospitality_numero_listini(idsito,Listino,Parity,Abilitato) VALUES('".IDSITO."','Listino ParityRate','1','1')");
            $IdListino = $db->insert_id($idquery);
          }

          // cancallo contenuti prima di sincronizzare
          $DELETE = "DELETE FROM hospitality_listino_camere WHERE idsito = ".IDSITO." AND IdNumeroListino = ".$IdListino."";
          $db->query($DELETE);

          foreach($array_listino as $key => $value){

              $select = "SELECT *
                        FROM hospitality_listino_camere
                        WHERE hospitality_listino_camere.idsito        = ".IDSITO."
                        AND hospitality_listino_camere.IdNumeroListino = ".$IdListino."
                        AND hospitality_listino_camere.RateId          = ".$value['IDTRATTAMENTO']."
                        AND hospitality_listino_camere.RoomId          = ".$value['IDCAMERA']."
                        AND hospitality_listino_camere.PeriodoDal      = '".$value['DAL']."'
                        AND hospitality_listino_camere.PeriodoAl       = '".$value['AL']."'
                        AND hospitality_listino_camere.PrezzoCamera    = '".$value['PREZZO']."'";
              $res    = $db->query($select);
              $type   = $db->row($res);

              if(is_array($type)) {
                if($type > count($type))
                  $check = count($type);
              }else{
                $check = 0;
              }
              $select2 = "SELECT Id as IdCamera
                          FROM hospitality_tipo_camere
                          WHERE hospitality_tipo_camere.idsito  = ".IDSITO."
                          AND hospitality_tipo_camere.RoomParityId = ".$value['IDCAMERA']."";
              $res2    = $db->query($select2);
              $type2   = $db->row($res2);
              if(is_array($type2)) {
                if($type2 > count($type2))
                  $check2 = count($type2);
              }else{
                $check2 = 0;
              }
              $select3 = "SELECT Id as IdSoggiorno
                          FROM hospitality_tipo_soggiorno
                          WHERE hospitality_tipo_soggiorno.idsito  = ".IDSITO."
                          AND hospitality_tipo_soggiorno.RateParityId = ".$value['IDTRATTAMENTO']."";
              $res3    = $db->query($select3);
              $type3   = $db->row($res3);
              if(is_array($type3)) {
                if($type3 > count($type3))
                  $check3 = count($type3);
              }else{
                $check3 = 0;
              }
              if($check2 > 0 && $check3 > 0 ){
                if($check == 0){
                    $insert = "INSERT INTO hospitality_listino_camere(idsito,IdNumeroListino,IdSoggiorno,RateId,IdCamera,RoomId,PeriodoDal,PeriodoAl,PrezzoCamera,Abilitato)
                                VALUES ('".IDSITO."','".$IdListino."','".$type3['IdSoggiorno']."','".$value['IDTRATTAMENTO']."','".$type2['IdCamera']."','".$value['IDCAMERA']."','".$value['DAL']."','".$value['AL']."','".$value['PREZZO']."','1')";
                    $db->query($insert);
                }

              }
          }

            if($check2 == 0 && $check3 == 0) {
                $msgparity =  'no-abbinamento';
            }
      }// chiusura if se parity è settato

    }else{
      $msgparity =  'no-date';
    }// chiusura se non si cosno le date

    $insert_data = "INSERT INTO hospitality_data_syncro_listino_parity(idsito,data) VALUES('".IDSITO."','".date('Y-m-d H:i:s')."')";
    $db->query($insert_data);

    $msgok = 'ok-syncro';

  header('Location:'.BASE_URL_SITO.'disponibilita-tipo_listino/'.($msgparity!=''?$msgparity.'/':$msgok.'/'));
?>
