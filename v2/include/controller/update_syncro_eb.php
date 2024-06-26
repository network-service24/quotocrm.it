<?php
 //
        $Qcheck = "SELECT * FROM hospitality_ericsoftbooking WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Qquery = $db->query($Qcheck);
        $record = $db->row($Qquery);

        $_SESSION['urlHost']           = $record['UrlHost'];
        $_SESSION['LicenzaId']         = $record['LicenzaId']; 
        $_SESSION['ProviderCode']      = $record['ProviderCode'];
        $_SESSION['ApiKey']            = $record['ProviderApiKey']; 

  

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
     
            $ch = curl_init($_SESSION['urlHost'].'GetConfiguration');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                          
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type:      application/json',                                                                                
            'Content-Length:   ' .strlen($data_string),  
            'X-ProviderCode:   '.$_SESSION['ProviderCode'],
            'X-ProviderApiKey: '.$_SESSION['ApiKey']));
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
        if($Tcheck > 0){

            include_once($_SERVER['DOCUMENT_ROOT'].'/v2/class/GoogleTranslate.class.php');

            $GT = new GoogleTranslate();

                        $data2 = array( "LicenseIdh" => $_SESSION['LicenzaId'],    
                                        "PortalIdh" => "",     
                                        "LanguageType" => 1,     
                                        "UserCurrencyCode" => "EUR");

                        $data_string2 = json_encode($data2);

                        $ch2 = curl_init($_SESSION['urlHost'].'GetInventory');                                                                      
                        curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch2, CURLOPT_POSTFIELDS, $data_string2);                                                                  
                        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch2, CURLOPT_HTTPHEADER, array(                                                                          
                        'Content-Type: application/json',                                                                                
                        'Content-Length: ' . strlen($data_string2),                      
                        'X-ProviderCode: '.$_SESSION['ProviderCode'],
                        'X-ProviderApiKey: '.$_SESSION['ApiKey']));
                        $res2 = curl_exec($ch2);

                        $risultato = json_decode($res2);

                        $oggetto_rates = $risultato->Rates;

                        foreach ($oggetto_rates as $key => $value) {
                            ## query per verificare se la tipologia è già present


                            $sel1 = $db->query("SELECT * FROM hospitality_tipo_soggiorno WHERE idsito = '".IDSITO."' AND Lingua = 'it' AND PlanCode = '".$value->RateId."' AND Abilitato = 1");
                            $tot1 = sizeof($db->result($sel1));
                            if($tot1 == 0){
                                $sync1 = $db->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,PlanCode,Abilitato) VALUES('".IDSITO."','it','".$value->DescriptionTranslation."','".$value->RateId."','1')");
                                $id_sync1 = $db->insert_id($sync1); 
                                $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','it','".$value->DescriptionTranslation."','".addslashes($value->NotesTranslation)."','".$value->RateId."')");      
                                $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','en','".$value->DescriptionTranslation."','".addslashes($GT->translate('it','en',$value->NotesTranslation))."','".$value->RateId."')");      
                                $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','fr','".$value->DescriptionTranslation."','".addslashes($GT->translate('it','fr',$value->NotesTranslation))."','".$value->RateId."')");      
                                $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','de','".$value->DescriptionTranslation."','".addslashes($GT->translate('it','de',$value->NotesTranslation))."','".$value->RateId."')");      
                            }                                                              
                                     
                        }

                        $oggetto_resources = $risultato->ResourceTypes;

                        foreach ($oggetto_resources as $k => $val) {

                            $selcam1 = $db->query("SELECT * FROM hospitality_tipo_camere WHERE idsito = '".IDSITO."' AND Lingua = 'it' AND RoomCode = '".$val->ResourceTypeId."' AND Abilitato = 1");
                            $totcam1 = sizeof($db->result($selcam1));
                              if($totcam1 == 0){ 
                                $cam1 = $db->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,RoomCode,Abilitato) VALUES('".IDSITO."','it','".$val->DescriptionTranslation."','".$val->ResourceTypeId."','1')");                        
                                $id_cam1 = $db->insert_id($cam1); 
                                $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','it','".$val->DescriptionTranslation."','".addslashes($val->NotesTranslation)."','".$val->ResourceTypeId."')");      
                                $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','en','".$val->DescriptionTranslation."','".addslashes($GT->translate('it','en',$val->NotesTranslation))."','".$val->ResourceTypeId."')");
                                $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','fr','".$val->DescriptionTranslation."','".addslashes($GT->translate('it','fr',$val->NotesTranslation))."','".$val->ResourceTypeId."')");
                                $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','de','".$val->DescriptionTranslation."','".addslashes($GT->translate('it','de',$val->NotesTranslation))."','".$val->ResourceTypeId."')");
                                $db->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','singola1.jpg')");
                                $db->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','doppia1.jpg')"); 
                                $db->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','tripla1.jpg')");
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
