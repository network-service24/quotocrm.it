<?php
 //
        $Qcheck = "SELECT * FROM hospitality_ericsoftbooking WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $record = $dbMysqli->query($Qcheck);
   

        $_SESSION['urlHost']           = $record[0]['UrlHost'];
        $_SESSION['LicenzaId']         = $record[0]['LicenzaId']; 
        $_SESSION['ProviderCode']      = $record[0]['ProviderCode'];
        $_SESSION['ApiKey']            = $record[0]['ProviderApiKey']; 

  

        if(is_array($record)) {
            if($record > count($record))
             $Tcheck = $record;
        }else{
            $Tcheck = 0;
        }
         
        if($Tcheck > 0){

            $data = array( "LicenseIdh" => $_SESSION['LicenzaId'],    
            "PortalIdh" => "",     
            "LanguageType" => 1,     
            "ShowNonBookingEngineRates" => false);

            $data_string = json_encode($data);
     
            $ch = curl_init($_SESSION['urlHost'].'GetConfigurationV1');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                          
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type:      application/json',                                                                                
            'Content-Length:   ' .strlen($data_string),  
            'X-ProviderCode:   '.$_SESSION['ProviderCode'],
            'X-ProviderApiKey: '.$_SESSION['ApiKey']),
            'X-ProviderIdentityKey: a90f688b-37e7-426c-a20c-6fa62b64ee0a');
            $res = curl_exec($ch);

            $risult = json_decode($res);

            $persone = $risult->Configuration->PersonTypes;        
         
        
            $insert     = '';
            $check_type = '';
            foreach ($persone as $key => $value) {

                ## query per verificare se la tipologia è già presente
                $select = "SELECT * FROM hospitality_pms_person WHERE idsito = ".IDSITO." AND PersonTypeId = ".$value->PersonTypeId;
                $res = $dbMysqli->query($select);
                $check_type = sizeof($res);
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
                    $dbMysqli->query($insert);
                } 
            }

            $carte = $risult->Configuration->AcceptedCreditCards;
           
            $insert2     = '';
            $check_type2 = '';
            foreach ($carte as $k => $val) {
                ## query per verificare se la tipologia è già presente
                $select2 = "SELECT * FROM hospitality_pms_cartecredito WHERE idsito = ".IDSITO." AND CreditCardType = ".$val->CreditCardType;
                $res2 = $dbMysqli->query($select2);
                $check_type2 = sizeof($res2);
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
                    $dbMysqli->query($insert2);
                } 
            }



        } 
        curl_close($ch);
        if($Tcheck > 0){

            include_once($_SERVER['DOCUMENT_ROOT'].'/class/GoogleTranslate.class.php');

            $GT = new GoogleTranslate();

                        $data2 = array( "LicenseIdh" => $_SESSION['LicenzaId'],    
                                        "PortalIdh" => "",     
                                        "LanguageType" => 1,     
                                        "UserCurrencyCode" => "EUR");

                        $data_string2 = json_encode($data2);

                        $ch2 = curl_init($_SESSION['urlHost'].'GetInventoryV1');                                                                      
                        curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch2, CURLOPT_POSTFIELDS, $data_string2);                                                                  
                        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch2, CURLOPT_HTTPHEADER, array(                                                                          
                        'Content-Type: application/json',                                                                                
                        'Content-Length: ' . strlen($data_string2),                      
                        'X-ProviderCode: '.$_SESSION['ProviderCode'],
                        'X-ProviderApiKey: '.$_SESSION['ApiKey']),
                        'X-ProviderIdentityKey: a90f688b-37e7-426c-a20c-6fa62b64ee0a');
                        $res2 = curl_exec($ch2);

                        $risultato = json_decode($res2);

                        $oggetto_rates = $risultato->Rates;
                     
                        foreach ($oggetto_rates as $key => $value) {
                            ## query per verificare se la tipologia è già present

                            $sel1 = $dbMysqli->query("SELECT * FROM hospitality_tipo_soggiorno WHERE idsito = '".IDSITO."' AND Lingua = 'it' AND PlanCode = '".$value->RateId."' AND Abilitato = 1");
                            $tot1 = sizeof($sel1);
                            if($tot1 == 0){
                                $sync1 = $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,PlanCode,Abilitato) VALUES('".IDSITO."','it','".$dbMysqli->escape($value->DescriptionTranslation)."','".$value->RateId."','1')");
                                $id_sync1 = $dbMysqli->getInsertId($sync1); 
                                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','it','".$dbMysqli->escape($value->DescriptionTranslation)."','".$dbMysqli->escape($value->NotesTranslation)."','".$value->RateId."')");      
                                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','en','".$dbMysqli->escape($value->DescriptionTranslation)."','".$dbMysqli->escape($GT->translate('it','en',$value->NotesTranslation))."','".$value->RateId."')");      
                                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','fr','".$dbMysqli->escape($value->DescriptionTranslation)."','".$dbMysqli->escape($GT->translate('it','fr',$value->NotesTranslation))."','".$value->RateId."')");      
                                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','de','".$dbMysqli->escape($value->DescriptionTranslation)."','".$dbMysqli->escape($GT->translate('it','de',$value->NotesTranslation))."','".$value->RateId."')");      
                            }                                                              
                                     
                        }

                        $oggetto_resources = $risultato->ResourceTypes;
                     
                        foreach ($oggetto_resources as $k => $val) {

                            $selcam1 = $dbMysqli->query("SELECT * FROM hospitality_tipo_camere WHERE idsito = '".IDSITO."' AND Lingua = 'it' AND RoomCode = '".$val->ResourceTypeId."' AND Abilitato = 1");
                            $totcam1 = sizeof($selcam1);
                              if($totcam1 == 0){ 
                                $cam1 = $dbMysqli->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,RoomCode,Abilitato) VALUES('".IDSITO."','it','".$dbMysqli->escape($val->DescriptionTranslation)."','".$val->ResourceTypeId."','1')");                        
                                $id_cam1 = $dbMysqli->getInsertId($cam1); 
                                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','it','".$dbMysqli->escape($val->DescriptionTranslation)."','".$dbMysqli->escape($val->NotesTranslation)."','".$val->ResourceTypeId."')");      
                                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','en','".$dbMysqli->escape($val->DescriptionTranslation)."','".$dbMysqli->escape($GT->translate('it','en',$val->NotesTranslation))."','".$val->ResourceTypeId."')");
                                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','fr','".$dbMysqli->escape($val->DescriptionTranslation)."','".$dbMysqli->escape($GT->translate('it','fr',$val->NotesTranslation))."','".$val->ResourceTypeId."')");
                                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','de','".$dbMysqli->escape($val->DescriptionTranslation)."','".$dbMysqli->escape($GT->translate('it','de',$val->NotesTranslation))."','".$val->ResourceTypeId."')");
                                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','singola1.jpg')");
                                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','doppia1.jpg')"); 
                                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','tripla1.jpg')");
                              }

                        }
        }
        curl_close($ch2);

        //fine

        
        if($_REQUEST['azione']=='sg'){
            $prt->_goto(BASE_URL_SITO.'disponibilita-soggiorni/ok/');
            //header('Location: '.BASE_URL_SITO.'disponibilita-soggiorni/ok/');          
        }    
        if($_REQUEST['azione']=='cm'){
           $prt->_goto(BASE_URL_SITO.'disponibilita-camere/ok/');
           //header('Location: '.BASE_URL_SITO.'disponibilita-camere/ok/');          
        } 
