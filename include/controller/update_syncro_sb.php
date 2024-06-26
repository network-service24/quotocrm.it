<?php
 //
        $Qcheck = "SELECT * FROM hospitality_simplebooking WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Tcheck = $dbMysqli->query($Qcheck);

        if(sizeof($Tcheck)>0){

              // SINCRO TIPO SOGGIORNO CON SIMPLE BOOKING
                    $xml='<OTA_HotelRatePlanRQ  xmlns="http://www.opentravel.org/OTA/2003/05"  Target="Production" Version="1.0">
                          <RatePlans>
                            <RatePlan>
                              <HotelRef HotelCode="'.$Tcheck[0]['IdHotel'].'" />
                              <TPA_Extensions>
                                   <provider Name="'.$Tcheck[0]['UserProvider'].'" Pwd="'.$Tcheck[0]['PasswordProvider'].'" />
                                   <XMLHotelAgent Name="'.$Tcheck[0]['UserHotel'].'" Pwd="'.$Tcheck[0]['PasswordHotel'].'" />
                              </TPA_Extensions>
                            </RatePlan>
                          </RatePlans>
                        </OTA_HotelRatePlanRQ>';

                    $dati = urlencode($xml);
                    $fp = fopen(BASE_PATH_SITO.'uploads/'.IDSITO.'/rate.xml','w');
                    $ch = curl_init();
                    $url = 'http://xml.simplebooking.it/xmlservice.asmx/RateListRQ';
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "xml=".$dati);
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_exec($ch);

                    $soggiorni = simplexml_load_file(BASE_PATH_SITO.'uploads/'.IDSITO.'/rate.xml') or die("Error: Cannot create object");

                    $tipo_soggiorno_it  = '';
                    $tipo_soggiorno_en  = '';
                    $tipo_soggiorno_fr  = '';
                    $tipo_soggiorno_de  = '';
                    $testo_soggiorno_it = '';
                    $testo_soggiorno_en = '';
                    $testo_soggiorno_fr = '';
                    $testo_soggiorno_de = '';
                    $value              = '';
                    $val                = '';
                    $v                  = ''; 


                    foreach ($soggiorni as $key => $value) {
                      foreach ($value as $ky => $val) {
                        foreach ($val as $k => $v) {
                          switch($v['MealPlanCode'][0]){
                              case"MPT.1":
                                $tipo_soggiorno_it  = 'All Inclusive';
                                $tipo_soggiorno_en  = 'All Inclusive';
                                $tipo_soggiorno_fr  = 'All Inclusive';
                                $tipo_soggiorno_de  = 'All Inclusive';
                                $testo_soggiorno_it = 'La tipologia Tutto Incluso comprende solo l\'uso della camera, il servizio di prima colazione, il pranzo, la cena con tutte le bevande al tavolo comprese e tutte le consumazioni al bar';
                                $testo_soggiorno_en = 'The type All Inclusive includes only the use of the room, the breakfast service, lunch, dinner with all the drinks to the table and including all drinks at the bar';
                                $testo_soggiorno_fr = 'Le type All Inclusive ne comprend que l\'utilisation de la chambre, le service de petit-déjeuner, déjeuner, dîner avec toutes les boissons à la table et y compris toutes les boissons au bar';
                                $testo_soggiorno_de = 'Die Art All Inclusive beinhaltet nur die Nutzung des Raumes, dem Frühstück, Mittagessen, Abendessen mit allen Getränke an den Tisch und inklusive aller Getränke an der Bar';
                             break;
                              case"MPT.3":
                                $tipo_soggiorno_it  = 'Bed & Breakfast';
                                $tipo_soggiorno_en  = 'Bed & Breakfast';
                                $tipo_soggiorno_fr  = 'Bed & Breakfast';
                                $tipo_soggiorno_de  = 'Bed & Breakfast';
                                $testo_soggiorno_it = 'La tipologia Bed & Breakfast comprende solo l\'uso della camera ed il servizio di prima colazione';
                                $testo_soggiorno_en = 'The type Bed & Breakfast includes only the use of the room and the breakfast service';
                                $testo_soggiorno_fr = 'Le type Bed & Breakfast comprend seulement l\'utilisation de la salle et le service du petit-déjeuner';
                                $testo_soggiorno_de = 'Das Bed & Breakfast beinhaltet nur die Nutzung des Raumes und der Frühstücksservice';                    
                              break;
                              case"MPT.10":
                                $tipo_soggiorno_it  = 'Pensione Completa';
                                $tipo_soggiorno_en  = 'Full Board';
                                $tipo_soggiorno_fr  = 'Pension complète';
                                $tipo_soggiorno_de  = 'Vollpension';
                                $testo_soggiorno_it = 'La tipologia di Pensione Completa comprende solo l\'uso della camera, il servizio di prima colazione, il pranzo e la cena al ristorante dell\'hotel';
                                $testo_soggiorno_en = 'The type Full Board includes only the use of the room, the breakfast service, lunch and dinner at the hotel restaurant';
                                $testo_soggiorno_fr = 'Le type Pension complète ne comprend que l\'utilisation de la chambre, le service de petit-déjeuner, le déjeuner et le dîner au restaurant de l\'hôtel';
                                $testo_soggiorno_de = 'Die Vollpension beinhaltet nur die Nutzung des Raumes, die Frühstück, Mittagessen und Abendessen im Hotelrestaurant';                     
                              break;
                              case"MPT.12":
                                $tipo_soggiorno_it  = 'Mezza Pensione';
                                $tipo_soggiorno_en  = 'Half Board';
                                $tipo_soggiorno_fr  = 'Demi-pension';
                                $tipo_soggiorno_de  = 'Halbpension';
                                $testo_soggiorno_it = 'La tipologia di Mezza Pensione comprende solo l\'uso della camera, il servizio di prima colazione e la cena in hotel';
                                $testo_soggiorno_en = 'The type of Half Board includes only the use of the room, the breakfast and dinner at the hotel';
                                $testo_soggiorno_fr = 'Le type de demi-pension ne comprend que l\'utilisation de la chambre, le petit déjeuner et le dîner à l\'hôtel';
                                $testo_soggiorno_de = 'Die Art der Halbpension beinhaltet nur die Nutzung des Raumes, das Frühstück und Abendessen im Hotel';                     
                              break;
                              case"MPT.14":
                                $tipo_soggiorno_it  = 'Solo Pernotto';
                                $tipo_soggiorno_en  = 'Room Only';
                                $tipo_soggiorno_fr  = 'Seulement la nuit';
                                $tipo_soggiorno_de  = 'Nur Übernachtung';
                                $testo_soggiorno_it = 'La tipologia di solo pernotto, comprende solo l\'uso della camera';
                                $testo_soggiorno_en = 'The type of bed only, includes only the use of the room';
                                $testo_soggiorno_fr = 'Le type de lit seulement, ne comprend que l\'utilisation de la salle';
                                $testo_soggiorno_de = 'Die Art des Bettes nur schließt nur die Verwendung des Raums';                     
                              break;  
                              default:
                                $tipo_soggiorno_it  = $v->Description->Text;
                                $tipo_soggiorno_en  = $v->Description->Text;
                                $tipo_soggiorno_fr  = $v->Description->Text;
                                $tipo_soggiorno_de  = $v->Description->Text;
                                $testo_soggiorno_it = '';
                                $testo_soggiorno_en = '';
                                $testo_soggiorno_fr = '';
                                $testo_soggiorno_de = '';
                            break;                                           
                          }

                            if($v['MealPlanCode'][0]!=''){

                                $sel1 = $dbMysqli->query("SELECT * FROM hospitality_tipo_soggiorno WHERE idsito = '".IDSITO."' AND Lingua = 'it' AND PlanCode = '".$v['MealPlanCode'][0]."' AND Abilitato = 1");
                                $tot1 = sizeof($sel1);
                                if($tot1 == 0){
                                    $sync1 = $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,PlanCode,Abilitato) VALUES('".IDSITO."','it','".$tipo_soggiorno_it."','".$v['MealPlanCode'][0]."','1')");
                                    $id_sync1 = $dbMysqli->getInsertId($sync1);
                                    $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','it','".$tipo_soggiorno_it."','".addslashes($testo_soggiorno_it)."','".$v['MealPlanCode'][0]."')");      
                                    $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','en','".$tipo_soggiorno_en."','".addslashes($testo_soggiorno_en)."','".$v['MealPlanCode'][0]."')");      
                                    $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','fr','".$tipo_soggiorno_fr."','".addslashes($testo_soggiorno_fr)."','".$v['MealPlanCode'][0]."')");      
                                    $db->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','de','".$tipo_soggiorno_de."','".addslashes($testo_soggiorno_de)."','".$v['MealPlanCode'][0]."')");      
                                }                                                                  
                            }

                            $tipo_soggiorno_it  = '';
                            $tipo_soggiorno_en  = '';
                            $tipo_soggiorno_fr  = '';
                            $tipo_soggiorno_de  = '';
                            $testo_soggiorno_it = '';
                            $testo_soggiorno_en = '';
                            $testo_soggiorno_fr = '';
                            $testo_soggiorno_de = '';
                            $value              = '';
                            $val                = '';
                            $v                  = ''; 

                        }
                      }
                    }               
                    curl_close($ch);
        }
        //fine

 //

        if(sizeof($Tcheck)>0){
       
                $xml2 = '<OTA_HotelRoomListRQ xmlns="http://www.opentravel.org/OTA/2003/05"  Target="Production" Version="1.0">
                          <HotelRoomLists>
                            <HotelRoomList HotelCode="'.$Tcheck[0]['IdHotel'].'" />
                          </HotelRoomLists>
                          <TPA_Extensions>
                                   <provider Name="'.$Tcheck[0]['UserProvider'].'" Pwd="'.$Tcheck[0]['PasswordProvider'].'" />
                                   <XMLHotelAgent Name="'.$Tcheck[0]['UserHotel'].'" Pwd="'.$Tcheck[0]['PasswordHotel'].'" />
                          </TPA_Extensions>
                        </OTA_HotelRoomListRQ>';

                $dati2 = urlencode($xml2);
                $fp2 = fopen(BASE_PATH_SITO.'uploads/'.IDSITO.'/camere.xml','w');
                $ch2 = curl_init();
                $url2 = "http://xml.simplebooking.it/xmlservice.asmx/RoomListRQ"; 
                curl_setopt($ch2, CURLOPT_URL, $url2);
                curl_setopt($ch2, CURLOPT_POST, true);
                curl_setopt($ch2, CURLOPT_POSTFIELDS, 'xml='.$dati2);
                curl_setopt($ch2, CURLOPT_FILE, $fp2);
                curl_exec($ch2);

                $camere = simplexml_load_file(BASE_PATH_SITO.'uploads/'.IDSITO.'/camere.xml') or die("Error: Cannot create object");

                //print_r($camere);
                $camera[] = array();
                //$camera = '';
                $RoomCode = '';
                    foreach ($camere as $key => $value) {
                      foreach ($value as $ky => $val) {
                        foreach ($val as $k => $v) {
                          foreach ($v as $chiave => $valore) {
                            foreach ($valore as $c => $va) {
                              foreach ($va as $ch => $vl) {
                                $RoomCode = $vl['RoomTypeCode'][0];
                                foreach ($vl as $kh => $row) {  
                                  if($row['Name'][0] != ''){
                                      $camera[] = array('RoomCode' => $RoomCode,'Camera' => $row['Name'][0]);                                  
                                  }                                 
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  
                    foreach ($camera as $y => $rec) {

                          // syncro dati camere da simplebooking
                          $selcam1 = $dbMysqli->query("SELECT * FROM hospitality_tipo_camere WHERE idsito = '".IDSITO."' AND Lingua = 'it' AND RoomCode = '".$rec['RoomCode']."' AND Abilitato = 1");
                          $totcam1 = sizeof($selcam1);
                            if($totcam1 == 0){ 
                              $cam1 = $dbMysqli->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,RoomCode,Abilitato) VALUES('".IDSITO."','it','".$rec['Camera']."','".$rec['RoomCode']."','1')");                        
                              $id_cam1 = $dbMysqli->getInsertId($cam1); 
                              $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','it','".$rec['Camera']."','','".$rec['RoomCode']."')");      
                              $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','en','".$rec['Camera']."','','".$rec['RoomCode']."')");
                              $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','fr','".$rec['Camera']."','','".$rec['RoomCode']."')");
                              $db->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','de','".$rec['Camera']."','','".$rec['RoomCode']."')");
                              $db->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','singola1.jpg')");
                              $db->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','doppia1.jpg')"); 
                              $db->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','tripla1.jpg')");
                            }
                    }
                    
              curl_close($ch2); 
        } 
        
        if($_REQUEST['azione']=='sg'){
            $prt->_goto(BASE_URL_SITO.'disponibilita-soggiorni/ok/');
            //header('Location: '.BASE_URL_SITO.'disponibilita-soggiorni/ok/');          
        }    
        if($_REQUEST['azione']=='cm'){
            $prt->_goto(BASE_URL_SITO.'disponibilita-camere/ok/');
           //header('Location: '.BASE_URL_SITO.'disponibilita-camere/ok/');          
        } 
