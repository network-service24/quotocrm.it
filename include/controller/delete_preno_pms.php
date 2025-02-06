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

                $PMScheck    = "SELECT * FROM hospitality_pms WHERE idsito = ".IDSITO." AND Pms = 'hotelcinquestelle.cloud' AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
                $PMSquery    = $dbMysqli->query($PMScheck);
                $PMScheck    = $PMSquery[0];
                $urlHost     = $PMScheck['UrlHost'];
                $clientToken = $PMScheck['Provider'];
                $hotelCode   = $PMScheck['Code'];
                $LicenzaId   = $PMScheck['LicenzaId'];
    
                $select = "SELECT hospitality_guest.*, hospitality_proposte.Id as IdProposta, hospitality_proposte.PrezzoP as PrezzoProposto,
                                hospitality_proposte.Arrivo,hospitality_proposte.Partenza
                        FROM hospitality_guest 
                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                        WHERE hospitality_guest.Id = ".$_REQUEST['azione']."
                        AND hospitality_guest.idsito = ".IDSITO;
                $result = $dbMysqli->query($select);
                $value  = $result[0];

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
                $DataArrivo     = $value['DataArrivo'];
                $DataPartenza   = $value['DataPartenza'];
                $ArrivoProposta = $value['Arrivo'];
                $PartenzaProposta= $value['Partenza'];
                $PrezzoProposto = floatval($value['PrezzoProposto']);

                if($DataArrivo != $ArrivoProposta || $DataPartenza != $PartenzaProposta){

                        $date1 = date_create_from_format('Y-m-d', $PartenzaProposta);

                        $date2 = date_create_from_format('Y-m-d', $ArrivoProposta);

                        $Arrivo   = $ArrivoProposta;
                        $Partenza = $PartenzaProposta;

                }else{
                        $date1 = date_create_from_format('Y-m-d', $DataPartenza);

                        $date2 = date_create_from_format('Y-m-d', $DataArrivo);

                        $Arrivo   = $DataArrivo;
                        $Partenza = $DataPartenza;
                }

                $diff  = date_diff($date1, $date2);

                $Notti = $diff->d;

                ## calcolo sconto
                $selectSconto = "SELECT sconto FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND sconto != 0  AND id_richiesta = ".$_REQUEST['azione']." AND id_proposta = ".$IdProposta."";
                $resultSc = $dbMysqli->query($selectSconto);
                if(sizeof($resultSc)>0){
                        $rowSC = $resultSc[0];
                        $percentualeSconto =  $rowSC['sconto'];
                }else{
                        $percentualeSconto = '';  
                }

                        ### Query per servizi aggiuntivi
                        $selectS = "     SELECT 
                                                        hospitality_tipo_servizi.Id as id_servizio,
                                                        hospitality_tipo_servizi.TipoServizio,
                                                        hospitality_tipo_servizi.PrezzoServizio,
                                                        hospitality_tipo_servizi.CalcoloPrezzo,
                                                        hospitality_tipo_servizi.PercentualeServizio,
                                                        hospitality_relazione_servizi_proposte.num_persone ,
                                                        hospitality_relazione_servizi_proposte.num_notti
                                                FROM 
                                                        hospitality_relazione_servizi_proposte 
                                                INNER JOIN 
                                                        hospitality_tipo_servizi 
                                                ON 
                                                        hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id             
                                                WHERE 
                                                        hospitality_relazione_servizi_proposte.idsito = ".IDSITO."  
                                                AND
                                                        hospitality_tipo_servizi.idsito = ".IDSITO." 
                                                AND 
                                                        hospitality_relazione_servizi_proposte.id_richiesta = ".$_REQUEST['azione']." 
                                                AND 
                                                        hospitality_relazione_servizi_proposte.id_proposta = ".$IdProposta ."";
                        $resS = $dbMysqli->query($selectS);

                        $servizi      = array();
                        $id_servizio  = '';
                        $TipoServizio = '';
                        $PrezzoServizio = '';
                        $valoreScontoServizi  = '';
                        $final_amount_servizi = '';

                        if(sizeof($resS)>0){

                                foreach ($resS as $k => $vl) {

                                        switch($vl['CalcoloPrezzo']){
                                        case "Al giorno":
                                                $PrezzoServizio = ($vl['PrezzoServizio']!=0?($vl['PrezzoServizio']*$Notti):0);
                                        break;
                                        case "A percentuale":
                                                $PrezzoServizio = ($vl['PercentualeServizio']!=''?($PrezzoProposto*$vl['PercentualeServizio']/100):0);
                                        break;
                                        case "Una tantum":
                                                $PrezzoServizio = ($vl['PrezzoServizio']!=0?$vl['PrezzoServizio']:0);
                                        break;
                                        case "A persona":
                                                $PrezzoServizio = ($vl['PrezzoServizio']!=0?($vl['PrezzoServizio']*($vl['num_notti']*$vl['num_persone'])):0);
                                        break;
                                        }
                                        
                                        $id_servizio    = $vl['id_servizio'];
                                        $TipoServizio   = $vl['TipoServizio'];


                                        $servizi[] =  array(    "quantity"           => 1,
                                                                "product_code"       => "$id_servizio",
                                                                "product_description"=> addslashes($TipoServizio) ,
                                                                "unit_price"         => floatval($PrezzoServizio));

                                        $totaleServizi += $PrezzoServizio;
                                }
                                        if($percentualeSconto!=''){
                                                $valoreScontoServizi  = (($totaleServizi*$percentualeSconto)/100);
                                                $final_amount_servizi = ($totaleServizi-$valoreScontoServizi);
                                        }else{
                                                $final_amount_servizi = $totaleServizi;
                                        }
                                ################################################################


                                                        
                                               
                        }
                       

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
                                hospitality_camere_testo.Descrizione
                                FROM hospitality_richiesta 
                                INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                                INNER JOIN hospitality_camere_testo ON hospitality_camere_testo.camere_id = hospitality_tipo_camere.Id
                                INNER JOIN hospitality_pms_camere ON hospitality_pms_camere.RoomTypeId = hospitality_tipo_camere.RoomTypePms
                                INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                                WHERE hospitality_richiesta.id_proposta = ".$IdProposta."
                                AND hospitality_camere_testo.lingue = 'it'
                                AND hospitality_pms_camere.idsito = ".IDSITO;
                $res2 = $dbMysqli->query($select2);

                $Camere         = array();
                $data           = array();
                $etaB           = array();
                $tipo_soggiorno = '';
                $tipo_camera    = '';
                $n              = 1;
                $amountCamera_after_tax = '';
                $numeroCamere = count($res2);

                foreach ($res2 as $ky => $val) {

                        switch(true){
                                case strstr($val['TipoSoggiorno'],"All Inclusive"):
                                        $tipo_soggiorno = 'AI';
                                break;
                                case strstr($val['TipoSoggiorno'],"Bed & Breakfast"):
                                        $tipo_soggiorno = 'BB';
                                break;
                                case strstr($val['TipoSoggiorno'],"Solo Perno"):
                                        $tipo_soggiorno = 'RO';
                                break;
                                case strstr($val['TipoSoggiorno'],"Pensione Completa"):
                                        $tipo_soggiorno = 'FB';
                                break;
                                case strstr($val['TipoSoggiorno'],"Mezza Pensione"):
                                        $tipo_soggiorno = 'HB';
                                break; 
                                case strstr($val['TipoSoggiorno'],"Mezza Pensione All Inclusive"):
                                        $tipo_soggiorno = 'AI-HB';
                                break; 
                                default:
                                        $tipo_soggiorno = $val['TipoSoggiorno'];
                                break;
                        }
                        $NumAdulti   = intval($val['NumAdulti']);

                        $NumBambini  = intval($val['NumBambini']);

                        $Prezzo      = floatval($val['Prezzo']);

/*                         if($numeroCamere > 1){
                                if($percentualeSconto!=''){
                                        $valoreSconto   = (($Prezzo*$percentualeSconto)/100);
                                        $amountCamera_after_tax = ($Prezzo-$valoreSconto);
                                }else{
                                        $amountCamera_after_tax = $Prezzo;
                                }
                        }else{
                                $amountCamera_after_tax = $PrezzoProposto;
                        } */

                        if($percentualeSconto!=''){
                                $valoreSconto           = (($Prezzo*$percentualeSconto)/100);
                                $amountCamera_after_tax = ($Prezzo-$valoreSconto);
                        }else{
                                $amountCamera_after_tax = $Prezzo;
                        }   

                        if($val['EtaB'] != ''){
                                $etaB    = array();
                                $etaB_   = explode(",",$val['EtaB']);

                                foreach($etaB_ as $k => $v){
                                        $etaB[] = intval($v);

                                }

                                $Camere[] = array("room_type_id"        => intval($val['RoomTypeId']),
                                                "room_type_description" => strip_tags(addslashes($val['Descrizione'])), 
                                                "meal_plan"             => $tipo_soggiorno,          
                                                "amount_after_tax"      => $amountCamera_after_tax,        
                                                "number_of_guests"      => ($NumAdulti+$NumBambini),
                                                "adults_number"         => $NumAdulti,
                                                "children_number"       => $NumBambini,
                                                "children_age"          => $etaB);
                        }else{
                                $Camere[] = array("room_type_id"        => intval($val['RoomTypeId']),
                                                "room_type_description" => strip_tags(addslashes($val['Descrizione'])), 
                                                "meal_plan"             => $tipo_soggiorno,          
                                                "amount_after_tax"      => $amountCamera_after_tax,        
                                                "number_of_guests"      => ($NumAdulti+$NumBambini),
                                                "adults_number"         => $NumAdulti,
                                                "children_number"       => $NumBambini);
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
                                pms_reservation_id != ''
                        AND 
                                idsito = ".IDSITO;
                $res = $dbMysqli->query($select);
                $rec = $res[0];
                if(is_array($rec)) {
                        if($rec > count($rec))
                                $tot = count($rec);
                        }else{ 	
                                $tot = 0;
                        }

                if($tot > 0){
                        $pms_reservation_id = $rec['pms_reservation_id'];
                        ### MODIFICA DI UNA PRENOTAZIONE GIA SINCRONIZZATA
                        $data = array("clientToken"=> $clientToken,
                                        "hotelCode"=> $hotelCode,
                                        "reservations"   =>   array(array("name"             => $Nome,
                                                                        "surname"            => $Cognome, 
                                                                        "email"              => $Email,         
                                                                        "phone"              => $Cellulare,        
                                                                        "checkin_date"       => $Arrivo,
                                                                        "checkout_date"      => $Partenza,
                                                                        "ext_reservation_id" => "7",
                                                                        "master_reservation_id" =>"$pms_reservation_id" ,
                                                                        "status"             =>  array("id"=>3, "desc"=>"cancelled"),
                                                                        "rooms"              =>  $Camere       
                                                                        )
                                                                )            
                                        );            

                }




                        $data_string = json_encode($data);
                       
                       // print_r($data_string);
                        
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
                        $risultato = json_decode($result);
                        
                        //$pms_reservation_id = $risultato[0]->link[0]->pms_reservation_id;

                        $ext_reservation_id    = $risultato[0]->link[0]->ext_reservation_id;
                        $pms_reservation_id    = $risultato[0]->link[0]->master_reservation_id;

                
                        $data_serv = date('Y-m-d').'T'.date('h:i:s').'.000Z';



                        if(sizeof($resS)>0){
                              
                                        ### MODIFICA PER SEFRVIZI AGGIUNTIVI
                                        $dataS = array("clientToken"=> $clientToken,
                                                        "hotelCode" => $hotelCode,
                                                        "charges"   =>   array(array("charge_id"                 => "$ext_reservation_id",
                                                                                        "master_reservation_id"  => "$pms_reservation_id",       
                                                                                        "date"                   => "$data_serv",        
                                                                                        "final_amount"           => $final_amount_servizi,
                                                                                        "sale_items"             => $servizi       
                                                                                        ) 
                                                                                )           
                                                        );

                                        $data_stringS = json_encode($dataS);   
                        // print_r($data_stringS);   exit;                    
                                        $chS = curl_init($urlHost.'charges/'); 
                                        curl_setopt($chS, CURLOPT_SSL_VERIFYPEER, false);                                                                
                                        curl_setopt($chS, CURLOPT_CUSTOMREQUEST, 'POST');                                                                     
                                        curl_setopt($chS, CURLOPT_POSTFIELDS, $data_stringS);                                                                  
                                        curl_setopt($chS, CURLOPT_RETURNTRANSFER, true);                                                                      
                                        curl_setopt($chS, CURLOPT_HTTPHEADER, array(                                                                          
                                        'Content-Type: application/json',                                                                                
                                        'Content-Length: ' . strlen($data_stringS))                                                                       
                                        ); 
                                        $resultS = curl_exec($chS);  
                                        $risultatoS = json_decode($resultS);
                        } 





                        $delete = "DELETE 
                                    FROM 
                                        hospitality_data_syncro_pms 
                                    WHERE 
                                        id_prenotazione = ".$_REQUEST['azione']." 
                                    AND 
                                        TypePms = 'C'
                                    AND 
                                        idsito = ".IDSITO;
                        $dbMysqli->query($delete);
        
        
        /**
         * ? se Ericsoft il secondo tipo di codice
         */                
        }elseif( $tipoP == 'Ericsoft'){

                $PMScheck    = "SELECT * FROM hospitality_pms WHERE idsito = ".IDSITO." AND Pms = '".($_REQUEST['valore'] == 'C'?'hotelcinquestelle.cloud': 'booking.ericsoft.com')."' AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
                $PMSquery    = $dbMysqli->query($PMScheck);
                $PMScheck    = $PMSquery[0];
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
                $result = $dbMysqli->query($select);
                $value  = $result[0];

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
                $res = $dbMysqli->query($sel);
                $val = $res[0];     
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
                $res2 = $dbMysqli->query($select2);

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
                $res = $dbMysqli->query($select);
                $rec = $res[0];
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
                $dbMysqli->query($delete);



        }  
                  

    }elseif( $tipoP == 'Bedzzle'){

                $PMScheck    = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = ".IDSITO." AND Pms = 1 ORDER BY Id DESC LIMIT 1";
                $PMSquery    = $dbMysqli->query($PMScheck);
                $PMScheck    = $PMSquery[0];
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
                $result = $dbMysqli->query($select);
                $value  = $result[0];

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
                $res2 = $dbMysqli->query($select2);

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
                        $dbMysqli->query($delete);
        

                            
    } 
       //curl_close($ch);    
    //header('Location:'.BASE_URL_SITO.'prenotazioni/');
    $prt->_goto(BASE_URL_SITO.''.$_REQUEST['prov'].'/'); 
?>