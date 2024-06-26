<?php
    if($_REQUEST['azione']=='sync'){

        switch($_REQUEST['param']){
                case "C":
                    $tipoP = '5Stelle';
                break;
                case "E":
                    $tipoP = 'Ericsoft';
                break;
            } 

            $PMScheck    = "SELECT * FROM hospitality_pms WHERE idsito = ".IDSITO." AND Pms = '".($_REQUEST['param'] == 'C'?'hotelcinquestelle.cloud': 'booking.ericsoft.com')."' AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
            $PMSquery    = $dbMysqli->query($PMScheck);
            $PMScheck    = $PMSquery[0];
            $urlHost     = $PMScheck['UrlHost'];
            $clientToken = $PMScheck['Provider'];
            $hotelCode   = $PMScheck['Code']; 
            $LicenzaId   = $PMScheck['LicenzaId'];   
            
        /**
         * !codice per sincronizzazione Camere con PMS
         * ? se 5Stelle il primo tipo di codice
         */
        if($tipoP == '5Stelle'){ 

         
                    ### RICAVARE LE TIPOLOGIA DI CAMERA
                    $data = array("clientToken"=> $clientToken, "hotelCode"=> $hotelCode);   

                    $data_string = json_encode($data);

                    $ch = curl_init($urlHost.'getRooms/'); 
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');                                                                     
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',                                                                                
                    'Content-Length: ' . strlen($data_string))                                                                       
                    );                                                                                                                   
                                                                                                                
                    $result = curl_exec($ch);  

                    $risultato = json_decode($result);

                    //print_r($risultato);

                    $oggetto_risultato = $risultato->rooms;
                    $insert     = '';
                    $check_type = '';
                    foreach ($oggetto_risultato as $key => $value) {
                        ## inserimento solo se il campo READY è uguale ad TRUE
                        if($value->ready == 1){
                            ## query per verificare se la tipologia è già presente
                            $select = "SELECT * FROM hospitality_pms_camere WHERE idsito = ".IDSITO." AND RoomTypeId = ".$value->room_type_id;
                            $res = $dbMysqli->query($select);
                            $check_type = sizeof($res);
                            ## inserimento solo se la tipologia NON è già presente
                            if($check_type == 0){
                               $insert = "INSERT INTO 
                                                hospitality_pms_camere 
                                                    (idsito,
                                                    TypePms,
                                                    RoomTypeId,
                                                    RoomTypeDescription) 
                                            VALUES 
                                                    ('".IDSITO."',
                                                    'C',
                                                    '".$value->room_type_id."',
                                                    '".$value->room_type."')";
                                $dbMysqli->query($insert);
                            }
                        }
                    }


        }else{

                        $data = array( "LicenseIdh" => $LicenzaId,    
                                        "PortalIdh" => "",     
                                        "LanguageType" => 1,     
                                        "UserCurrencyCode" => "EUR");

                        $data_string = json_encode($data);

                        $ch = curl_init($urlHost.'GetInventory');                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                        'Content-Type: application/json',                                                                                
                        'Content-Length: ' . strlen($data_string),                         
                        'X-ProviderCode: '.$clientToken,
                        'X-ProviderApiKey: '.$hotelCode));
                        $res = curl_exec($ch);
                        $risultato = json_decode($res);

                        //print_r($risultato);  

                        $oggetto_rates = $risultato->Rates;
                        $insert     = '';
                        $check_type = '';
                        foreach ($oggetto_rates as $key => $value) {
                            ## query per verificare se la tipologia è già presente
                            $select = "SELECT * FROM hospitality_pms_trattamenti WHERE idsito = ".IDSITO." AND RateId = ".$value->RateId;
                            $res = $dbMysqli->query($select);
                            $check_type = sizeof($res);
                            ## inserimento solo se la tipologia NON è già presente
                            if($check_type == 0){
                                $insert = "INSERT INTO 
                                                hospitality_pms_trattamenti 
                                                    (idsito,
                                                    TypePms,
                                                    RateId,
                                                    Description) 
                                            VALUES 
                                                    ('".IDSITO."',
                                                    'E',
                                                    '".$value->RateId."',
                                                    '".$value->DescriptionTranslation."')";
                                $dbMysqli->query($insert);
                            } 
                        }

                        $oggetto_resources = $risultato->ResourceTypes;
                        $insert2     = '';
                        $check_t = '';
                        foreach ($oggetto_resources as $k => $val) {
                            ## query per verificare se la tipologia è già presente
                            $select2 = "SELECT * FROM hospitality_pms_camere WHERE idsito = ".IDSITO." AND RoomTypeId = ".$val->ResourceTypeId;
                            $res2 = $dbMysqli->query($select2);
                            $check_t = sizeof($res2);
                            ## inserimento solo se la tipologia NON è già presente
                            if($check_t == 0){
                                $insert2 = "INSERT INTO 
                                                hospitality_pms_camere 
                                                    (idsito,
                                                    TypePms,
                                                    RoomTypeId,
                                                    RoomTypeDescription) 
                                            VALUES 
                                                    ('".IDSITO."',
                                                    'E',
                                                    '".$val->ResourceTypeId."',
                                                    '".$val->DescriptionTranslation."')";
                                $dbMysqli->query($insert2);
                            } 
                        }
        }
        curl_close($ch);
  
    }

    
    header('Location:'.BASE_URL_SITO.'disponibilita-'.$_REQUEST['valore'].'/');
?>