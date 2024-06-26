<?php
 //
                     $Qcheck = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
                     $Qquery = $db->query($Qcheck);
                     $record = $db->row($Qquery);
                     $PMS                         = $record['PMS'];
                     $urlHostSetting              = $record['UrlHostSetting'];
                     $keySetting                  = $record['ProxyAuthSetting']; 
                     $ApiKeySetting               = $record['VendorAccountSetting'];
                     $PropertyIdSetting           = $record['HotelAccountSetting']; 


                    $ch = curl_init($urlHostSetting.'pms/property/roomrates/list?propertyId='.$PropertyIdSetting.'&key='.$keySetting.'');
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json',  
                    'X-API-KEY: '.$ApiKeySetting));
                    $res = curl_exec($ch);
    
                    $risultato = json_decode($res);

                    $dati = $risultato->data;
                    
                    foreach ($dati  as $key => $value) {
              
                           foreach ($value->rates as $ky => $val) {
                          
                                $id_soggiorno      =    $val->rateId;

                                $soggiorno         =    $val->rateType;

                                $code_soggiorno    =    $val->rateCode;

                                $array_soggiorni[$id_soggiorno] = array('IdSoggiorno' => $id_soggiorno,'CodeSoggiorno' => $code_soggiorno,'Soggiorno' => $soggiorno);      
                            } 
                        
                    }  



                    include_once($_SERVER['DOCUMENT_ROOT'].'/v2/class/GoogleTranslate.class.php');
                    $GT = new GoogleTranslate();



                    foreach ($array_soggiorni as $y => $rc) {

                        switch($rc['Soggiorno']){
                            case"AI":
                                    $tipo_soggiorno = 'All Inclusive';
                                    $testo_soggiorno_it = 'La tipologia Tutto Incluso comprende solo l\'uso della camera, il servizio di prima colazione, il pranzo, la cena con tutte le bevande al tavolo comprese e tutte le consumazioni al bar';
                                    $testo_soggiorno_en = 'The type All Inclusive includes only the use of the room, the breakfast service, lunch, dinner with all the drinks to the table and including all drinks at the bar';
                                    $testo_soggiorno_fr = 'Le type All Inclusive ne comprend que l\'utilisation de la chambre, le service de petit-déjeuner, déjeuner, dîner avec toutes les boissons à la table et y compris toutes les boissons au bar';
                                    $testo_soggiorno_de = 'Die Art All Inclusive beinhaltet nur die Nutzung des Raumes, dem Frühstück, Mittagessen, Abendessen mit allen Getränke an den Tisch und inklusive aller Getränke an der Bar';
       
                            break;
                            case"RO":
                                    $tipo_soggiorno = 'Solo Pernottamento';
                                    $testo_soggiorno_it = 'La tipologia di solo pernotto, comprende solo l\'uso della camera';
                                    $testo_soggiorno_en = 'The type of bed only, includes only the use of the room';
                                    $testo_soggiorno_fr = 'Le type de lit seulement, ne comprend que l\'utilisation de la salle';
                                    $testo_soggiorno_de = 'Die Art des Bettes nur schließt nur die Verwendung des Raums';
                            break;
                            case"FB":
                                    $tipo_soggiorno = 'Pensione Completa';
                                    $testo_soggiorno_it = 'La tipologia di Pensione Completa comprende solo l\'uso della camera, il servizio di prima colazione, il pranzo e la cena al ristorante dell\'hotel';
                                    $testo_soggiorno_en = 'The type Full Board includes only the use of the room, the breakfast service, lunch and dinner at the hotel restaurant';
                                    $testo_soggiorno_fr = 'Le type Pension complète ne comprend que l\'utilisation de la chambre, le service de petit-déjeuner, le déjeuner et le dîner au restaurant de l\'hôtel';
                                    $testo_soggiorno_de = 'Die Vollpension beinhaltet nur die Nutzung des Raumes, die Frühstück, Mittagessen und Abendessen im Hotelrestaurant';
                            break;
                            case"HB":
                                    $tipo_soggiorno = 'Mezza Pensione';
                                    $testo_soggiorno_it = 'La tipologia di Mezza Pensione comprende solo l\'uso della camera, il servizio di prima colazione e la cena in hotel';
                                    $testo_soggiorno_en = 'The type of Half Board includes only the use of the room, the breakfast and dinner at the hotel';
                                    $testo_soggiorno_fr = 'Le type de demi-pension ne comprend que l\'utilisation de la chambre, le petit déjeuner et le dîner à l\'hôtel';
                                    $testo_soggiorno_de = 'Die Art der Halbpension beinhaltet nur die Nutzung des Raumes, das Frühstück und Abendessen im Hotel';
                            break; 
                            case"BB":
                                    $tipo_soggiorno = 'Bed & Breakfast';
                                    $testo_soggiorno_it = 'La tipologia Bed & Breakfast comprende solo l\'uso della camera ed il servizio di prima colazione';
                                    $testo_soggiorno_en = 'The type Bed & Breakfast includes only the use of the room and the breakfast service';
                                    $testo_soggiorno_fr = 'Le type Bed & Breakfast comprend seulement l\'utilisation de la salle et le service du petit-déjeuner';
                                    $testo_soggiorno_de = 'Das Bed & Breakfast beinhaltet nur die Nutzung des Raumes und der Frühstücksservice';
                            break; 
                        }
                      

                        $sel1 = $db->query("SELECT * FROM hospitality_tipo_soggiorno WHERE idsito = '".IDSITO."' AND Lingua = 'it' AND PlanCode = '".$rc['IdSoggiorno']."' AND Abilitato = 1");
                        $tot1 = sizeof($db->result($sel1));
                        if($tot1 == 0){
                            $sync1 = $db->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,PlanCode,Abilitato) VALUES('".IDSITO."','it','".addslashes($tipo_soggiorno)." ".$rc['CodeSoggiorno']."','".$rc['IdSoggiorno']."','1')");
                            $id_sync1 = $db->insert_id($sync1); 
                            $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','it','".addslashes($tipo_soggiorno) ." ".$rc['CodeSoggiorno']."','".addslashes($testo_soggiorno_it)."','".$rc['IdSoggiorno']."')");      
                            $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','en','".addslashes($GT->translate('it','en',$tipo_soggiorno))." ".$rc['CodeSoggiorno']."','".addslashes($testo_soggiorno_en)."','".$rc['IdSoggiorno']."')");      
                            $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','fr','".addslashes($GT->translate('it','fr',$tipo_soggiorno))." ".$rc['CodeSoggiorno']."','".addslashes($testo_soggiorno_fr)."','".$rc['IdSoggiorno']."')");      
                            $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','de','".addslashes($GT->translate('it','de',$tipo_soggiorno))." ".$rc['CodeSoggiorno']."','".addslashes($testo_soggiorno_de)."','".$rc['IdSoggiorno']."')");      
                        }  


                        ##se il PMS è attivo compilo anche la tabella pms_trattamenti
                        if($PMS == 1){
                            $select = "SELECT * FROM hospitality_pms_trattamenti WHERE idsito = ".IDSITO." AND RateId = ".$rc['IdSoggiorno'];
                            $res = $db->query($select);
                            $check_type = sizeof($db->result($res));
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
                                                    'B',
                                                    '".$rc['IdSoggiorno']."',
                                                    '".addslashes($tipo_soggiorno)." ".$rc['CodeSoggiorno']."')";
                                $db->query($insert);
                            } 
                        }




                    }

                    foreach ($dati as $key => $value) {

                        if(!is_null($value->l10n) && !empty($value->l10n)){

                            foreach ($value->l10n as $ky => $val) {
                          
                                $camera      =       $val->name;

                                $id_camera   =       $val->roomId;
                       
                                $descrizione =       $val->description;
           
                                $lingua      =       $val->langCode;

                                $array_camere[] = array('IdCamera' => $id_camera,'Camera' => $camera,'Descrizione' => $descrizione,'lingua' => $lingua);      
                            }
                        }
                    } 
                                                 
                                
       
                   
                     foreach ($array_camere as $y => $rec) {

                        // syncro dati camere da simplebooking
                        $selcam1 = $db->query("SELECT * FROM hospitality_tipo_camere WHERE idsito = '".IDSITO."' AND Lingua = 'it' AND RoomCode = '".$rec['IdCamera']."' AND Abilitato = 1");
                        $totcam1 = sizeof($db->result($selcam1));
                          if($totcam1 == 0){ 
                            $cam1 = $db->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,RoomCode,Abilitato) VALUES('".IDSITO."','it','".addslashes($rec['Camera'])."','".$rec['IdCamera']."','1')");                        
                            $id_cam1 = $db->insert_id($cam1); 
                            $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','it','".addslashes($rec['Camera'])."','".addslashes($rec['Descrizione'])."','".$rec['IdCamera']."')");      
                            $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','en','".addslashes($GT->translate('it','en',$rec['Camera']))."','".addslashes($GT->translate('it','en',$rec['Descrizione']))."','".$rec['IdCamera']."')");
                            $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','fr','".addslashes($GT->translate('it','fr',$rec['Camera']))."','".addslashes($GT->translate('it','fr',$rec['Descrizione']))."','".$rec['IdCamera']."')");
                            $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','de','".addslashes($GT->translate('it','de',$rec['Camera']))."','".addslashes($GT->translate('it','de',$rec['Descrizione']))."','".$rec['IdCamera']."')");
                            $db->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','singola1.jpg')");
                            $db->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','doppia1.jpg')"); 
                            $db->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','tripla1.jpg')");
                          }
                        ##se il PMS è attivo compilo anche la tabella pms_tcamere
                        if($PMS == 1){
                            $select = "SELECT * FROM hospitality_pms_camere WHERE idsito = ".IDSITO." AND RoomTypeId = ".$rec['IdCamera'];
                            $res = $db->query($select);
                            $check_type = sizeof($db->result($res));
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
                                                    'B',
                                                    '".$rec['IdCamera']."',
                                                    '".addslashes($rec['Camera'])."')";
                                $db->query($insert);
                            }
                        }

                    }

 if($_REQUEST['azione']=='sg'){
    $prt->_goto(BASE_URL_SITO.'disponibilita-soggiorni/ok/');
    //header('Location: '.BASE_URL_SITO.'disponibilita-soggiorni/ok/');          
}    
if($_REQUEST['azione']=='cm'){
    $prt->_goto(BASE_URL_SITO.'disponibilita-camere/ok/');
    //header('Location: '.BASE_URL_SITO.'disponibilita-camere/ok/');          
}  