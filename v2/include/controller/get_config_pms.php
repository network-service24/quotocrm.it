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
            $PMSquery    = $db->query($PMScheck);
            $PMScheck    = $db->row($PMSquery);
            $urlHost     = $PMScheck['UrlHost'];
            $clientToken = $PMScheck['Provider'];
            $hotelCode   = $PMScheck['Code']; 
            $LicenzaId   = $PMScheck['LicenzaId'];   
            
        /**
         * !codice per sincronizzazione Camere con PMS
         * ? se 5Stelle il primo tipo di codice
         */
        if($tipoP == 'Ericsoft'){ 

         
            $data = array( "LicenseIdh" => $LicenzaId,    
            "PortalIdh" => "",     
            "LanguageType" => 1,     
            "ShowNonBookingEngineRates" => false);

            $data_string = json_encode($data);

            $ch = curl_init($urlHost.'GetConfiguration');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string),                         
            'X-ProviderCode: '.$clientToken,
            'X-ProviderApiKey: '.$hotelCode));
            $res = curl_exec($ch);
            $risult = json_decode($res);

            $persone = $risult->Configuration->PersonTypes;        

            $insert     = '';
            $check_type = '';
            foreach ($persone as $key => $value) {
                ## query per verificare se la tipologia è già presente
                $select = "SELECT * FROM hospitality_pms_person WHERE idsito = ".IDSITO." AND PersonTypeId = ".$value->PersonTypeId;
                $res = $db->query($select);
                $check_type = sizeof($db->result($res));
                ## inserimento solo se la tipologia NON è già presente
                if($check_type == 0){
                    $insert = "INSERT INTO 
                                    hospitality_pms_person 
                                        (idsito,
                                        TypePms,
                                        PersonTypeId,
                                        PersonName) 
                                VALUES 
                                        ('".IDSITO."',
                                        'E',
                                        '".$value->PersonTypeId."',
                                        '".$value->Translation."')";
                    $db->query($insert);
                } 
            }

            $carte = $risult->Configuration->AcceptedCreditCards;

            $insert2     = '';
            $check_type2 = '';
            foreach ($carte as $k => $val) {
                ## query per verificare se la tipologia è già presente
                $select2 = "SELECT * FROM hospitality_pms_cartecredito WHERE idsito = ".IDSITO." AND CreditCardType = ".$val->CreditCardType;
                $res2 = $db->query($select2);
                $check_type2 = sizeof($db->result($res2));
                ## inserimento solo se la tipologia NON è già presente
                if($check_type2 == 0){
                    $insert2 = "INSERT INTO 
                                    hospitality_pms_cartecredito 
                                        (idsito,
                                        TypePms,
                                        CreditCardType,
                                        CreditCardName) 
                                VALUES 
                                        ('".IDSITO."',
                                        'E',
                                        '".$val->CreditCardType."',
                                        '".$val->CreditCardName."')";
                    $db->query($insert2);
                } 
            }



        }
        curl_close($ch);
  
    }

    
    header('Location:'.BASE_URL_SITO.'setting-pms/');
?>