<?php

    if($_REQUEST['azione']=='sync'){

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

        $xml_post_stringR = '<?xml version="1.0" encoding="utf-8"?>
                                  <Request  userName="'.$UserParity.'" password="'.$PasswordParity.'" apikey="'.$Apikey.'">
                                    <getRooms hotelId="'.$HotelId.'"/>
                                  </Request>';

        $headers = array(
          "Content-Type: text/xml; charset=utf-8",
          "Content-Length: ".strlen($xml_post_stringR)
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_stringR);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $responseR = curl_exec($ch);
        curl_close($ch);


        $parserR = simplexml_load_string($responseR);

        //require_once BASE_PATH_SITO.'google-translate/src/gtranslate.php';
        //$gt = new gtranslate();
        //$gt->translate($val['description'], 'en','it',true);
        //$gt->translate($val['description'], 'fr','it',true);
        //$gt->translate($val['description'], 'de','it',true);

            foreach($parserR->room as $ky => $val){

              $select = "SELECT * FROM hospitality_parity_camere WHERE idsito = ".IDSITO." AND RoomId = ".$val['id'];
              $res    = $db->query($select);
              $type   = $db->row($res);

              if(is_array($type)) {
                if($type > count($type))
                  $check = count($type);
              }else{
                $check = 0;
              }

              if($check == 0){
                  $insert = "INSERT INTO hospitality_parity_camere(idsito,RoomId,RoomDescription,letti,letti_agg)
                              VALUES ('".IDSITO."','".$val['id']."','".$val['description']."','".$val['beds']."','".$val['additionalBeds']."')";
                  $db->query($insert);
              }else{
                $update = "UPDATE hospitality_parity_camere SET RoomDescription = '".$val['description']."', letti = '".$val['beds']."', letti_agg = '".$val['additionalBeds']."' WHERE Id = ".$type['Id'];
                $db->query($update);
              }
          }

      }

    }


    header('Location:'.BASE_URL_SITO.'disponibilita-camere/');
?>
