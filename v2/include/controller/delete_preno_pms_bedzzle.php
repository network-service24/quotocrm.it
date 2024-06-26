<?php


                $PMScheck    = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = ".IDSITO." AND Pms = 1 ORDER BY Id DESC LIMIT 1";
                $PMSquery    = $db->query($PMScheck);
                $PMScheck    = $db->row($PMSquery);
                $urlHost     = $PMScheck['UrlHost'];
                $key         = $PMScheck['ProxyAuth'];
                $propertyId  = $PMScheck['HotelAccount'];
                $ApiKeySetting = $PMScheck['VendorAccountSetting'];
                   /** 
                 * ! query per estrpolare i dati della prenotazione per sincro PMS BEDZZLE
                 * */
                $select = "SELECT 
                                hospitality_guest.*, 
                                hospitality_proposte.Id as IdProposta, 
                                hospitality_proposte.PrezzoP as PrezzoProposto
                        FROM 
                                hospitality_guest 
                        INNER JOIN 
                                hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                        WHERE 
                                hospitality_guest.Id = ".$_REQUEST['azione']."
                        AND 
                                hospitality_guest.idsito = ".IDSITO;
                $result = $db->query($select);
                $value  = $db->row($result);

                $Camere         = '';
                $Id             = $value['Id'];
                $IdProposta     = $value['IdProposta'];
                $Nome           = stripslashes($value['Nome']); 
                $Cognome        = stripslashes($value['Cognome']); 
                $Email          = $value['Email'];
                $Cellulare      = $value['Cellulare'];
                $NumeroAdulti   = intval($value['NumeroAdulti']);
                $NumeroBambini  = intval($value['NumeroBambini']);
                $EtaBambini1    = $value['EtaBambini1'];
                $EtaBambini2    = $value['EtaBambini2'];
                $EtaBambini3    = $value['EtaBambini3'];
                $EtaBambini4    = $value['EtaBambini4'];
                $EtaBambini5    = $value['EtaBambini5'];
                $EtaBambini6    = $value['EtaBambini6'];
                $Arrivo         = $value['DataArrivo'];
                $Partenza       = $value['DataPartenza'];
                $PrezzoProposto = intval($value['PrezzoProposto']);
                $Lingua         = $value['Lingua'];

                
                $date1 = date_create_from_format('Y-m-d', $Partenza);

                $date2 = date_create_from_format('Y-m-d', $Arrivo);

                $diff  = date_diff($date1, $date2);

                $Notti = $diff->d;

                $array_eta_bimbi = array(intval($EtaBambini1),intval($EtaBambini2),intval($EtaBambini3),intval($EtaBambini4),intval($EtaBambini5),intval($EtaBambini6));
                foreach($array_eta_bimbi as $ky => $vl){
                        if($vl > 0 || $vl != ''){
                                $EtaBimbi[] = $vl;
                        }         
                }

                $select2 = "SELECT hospitality_richiesta.NumeroCamere,
                                hospitality_richiesta.NumAdulti,
                                hospitality_richiesta.NumBambini,
                                hospitality_richiesta.EtaB,
                                hospitality_richiesta.Prezzo,
                                hospitality_pms_camere.RoomTypeDescription,
                                hospitality_pms_camere.RoomTypeId,
                                hospitality_tipo_soggiorno.TipoSoggiorno,
                                hospitality_tipo_soggiorno.PlanCode,
                                hospitality_camere_testo.Descrizione
                                FROM hospitality_richiesta 
                                INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                                INNER JOIN hospitality_camere_testo ON hospitality_camere_testo.camere_id = hospitality_tipo_camere.Id
                                INNER JOIN hospitality_pms_camere ON hospitality_pms_camere.RoomTypeId = hospitality_tipo_camere.RoomTypePms
                                INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                                WHERE hospitality_richiesta.id_proposta = ".$IdProposta."
                                AND hospitality_camere_testo.lingue = 'it'
                                AND hospitality_pms_camere.idsito = ".IDSITO;
                $result2 = $db->query($select2);
                $res2    = $db->result($result2); 

                $Camere         = array();
                $data           = array();
                $tipo_soggiorno = '';
                $tipo_camera    = '';
                $n              = 1;
                $EtaB           = '';

                foreach ($res2 as $ky => $val) {


                        $NumAdulti   = intval($val['NumAdulti']);

                        $NumBambini  = intval($val['NumBambini']);
                          
                        $EtaB        = intval($val['EtaB']);

                        $Prezzo      = intval($val['Prezzo']);
                   
                        if(intval($val['NumeroCamere'])>1){

                                for($n==1; $n<=intval($val['NumeroCamere']); $n++){

                                        $Camere[] = array("uniqueId"    => intval($val['RoomTypeId']),
                                                        "roomTypeCode"          => intval($val['RoomTypeId']), 
                                                        "rateTypeCode"          => intval($val['PlanCode']),               
                                                        "numOfAdults"           => ($NumAdulti+$NumBambini),
                                                        "numOfChildren"         => $NumBambini,
                                                        "checkIn"               => $Arrivo,
                                                        "checkOut"              => $Partenza,
                                                        "agesOfChildren"        => (($NumeroBambini > 0 || $NumeroBambini != '') ? $EtaB:0 ),
                                                        "totalPrice"            => array("afterTax" => ($Prezzo/intval($val['NumeroCamere']))),  
                                                        "guest"                 => array("firstName"   => $Nome,
                                                                                        "lastName"    => $Cognome, 
                                                                                        "email"       => $Email,         
                                                                                        "mobilePhone" => $Cellulare, 
                                                                                        "language"    => $Lingua )
                                                        );
                                }
                            
                        }else{

                       
                                $Camere[] = array("uniqueId"            => intval($val['RoomTypeId']),
                                                "roomTypeCode"          => intval($val['RoomTypeId']), 
                                                "rateTypeCode"          => intval($val['PlanCode']),               
                                                "numOfAdults"           => ($NumAdulti+$NumBambini),
                                                "numOfChildren"         => $NumBambini,
                                                "checkIn"               => $Arrivo,
                                                "checkOut"              => $Partenza,
                                                "agesOfChildren"        => (($NumeroBambini > 0 || $NumeroBambini != '') ? array($EtaB):array(0) ),
                                                "totalPrice"            => array("afterTax" => $Prezzo),  
                                                "guest"                 => array(      "firstName"   => $Nome,
                                                                                        "lastName"    => $Cognome, 
                                                                                        "email"       => $Email,         
                                                                                        "mobilePhone" => $Cellulare, 
                                                                                        "language"    => $Lingua )
                                                );

                        }         
                        
                }    



                        $isertDate_ = date('Y-m-d h:i:s');
                        $isertDate  = "$isertDate_";
                        ### PRIMO INSERIMENTO
                        $data = array("reservations"   =>   array(array(
                                                                        "propertyId"         => $propertyId, 
                                                                        "insertDate"         => $isertDate,             
                                                                        "reservationStatus"  => 2, 
                                                                        "reservationId"      => $Id,      
                                                                        "checkIn"            => $Arrivo,
                                                                        "checkOut"           => $Partenza,
                                                                        "totalPrice"         => array("afterTax"=>$PrezzoProposto),
                                                                        "rooms"              =>  $Camere                                                                        
                                                                        )
                                                                )
                                        );            
                                    
              





                        $data_string = json_encode($data);

                        $ch = curl_init($urlHost.'pms/property/reservations_queue?key='.$key.'&propertyId='.$propertyId); 
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                        'Content-Type: application/json',
                         'X-API-KEY: '.$ApiKeySetting,                                                                                
                        'Content-Length: ' . strlen($data_string))                                                                       
                        );                                                                                                                   
                                                                                                                                
                        $result = curl_exec($ch);  
                        $risultato = json_decode($result);
  
                        $delete = "DELETE 
                                    FROM 
                                        hospitality_data_syncro_pms 
                                    WHERE 
                                        id_prenotazione = ".$_REQUEST['azione']." 
                                    AND 
                                        TypePms = 'B'
                                    AND 
                                        idsito = ".IDSITO;
                        $db->query($delete);
        


       //curl_close($ch);    
    //header('Location:'.BASE_URL_SITO.'prenotazioni/');
    $prt->_goto(BASE_URL_SITO.'prenotazioni/'); 
?>