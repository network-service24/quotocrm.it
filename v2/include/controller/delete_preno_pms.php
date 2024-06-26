<?php

    if($_REQUEST['param']=='sync'){

        switch($_REQUEST['valore']){
            case "C":
                $tipoP = '5Stelle';
            break;
            case "E":
                $tipoP = 'Ericsoft';
            break;
            case "B":
                $tipoP = 'Bedzzle';
            break;
        } 


        /**
         * !codice per cancellare una prenotazione da PMS
         * ? se 5Stelle il primo tipo di codice
         */
        if($tipoP == '5Stelle'){         
                $PMScheck    = "SELECT * FROM hospitality_pms WHERE idsito = ".IDSITO." AND Pms = '".($_REQUEST['valore'] == 'C'?'hotelcinquestelle.cloud': 'booking.ericsoft.com')."' AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
                $PMSquery    = $db->query($PMScheck);
                $PMScheck    = $db->row($PMSquery);
                $urlHost     = $PMScheck['UrlHost'];
                $clientToken = $PMScheck['Provider'];
                $hotelCode   = $PMScheck['Code'];
                $LicenzaId   = $PMScheck['LicenzaId']; 

               /** 
                 * ! query per estrpolare i dati della prenotazione 
                 * */
                $select = "SELECT hospitality_guest.*, hospitality_proposte.Id as IdProposta, hospitality_proposte.PrezzoP as PrezzoProposto
                        FROM hospitality_guest 
                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                        WHERE hospitality_guest.Id = ".$_REQUEST['azione']."
                        AND hospitality_guest.idsito = ".IDSITO;
                $result = $db->query($select);
                $value  = $db->row($result);

                $Camere         = '';
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

                $array_eta_bimbi = array(intval($EtaBambini1),intval($EtaBambini2),intval($EtaBambini3),intval($EtaBambini4),intval($EtaBambini5),intval($EtaBambini6));
                foreach($array_eta_bimbi as $ky => $vl){
                        if($vl > 0 || $vl != ''){
                                $EtaBimbi[] = $vl;
                        }         
                }

                $select2 = "SELECT hospitality_richiesta.NumeroCamere,hospitality_pms_camere.RoomTypeDescription,hospitality_tipo_soggiorno.TipoSoggiorno,
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

                foreach ($res2 as $ky => $val) {

                        switch($val['TipoSoggiorno']){
                                case"All Inclusive":
                                        $tipo_soggiorno = 'AL';
                                break;
                                case"Bed & Breakfast":
                                        $tipo_soggiorno = 'BB';
                                break;
                                case"Pensione Completa":
                                        $tipo_soggiorno = 'FB';
                                break;
                                case"Mezza Pensione":
                                        $tipo_soggiorno = 'HB';
                                break; 
                                default:
                                        $tipo_soggiorno = $val['TipoSoggiorno'];
                                break;
                        }
                    

                        if(intval($val['NumeroCamere'])>1){

                                for($n==1; $n<=intval($val['NumeroCamere']); $n++){

                                        $Camere[] = array("room_type_id"        => $val['RoomTypeDescription'],
                                                        "room_type_description" => strip_tags($val['Descrizione']), 
                                                        "meal_plan"             => $tipo_soggiorno,          
                                                        "amount_after_tax"      => ($PrezzoProposto/intval($val['NumeroCamere'])),        
                                                        "number_of_guests"      => ($NumeroAdulti+$NumeroBambini),
                                                        "adults_number"         => $NumeroAdulti,
                                                        "children_number"       => $NumeroBambini,
                                                        "children_age"          => (($NumeroBambini > 0 || $NumeroBambini != '') ? ($tipo_camere!='Singola'?$EtaBimbi:'') : 0 ));
                                }
                               
                        }else{

                       
                                $Camere[] = array("room_type_id"        => $val['RoomTypeDescription'],
                                                "room_type_description" => strip_tags($val['Descrizione']), 
                                                "meal_plan"             => $tipo_soggiorno,          
                                                "amount_after_tax"      => $PrezzoProposto,        
                                                "number_of_guests"      => ($NumeroAdulti+$NumeroBambini),
                                                "adults_number"         => $NumeroAdulti,
                                                "children_number"       => $NumeroBambini,
                                                "children_age"          => (($NumeroBambini > 0 || $NumeroBambini != '') ? ($tipo_camere!='Singola'?$EtaBimbi:'') : 0 ));

                                 
                        }
                }            



                $select = "SELECT 
                            * 
                            FROM 
                                hospitality_data_syncro_pms 
                            WHERE 
                                id_prenotazione = ".$_REQUEST['azione']." 
                            AND 
                                TypePms = 'C'
                            AND 
                                idsito = ".IDSITO;
                $res = $db->query($select);
                $rec = $db->row($res);

                    ### CANCELLAZIONE DI UNA PRENOTAZIONE GIA SINCRONIZZATA
                    $data = array("clientToken"=> $clientToken,
                    "hotelCode"=> $hotelCode,
                    "reservations"   =>   array(array("name"             => $Nome,
                                                    "surname"            => $Cognome, 
                                                    "email"              => $Email,         
                                                    "phone"              => $Cellulare,        
                                                    "checkin_date"       => $Arrivo,
                                                    "checkout_date"      => $Partenza,
                                                    "ext_reservation_id" => "7",
                                                    "pms_reservation_id" => $rec['pms_reservation_id'],
                                                    "status"             =>  array("id"=>3, "desc"=>"cancelled"),
                                                    "rooms"              =>  $Camere       
                                                    )
                                            )            
                    );   



                    $data_string = json_encode($data);

                    $ch = curl_init($urlHost.'insertReservations/'); 
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');                                                                     
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',                                                                                
                    'Content-Length: ' . strlen($data_string))                                                                       
                    );                                                                                                                   
                                                                                                                
                    $result = curl_exec($ch);  


                        $delete = "DELETE 
                                    FROM 
                                        hospitality_data_syncro_pms 
                                    WHERE 
                                        id_prenotazione = ".$_REQUEST['azione']." 
                                    AND 
                                        TypePms = 'C'
                                    AND 
                                        idsito = ".IDSITO;
                        $db->query($delete);
        
        
        /**
         * ? se Ericsoft il secondo tipo di codice
         */                
        }elseif( $tipoP == 'Ericsoft'){

                $PMScheck    = "SELECT * FROM hospitality_pms WHERE idsito = ".IDSITO." AND Pms = '".($_REQUEST['valore'] == 'C'?'hotelcinquestelle.cloud': 'booking.ericsoft.com')."' AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
                $PMSquery    = $db->query($PMScheck);
                $PMScheck    = $db->row($PMSquery);
                $urlHost     = $PMScheck['UrlHost'];
                $clientToken = $PMScheck['Provider'];
                $hotelCode   = $PMScheck['Code'];
                $LicenzaId   = $PMScheck['LicenzaId']; 
            ## CODICE PER ERICSOFT
         /** 
                 * ! query per estrpolare i dati della prenotazione 
                 * */
                $select = "SELECT hospitality_guest.*, 
                                hospitality_proposte.Id as IdProposta, 
                                hospitality_proposte.PrezzoP as PrezzoProposto ,
                                hospitality_proposte.NomeProposta as NomeProposta ,
                                hospitality_proposte.TestoProposta as TestoProposta 
                        FROM hospitality_guest 
                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                        WHERE hospitality_guest.Id = ".$_REQUEST['azione']."
                        AND hospitality_guest.idsito = ".IDSITO;
                $result = $db->query($select);
                $value  = $db->row($result);

                $Camere         = '';
                $IdUnivoco      = $value['Id'];
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
                $DataChiuso_    = $value['DataChiuso'];
                $DataChiuso = str_replace(" ","T",$DataChiuso_);
                if($value['DataModificaPrenotazione']!=''){
                        $DataModificaPrenotazione = $value['DataModificaPrenotazione'].'T00:00:00';
                }else{
                        $DataModificaPrenotazione  = $DataChiuso;
                }
                $Note           = trim($value['Note']);
                $Lingua         = strtoupper($value['Lingua']);
                $PrezzoProposto = number_format($value['PrezzoProposto'],2);
                $PrezzoProposto = str_replace(",","",$PrezzoProposto);

                $NomeProposta   = $value['NomeProposta'];
                $TestoProposta  = $value['TestoProposta'];
                if($TestoProposta!=''){
                        $NoteProposta = trim(strip_tags($TestoProposta));
                }

                ##controllo se è stata pagata tramite carta
                $sel = "     SELECT 
                                        hospitality_carte_credito.*
                                FROM 
                                        hospitality_carte_credito 
                                WHERE 
                                        hospitality_carte_credito.id_richiesta = ".$_REQUEST['azione']."
                                AND 
                                        hospitality_carte_credito.idsito = ".IDSITO;
                $res = $db->query($sel);
                $val = $db->row($res);     
                if(is_array($val)) {
                        if($val > count($val))
                            $check_cc = count($val);
                    }else{
                        $check_cc = 0;
                    }
                    if($check_cc > 0){

                        $carta        = ucfirst($val['carta']);
                        $intestatario = $val['intestatario'];
                        $scadenza     = str_replace(" / ","-", $val['scadenza']);
                        $cvv          = $val['cvv'];
                        $numero_carta = $val['numero_carta'];
                        
                        switch($carta){
                                case "Mastercard":
                                        $sigla_cc = 'MC';
                                break;
                                case "Visa":
                                        $sigla_cc = 'VI';
                                break;
                                case "American Express":
                                        $sigla_cc = 'AX';
                                break;
                                case "Diners Club":
                                        $sigla_cc = 'DN';
                                break;
                                case "Eurocard":
                                        $sigla_cc = 'EC';
                                break;
                                case "Maestro":
                                        $sigla_cc = 'TO';
                                break;
                        }

                        $dati_carta ='          <CreditCard>
                                                        <Type>'.$sigla_cc.'</Type>
                                                        <Number>'.base64_decode($numero_carta).'</Number>
                                                        <Name>'. $intestatario.'</Name>
                                                        <SecurityCode>'.$cvv.'</SecurityCode >
                                                        <Expiration>'.$scadenza.'</Expiration >
                                                </CreditCard>'."\r\n";
                    }

                ##compilazione della proposta
                $select2 = "    SELECT 
                                        hospitality_richiesta.NumeroCamere,
                                        hospitality_richiesta.NumAdulti,
                                        hospitality_richiesta.NumBambini,
                                        hospitality_richiesta.EtaB,
                                        hospitality_richiesta.Prezzo as PrezzoCamera,
                                        hospitality_tipo_camere.Id as IdCamera,
                                        hospitality_tipo_camere.TipoCamere as Camera,
                                        hospitality_tipo_soggiorno.Id as IdSoggiorno,
                                        hospitality_tipo_soggiorno.TipoSoggiorno as Soggiorno
                                FROM 
                                        hospitality_richiesta 
                                INNER JOIN 
                                        hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                                INNER JOIN 
                                        hospitality_camere_testo ON hospitality_camere_testo.camere_id = hospitality_tipo_camere.Id                                  
                                INNER JOIN 
                                        hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                                WHERE 
                                        hospitality_richiesta.id_proposta = ".$IdProposta."
                                AND 
                                        hospitality_camere_testo.lingue = 'it'
                                AND 
                                        hospitality_tipo_camere.idsito = ".IDSITO."
                                AND 
                                        hospitality_tipo_soggiorno.idsito = ".IDSITO;
                $result2 = $db->query($select2);
                $res2    = $db->result($result2); 

                $Struttura = str_replace("  "," ",NOMEHOTEL);
                $Struttura = str_replace(" ","_",$Struttura);
                $Struttura = trim($Struttura);

                //  chiamata QUERY PER INVIARE PRENO A ERICSOFT
                $xml .='<ReservationPushRequest>
                        <PropertyCode>'.IDSITO.'_'.$Struttura.'</PropertyCode>
                        <Reservation id="'.$IdUnivoco.'">
                                <TotalPrice>'.$PrezzoProposto.'</TotalPrice>
                                <CreationDate>'.$DataChiuso.'</CreationDate>
                                <LastChangeDate>'.$DataModificaPrenotazione.'</LastChangeDate>
                                <State>canceled</State>
                                <Booker>
                                        <Name>'.$Nome.'</Name>
                                        <Surname>'.$Cognome.'</Surname>
                                        <Email>'.$Email.'</Email>
                                        <Telephone>'.$Cellulare.'</Telephone>
                                        <Notes>'.$Note.'</Notes>'."\r\n";

                $xml .=                 $dati_carta;

                $xml .='                </Booker>
                                        <Rooms>'."\r\n";

                foreach ($res2 as $ky => $val) {
                       

                                    
                        $xml .='                <Room id="'.$val['IdCamera'].'">
                                                        <RoomReservationCode>'.$val['Camera'].'</RoomReservationCode>
                                                        <CheckIn>'.$Arrivo.'</CheckIn>
                                                        <CheckOut>'.$Partenza.'</CheckOut>
                                                        <AdultsNumber>'.$NumeroAdulti.'</AdultsNumber>'."\r\n";
                                                if($NumeroBambini!=''){
                        $xml .='                        <ChildrenNumber>'.$NumeroBambini.'</ChildrenNumber>'."\r\n";
                                                }
                        $xml .='                        <Guests>
                                                                <Guest type="adult" quantity="'.$val['NumAdulti'].'"/>'."\r\n";
                                                if($val['NumBambini']!=''){
                        $xml .='                                <Guest type="child" quantity="'.$val['NumBambini'].'"/>'."\r\n";
                                                }
                                                                
                        $xml .='                        </Guests>
                                                        <RoomPrice>'.str_replace(",","",number_format($val['PrezzoCamera'],2)).'</RoomPrice >'."\r\n";
                                                if($NoteProposta!=''){
                        $xml .='                        <Notes>'.$NoteProposta.'</Notes>'."\r\n";
                                                }
                        $xml .='                        <Prices>
                                                                <Price idRate="'.$val['Soggiorno'].'" date="'.$Arrivo.'">00.00</Price>
                                                        </Prices>
                                                </Room>'."\r\n";
                        }
                               
                $xml .='  
                                        </Rooms>
                                </Reservation>
                        </ReservationPushRequest>'."\r\n";



                $select = "SELECT 
                                * 
                        FROM 
                                hospitality_data_syncro_pms 
                        WHERE 
                                id_prenotazione = ".$_REQUEST['azione']." 
                        AND 
                                TypePms = 'E'
                        AND 
                                idsito = ".IDSITO;
                $res = $db->query($select);
                $rec = $db->row($res);
                if(is_array($rec)) {
                        if($rec > count($rec))
                                $tot = count($rec);
                        }else{ 	
                                $tot = 0;
                        }

                                                                               
                $dati = $xml;
                $ch = curl_init();
                $url = 'https://webservices.ericsoft.com/API/Suite/ReservationPush';
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dati);
                curl_exec($ch);

                $delete = "     DELETE 
                                FROM 
                                        hospitality_data_syncro_pms 
                                WHERE 
                                        id_prenotazione = ".$_REQUEST['azione']." 
                                AND 
                                        TypePms = 'E'
                                AND 
                                        idsito = ".IDSITO;
                $db->query($delete);



        }  
                  

    }elseif( $tipoP == 'Bedzzle'){

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
        

                            
    } 
       //curl_close($ch);    
    //header('Location:'.BASE_URL_SITO.'prenotazioni/');
    $prt->_goto(BASE_URL_SITO.'prenotazioni/'); 
?>