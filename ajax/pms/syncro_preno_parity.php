<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
    /*
        Funzione ricorsiva che aggiunge un array ad un oggetto SimpleXMLElement
    */
    function to_xml(SimpleXMLElement $object, $data)
    {
        $attr   = "Attribute_"; //Testo di riconoscimento di un nodo "attributo"
        $regexp = "/^Multi[\d]{1,2}_/"; //Regular expression per riconoscere nei nomi duplicati la parte differenziante
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if ( substr( $key, 0, 5 ) === "Multi" ) $nodename = preg_replace($regexp,'',$key);
                else $nodename = $key;
                $new_object = $object->addChild($nodename);
                to_xml($new_object, $value);
            } else {
                if(strpos($key, $attr) !== false){
                    $object->addAttribute(substr($key, strlen($attr)), $value);
                }else{
                    $object->addChild($key, $value);
                }
            }
        }
    }
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><reservations></reservations>', null, false);



  $idsito         = $_REQUEST['idsito'];
  $File           = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$idsito.'/data.xml';
  $Apikey         = '';
  $Url            = '';
  $HotelId        = '';
  $UserParity     = '';
  $PasswordParity = '';

  ##########################
  $Qcheck = "SELECT * FROM hospitality_parityrate WHERE idsito = ".$idsito." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
  $Rquery  = $dbMysqli->query($Qcheck);
  $records = $Rquery[0];

  if(isset($records) && is_array($records)) {
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

    if (!file_exists($File)) {
        fopen($File, "w");
    } 

    ### CHECK 
    $syncro = 'SELECT distinct(hospitality_guest.NumeroPrenotazione),hospitality_guest.Id,hospitality_guest.AzioneParity,hospitality_data_syncro_preno_to_parity.azione
                    FROM hospitality_guest 
                    LEFT JOIN hospitality_data_syncro_preno_to_parity ON hospitality_data_syncro_preno_to_parity.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione 
                    WHERE hospitality_guest.idsito = '.$idsito.'
                    AND hospitality_guest.TipoRichiesta = "Conferma"
                    AND hospitality_guest.Chiuso = 1
                    AND hospitality_guest.DataChiuso is not Null 
                    AND (hospitality_guest.Disdetta = 0  OR hospitality_guest.Disdetta = 1)
                    AND (hospitality_guest.Hidden = 0  OR hospitality_guest.Hidden = 1)';
    $resyncro    = $dbMysqli->query($syncro);
 
    if(sizeof($resyncro)>0){

        $lista_IdRichieste = array();
        
        foreach($resyncro as $key => $value){
            if($value['azione'] == ''){
                
                $lista_IdRichieste[] = $value['Id'];
            }
            elseif($value['AzioneParity'] != $value['azione']){
                
                $lista_IdRichieste[] = $value['Id'];
            }
            elseif($value['AzioneParity'] == $value['azione']){
                
                $lista_IdRichieste[] = '';
            }
            
        }
    }

    if(is_array($lista_IdRichieste) && !is_null($lista_IdRichieste) && !empty($lista_IdRichieste)){

            
            foreach($lista_IdRichieste as $ky => $v){
                if($v!=''){
                   
                    $lista_id_[] = $v;
                }
            }


            if(is_array($lista_id_) || !is_null($lista_id_) || !empty($lista_id_)){

                    $lista_id = implode(',',$lista_id_);

                    $query      = "SELECT hospitality_proposte.Id as IdProposta, 
                                    hospitality_proposte.PrezzoL,
                                    hospitality_proposte.PrezzoP,
                                    hospitality_proposte.NomeProposta,
                                    hospitality_proposte.TestoProposta,
                                    hospitality_proposte.AccontoPercentuale,
                                    hospitality_proposte.AccontoImporto,
                                    hospitality_proposte.AccontoTariffa,
                                    hospitality_proposte.AccontoTesto,
                                    hospitality_guest.Id as IdRichiesta, 
                                    hospitality_guest.DataRichiesta,
                                    hospitality_guest.DataChiuso,
                                    hospitality_guest.Chiuso,
                                    hospitality_guest.NumeroPrenotazione,
                                    hospitality_guest.NumeroAdulti,
                                    hospitality_guest.NumeroBambini,
                                    hospitality_guest.EtaBambini1,
                                    hospitality_guest.EtaBambini2,
                                    hospitality_guest.EtaBambini3,
                                    hospitality_guest.EtaBambini4,
                                    hospitality_guest.EtaBambini5,
                                    hospitality_guest.EtaBambini6,
                                    hospitality_guest.Cellulare,
                                    hospitality_guest.FontePrenotazione,
                                    hospitality_guest.TipoRichiesta,
                                    hospitality_guest.Note,
                                    hospitality_guest.AccontoLibero,
                                    hospitality_guest.AccontoRichiesta,
                                    hospitality_guest.Nome,
                                    hospitality_guest.Cognome,
                                    hospitality_guest.Email,
                                    hospitality_guest.DataArrivo,
                                    hospitality_guest.DataPartenza,
                                    hospitality_guest.ChiPrenota,
                                    hospitality_guest.Lingua,
                                    hospitality_guest.AzioneParity
                            FROM hospitality_proposte
                            INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                            WHERE  hospitality_guest.Id IN (".$lista_id.")
                            AND hospitality_guest.idsito = ".$idsito."
                            AND hospitality_guest.TipoRichiesta = 'Conferma'
                            AND hospitality_guest.Chiuso = 1
                            AND hospitality_guest.DataChiuso is not Null 
                            ";
                    $risultato    = $dbMysqli->query($query);

                        /* AZZERO VARIBAILI */
                        $PrezzoL              = '';
                        $PrezzoP              = '';
                        $IdProposta           = '';
                        $IdRichiesta          = '';
                        $PrezzoP              = '';
                        $AccontoRichiesta     = '';
                        $AccontoLibero        = '';
                        $Nome                 = '';
                        $Cognome              = '';
                        $Note                 = '';
                        $Email                = '';
                        $Cellulare            = '';
                        $Lingua               = '';
                        $NumeroPrenotazione   = '';
                        $NumeroAdulti         = '';
                        $NumeroBambini        = '';
                        $EtaBambini1          = '';
                        $EtaBambini2          = '';
                        $EtaBambini3          = '';
                        $EtaBambini4          = '';
                        $EtaBambini5          = '';
                        $EtaBambini6          = '';
                        $DataArrivo           = '';
                        $DataPartenza         = '';
                        $DataRichiesta        = '';
                        $DataPrenotazione     = '';
                        $AccontoPercentuale   = '';
                        $AccontoImporto       = '';
                        $acconto              = '';
                        $Camere               = array();
                        $my_array             = array();
                        $eta                  = '';
                        $NAdulti              = '';
                        $NBimbi               = '';
                        $Carta                = '';
                        $NumeroCarta_hidden   = '';
                        $NumeroCarta          = '';
                        $Intestatario         = '';
                        $Scadenza             = '';
                        $CVV                  = '';
                        $paymentType          = '';
                        $TipoPagamento        = '';
                        $Action               = '';
                        $status               = '';
                        $check_STATUS         = '';
                        $check_AP             = '';
                        $CC_Check             = '';
                        $prepaid              = '';
                        $PrezzoCamera         = '';
                        $contatore            = 1;
                        $data                 = '';
                        $inserimento_permesso = false;
                        $id_status            = '';
                        $AzioneParity         = '';
                        $Check                = '';
                        /* AZZERO VARIBAILI */
                        
                        //print_r($risultato);

                    foreach($risultato as $c => $record){
                      
                       
                        $PrezzoL            = number_format($record['PrezzoL'],1,'.','');
                        $PrezzoP            = number_format($record['PrezzoP'],1,'.','');
                        $IdProposta         = $record['IdProposta'];
                        $IdRichiesta        = $record['IdRichiesta'];
                        $PrezzoP_no_format  = $record['PrezzoP'];
                        $AccontoRichiesta   = $record['AccontoRichiesta'];
                        $AccontoLibero      = $record['AccontoLibero'];
                        $Nome               = $db->escape(($record['Nome']));
                        $Cognome            = $db->escape(($record['Cognome']));
                        $Note               = $db->escape(($record['Note']));
                        $Email              = $record['Email'];
                        $Cellulare          = $record['Cellulare'];
                        $Lingua             = $record['Lingua'];
                        $NumeroPrenotazione = $record['NumeroPrenotazione'];
                        $NumeroAdulti       = $record['NumeroAdulti'];
                        $NumeroBambini      = $record['NumeroBambini'];
                        $EtaBambini1        = $record['EtaBambini1'];
                        $EtaBambini2        = $record['EtaBambini2'];
                        $EtaBambini3        = $record['EtaBambini3'];
                        $EtaBambini4        = $record['EtaBambini4'];
                        $EtaBambini5        = $record['EtaBambini5'];
                        $EtaBambini6        = $record['EtaBambini6'];
                        $DataArrivo         = $record['DataArrivo'];
                        $DataPartenza       = $record['DataPartenza'];
                        $DataRichiesta      = $record['DataRichiesta'].' 00:00:00';
                        $DataPrenotazione   = $record['DataChiuso'].' 00:00:00';
                        $AccontoPercentuale = $record['AccontoPercentuale'];
                        $AccontoImporto     = $record['AccontoImporto'];
                        $AzioneParity       = $record['AzioneParity'];

                       
                        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                            $acconto = number_format(($PrezzoP*$AccontoRichiesta/100),1,'.','');
                            $prepaid = number_format(($PrezzoP - $acconto),1,'.',''); //se prepaid è la differenza tra il prezzo  -  acconto
                        }
                        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                            $acconto = number_format($AccontoLibero,1,'.','');
                            $prepaid = ($PrezzoP - $acconto); //se prepaid è la differenza tra il prezzo  -  acconto
                        }

                        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                            $acconto = number_format(($PrezzoP*$AccontoPercentuale/100),1,'.','');
                            $prepaid = ($PrezzoP - $acconto); //se prepaid è la differenza tra il prezzo  -  acconto
                        }
                        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                            $acconto = number_format($AccontoImporto,1,'.','');
                            $prepaid = ($PrezzoP - $acconto); //se prepaid è la differenza tra il prezzo  -  acconto
                        }

                        

                        ### CHECK  SYNCRO
                        $syncro_select = 'SELECT * FROM hospitality_data_syncro_preno_to_parity WHERE NumeroPrenotazione = '.$NumeroPrenotazione.' AND idsito = '.$idsito;
                        $res_syncro    = $dbMysqli->query($syncro_select);
                        if($res_syncro){
                            $recordSync = $res_syncro[0];

                            if(is_array($recordSync)) {
                                if($recordSync > count($recordSync))
                                $Check = count($recordSync);
                            }else{
                                $Check = 0;
                            }
                        }
                        if($Check > 0){

                
                            $Oldstatus  = $recordSync['azione'];
                            $id_status  = $recordSync['id'];

                            $status     = $AzioneParity;

                            if($AzioneParity != $Oldstatus){

                                $update = "UPDATE hospitality_data_syncro_preno_to_parity SET azione = '".$status."', data = '".date('Y-m-d H:i:s')."' WHERE id = ".$id_status." AND idsito = ".$idsito;
                                $dbMysqli->query($update);
                            }

                        
                        }else{

                            $status = 4;

                            $insert = "INSERT INTO  hospitality_data_syncro_preno_to_parity(NumeroPrenotazione,idsito,azione,data) VALUES('".$NumeroPrenotazione."','".$idsito."','".$status."','".date('Y-m-d H:i:s')."')";
                            $dbMysqli->query($insert);
                        }

                        ## CAMERE
                        $sel2   = "SELECT COUNT(hospitality_richiesta.Id) as numero_camere FROM hospitality_richiesta WHERE hospitality_richiesta.id_proposta = ".$IdProposta ;
                        $res2   = $dbMysqli->query($sel2);
                        $NumCam = $res2[0];
                        $numero_camere = $NumCam['numero_camere'];

                        $select2 = "SELECT hospitality_richiesta.*,
                                        hospitality_tipo_camere.TipoCamere,
                                        hospitality_tipo_camere.RoomParityId as IdCamera,
                                        hospitality_tipo_soggiorno.TipoSoggiorno,
                                        hospitality_tipo_soggiorno.RateParityId as IdSoggiorno
                                    FROM hospitality_richiesta
                                    INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                                    INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                                    WHERE hospitality_richiesta.id_proposta = ".$IdProposta ;
                        $result2 = $dbMysqli->query($select2);

                        $Camere  = array();
                        $eta     = '';
                        $NAdulti = '';
                        $NBimbi  = '';
                        $n = 1;
                     
                        if(count($result2)>0){

                            foreach ($result2 as $key => $val) {

                                    if($val['EtaB']!='' && !is_null($val['EtaB']) && $val['EtaB'] != NULL){
                                        $eta_ = explode(",",$val['EtaB']);
                                    }
                                    if($val['NumAdulti']!=0){
                                        $NAdulti = $val['NumAdulti'];
                                    }
                                    if($val['NumBambini']!=0){
                                        $NBimbi =$val['NumBambini'];
                                    }

                                    $Camere['Multi'.$n.'_room'] = array('Attribute_id'          => $val['IdCamera'],
                                                                        'Attribute_description' => $val['TipoCamere'],
                                                                        'Attribute_checkin'     => $DataArrivo,
                                                                        'Attribute_checkout'    => $DataPartenza,
                                                                        'Attribute_price'       => number_format($val['Prezzo'],1,'.',''),
                                                                        'Attribute_rateId'      => $val['IdSoggiorno'],
                                                                        'Attribute_quantity'    => $val['NumeroCamere'],
                                                                        'Attribute_adults'      => $NAdulti,
                                                                        'Attribute_children'    => $NBimbi,
                                                                        'Attribute_status'      => $status);
                                    $n++;
                                }                   
                        }


                                $my_array = array (
                                                    'Multi'.$contatore.'_reservation' => array (
                                                        'Attribute_checkin'       => $DataArrivo,
                                                        'Attribute_checkout'      => $DataPartenza,
                                                        'Attribute_firstName'     => $Nome,
                                                        'Attribute_lastName'      => $Cognome,
                                                        'Attribute_id'            => $NumeroPrenotazione,
                                                        'Attribute_room'          => $numero_camere,
                                                        'Attribute_adults'        => $NumeroAdulti,
                                                        'Attribute_children'      => $NumeroBambini,
                                                        'Attribute_email'         => $Email,
                                                        'Attribute_telephone'     => $Cellulare,
                                                        'Attribute_price'         => $PrezzoP,
                                                        'Attribute_prepaid'       => $prepaid,
                                                        'Attribute_status'        => $status,
                                                        'Attribute_creation_date' => $DataPrenotazione,
                                                        'Attribute_dlm'           => $DataPrenotazione,
                                                        'Attribute_notes'         => $Note,
                                                                $Camere
                                                    ),
                                                );
                          

                            to_xml($xml, $my_array);   

                            $contatore++;

                        } // fine ciclo prenotazioni                       


                        $data = $xml->asXML();
                        $data = str_replace('<0>','',$data);
                        $data = str_replace('</0>','',$data);
                        $data = str_replace('<1>','',$data);
                        $data = str_replace('</1>','',$data);
                        $data = str_replace('<2>','',$data);
                        $data = str_replace('</2>','',$data);

                        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$idsito.'/data.xml', $data);
                }
        }

            
    }

?>