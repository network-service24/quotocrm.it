<?php
// ribadisco error_reporting, perchè escludere alcuni warning
error_reporting(0);

$DataDiOggi = date('Y-m-d');
$GiornoInPiu = mktime (0,0,0,date('m'),(date('d')+1),date('Y'));
$DataDiDomani = date('Y-m-d',$GiornoInPiu);

if($_REQUEST['azione'] == 'edit' && $_REQUEST['param'] != '') {

        // query per recupero dati tramite Identificativo
        $row = $fun->get_modify($_REQUEST['param']);
        // instanza delle varibili utili
        $Id                  = $row['Id'];
        $idsito              = $row['idsito'];
        $id_politiche        = $row['id_politiche'];
        $id_template         = $row['id_template'];
        $Acconto             = $row['AccontoRichiesta'];
        $AccontoLibero       = $row['AccontoLibero'];
        $DataRichiesta       = $row['DataRichiesta'];
        $TipoRichiesta       = $row['TipoRichiesta'];
        $TipoVacanza         = $row['TipoVacanza'];
        $Lingua              = $row['Lingua'];
        $ChiPrenota          = $row['ChiPrenota'];
        $EmailOperatore      = $row['EmailSegretaria'];
        $IdClienteGestionale = $row['IdClienteGestionale'];
        $MultiStruttura      = stripslashes($row['MultiStruttura']);
        $Nome                = stripslashes($row['Nome']);
        $Cognome             = stripslashes($row['Cognome']);
        $Email               = $row['Email'];
        $prefisso            = $row['PrefissoInternazionale'];
        $Cellulare           = $row['Cellulare'];
        $DataArrivo          = $row['DataArrivo'];
        $DataPartenza        = $row['DataPartenza'];
        $NumeroPrenotazione  = $row['NumeroPrenotazione'];
        $NumAdulti           = $row['NumeroAdulti'];
        $NumBambini          = $row['NumeroBambini'];
        $FontePrenotazione   = $row['FontePrenotazione'];
        $TipoPagamento       = $row['TipoPagamento'];
        $DataScadenza        = $row['DataScadenza'];
        $Note                = stripslashes($row['Note']);
        $AbilitaInvio        = 1;
        $CodiceSconto        = $row['CodiceSconto'];
        $Chiuso              = $row['Chiuso'];
        $DataChiuso          = $row['DataChiuso'];
        $IdMotivazione       = $row['IdMotivazione'];
        $DataVoucherRecSend  = $row['DataVoucherRecSend'];
        $DataValiditaVoucher = $row['DataValiditaVoucher'];
        $DataRi              = $row['DataRiconferma'];

        ### check controllo se il preventivo sta già per essere modificato ###
        $check_control_modify = $fun->check_control_modify(IDSITO,$Id,$_SESSION['user_accesso']);
        $occupato = strlen($check_control_modify);


        if($TipoRichiesta == 'Preventivo'){
            $etichetta_numero = 'ID e N° Preventivo'; 
            $etichetta_data   = 'Data Preventivo';  
            $EtichettaEditingTemplate = 'Modifica il contenuto con un testo alternativo per questo preventivo:';
            $data_proposta    = $fun->gira_data($DataRichiesta);  
        }
        if($TipoRichiesta == 'Conferma' && $Chiuso == 0){
            $etichetta_numero = 'ID e N° Conferma';
            $etichetta_data   = 'Data Conferma';
            $EtichettaEditingTemplate = 'Modifica il contenuto con un testo alternativo per questa conferma:';
            $data_proposta    = $fun->gira_data($DataRichiesta);      
        }
        if($TipoRichiesta == 'Conferma' && $Chiuso == 1){
            $etichetta_numero = 'ID e N° Prenotazione';
            $etichetta_data   = 'Data Prenotazione';
            $EtichettaEditingTemplate = 'Modifica il contenuto con un testo alternativo per questa prenotazione:';
            $data_proposta    = $fun->gira_data_noHour($DataChiuso);      
        }

        // chiamate per popolare la lista select del target cliente
        $listaTarget = $fun->lista_target(IDSITO);
        $array_target = explode(",",$TipoVacanza);
        foreach($listaTarget as $key => $value){
            $target .= '<option value="'.$value['Target'].'" '.($value['Target']!=''?(in_array($value['Target'],$array_target)?'selected="selected"':''):'').'>'.$value['Target'].'</option>';
        }
      

        // chiamate per popolare la lista select degli operatori
        $listaOperatori = $fun->lista_operatori(IDSITO);
            $Operatori .='<option value="">scegli</option>';
        foreach($listaOperatori as $key => $value){
            $Operatori .='<option value="'.$value['NomeOperatore'].'" '.($value['NomeOperatore'] == $ChiPrenota?'selected="selected"':'').'>'.$value['NomeOperatore'].'</option>';
            $EmailAssociata .='<option value="'.$value['EmailSegretaria'].'" '.($value['EmailSegretaria'] == $EmailOperatore?'selected="selected"':'').'>'.$value['EmailSegretaria'].'</option>';
        }

        // lisat delle lingue disponibili in QUOTO
        $ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/it.png" data-img-label="Italiano" value="it" '.($Lingua=='it'?'selected="selected"':'').'>Italiano</option>';
        $ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/en.png" data-img-label="Inglese"  value="en" '.($Lingua=='en'?'selected="selected"':'').'>Inglese</option>';
        $ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/fr.png" data-img-label="Francese" value="fr" '.($Lingua=='fr'?'selected="selected"':'').'>Francese</option>';
        $ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/de.png" data-img-label="Tedesco"  value="de" '.($Lingua=='de'?'selected="selected"':'').'>Tedesco</option>';

        // lista dei template disponibili in QUOTO
        $ListaTemplate = $fun->get_lista_template(IDSITO,$id_template);

        // lista fonti di prenotazione
        $listaFonti = $fun->lista_fonti(IDSITO);
            $fonti .='<option value="">scegli</option>';
        foreach($listaFonti as $key => $value){
            $fonti .='<option value="'.$value['FontePrenotazione'].'" '.($value['FontePrenotazione']==$FontePrenotazione?'selected="selected"':'').' '.($value['FontePrenotazione']=='Sito Web'?'disabled="disabled"':'').'>'.($value['FontePrenotazione']=='Sito Web'?$value['FontePrenotazione'].' / Landing':$value['FontePrenotazione']).'</option>';
        }

        // lista politiche
        $listaPolitiche = $fun->lista_politiche(IDSITO);
            $politiche .='<option value="">scegli</option>';
        foreach($listaPolitiche as $ch => $vl){
            $politiche .='<option value="'.$vl['id'].'" '.($vl['id']==$id_politiche?'selected="selected"':'').'>'.$vl['etichetta'].'</option>';
        }

        // lista clienti per la ricerca sul campo nome e cognome
        $lista_nomi = $fun->lista_clienti(IDSITO);

        // Ciclo per il select Numero Totale Adulti
        $i = 1;
            $NumeroAdulti .='<option value="">scegli</option>';
        for($i==1; $i<=20; $i++){
            $NumeroAdulti .='<option value="'.$i.'" '.($i==$NumAdulti?'selected="selected"':'').'>'.$i.'</option>';
        }
            $NumeroAdulti .='<option value="25" '.(25==$NumAdulti?'selected="selected"':'').'>25</option>';
            $NumeroAdulti .='<option value="30" '.(30==$NumAdulti?'selected="selected"':'').'>30</option>';
            $NumeroAdulti .='<option value="35" '.(35==$NumAdulti?'selected="selected"':'').'>35</option>';
            $NumeroAdulti .='<option value="40" '.(40==$NumAdulti?'selected="selected"':'').'>40</option>';
            $NumeroAdulti .='<option value="45" '.(45==$NumAdulti?'selected="selected"':'').'>45</option>';
            $NumeroAdulti .='<option value="50" '.(50==$NumAdulti?'selected="selected"':'').'>50</option>';
            $NumeroAdulti .='<option value="60" '.(60==$NumAdulti?'selected="selected"':'').'>60</option>';
            $NumeroAdulti .='<option value="70" '.(70==$NumAdulti?'selected="selected"':'').'>70</option>';

        // Ciclo per il select Numero Totale Bambini
        $n = 1;
            $NumeroBambini .='<option value="">scegli</option>';
        for($n==1; $n<=20; $n++){
            $NumeroBambini .='<option value="'.$n.'" '.($n==$NumBambini?'selected="selected"':'').'>'.$n.'</option>';
        }

        //controllo se l'url del boooking è compilato nella voce di menu [Collegamenti social] oppure se il cliente ha un booking engine sincronizzato 
        if($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0){
            $BookingOnline = $fun->check_UrlBookingOnline(IDSITO);
        }
        //controllo se simpleboooking è attivo 
        if($fun->check_simplebooking(IDSITO)==1){

            $BookingOnline ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_booking1">Apri SimpleBooking</button>  
                                    </div>
                                </div>
                                <div id="wait1"></div>'."\r\n";

            $resultBookingOnline = '<div id="simple1"></div>'."\r\n";

            $BookingOnline2 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                             
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_booking2">Apri SimpleBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait2"></div>'."\r\n";

            $resultBookingOnline2 = '<div id="simple2"></div>'."\r\n";

            $BookingOnline3 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                                
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_booking3">Apri SimpleBooking</button>                                                                                        
                                    </div>
                                </div>
                                <div id="wait3"></div>'."\r\n";   

            $resultBookingOnline3 = '<div id="simple3"></div>'."\r\n";

            $BookingOnline4 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                               
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_booking4">Apri SimpleBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait4"></div>'."\r\n";

            $resultBookingOnline4 = '<div id="simple4"></div>'."\r\n";

            $BookingOnline5 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                               
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_booking5">Apri SimpleBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait5"></div>'."\r\n";
            $resultBookingOnline5 = '<div id="simple5"></div>'."\r\n";
        }
        //controllo se ericsoft boooking è attivo 
        if($fun->check_ericsoftbooking(IDSITO)==1){

            $BookingOnline ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                               
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_ericsoft_booking1">Apri EricSoftBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait1E"></div>'."\r\n";

            $resultBookingOnline = '<div id="simple1E"></div>'."\r\n";

            $BookingOnline2 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                                
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_ericsoft_booking2">Apri EricSoftBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait2E"></div>'."\r\n";

            $resultBookingOnline2 = '<div id="simple2E"></div>'."\r\n";

            $BookingOnline3 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                                
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_ericsoft_booking3">Apri EricSoftBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait3E"></div>'."\r\n";

            $resultBookingOnline3 = '<div id="simple3E"></div>'."\r\n";

            $BookingOnline4 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                                
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_ericsoft_booking4">Apri EricSoftBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait4E"></div>'."\r\n";

            $resultBookingOnline4 = '<div id="simple4E"></div>'."\r\n";

            $BookingOnline5 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                                
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_ericsoft_booking5">Apri EricSoftBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait5E"></div>'."\r\n";

            $resultBookingOnline5 = '<div id="simple5E"></div>'."\r\n";                       
        } 
        //controllo se bedzzle boooking è attivo 
        if($fun->check_bedzzlebooking(IDSITO)==1){

            $BookingOnline ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                               
                                        <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#input_bedzzle_booking1">Apri BedzzleBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait1Bedzzle"></div>'."\r\n";

            $resultBookingOnline = '<div id="simple1Bedzzle"></div>'."\r\n";

            $BookingOnline2 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                                
                                        <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#input_bedzzle_booking2">Apri BedzzleBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait2Bedzzle"></div>'."\r\n";

            $resultBookingOnline2 = '<div id="simple2Bedzzle"></div>'."\r\n";

            $BookingOnline3 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                                
                                        <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#input_bedzzle_booking3">Apri BedzzleBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait3Bedzzle"></div>'."\r\n";

            $resultBookingOnline3 = '<div id="simple3Bedzzle"></div>'."\r\n";

            $BookingOnline4 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                               
                                        <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#input_bedzzle_booking4">Apri BedzzleBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait4Bedzzle"></div>'."\r\n";

            $resultBookingOnline4 = '<div id="simple4Bedzzle"></div>'."\r\n";

            $BookingOnline5 ='   <div class="row m-t-10">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">                                
                                        <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#input_bedzzle_booking5">Apri BedzzleBooking</button>                                                         
                                    </div>
                                </div>
                                <div id="wait5Bedzzle"></div>'."\r\n";

            $resultBookingOnline5 = '<div id="simple5Bedzzle"></div>'."\r\n";

        }                             
        //query per la lista dei pacchetti
        $lista_pacchetti = $fun->lista_pacchetti(IDSITO,$Lingua);
        //query per la lista dei soggiorni
        $ListaSoggiorno  = $fun->lista_soggiorni(IDSITO);
        //query per la lista delle camere
        $ListaCamere  = $fun->lista_camere(IDSITO);
        //controllo se plugin delle select camere è attivo
        $stile_chosen = $fun->check_configurazioni(IDSITO,'select_tipo_camere');
        //select tipocamere 1,2,3,4,5
        $select_tipo_camere1 .= '  <select required name="TipoCamere1[]" id="TipoCamere_1_1" class="'.$stile_chosen.' form-control" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onChange="get_listino(1,1);"':''):'').'>
                                            '.$ListaCamere.'
                                    </select>';

        $select_tipo_camere2 .= '  <select name="TipoCamere2[]" id="TipoCamere_2_1" class="'.$stile_chosen.' form-control" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onChange="get_listino(2,1);"':''):'').'>
                                            '.$ListaCamere.'
                                    </select>';

        $select_tipo_camere3 .= '  <select name="TipoCamere3[]" id="TipoCamere_3_1" class="'.$stile_chosen.' form-control" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onChange="get_listino(3,1);"':''):'').'>
                                            '.$ListaCamere.'
                                    </select>';

        $select_tipo_camere4 .= '  <select name="TipoCamere4[]" id="TipoCamere_4_1" class="'.$stile_chosen.' form-control" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onChange="get_listino(4,1);"':''):'').'>
                                            '.$ListaCamere.'
                                    </select>';

        $select_tipo_camere5 .= '  <select name="TipoCamere5[]" id="TipoCamere_5_1" class="'.$stile_chosen.' form-control" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onChange="get_listino(5,1);"':''):'').'>
                                            '.$ListaCamere.'
                                    </select>';

        //ciclo per percentuli sconto
	    ### CODICE SCONTO PROVENIENTE DA FORM QUOTO ######
		$sel_sc     = "SELECT CodiceSconto FROM hospitality_guest WHERE Id = ".$Id;
		$result     = $dbMysqli->query($sel_sc);

		if(sizeof($result)>0){

			$datirecord = $result[0];

			$CodiceSconto = $datirecord['CodiceSconto'];

			$check_codice_sconto = false;

			if($CodiceSconto != ''){

				$select_codice_sconto = "SELECT * FROM hospitality_codice_sconto WHERE cod = '".$CodiceSconto."' AND idsito = ".$idsito." AND usato = 0";
				$res_cod_sconti       = $dbMysqli->query($select_codice_sconto);
				$arr_cod_sconti       = $res_cod_sconti[0];
				if(sizeof($res_cod_sconti)>0){

						$check_codice_sconto  = true;
						$codice_sconto        = $arr_cod_sconti['cod'];
						$valore_sconto        = $arr_cod_sconti['imp_sconto'];
						$note_sconto          = $arr_cod_sconti['note'];
						$fine_sconto          = $arr_cod_sconti['data_fine'];
						if($valore_sconto != ''){
							$percentuali_sconto .='<option value="'.$valore_sconto.'">'.$codice_sconto.' - '.$valore_sconto.'%</option>';
						}

				}
			
			}
		}
        $num_sconto = 1;
        for($num_sconto==1; $num_sconto<=25; $num_sconto++){
            $percentuali_sconto .='<option value="'.$num_sconto.'">'.$num_sconto.'%</option>';
        }
        $percentuali_sconto .='<option value="30">30%</option>';
        $percentuali_sconto .='<option value="35">35%</option>';
        $percentuali_sconto .='<option value="40">40%</option>';
        $percentuali_sconto .='<option value="45">45%</option>';
        $percentuali_sconto .='<option value="50">50%</option>';
        $percentuali_sconto .='<option value="100">100%</option>';

        $AccontoRichiesta = $fun->get_dati_caparra(IDSITO,$Acconto);

        $listaServizi = $fun->lista_servizi_aggiuntivi(IDSITO);

        $TipiPagamento = $fun->sel_tipo_pagamenti(IDSITO,$Id);

        $ListaPrefissi = $fun->get_var_prefissi($prefisso,$Lingua);

        // chiamate per popolare la lista select degli INFO BOX
        $info_Box = $fun->get_lista_infoBox(IDSITO,$Id);

        // testo alternativo e non salvato per ogni rpeventivo
        $TestoAlternativo_ = $fun->testo_alternativo($idsito,$Id,$Lingua,$id_template,$TipoVacanza,$TipoRichiesta);
        foreach($TestoAlternativo_  as $key => $value){
            $TestoAlternativo = $value;
            $IdTestoAlternativo = ($key==0?'':$key);
        }

        $boxCodiceSconto = ($CodiceSconto != ''?
                            '<small class="'.($check_codice_sconto == true?'boxCodiceScontoGreen':'boxCodiceSconto').' nowrap">
                                    '.($CodiceSconto != ''  && $check_codice_sconto == true ? '<b>Applica il codice promo['.$CodiceSconto.']</b>'.($fine_sconto < date('Y-m-d H:i:s')?'<br><b>attenzione: la data di scadenza è superata!</b> ':'').' <i class="fa fa-question-circle" data-toggle="tooltip" title="" aria-hidden="true" data-original-title="'.$note_sconto.'"></i>' : ($CodiceSconto != ''  && $check_codice_sconto == false?'<b>Il codice promo inserito dal cliente è ['.$CodiceSconto.'],<br> ma non corrisponde a quello creato su QUOTO!</b>':'') ).'
                            </small>
                            <div class="clearfix p-b-10"></div>':'')."\r\n";

        if($CodiceSconto != ''){
            $select_codice_sconto = "SELECT * FROM hospitality_codice_sconto WHERE cod = '".$CodiceSconto."' AND idsito = ".IDSITO." AND usato = 0";
            $res_cod_sconti       = $dbMysqli->query($select_codice_sconto);
            $arr_cod_sconti       = $res_cod_sconti[0];
            
            $codice_sconto        = $arr_cod_sconti['cod'];
            $valore_sconto        = $arr_cod_sconti['imp_sconto'];
            $note_sconto          = $arr_cod_sconti['note'];
            $fine_sconto          = $arr_cod_sconti['data_fine'];
           
        }
        

        // comincio ad esplodere le proposte già compilate
        $conteggio_proposte = "SELECT * FROM hospitality_proposte WHERE id_richiesta = ".$Id." ORDER BY Id ASC";
        $record_proposte    = $dbMysqli->query($conteggio_proposte);
        $numero_proposte    = sizeof($record_proposte);
        // azzero le variabili
        
        $ListaPacchetti = '';
        $ListaTariffe   = '';
        $listaCamere    = '';
        $select_sconti  = '';
        $lista_sconti   = '';
        $proposte = '';
       // foreach per ogni proposta compilata
        $i = 1;
        foreach($record_proposte as $k => $rows){

               $Id_riga            = $rows['Id'];
               $NomeProposta       = stripslashes($rows['NomeProposta']);
               $TestoProposta      = stripslashes($rows['TestoProposta']);
               $CheckProposta      = $rows['CheckProposta'];
               $PrezzoL            = $rows['PrezzoL'];
               $PrezzoP            = $rows['PrezzoP'];
               $AccontoPercentuale = $rows['AccontoPercentuale'];
               $AccontoImporto     = $rows['AccontoImporto'];
               $AccontoTariffa     = stripslashes($rows['AccontoTariffa']);
               $AccontoTesto       = stripslashes($rows['AccontoTesto']);
               $Arrivo             = $rows['Arrivo'];
               $Partenza           = $rows['Partenza'];
               $ListaPacchetti     = '';


               $select_sconti = "  SELECT 
                                        hospitality_relazione_sconto_proposte.* 
                                    FROM 
                                        hospitality_relazione_sconto_proposte
                                    WHERE 
                                        hospitality_relazione_sconto_proposte.idsito = ".IDSITO."
                                    AND 
                                        hospitality_relazione_sconto_proposte.id_richiesta = ".$Id."
                                    AND 
                                        hospitality_relazione_sconto_proposte.id_proposta = ".$Id_riga."";
                $result_sconti = $dbMysqli->query($select_sconti);
                $rec_sconti    = $result_sconti[0];
                
               
                $lista_sconti .='<option value="0" '.($rec_sconti['sconto']==0 || $rec_sconti['sconto']==''?'selected="selected"':'').'>--</option>';
                if($CodiceSconto != ''  && $check_codice_sconto == true){
                   if ($valore_sconto !=''){
                        $lista_sconti .='<option value="'.$valore_sconto.'" selected="selected">'.$codice_sconto.' - '.$valore_sconto.'%</option>';
                   }
                }
                //ciclo per percentuli sconto
                $num_sc = 1;
                for($num_sc==1; $num_sc<=25; $num_sc++){
                   $lista_sconti .='<option value="'.$num_sc.'" '.($rec_sconti['sconto']==$num_sc?'selected="selected"':'').'>'.$num_sc.'%</option>';
                }

                $lista_sconti .='   <option value="30" '.($rec_sconti['sconto']==30?'selected="selected"':'').'>30%</option>
                                    <option value="35" '.($rec_sconti['sconto']==35?'selected="selected"':'').'>35%</option>
                                    <option value="40" '.($rec_sconti['sconto']==40?'selected="selected"':'').'>40%</option>
                                    <option value="45" '.($rec_sconti['sconto']==45?'selected="selected"':'').'>45%</option>
                                    <option value="50" '.($rec_sconti['sconto']==50?'selected="selected"':'').'>50%</option>';

                // Query e ciclo per estrapolare i pacchetti
                $selePacchetti = "  SELECT 
                                        hospitality_tipo_pacchetto_lingua.* 
                                    FROM 
                                        hospitality_tipo_pacchetto_lingua
                                    INNER JOIN 
                                        hospitality_tipo_pacchetto 
                                    ON 
                                        hospitality_tipo_pacchetto.Id = hospitality_tipo_pacchetto_lingua.pacchetto_id
                                    WHERE 
                                        hospitality_tipo_pacchetto_lingua.lingue = '".$Lingua."'
                                    AND 
                                        hospitality_tipo_pacchetto.Abilitato = 1
                                    AND 
                                        hospitality_tipo_pacchetto_lingua.idsito = ".IDSITO."
                                    ORDER BY 
                                        hospitality_tipo_pacchetto_lingua.Pacchetto ASC";
                $row = $dbMysqli->query($selePacchetti);

                $ListaPacchetti .='<option value="">scegli</option>';
                foreach($row as $chiave => $valore){
                    $ListaPacchetti .='<option value="'.$valore['Pacchetto'].'" '.($NomeProposta==$valore['Pacchetto']?'selected="selected"':'').' data-id="'.$valore['Id'].'">'.$valore['Pacchetto'].'</option>';
                }

               $seletariffe ="  SELECT 
                                    hospitality_condizioni_tariffe_lingua.* 
                                FROM 
                                    hospitality_condizioni_tariffe_lingua
                                INNER JOIN 
                                    hospitality_condizioni_tariffe 
                                ON 
                                    hospitality_condizioni_tariffe.id = hospitality_condizioni_tariffe_lingua.id_tariffe
                                WHERE 
                                    hospitality_condizioni_tariffe_lingua.Lingua = '".$Lingua."'
                                AND
                                    hospitality_condizioni_tariffe.idsito = ".IDSITO."
                                ORDER BY 
                                    hospitality_condizioni_tariffe_lingua.tariffa ASC";
                $row = $dbMysqli->query($seletariffe);

                $ListaTariffe .='<option value="">scegli</option>';
                foreach($row as $chiave => $valore){
                    $ListaTariffe .='<option value="'.$valore['tariffa'].'" '.($AccontoTariffa==$valore['tariffa']?'selected="selected"':'').' data-id="'.$valore['id'].'" >'.$valore['tariffa'].'</option>';
                }

               $proposte .='  <div class="accordion-panel card card-block  m-t-30">                                                                                                                                                
                                    <a class="f-16 f-w-600 text-black checkCaret" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'" aria-expanded="true" aria-controls="collapseOne">
                                        '.$i.'° PROPOSTA
                                        <i class="fa fa-caret-up fa-2x fa-fw f-right"></i>
                                    </a> 
                                    <div id="collapse'.$i.'" class="panel-collapse collapse in show" role="tabpanel">                                       
                                        <input type="hidden" value="'.$Id_riga .'" name="id_proposta'.$i.'">
                                            <div class="Check'.$i.'" style="display:none">
                                                <label for="CheckProposta"> Seleziona Proposta</label>
                                                <div class="form-group">
                                                    <input type="checkbox"  value="1" name="CheckProposta'.$i.'" onclick="check(this);" class="controllo" id="CheckProposta_'.$i.'"  '.($CheckProposta ==1?'checked':'').'>
                                                </div>
                                            </div>';
                    if($TipoRichiesta=='Preventivo'){
                            if($fun->check_simplebooking(IDSITO)==1){
                                 $proposte  .=    '<div class="row m-t-10">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4 text-center">
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_booking'.$i.'">Apri SimpleBooking</button>  
                                                        </div>
                                                    </div>
                                                    <div id="wait'.$i.'"></div>';
                            }
                            if($fun->check_ericsoftbooking(IDSITO)==1){
                                $proposte  .=    '  <div class="row m-t-10">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4 text-center">                               
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#input_ericsoft_booking'.$i.'>">Apri EricSoftBooking</button>                                                         
                                                        </div>
                                                    </div>
                                                    <div id="wait'.$i.'E"></div>';
                           }
                            if($fun->check_bedzzlebooking(IDSITO)==1){
                                $proposte  .=    '  <div class="row m-t-10">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4 text-center">                               
                                                            <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#input_bedzzle_booking'.$i.'">Apri BedzzleBooking</button>                                                         
                                                        </div>
                                                    </div>
                                                    <div id="wait'.$i.'Bedzzle"></div>';
                            }   
                    }
                    if($Id_riga!='' && $i>1){
                                $proposte .=' <div class="row m-t-20">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4 text-right"> 
                                                        <script>
                                                            $( document ).ready(function() {

                                                                $(\'[data-toogle="tooltip"]\').tooltip();

                                                                $("#del_prop'.$Id_riga.'").click(function(){
                                                                    var idproposta = '.$Id_riga.';
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "'.BASE_URL_SITO.'ajax/del_proposta.php",
                                                                        data: "idproposta=" + idproposta,
                                                                        dataType: "html",
                                                                        success: function(data){
                                                                            $("div#ris_prop'.$i.'").html(\'<div class="alert alert-danger alert-dismissable">ATTENZIONE: la '.$i.'° proposta è stata svuotata attendere il reload della pagina!</div>\');
                                                                                setTimeout(function(){
                                                                                    location.reload();
                                                                                },3000);
                                                                        },
                                                                        error: function(){
                                                                            alert("Chiamata fallita, si prega di riprovare...");
                                                                        }
                                                                    });
                                                                });
                                                            });
                                                            </script>
                                                            <a href="javascript:;" id="del_prop'.$Id_riga.'" title="Svuota questa Proposta" data-toogle="tooltip">Svuota proposta <i  class="fa fa-remove text-red"></i></a>
                                                        </div>
                                                </div>';
                    }                           
                            
                           
                                $proposte  .=    '        
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Data di Arrivo</b> (alternativa)</label>
                                                                            <input type="date" name="DataArrivo'.$i.'" id="DataArrivo_'.$i.'" class="form-control" value="'.$Arrivo.'">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Data di Partenza</b> (alternativa)</label>
                                                                            <input type="date" name="DataPartenza'.$i.'" id="DataPartenza_'.$i.'" class="form-control" value="'.$Partenza.'">
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>                                                                               
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-8"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Nome proposta o del pacchetto</b></label>
                                                                                <select name="NomeProposta'.$i.'" id="NomeProposta_'.$i.'" class="form-control">
                                                                                    '.$ListaPacchetti.'
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-8"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Descrizione proposta o del pacchetto</b></label>
                                                                                <textarea class="form-control" name="TestoProposta'.$i.'" id="TestoProposta_'.$i.'" rows="3" placeholder="Non è obbligatoria la compilazione di questo campo, ma offre qualche informazione in più per la proposta">'.$TestoProposta.'</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                             if($TipoRichiesta=='Preventivo'){
                                                if($fun->check_simplebooking(IDSITO)==1){
                                                   $proposte  .=    ' <div id="simple'.$i.'"></div>';
                                                }
                                                if($fun->check_ericsoftbooking(IDSITO)==1){
                                                    $proposte  .=    '<div id="simple'.$i.'E"></div>';
                                                }
                                                if($fun->check_bedzzlebooking(IDSITO)==1){
                                                    $proposte  .=    '<div id="wait'.$i.'Bedzzle"></div>';
                                                }
                                            }

                            $proposte  .=    '  <div id="risultato_del'.$i.'"></div>
                                                <div id="ris_prop'.$i.'"></div>
                                                    <table class="table no-border-top no-border-bottom">';

                           $select2 = "SELECT hospitality_richiesta.Id as idRichiesta,
                                                hospitality_richiesta.TipoSoggiorno,
                                                hospitality_richiesta.NumAdulti,
                                                hospitality_richiesta.NumBambini,
                                                hospitality_richiesta.EtaB,
                                                hospitality_richiesta.NumeroCamere,
                                                hospitality_richiesta.Prezzo,
                                                hospitality_tipo_camere.Id as id_camere,
                                                hospitality_tipo_camere.TipoCamere
                                        FROM 
                                            hospitality_richiesta
                                        INNER JOIN 
                                            hospitality_tipo_camere 
                                        ON 
                                            hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                                        WHERE 
                                            hospitality_richiesta.id_proposta = ".$Id_riga." 
                                        AND  
                                            hospitality_richiesta.id_richiesta = ".$Id." 
                                        ORDER BY 
                                            hospitality_richiesta.Id ASC "  ;
                                    $res2  = $dbMysqli->query($select2);

                                $num_righe = 1;
                                foreach ($res2 as $ky => $val) {


                                            $proposte  .= '<tr>
                                                            <td class="td25 no-border-top">
                                                                <div class="td25 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_'.$i.'_'.$num_righe.'"></div>
                                                                    <div class="form-group">
                                                                    '.($ky==0?'<label class="control-label"><b>Tipo Soggiorno</b></label>':'').'
                                                                        <input type="hidden" value="'.$val['idRichiesta'] .'" name="idrichiesta'.$i.'[]">
                                                                                    <select name="TipoSoggiorno'.$i.'[]" id="TipoSoggiorno_'.$i.'_'.$num_righe.'" class="form-control">';
                                                                                        // Query e ciclo per estrapolare i dati di tipologia soggiorno
                                                                                        $selSOgg =" SELECT 
                                                                                                        * 
                                                                                                    FROM 
                                                                                                        hospitality_tipo_soggiorno 
                                                                                                    WHERE 
                                                                                                        Lingua = 'it' 
                                                                                                    AND 
                                                                                                        Abilitato = 1 
                                                                                                    AND 
                                                                                                        idsito = ".IDSITO." 
                                                                                                    ORDER BY 
                                                                                                        TipoSoggiorno ASC";
                                                                                        $row = $dbMysqli->query($selSOgg);

                                                                                        $ListaSoggiorno  = '';
                                                                                        if($val['TipoSoggiorno']==''){
                                                                                            $proposte .='<option value="" selected="selected">scegli</option>';
                                                                                        }
                                                                                        foreach($row as $chiave => $valore){
                                                                                            $proposte .='<option value="'.$valore['Id'].'" '.($val['TipoSoggiorno']==$valore['Id']?'selected="selected"':'').'>'.$fun->mini_clean($valore['TipoSoggiorno']).'</option>';
                                                                                        }
                                            $proposte  .= '                        </select>
                                                                        </div>
                                                                </td>
                                                                <td class="td25 no-border-top">
                                                                    <div class="form-group">
                                                                    '.($ky==0?'<label class="control-label"><b>Tipo Camera</b></label>':'').'
                                                                        <input type="hidden" name="NumeroCamere'.$i.'[]" id="NumeroCamere_'.$i.'_1" value="1">
                                                                                <select name="TipoCamere'.$i.'[]"  id="TipoCamere_'.$i.'_'.$num_righe.'" class="'.$stile_chosen.'form-control" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0  && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onfocus="get_listino('.$i.','.$num_righe.');"':''):'').'>';
                                                                                    $selCam = " SELECT 
                                                                                                    * 
                                                                                                FROM 
                                                                                                    hospitality_tipo_camere 
                                                                                                WHERE  
                                                                                                    Abilitato = 1 
                                                                                                AND 
                                                                                                    idsito = ".IDSITO." 
                                                                                                ORDER BY 
                                                                                                    Ordine ASC";
                                                                                    $rw = $dbMysqli->query($selCam);

                                                                                    $ListaCamere = '';
                                                                                    if($val['id_camere']==''){
                                                                                        $proposte .='<option value="" selected="selected">scegli</option>';
                                                                                    }
                                                                                    foreach($rw as $key => $v){
                                                                                        $proposte  .='<option value="'.$v['Id'].'" '.($v['Id']==$val['id_camere']?'selected="selected"':'').'>'.$v['TipoCamere'].'</option>';
                                                                                    }
                                            $proposte  .= '                    </select>
                                                                    </div>
                                                                </td>
                                                                <td class="td10 no-border-top">
                                                                    <div class="form-group">
                                                                    '.($ky==0?'<label class="control-label"><b>Adulti</b></label>':'').'
                                                                                <select name="NumAdulti'.$i.'[]" id="NumeroAdulti_'.$i.'_'.$num_righe.'"
                                                                                    class="form-control"  '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0  && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onfocus="get_listino('.$i.','.$num_righe.');"':''):'').'>
                                                                                    <option value="" '.($val['NumAdulti']==''?'selected="selected"':'').'>scegli</option>
                                                                                    <option value="1" '.(1==$val['NumAdulti']?'selected="selected"':'').'>1</option>
                                                                                    <option value="2" '.(2==$val['NumAdulti']?'selected="selected"':'').'>2</option>
                                                                                    <option value="3" '.(3==$val['NumAdulti']?'selected="selected"':'').'>3</option>
                                                                                    <option value="4" '.(4==$val['NumAdulti']?'selected="selected"':'').'>4</option>
                                                                                    <option value="5" '.(5==$val['NumAdulti']?'selected="selected"':'').'>5</option>
                                                                                    <option value="6" '.(6==$val['NumAdulti']?'selected="selected"':'').'>6</option>
                                                                                    <option value="7" '.(7==$val['NumAdulti']?'selected="selected"':'').'>7</option>
                                                                                    <option value="8" '.(8==$val['NumAdulti']?'selected="selected"':'').'>8</option>
                                                                                    <option value="9" '.(9==$val['NumAdulti']?'selected="selected"':'').'>9</option>
                                                                                    <option value="10" '.(10==$val['NumAdulti']?'selected="selected"':'').'>10</option>
                                                                                </select>
                                                                    </div>
                                                                </td>
                                                                <td class="td10 no-border-top">
                                                                    <div class="form-group">
                                                                    '.($ky==0?'<label class="control-label"><b>Bambini</b></label>':'').'
                                                                                <select name="NumBambini'.$i.'[]" id="NumeroBambini_'.$i.'_'.$num_righe.'"
                                                                                    class="NumeroBambini_'.$i.'_'.$num_righe.' form-control"  onchange="eta_bimbi(\''.$i.'_'.$num_righe.'\');">
                                                                                    <option value="" '.($val['NumBambini']==''?'selected="selected"':'').'>scegli</option>
                                                                                    <option value="1" '.(1==$val['NumBambini']?'selected="selected"':'').'>1</option>
                                                                                    <option value="2" '.(2==$val['NumBambini']?'selected="selected"':'').'>2</option>
                                                                                    <option value="3" '.(3==$val['NumBambini']?'selected="selected"':'').'>3</option>
                                                                                    <option value="4" '.(4==$val['NumBambini']?'selected="selected"':'').'>4</option>
                                                                                    <option value="5" '.(5==$val['NumBambini']?'selected="selected"':'').'>5</option>
                                                                                    <option value="6" '.(6==$val['NumBambini']?'selected="selected"':'').'>6</option>
                                                                                    <option value="7" '.(7==$val['NumBambini']?'selected="selected"':'').'>7</option>
                                                                                    <option value="8" '.(8==$val['NumBambini']?'selected="selected"':'').'>8</option>
                                                                                    <option value="9" '.(9==$val['NumBambini']?'selected="selected"':'').'>9</option>
                                                                                    <option value="10" '.(10==$val['NumBambini']?'selected="selected"':'').'>10</option>
                                                                                </select>
                                                                                <div class="EtaBambini'.$i.'_'.$num_righe.'" style="'.($val['EtaB']!=''?'display:block':'display:none').'">
                                                                                    <input type="text"  name="EtaB'.$i.'[]" placeholder="Età: 1,2,3" value="'.$val['EtaB'].'" class="form-control">
                                                                                </div>
                                                                    </div>
                                                                </td>
                                                                <td class="td30 no-border-top">
                                                                    <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_'.$i.'_'.$num_righe.'"></div>
                                                                    <div class="form-group">
                                                                    '.($ky==0?'<label class="control-label"><b>Prezzo</b></label>':'').'
                                                                        <div class="input-group">
                                                                            <input type="text" name="Prezzo'.$i.'[]" id="Prezzo_'.$i.'_'.$num_righe.'"
                                                                                        class="prezzo'.$i.' form-control" value="'.$val['Prezzo'].'"
                                                                                        placeholder="Prezzo 0000.00" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0  && $fun->check_bedzzlebooking(IDSITO)==0)?($fun->check_listini(IDSITO)==1?'onfocus="get_listino('.$i.','.$num_righe.');"':''):'').' onkeyup="calcola_totale'.$i.'();">';
                                    if($TipoRichiesta=='Preventivo'){
                                        $proposte  .= '                             <span class="input-group-addon btn bg-green" onclick="room_fields('.$i.',\'righe_room'.($i==1?'':$i).'\');">
                                                                                    <i class="fa fa-plus"></i>
                                                                                    </span>';
                                    }
                                        $proposte  .= '                  </div>  
                                                                    </div>';

                                    if($Chiuso=='0'){
                                                    $proposte  .='  <script>
                                                                    $( document ).ready(function() {
                                                                            $(\'[data-toogle="tooltip"]\').tooltip();

                                                                            $("#del_riga'.$val['idRichiesta'] .'").click(function(){
                                                                                if($(".contax'.$i.'").length===1){
                                                                                    alert(\'ATTENZIONE non è possibile eliminare tutte le righe compilate\');
                                                                                    return;
                                                                                }
                                                                                var idrichiesta = '.$val['idRichiesta'] .';
                                                                                $.ajax({
                                                                                    type: "POST",
                                                                                    url: "'.BASE_URL_SITO.'ajax/del_riga.php",
                                                                                    data: "idrichiesta=" + idrichiesta,
                                                                                    dataType: "html",
                                                                                    success: function(data){
                                                                                        $("div#risultato_del'.$i.'").html(\'<div class="alert alert-danger alert-dismissable">Eliminazione avvenuta! ATTENZIONE: attendere il reload della pagina ed AGGIORNARE il TOTALE del soggiorno!</div>\');
                                                                                            setTimeout(function(){
                                                                                                location.reload();
                                                                                            },3000);
                                                                                    },
                                                                                    error: function(){
                                                                                        alert("Chiamata fallita, si prega di riprovare...");
                                                                                    }
                                                                                });
                                                                            });
                                                                        });
                                                                    </script>
                                                                    <div class="centoPercento fl-right text-right"><i id="del_riga'.$val['idRichiesta'] .'" title="Elimina la riga e aggiorna il prezzo soggiorno" data-toogle="tooltip" class="fa fa-remove text-red contax'.$i.'" style="cursor:pointer"></i></div>';
                                    }                                          
                                        
                                        $proposte  .= '                 
                                                                </td>
                                                            </tr>';
                                    
                                    if($TipoRichiesta=='Preventivo'){
                                        $proposte  .= ' <tr>
                                                            <td colspan="7" class="nopadding no-border-top no-border-bottom">
                                                                <table id="righe_room'.($i==1?'':$i).'" class="nopadding no-border-top no-border-bottom" style="width:100%"></table>
                                                            </td>
                                                        </tr>';
                                    }

                                    $num_righe++;
                                }                           
                                       $proposte  .= '   '.$fun->get_modifica_servizi_aggiuntivi($i,$Id,$Id_riga).'
                                                        </table>';

                                       

                                
                                   
                                        $proposte .='<div class="row m-t-10">
                                                            <div class="col-md-3">
                                                               <!--
                                                                <div class="form-group">
                                                                    <label for="Prezzo"><b>Prezzo Soggiorno <strike>Listino</strike></b></label>
                                                                    <input type="text" onclick="calcola_totale'.$i.'();" name="PrezzoL'.$i.'" id="PrezzoL_'.$i.'" class="form-control" placeholder="0000.00"  value="'.$PrezzoL.'">
                                                                </div>
                                                                -->
                                                                <input type="hidden" onclick="calcola_totale'.$i.'();" name="PrezzoL'.$i.'" id="PrezzoL_'.$i.'" class="form-control" placeholder="0000.00"  value="'.$PrezzoL.'">
                                                                <span id="sconto_P'.$i.'"></span>
                                                            </div>
                                                            <div class="col-md-3"> 
                                                                <div class="form-group">
                                                                    <label class="control-label"><b>Prezzo soggiorno proposto</b></label>
                                                                     <input type="text" onclick="calcola_totale'.$i.'();" name="PrezzoP'.$i.'" id="PrezzoP_'.$i.'" class="form-control" placeholder="0000.00" value="'.$PrezzoP.'">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3"> 
                                                                <div class="form-group">
                                                                    <label class="control-label"><b>Sconto</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate la <b>sincronizzazione con un PMS</b>, una volta applicata la percentuale di sconto <b>non modificate più il Prezzo soggiorno proposto</b>!"></i></label>
                                                                        <select name="SC'.$i.'" id="SC_'.$i.'" class="form-control" >
                                                                            '.$lista_sconti.'
                                                                        </select>
                                                                    <input type="hidden" name="sconto_camere'.$i.'" id="sconto_camere_'.$i.'">
                                                                    <div id="Imponibile_'.$i.'"></div>
                                                                </div> 
                                                                  '.$boxCodiceSconto.'                                                       
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">';
                                                    if($AccontoImporto){
                                                        $proposte .='<label for="acconto_richiesta">Caparra '.($AccontoImporto=='0.1'?'con CC a garanzia ':'ad importo ').'<i class="fa fa-question-circle" data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento!"></i></label>
                                                                        <input type="text" id="AccontoImporto_'.$i.'" name="AccontoImporto'.$i.'" value="'.$AccontoImporto.'" class="form-control" placeholder="000.00">';
                                                    }else{
                                                        $proposte .='<label for="acconto_richiesta">'.((($DataVoucherRecSend != '' && $DataValiditaVoucher != '' && $IdMotivazione != '') && $DataRi == ''  && $TipoRichiesta == 'Conferma')?'Caparra (attuale - precedente) <i class="fa fa-question-circle text-info" data-toggle="tooltip" title="" aria-hidden="true" data-original-title="Inserire nel campo la differenza tra la caparra attuale e la precedente, usare valore ad importo"></i>':'Caparra').'</label>
                                                                    <select  name="AccontoPercentuale'.$i.'" id="AccontoPercentuale_'.$i.'" class="form-control">
                                                                        <option value="" '.($AccontoPercentuale==''?'selected="selected"':'').'>--</option>
                                                                        <option value="importo" '.($Acc=='importo'?'selected="selected"':'').'>importo</option>
                                                                        <option value="garanzia" '.($Acc=='garanzia'?'selected="selected"':'').'>Carta Credito a garanzia</option>
                                                                        <option value="10" '.($AccontoPercentuale=='10'?'selected="selected"':'').'>10%</option>
                                                                        <option value="15" '.($AccontoPercentuale=='15'?'selected="selected"':'').'>15%</option>
                                                                        <option value="20" '.($AccontoPercentuale=='20'?'selected="selected"':'').'>20%</option>
                                                                        <option value="25" '.($AccontoPercentuale=='25'?'selected="selected"':'').'>25%</option>
                                                                        <option value="30" '.($AccontoPercentuale=='30'?'selected="selected"':'').'>30%</option>
                                                                        <option value="40" '.($AccontoPercentuale=='40'?'selected="selected"':'').'>40%</option>
                                                                        <option value="50" '.($AccontoPercentuale=='50'?'selected="selected"':'').'>50%</option>
                                                                        <option value="60" '.($AccontoPercentuale=='60'?'selected="selected"':'').'>60%</option>
                                                                        <option value="70" '.($AccontoPercentuale=='70'?'selected="selected"':'').'>70%</option>
                                                                        <option value="80" '.($AccontoPercentuale=='80'?'selected="selected"':'').'>80%</option>
                                                                        <option value="90" '.($AccontoPercentuale=='90'?'selected="selected"':'').'>90%</option>
                                                                        <option value="100" '.($AccontoPercentuale=='100'?'selected="selected"':'').'>100%</option>
                                                                    </select>
                                                                    <div id="acconto_l'.$i.'"></div>';
                                                        if(($DataVoucherRecSend != '' && $DataValiditaVoucher != '' && $IdMotivazione != '') && $DataRi == '' && $TipoRichiesta == 'Conferma'){

                                                            $proposte .=' <div style="clear:both;"></div>
                                                                            <label for="precedente">Caparra precedente</label>
                                                                            <input type="text" name="AccontoPrecedente" id="AccontoPrecedente_1" class="form-control" value="'.output_acconto($Id).'" >';
                                                        }
                                                    }

                                $proposte .='               </div>
                                                        </div> 
                                                    </div>                 
                                                        <div class="row m-t-10">
                                                            <div class="col-md-8"> 
                                                                <div class="form-group">
                                                                    <label class="control-label"><b>Tipologia tariffa</b></label>
                                                                        <select id="EtichettaTariffa_'.$i.'" name="EtichettaTariffa'.$i.'" class="form-control">
                                                                            '.$ListaTariffe.'
                                                                        </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-t-10">
                                                            <div class="col-md-8"> 
                                                                <div class="form-group">
                                                                    <label class="control-label"><b>Condizioni e politiche di cancellazione per tariffa</b></label>
                                                                      <textarea rows="3" name="AccontoTesto'.$i.'" id="AccontoTesto_'.$i.'" class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!">'.$AccontoTesto.'</textarea>
                                                                </div>
                                                            </div>
                                                        </div>';


                                $proposte .='</div>
                                        </div>';

            $i++;

        }
        if($TipoRichiesta=='Conferma'){
           $proposte .='<!-- id utile alla compilazione della conferma automatica dei prezzi camere in ajax --><div id="valori"></div>';
        }

        $ListaPacchetti = '';
        $ListaTariffe   = '';
}
        $ListaPacchetti = '';
        $ListaTariffe   = '';


#### SALVATAGGIO DELLA MODIFICA #####

if($_REQUEST['action']=='modify'){


    if($_REQUEST['id_testo_alternativo']==''){

            $in ="INSERT INTO hospitality_contenuti_web_lingua(
                                                                    idsito,
                                                                    IdRichiesta,
                                                                    Lingua,
                                                                    Testo)
                                                                VALUES (
                                                                    '".$_REQUEST['idsito']."',
                                                                    '".$_REQUEST['Id']."',
                                                                    '".$_REQUEST['Lingua']."',
                                                                    '".addslashes($_REQUEST['Testo'])."')";

            $dbMysqli->query($in);
    }else{

            $up ="UPDATE hospitality_contenuti_web_lingua SET Testo = '".addslashes($_REQUEST['Testo'])."' WHERE Id =  ".$_REQUEST['id_testo_alternativo'];

            $dbMysqli->query($up);
    }



    if($_REQUEST['PrezzoL1'] == $_REQUEST['PrezzoP1']) {
        $_REQUEST['PrezzoL1'] = 0;
    }
    if($_REQUEST['PrezzoL2'] == $_REQUEST['PrezzoP2']) {
        $_REQUEST['PrezzoL2'] = 0;
    }
    if($_REQUEST['PrezzoL3'] == $_REQUEST['PrezzoP3']) {
        $_REQUEST['PrezzoL3'] = 0;
    }
    if($_REQUEST['PrezzoL4'] == $_REQUEST['PrezzoP4']) {
        $_REQUEST['PrezzoL4'] = 0;
    }
    if($_REQUEST['PrezzoL5'] == $_REQUEST['PrezzoP5']) {
        $_REQUEST['PrezzoL5'] = 0;
    }

    $select = "SELECT * FROM hospitality_guest WHERE Id = ".$_REQUEST['Id'];
    $result = $dbMysqli->query($select);
    $rw = $result[0];

    $TipoRichiesta = $rw['TipoRichiesta'];
    $Chiuso        = $rw['Chiuso'];
    

    $DataArrivo   = $_REQUEST['DataArrivo'];
    $DataPartenza = $_REQUEST['DataPartenza'];
    $DataScadenza = $_REQUEST['DataScadenza'];

    $CC           = $_REQUEST['CC'];
    $BB           = $_REQUEST['BB'];
    $VP           = $_REQUEST['VP'];
    $PP           = $_REQUEST['PP'];
    $GB           = $_REQUEST['GB'];
    $GBVP         = $_REQUEST['GBVP'];
    $GBS          = $_REQUEST['GBS'];
    $linkStripe   = $_REQUEST['linkStripe'];
    $GBNX         = $_REQUEST['GBNX'];


    if($_REQUEST['TipoRichiesta']=='Conferma' && $TipoRichiesta == 'Preventivo'){

            $ins_template = "INSERT INTO hospitality_template_link_landing(id_richiesta,id_template,idsito) VALUES ('".$IdRichiesta."','".$_REQUEST['id_template']."','".$_REQUEST['idsito']."')";
            $dbMysqli->query($ins_template);

            if($_REQUEST['DataRiconferma']!=''){               
                $datariconferma  = $_REQUEST['DataRiconferma'].',';
                $camporiconferma = 'DataRiconferma,';
            }else{
                $datariconferma  = "";
                $camporiconferma = "";
            }

            // query di inserimento
            $insert = "INSERT INTO hospitality_guest(id_politiche,
                                                    id_template,
                                                    AccontoRichiesta,
                                                    AccontoLibero,
                                                    DataRichiesta,
                                                    TipoRichiesta,
                                                    TipoVacanza,
                                                    ChiPrenota,
                                                    EmailSegretaria,
                                                    idsito,
                                                    MultiStruttura,
                                                    Nome,
                                                    Cognome,
                                                    Email,
                                                    PrefissoInternazionale,
                                                    Cellulare,
                                                    DataNascita,
                                                    Lingua,
                                                    DataArrivo,
                                                    DataPartenza,
                                                    NumeroPrenotazione,
                                                    NumeroAdulti,
                                                    NumeroBambini,
                                                    EtaBambini1,
                                                    EtaBambini2,
                                                    EtaBambini3,
                                                    EtaBambini4,
                                                    EtaBambini5,
                                                    EtaBambini6,
                                                    FontePrenotazione,
                                                    TipoPagamento,
                                                    DataScadenza,
                                                    Note,
                                                    ".$camporiconferma."
                                                    AbilitaInvio
                                                    ) VALUES (
                                                    '".$_REQUEST['id_politiche']."',
                                                    '".$_REQUEST['id_template']."',
                                                    '".$_REQUEST['acconto_richiesta']."',
                                                    '".$_REQUEST['acconto_libero']."',
                                                    '".$_REQUEST['DataRichiesta']."',
                                                    '".$_REQUEST['TipoRichiesta']."',
                                                    '".$_REQUEST['TipoVacanza']."',
                                                    '".addslashes($_REQUEST['ChiPrenota'])."',
                                                    '".$_REQUEST['EmailSegretaria']."',
                                                    '".$_REQUEST['idsito']."',
                                                    '".addslashes($_REQUEST['MultiStruttura'])."',
                                                    '".addslashes(ucfirst($_REQUEST['Nome']))."',
                                                    '".addslashes(ucfirst($_REQUEST['Cognome']))."',
                                                    '".$_REQUEST['Email']."',
                                                    '".$_REQUEST['PrefissoInternazionale']."',
                                                    '".$_REQUEST['Cellulare']."',
                                                    '".$DataNascita."',
                                                    '".$_REQUEST['Lingua']."',
                                                    '".$DataArrivo."',
                                                    '".$DataPartenza."',
                                                    '".$_REQUEST['NumeroPrenotazione']."',
                                                    '".$_REQUEST['NumeroAdulti']."',
                                                    '".$_REQUEST['NumeroBambini']."',
                                                    '".$_REQUEST['EtaBambini1']."',
                                                    '".$_REQUEST['EtaBambini2']."',
                                                    '".$_REQUEST['EtaBambini3']."',
                                                    '".$_REQUEST['EtaBambini4']."',
                                                    '".$_REQUEST['EtaBambini5']."',
                                                    '".$_REQUEST['EtaBambini6']."',
                                                    '".$_REQUEST['FontePrenotazione']."',
                                                    '".$_REQUEST['TipoPagamento']."',
                                                    '".$DataScadenza."',
                                                    '".addslashes($_REQUEST['Note'])."',
                                                    '".$datariconferma."'
                                                    '".$_REQUEST['AbilitaInvio']."')";
            $result = $dbMysqli->query($insert);

            $IdRichiesta = $dbMysqli->getInsertId($result);

            /**
                * * inserire le scelate dei tipi di pagamento
                */
            $ins_pag = "INSERT INTO hospitality_rel_pagamenti_preventivi(idsito,id_richiesta,CC,BB,VP,PP,GB,GBVP,GBS,linkStripe,GBNX) VALUES ('".$_REQUEST['idsito']."','".$IdRichiesta."','".$CC."','".$BB."','".$VP."','".$PP."','".$GB."','".$GBVP."','".$GBS."','".$linkStripe."','".$GBNX."')";
            $dbMysqli->query($ins_pag);

            // se la prima proposta è compilata
            if($_REQUEST['CheckProposta1']!=''){

            $DataArrivo1         = $_REQUEST['DataArrivo1'];
            $DataPartenza1       = $_REQUEST['DataPartenza1'];


                $insertP1 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                    Arrivo,
                                                    Partenza,
                                                    NomeProposta,
                                                    TestoProposta,
                                                    CheckProposta,
                                                    PrezzoL,
                                                    PrezzoP,
                                                    AccontoPercentuale,
                                                    AccontoImporto,
                                                    AccontoTariffa,
                                                    AccontoTesto
                                                    ) VALUES (
                                                    '".$IdRichiesta."',
                                                    '".$DataArrivo1."',
                                                    '".$DataPartenza1."',
                                                    '".addslashes($_REQUEST['NomeProposta1'])."',
                                                    '".addslashes($_REQUEST['TestoProposta1'])."',
                                                    '".$_REQUEST['CheckProposta1']."',
                                                    '".$_REQUEST['PrezzoL1']."',
                                                    '".$_REQUEST['PrezzoP1']."',
                                                    '".$_REQUEST['AccontoPercentuale1']."',
                                                    '".$_REQUEST['AccontoImporto1']."',
                                                    '".addslashes($_REQUEST['EtichettaTariffa1'])."',
                                                    '".addslashes($_REQUEST['AccontoTesto1'])."')";
            $resultP1   = $dbMysqli->query($insertP1);
            $IdProposta = $dbMysqli->getInsertId($resultP1);


                if($_REQUEST['PrezzoServizio1'] != '') {
                  
                    foreach($_REQUEST['PrezzoServizio1'] as $key => $value){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$key."','".$_REQUEST['num_persone_1_'.$key]."','".$_REQUEST['notti1_'.$key]."')");
                    }
                } 
                if($_REQUEST['VisibileServizio1'] != '') {
                    foreach($_REQUEST['VisibileServizio1'] as $key => $value){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$key."','".$value."')");
                    }
                }
                ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$_REQUEST['SC5']."')");                     

                $n_camere = count($_REQUEST['TipoCamere1']);
                    for($i=0; $i<=($n_camere-1); $i++){
                        $insertR1 = "INSERT INTO hospitality_richiesta(id_richiesta,
                                                            id_proposta,
                                                            TipoSoggiorno,
                                                            NumeroCamere,
                                                            TipoCamere,
                                                            NumAdulti,
                                                            NumBambini,
                                                            EtaB,
                                                            Prezzo
                                                            ) VALUES (
                                                            '".$IdRichiesta."',
                                                            '".$IdProposta."',
                                                            '".$_REQUEST['TipoSoggiorno1'][$i]."',
                                                            '1',
                                                            '".$_REQUEST['TipoCamere1'][$i]."',
                                                            '".$_REQUEST['NumAdulti1'][$i]."',
                                                            '".$_REQUEST['NumBambini1'][$i]."',
                                                            '".$_REQUEST['EtaB1'][$i]."',
                                                            '".$_REQUEST['Prezzo1'][$i]."')";
                        $dbMysqli->query($insertR1);
                

                    }// fine cilo for delle camere
          


            }
            // se la seconda proposta è compilata
            if($_REQUEST['CheckProposta2']!=''){

            $DataArrivo2         = $_REQUEST['DataArrivo2'];
            $DataPartenza2       = $_REQUEST['DataPartenza2'];

                $insertP2 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                    Arrivo,
                                                    Partenza,
                                                    NomeProposta,
                                                    TestoProposta,
                                                    CheckProposta,
                                                    PrezzoL,
                                                    PrezzoP,
                                                    AccontoPercentuale,
                                                    AccontoImporto,
                                                    AccontoTariffa,
                                                    AccontoTesto
                                                    ) VALUES (
                                                    '".$IdRichiesta."',
                                                    '".$DataArrivo2."',
                                                    '".$DataPartenza2."',
                                                    '".addslashes($_REQUEST['NomeProposta2'])."',
                                                    '".addslashes($_REQUEST['TestoProposta2'])."',
                                                    '".$_REQUEST['CheckProposta2']."',
                                                    '".$_REQUEST['PrezzoL2']."',
                                                    '".$_REQUEST['PrezzoP2']."',
                                                    '".$_REQUEST['AccontoPercentuale2']."',
                                                    '".$_REQUEST['AccontoImporto2']."',
                                                    '".addslashes($_REQUEST['EtichettaTariffa2'])."',
                                                    '".addslashes($_REQUEST['AccontoTesto2'])."')";
                $resultP2    = $dbMysqli->query($insertP2);
                $IdProposta2 = $dbMysqli->getInsertId($resultP2);

                if($_REQUEST['PrezzoServizio2'] != '') {
                   
                    foreach($_REQUEST['PrezzoServizio2'] as $key2 => $value2){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta2."','".$key2."','".$_REQUEST['num_persone_2_'.$key2]."','".$_REQUEST['notti2_'.$key2]."')");
                    }
                }
                if($_REQUEST['VisibileServizio2'] != '') {
                    foreach($_REQUEST['VisibileServizio2'] as $key2 => $value2){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta2."','".$key2."','".$value2."')");
                    }
                }
                ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta2."','".$_REQUEST['SC2']."')");    
               
                    $n_camere2 = count($_REQUEST['TipoCamere2']);
                    for($i=0; $i<=($n_camere2-1); $i++){
                        $insertR2 = "INSERT INTO hospitality_richiesta(id_richiesta,
                                                            id_proposta,
                                                            TipoSoggiorno,
                                                            NumeroCamere,
                                                            TipoCamere,
                                                            NumAdulti,
                                                            NumBambini,
                                                            EtaB,
                                                            Prezzo
                                                            ) VALUES (
                                                            '".$IdRichiesta."',
                                                            '".$IdProposta2."',
                                                            '".$_REQUEST['TipoSoggiorno2'][$i]."',
                                                            '1',
                                                            '".$_REQUEST['TipoCamere2'][$i]."',
                                                            '".$_REQUEST['NumAdulti2'][$i]."',
                                                            '".$_REQUEST['NumBambini2'][$i]."',
                                                            '".$_REQUEST['EtaB2'][$i]."',
                                                            '".$_REQUEST['Prezzo2'][$i]."')";

                        $dbMysqli->query($insertR2);
                    

                    }// fine ciclo for delle camere

                   


            }
            // se la terza proposta è compilata
            if($_REQUEST['CheckProposta3']!=''){

            $DataArrivo3         = $_REQUEST['DataArrivo3'];
            $DataPartenza3       = $_REQUEST['DataPartenza3'];

                $insertP3 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                    Arrivo,
                                                    Partenza,
                                                    NomeProposta,
                                                    TestoProposta,
                                                    CheckProposta,
                                                    PrezzoL,
                                                    PrezzoP,
                                                    AccontoPercentuale,
                                                    AccontoImporto,
                                                    AccontoTariffa,
                                                    AccontoTesto
                                                    ) VALUES (
                                                    '".$IdRichiesta."',
                                                    '".$DataArrivo3."',
                                                    '".$DataPartenza3."',
                                                    '".addslashes($_REQUEST['NomeProposta3'])."',
                                                    '".addslashes($_REQUEST['TestoProposta3'])."',
                                                    '".$_REQUEST['CheckProposta3']."',
                                                    '".$_REQUEST['PrezzoL3']."',
                                                    '".$_REQUEST['PrezzoP3']."',
                                                    '".$_REQUEST['AccontoPercentuale3']."',
                                                    '".$_REQUEST['AccontoImporto3']."',
                                                    '".addslashes($_REQUEST['EtichettaTariffa3'])."',
                                                    '".addslashes($_REQUEST['AccontoTesto3'])."')";

                $resultP3    = $dbMysqli->query($insertP3);
                $IdProposta3 = $dbMysqli->getInsertId($resultP3);

                if($_REQUEST['PrezzoServizio3'] != '') {
                   
                    foreach($_REQUEST['PrezzoServizio3'] as $key3 => $value3){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta3."','".$key3."','".$_REQUEST['num_persone_3_'.$key3]."','".$_REQUEST['notti3_'.$key3]."')");
                    }
                }
                if($_REQUEST['VisibileServizio3'] != '') {
                    foreach($_REQUEST['VisibileServizio3'] as $key3 => $value3){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta3."','".$key3."','".$value3."')");
                    }
                }
                ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta3."','".$_REQUEST['SC3']."')");    
               
                    $n_camere3 = count($_REQUEST['TipoCamere3']);
                    for($i=0; $i<=($n_camere3-1); $i++){
                        $insertR3 = "INSERT INTO hospitality_richiesta(id_richiesta,
                                                            id_proposta,
                                                            TipoSoggiorno,
                                                            NumeroCamere,
                                                            TipoCamere,
                                                            NumAdulti,
                                                            NumBambini,
                                                            EtaB,
                                                            Prezzo
                                                            ) VALUES (
                                                            '".$IdRichiesta."',
                                                            '".$IdProposta3."',
                                                            '".$_REQUEST['TipoSoggiorno3'][$i]."',
                                                            '1',
                                                            '".$_REQUEST['TipoCamere3'][$i]."',
                                                            '".$_REQUEST['NumAdulti3'][$i]."',
                                                            '".$_REQUEST['NumBambini3'][$i]."',
                                                            '".$_REQUEST['EtaB3'][$i]."',
                                                            '".$_REQUEST['Prezzo3'][$i]."')";
                        $dbMysqli->query($insertR3);
                                        
                    

                }// fine ciclo for delle camere

             

            }

            // se la 4 proposta è compilata
            if($_REQUEST['CheckProposta4']!=''){

            $DataArrivo4         = $_REQUEST['DataArrivo4'];
            $DataPartenza4       = $_REQUEST['DataPartenza4'];

                $insertP4 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                    Arrivo,
                                                    Partenza,
                                                    NomeProposta,
                                                    TestoProposta,
                                                    CheckProposta,
                                                    PrezzoL,
                                                    PrezzoP,
                                                    AccontoPercentuale,
                                                    AccontoImporto,
                                                    AccontoTariffa,
                                                    AccontoTesto
                                                    ) VALUES (
                                                    '".$IdRichiesta."',
                                                    '".$DataArrivo4."',
                                                    '".$DataPartenza4."',
                                                    '".addslashes($_REQUEST['NomeProposta4'])."',
                                                    '".addslashes($_REQUEST['TestoProposta4'])."',
                                                    '".$_REQUEST['CheckProposta4']."',
                                                    '".$_REQUEST['PrezzoL4']."',
                                                    '".$_REQUEST['PrezzoP4']."',
                                                    '".$_REQUEST['AccontoPercentuale4']."',
                                                    '".$_REQUEST['AccontoImporto4']."',
                                                    '".addslashes($_REQUEST['EtichettaTariffa4'])."',
                                                    '".addslashes($_REQUEST['AccontoTesto4'])."')";

                $resultP4    = $dbMysqli->query($insertP4);
                $IdProposta4 = $dbMysqli->getInsertId($resultP4);

                if($_REQUEST['PrezzoServizio4'] != '') {
                   
                    foreach($_REQUEST['PrezzoServizio4'] as $key4 => $value4){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta4."','".$key4."','".$_REQUEST['num_persone_4_'.$key4]."','".$_REQUEST['notti4_'.$key4]."')");
                    }
                }
                if($_REQUEST['VisibileServizio4'] != '') {
                    foreach($_REQUEST['VisibileServizio4'] as $key4 => $value4){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta4."','".$key4."','".$value4."')");
                    }
                }
                ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta4."','".$_REQUEST['SC4']."')");    
               
                    $n_camere4 = count($_REQUEST['TipoCamere4']);
                    for($i=0; $i<=($n_camere4-1); $i++){
                        $insertR4 = "INSERT INTO hospitality_richiesta(id_richiesta,
                                                            id_proposta,
                                                            TipoSoggiorno,
                                                            NumeroCamere,
                                                            TipoCamere,
                                                            NumAdulti,
                                                            NumBambini,
                                                            EtaB,
                                                            Prezzo
                                                            ) VALUES (
                                                            '".$IdRichiesta."',
                                                            '".$IdProposta4."',
                                                            '".$_REQUEST['TipoSoggiorno4'][$i]."',
                                                            '1',
                                                            '".$_REQUEST['TipoCamere4'][$i]."',
                                                            '".$_REQUEST['NumAdulti4'][$i]."',
                                                            '".$_REQUEST['NumBambini4'][$i]."',
                                                            '".$_REQUEST['EtaB4'][$i]."',
                                                            '".$_REQUEST['Prezzo4'][$i]."')";
                        $dbMysqli->query($insertR4);
                


                    }// fine ciclo for delle camere

            
                   

            }

            // se la 5 proposta è compilata
            if($_REQUEST['CheckProposta5']!=''){

                $DataArrivo5         = $_REQUEST['DataArrivo5'];
                $DataPartenza5       = $_REQUEST['DataPartenza5'];

                $insertP5 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                    Arrivo,
                                                    Partenza,
                                                    NomeProposta,
                                                    TestoProposta,
                                                    CheckProposta,
                                                    PrezzoL,
                                                    PrezzoP,
                                                    AccontoPercentuale,
                                                    AccontoImporto,
                                                    AccontoTariffa,
                                                    AccontoTesto
                                                    ) VALUES (
                                                    '".$IdRichiesta."',
                                                    '".$DataArrivo5."',
                                                    '".$DataPartenza5."',
                                                    '".addslashes($_REQUEST['NomeProposta5'])."',
                                                    '".addslashes($_REQUEST['TestoProposta5'])."',
                                                    '".$_REQUEST['CheckProposta5']."',
                                                    '".$_REQUEST['PrezzoL5']."',
                                                    '".$_REQUEST['PrezzoP5']."',
                                                    '".$_REQUEST['AccontoPercentuale5']."',
                                                    '".$_REQUEST['AccontoImporto5']."',
                                                    '".addslashes($_REQUEST['EtichettaTariffa5'])."',
                                                    '".addslashes($_REQUEST['AccontoTesto5'])."')";
                $resultP5    = $dbMysqli->query($insertP5);
                $IdProposta5 = $dbMysqli->getInsertId($resultP5);

                if($_REQUEST['PrezzoServizio5'] != '') {
                    
                    foreach($_REQUEST['PrezzoServizio5'] as $key5 => $value5){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta5."','".$key5."','".$_REQUEST['num_persone_5_'.$key5]."','".$_REQUEST['notti5_'.$key5]."')");
                    }
                } 
                if($_REQUEST['VisibileServizio5'] != '') {
                    foreach($_REQUEST['VisibileServizio5'] as $key5 => $value5){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta5."','".$key5."','".$value5."')");
                    }
                }
                ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta5."','".$_REQUEST['SC5']."')");                        
             
                    $n_camere5 = count($_REQUEST['TipoCamere5']);
                    for($i=0; $i<=($n_camere5-1); $i++){
                        $insertR5 = "INSERT INTO hospitality_richiesta(id_richiesta,
                                                            id_proposta,
                                                            TipoSoggiorno,
                                                            NumeroCamere,
                                                            TipoCamere,
                                                            NumAdulti,
                                                            NumBambini,
                                                            EtaB,
                                                            Prezzo
                                                            ) VALUES (
                                                            '".$IdRichiesta."',
                                                            '".$IdProposta5."',
                                                            '".$_REQUEST['TipoSoggiorno5'][$i]."',
                                                            '1',
                                                            '".$_REQUEST['TipoCamere5'][$i]."',
                                                            '".$_REQUEST['NumAdulti5'][$i]."',
                                                            '".$_REQUEST['NumBambini5'][$i]."',
                                                            '".$_REQUEST['EtaB5'][$i]."',
                                                            '".$_REQUEST['Prezzo5'][$i]."')";

                        $dbMysqli->query($insertR5); 
                        

                    } //fine ciclo for camere

     

            }


        // UPDATE dello stato del preventivo in accettato
        $dbMysqli->query("UPDATE hospitality_guest SET Accettato = 1,Inviata = 1, DataInvio = '".date('Y-m-d')."' WHERE Id = ".$_REQUEST['Id']);

    }

    if(($_REQUEST['TipoRichiesta']=='Conferma' && $TipoRichiesta == 'Conferma') || ($_REQUEST['TipoRichiesta']=='Preventivo' && $TipoRichiesta == 'Preventivo')){

            if($_REQUEST['Chiuso'] == 1 && $_REQUEST['DataChiuso'] != ''){
                $cancella_prenotazione .= "Chiuso = '0',";
                $cancella_prenotazione .= " DataChiuso = NULL,";
            }
            // controllo se è gia stata riempita la tabella rel_pagamenti
            $selP = "SELECT * FROM hospitality_rel_pagamenti_preventivi WHERE idsito = ".$_REQUEST['idsito']." AND id_richiesta = ".$_REQUEST['Id'];
            $resP = $dbMysqli->query($selP);
            $totP = sizeof($resP);
            if($totP > 0){
                $up_template = "UPDATE hospitality_rel_pagamenti_preventivi SET CC = '".$_REQUEST['CC']."', BB = '".$_REQUEST['BB']."', VP = '".$_REQUEST['VP']."', PP = '".$_REQUEST['PP']."', GB = '".$_REQUEST['GB']."', GBVP = '".$_REQUEST['GBVP']."', GBS = '".$_REQUEST['GBS']."', linkStripe = '".$_REQUEST['linkStripe']."', GBNX = '".$_REQUEST['GBNX']."' WHERE idsito = '".$_REQUEST['idsito']."' AND id_richiesta = '".$_REQUEST['Id']."'";
                $dbMysqli->query($up_template);
            }else{
                $ins_pag = "INSERT INTO hospitality_rel_pagamenti_preventivi(idsito,id_richiesta,CC,BB,VP,PP,GB,GBVP,GBS,linkStripe,GBNX) VALUES ('".$_REQUEST['idsito']."','".$_REQUEST['Id']."','".$_REQUEST['CC']."','".$_REQUEST['BB']."','".$_REQUEST['VP']."','".$_REQUEST['PP']."','".$_REQUEST['GB']."','".$_REQUEST['GBVP']."','".$_REQUEST['GBS']."','".$_REQUEST['linkStripe']."','".$_REQUEST['GBNX']."')";
                $dbMysqli->query($ins_pag);
            }

            // controllo se è gia stata riempita la tabella (questo per i QUOTO senza gestione template)
            $selT = "SELECT * FROM hospitality_template_link_landing WHERE idsito = ".$_REQUEST['idsito']." AND id_richiesta = ".$_REQUEST['Id'];
            $resT = $dbMysqli->query($selT);
            $totT = sizeof($resT);
            if($totT > 0){
                $up_template = "UPDATE hospitality_template_link_landing SET id_template = '".$_REQUEST['id_template']."' WHERE idsito = '".$_REQUEST['idsito']."' AND id_richiesta = '".$_REQUEST['Id']."'";
                $dbMysqli->query($up_template);
            }else{
                $in_template = "INSERT INTO hospitality_template_link_landing(id_richiesta,id_template,idsito) VALUES ('".$_REQUEST['Id']."','".$_REQUEST['id_template']."','".$_REQUEST['idsito']."')";
                $dbMysqli->query($in_template);
            }

            if($_REQUEST['DataRiconferma']!=''){               
                $datariconferma = "DataRiconferma = '".$_REQUEST['DataRiconferma']."',";
            }else{
                $datariconferma = '';
            }
            // query di modifica
            $update = "UPDATE hospitality_guest SET ChiPrenota = '".addslashes($_REQUEST['ChiPrenota'])."',
                                                EmailSegretaria = '".$_REQUEST['EmailSegretaria']."',
                                                TipoVacanza = '".$_REQUEST['TipoVacanza']."',
                                                idsito = '".$_REQUEST['idsito']."',
                                                id_politiche = '".$_REQUEST['id_politiche']."',
                                                id_template = '".$_REQUEST['id_template']."',
                                                AccontoRichiesta = '".$_REQUEST['acconto_richiesta']."',
                                                Accontolibero = '".$_REQUEST['acconto_libero']."',
                                                Nome = '".addslashes($_REQUEST['Nome'])."',
                                                Cognome = '".addslashes($_REQUEST['Cognome'])."',
                                                Email = '".$_REQUEST['Email']."',
                                                PrefissoInternazionale = '".$_REQUEST['PrefissoInternazionale']."',
                                                Cellulare = '".$_REQUEST['Cellulare']."',
                                                DataNascita = '".$DataNascita."',
                                                Lingua = '".$_REQUEST['Lingua']."',
                                                DataArrivo = '".$DataArrivo."',
                                                DataPartenza = '".$DataPartenza."',
                                                NumeroPrenotazione = '".$_REQUEST['NumeroPrenotazione']."',
                                                NumeroAdulti = '".$_REQUEST['NumeroAdulti']."',
                                                NumeroBambini = '".$_REQUEST['NumeroBambini']."',
                                                EtaBambini1 = '".$_REQUEST['EtaBambini1']."',
                                                EtaBambini2 = '".$_REQUEST['EtaBambini2']."',
                                                EtaBambini3 = '".$_REQUEST['EtaBambini3']."',
                                                EtaBambini4 = '".$_REQUEST['EtaBambini4']."',
                                                EtaBambini5 = '".$_REQUEST['EtaBambini5']."',
                                                EtaBambini6 = '".$_REQUEST['EtaBambini6']."',
                                                FontePrenotazione = '".$_REQUEST['FontePrenotazione']."',
                                                TipoPagamento = '".$_REQUEST['TipoPagamento']."',
                                                DataScadenza = '".$DataScadenza."',
                                                Note = '".addslashes($_REQUEST['Note'])."',
                                                ".$cancella_prenotazione."
                                                ".$datariconferma."
                                                AbilitaInvio = '".$_REQUEST['AbilitaInvio']."'
                                                WHERE Id = ".$_REQUEST['Id'];
            $dbMysqli->query($update);

                if($_REQUEST['id_proposta1']!=''){

                    $DataArrivo1         = $_REQUEST['DataArrivo1'];
                    $DataPartenza1       = $_REQUEST['DataPartenza1'];

                            $dbMysqli->query("UPDATE hospitality_proposte SET
                                                                Arrivo             = '".$DataArrivo1."',
                                                                Partenza           = '".$DataPartenza1."',
                                                                NomeProposta       = '".addslashes($_REQUEST['NomeProposta1'])."',
                                                                TestoProposta      = '".addslashes($_REQUEST['TestoProposta1'])."',
                                                                CheckProposta      = '".$_REQUEST['CheckProposta1']."',
                                                                PrezzoL            = '".$_REQUEST['PrezzoL1']."',
                                                                PrezzoP            = '".$_REQUEST['PrezzoP1']."',
                                                                AccontoPercentuale = '".$_REQUEST['AccontoPercentuale1']."',
                                                                AccontoImporto     = '".$_REQUEST['AccontoImporto1']."',
                                                                AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa1'])."',
                                                                AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto1'])."'
                                                                WHERE Id           = '".$_REQUEST['id_proposta1']."'");

                    $n_rich = count($_REQUEST['idrichiesta1']);
                    for($i=0; $i<=($n_rich-1); $i++){
                        
                            $dbMysqli->query("UPDATE hospitality_richiesta SET TipoSoggiorno = '".$_REQUEST['TipoSoggiorno1'][$i]."',
                                                                            NumeroCamere  = '1',
                                                                            TipoCamere    = '".$_REQUEST['TipoCamere1'][$i]."',
                                                                            NumAdulti     = '".$_REQUEST['NumAdulti1'][$i]."',
                                                                            NumBambini    = '".$_REQUEST['NumBambini1'][$i]."',
                                                                            EtaB          = '".$_REQUEST['EtaB1'][$i]."',
                                                                            Prezzo        = '".$_REQUEST['Prezzo1'][$i]."'
                                                                            WHERE Id      = '".$_REQUEST['idrichiesta1'][$i]."'");
                        if($_REQUEST['idrichiesta1'][$i]==''){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                    id_proposta,
                                                                    TipoSoggiorno,
                                                                    NumeroCamere,
                                                                    TipoCamere,
                                                                    NumAdulti,
                                                                    NumBambini,
                                                                    EtaB,
                                                                    Prezzo
                                                                    ) VALUES (
                                                                    '".$_REQUEST['Id']."',
                                                                    '".$_REQUEST['id_proposta1']."',
                                                                    '".$_REQUEST['TipoSoggiorno1'][$i]."',
                                                                    '1',
                                                                    '".$_REQUEST['TipoCamere1'][$i]."',
                                                                    '".$_REQUEST['NumAdulti1'][$i]."',
                                                                    '".$_REQUEST['NumBambini1'][$i]."',
                                                                    '".$_REQUEST['EtaB1'][$i]."',
                                                                    '".$_REQUEST['Prezzo1'][$i]."')");
                        } 
                    }

                    if($_REQUEST['PrezzoServizio1'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta1']);
                        foreach($_REQUEST['PrezzoServizio1'] as $key => $value){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta1']."','".$key."','".$_REQUEST['num_persone_1_'.$key]."','".$_REQUEST['notti1_'.$key]."')");
                        }
                    }

                    if($_REQUEST['VisibileServizio1'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta1']);
                        foreach($_REQUEST['VisibileServizio1'] as $key => $value){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta1']."','".$key."','".$value."')");
                        }
                    }
                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $dbMysqli->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta1']);
                    $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta1']."','".$_REQUEST['SC1']."')");    
                }
                
                 if($_REQUEST['id_proposta_1']=='1' && $_REQUEST['PrezzoP1']!=''){

                    $DataArrivo1         = $_REQUEST['DataArrivo1'];
                    $DataPartenza1       = $_REQUEST['DataPartenza1'];

                            $insertP1 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$DataArrivo1."',
                                                                '".$DataPartenza1."',
                                                                '".addslashes($_REQUEST['NomeProposta1'])."',
                                                                '".addslashes($_REQUEST['TestoProposta1'])."',
                                                                '".$_REQUEST['CheckProposta1']."',
                                                                '".$_REQUEST['PrezzoL1']."',
                                                                '".$_REQUEST['PrezzoP1']."',
                                                                '".$_REQUEST['AccontoPercentuale1']."',
                                                                '".$_REQUEST['AccontoImporto1']."',
                                                                '".addslashes($_REQUEST['EtichettaTariffa1'])."',
                                                                '".addslashes($_REQUEST['AccontoTesto1'])."')";
                    $resultP1   = $dbMysqli->query($insertP1);
                    $IdProposta = $dbMysqli->getInsertId($resultP1);

                        $n_camere = count($_REQUEST['TipoCamere1']);
                        for($i=0; $i<=($n_camere-1); $i++){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$IdProposta."',
                                                                '".$_REQUEST['TipoSoggiorno1'][$i]."',
                                                                '1',
                                                                '".$_REQUEST['TipoCamere1'][$i]."',
                                                                '".$_REQUEST['NumAdulti1'][$i]."',
                                                                '".$_REQUEST['NumBambini1'][$i]."',
                                                                '".$_REQUEST['EtaB1'][$i]."',
                                                                '".$_REQUEST['Prezzo1'][$i]."')");
                        } 
                    if($_REQUEST['PrezzoServizio1'] != '') {
                       
                        foreach($_REQUEST['PrezzoServizio1'] as $key => $value){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta."','".$key."','".$_REQUEST['num_persone_1_'.$key]."','".$_REQUEST['notti1_'.$key]."')");
                        }
                    }
                    if($_REQUEST['VisibileServizio1'] != '' && $IdProposta != '') {   
                        foreach($_REQUEST['VisibileServizio1'] as $key => $value){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta."','".$key."','".$value."')");
                        }
                    }
                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE  
                    $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta."','".$_REQUEST['SC1']."')");    
        
                } 


                if($_REQUEST['id_proposta2']!=''){

                    $DataArrivo2         = $_REQUEST['DataArrivo2'];
                    $DataPartenza2       = $_REQUEST['DataPartenza2'];

                            $dbMysqli->query("UPDATE hospitality_proposte SET
                                                                Arrivo             = '".$DataArrivo2."',
                                                                Partenza           = '".$DataPartenza2."',
                                                                NomeProposta       = '".addslashes($_REQUEST['NomeProposta2'])."',
                                                                TestoProposta      = '".addslashes($_REQUEST['TestoProposta2'])."',
                                                                CheckProposta      = '".$_REQUEST['CheckProposta2']."',
                                                                PrezzoL            = '".$_REQUEST['PrezzoL2']."',
                                                                PrezzoP            = '".$_REQUEST['PrezzoP2']."',
                                                                AccontoPercentuale = '".$_REQUEST['AccontoPercentuale2']."',
                                                                AccontoImporto     = '".$_REQUEST['AccontoImporto2']."',
                                                                AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa2'])."',
                                                                AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto2'])."'
                                                                WHERE Id           = '".$_REQUEST['id_proposta2']."'");

                        $n_rich2 = count($_REQUEST['idrichiesta2']);
                        for($s=0; $s<=($n_rich2-1); $s++){
                            $dbMysqli->query("UPDATE hospitality_richiesta SET  TipoSoggiorno = '".$_REQUEST['TipoSoggiorno2'][$s]."',
                                                                        NumeroCamere    = '1',
                                                                        TipoCamere      = '".$_REQUEST['TipoCamere2'][$s]."',
                                                                        NumAdulti       = '".$_REQUEST['NumAdulti2'][$s]."',
                                                                        NumBambini      = '".$_REQUEST['NumBambini2'][$s]."',
                                                                        EtaB            = '".$_REQUEST['EtaB2'][$s]."',
                                                                        Prezzo          = '".$_REQUEST['Prezzo2'][$s]."'
                                                                WHERE Id              = '".$_REQUEST['idrichiesta2'][$s]."'");

                        if($_REQUEST['idrichiesta2'][$s]==''){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                    id_proposta,
                                                                    TipoSoggiorno,
                                                                    NumeroCamere,
                                                                    TipoCamere,
                                                                    NumAdulti,
                                                                    NumBambini,
                                                                    EtaB,
                                                                    Prezzo
                                                                    ) VALUES (
                                                                    '".$_REQUEST['Id']."',
                                                                    '".$_REQUEST['id_proposta2']."',
                                                                    '".$_REQUEST['TipoSoggiorno2'][$s]."',
                                                                    '1',
                                                                    '".$_REQUEST['TipoCamere2'][$s]."',
                                                                    '".$_REQUEST['NumAdulti2'][$s]."',
                                                                    '".$_REQUEST['NumBambini2'][$s]."',
                                                                    '".$_REQUEST['EtaB2'][$s]."',
                                                                    '".$_REQUEST['Prezzo2'][$s]."')");
                        }
                        }
                        if($_REQUEST['PrezzoServizio2'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta2']);
                        foreach($_REQUEST['PrezzoServizio2'] as $key2 => $value2){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta2']."','".$key2."','".$_REQUEST['num_persone_2_'.$key2]."','".$_REQUEST['notti2_'.$key2]."')");
                        }
                    }
                    if($_REQUEST['VisibileServizio2'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta2']);
                        foreach($_REQUEST['VisibileServizio2'] as $key2 => $value2){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta2']."','".$key2."','".$value2."')");
                        }
                    }
                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $dbMysqli->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta2']);
                    $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta2']."','".$_REQUEST['SC2']."')");    
        
                }

                if($_REQUEST['id_proposta_2']=='2' && $_REQUEST['PrezzoP2']!=''){


                    $DataArrivo2         = $_REQUEST['DataArrivo2'];
                    $DataPartenza2       = $_REQUEST['DataPartenza2'];

                    $insertP2 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$DataArrivo2."',
                                                                '".$DataPartenza2."',
                                                                '".addslashes($_REQUEST['NomeProposta2'])."',
                                                                '".addslashes($_REQUEST['TestoProposta2'])."',
                                                                '".$_REQUEST['CheckProposta2']."',
                                                                '".$_REQUEST['PrezzoL2']."',
                                                                '".$_REQUEST['PrezzoP2']."',
                                                                '".$_REQUEST['AccontoPercentuale2']."',
                                                                '".$_REQUEST['AccontoImporto2']."',
                                                                '".addslashes($_REQUEST['EtichettaTariffa2'])."',
                                                                '".addslashes($_REQUEST['AccontoTesto2'])."')";
                    $resultP2    = $dbMysqli->query($insertP2);
                    $IdProposta2 = $dbMysqli->getInsertId($resultP2);

                        $n_camere2 = count($_REQUEST['TipoCamere2']);
                        for($i=0; $i<=($n_camere2-1); $i++){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$IdProposta2."',
                                                                '".$_REQUEST['TipoSoggiorno2'][$i]."',
                                                                '1',
                                                                '".$_REQUEST['TipoCamere2'][$i]."',
                                                                '".$_REQUEST['NumAdulti2'][$i]."',
                                                                '".$_REQUEST['NumBambini2'][$i]."',
                                                                '".$_REQUEST['EtaB2'][$i]."',
                                                                '".$_REQUEST['Prezzo2'][$i]."')");
                    }
                    if($_REQUEST['PrezzoServizio2'] != '') {
                      
                        foreach($_REQUEST['PrezzoServizio2'] as $key2 => $value2){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta2."','".$key2."','".$_REQUEST['num_persone_2_'.$key2]."','".$_REQUEST['notti2_'.$key2]."')");
                        }
                    }
                    if($_REQUEST['VisibileServizio2'] != '' && $IdProposta2 != '') { 
                        foreach($_REQUEST['VisibileServizio2'] as $key2 => $value2){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta2."','".$key2."','".$value2."')");
                        }
                    }
                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta2."','".$_REQUEST['SC2']."')");  
                }

                if($_REQUEST['id_proposta3']!=''){

                    $DataArrivo3         = $_REQUEST['DataArrivo3'];
                    $DataPartenza3       = $_REQUEST['DataPartenza3'];

                            $dbMysqli->query("UPDATE hospitality_proposte SET
                                                                Arrivo             = '".$DataArrivo3."',
                                                                Partenza           = '".$DataPartenza3."',
                                                                NomeProposta       = '".addslashes($_REQUEST['NomeProposta3'])."',
                                                                TestoProposta      = '".addslashes($_REQUEST['TestoProposta3'])."',
                                                                CheckProposta      = '".$_REQUEST['CheckProposta3']."',
                                                                PrezzoL            = '".$_REQUEST['PrezzoL3']."',
                                                                PrezzoP            = '".$_REQUEST['PrezzoP3']."',
                                                                AccontoPercentuale = '".$_REQUEST['AccontoPercentuale3']."',
                                                                AccontoImporto     = '".$_REQUEST['AccontoImporto3']."',
                                                                AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa3'])."',
                                                                AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto3'])."'
                                                                WHERE Id           = '".$_REQUEST['id_proposta3']."'");

                        $n_rich3 = count($_REQUEST['idrichiesta3']);
                        for($t=0; $t<=($n_rich3-1); $t++){
                            $dbMysqli->query("UPDATE hospitality_richiesta SET   TipoSoggiorno = '".$_REQUEST['TipoSoggiorno3'][$t]."',
                                                                        NumeroCamere  = '1',
                                                                        TipoCamere    = '".$_REQUEST['TipoCamere3'][$t]."',
                                                                        NumAdulti     = '".$_REQUEST['NumAdulti3'][$t]."',
                                                                        NumBambini    = '".$_REQUEST['NumBambini3'][$t]."',
                                                                        EtaB          = '".$_REQUEST['EtaB3'][$t]."',
                                                                        prezzo        = '".$_REQUEST['Prezzo3'][$t]."'
                                                                        WHERE Id      = '".$_REQUEST['idrichiesta3'][$t]."'");
                        if($_REQUEST['idrichiesta3'][$t]==''){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                    id_proposta,
                                                                    TipoSoggiorno,
                                                                    NumeroCamere,
                                                                    TipoCamere,
                                                                    NumAdulti,
                                                                    NumBambini,
                                                                    EtaB,
                                                                    Prezzo
                                                                    ) VALUES (
                                                                    '".$_REQUEST['Id']."',
                                                                    '".$_REQUEST['id_proposta3']."',
                                                                    '".$_REQUEST['TipoSoggiorno3'][$t]."',
                                                                    '1',
                                                                    '".$_REQUEST['TipoCamere3'][$t]."',
                                                                    '".$_REQUEST['NumAdulti3'][$t]."',
                                                                    '".$_REQUEST['NumBambini3'][$t]."',
                                                                    '".$_REQUEST['EtaB3'][$t]."',
                                                                    '".$_REQUEST['Prezzo3'][$t]."')");
                        }

                        }
                        if($_REQUEST['PrezzoServizio3'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta3']);
                        foreach($_REQUEST['PrezzoServizio3'] as $key3 => $value3){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta3']."','".$key3."','".$_REQUEST['num_persone_3_'.$key3]."','".$_REQUEST['notti3_'.$key3]."')");
                        }
                    }
                    if($_REQUEST['VisibileServizio3'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta3']);
                        foreach($_REQUEST['VisibileServizio3'] as $key3 => $value3){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta3']."','".$key3."','".$value3."')");
                        }
                    }
                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $dbMysqli->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta3']);
                    $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta3']."','".$_REQUEST['SC3']."')");  
                }

                if($_REQUEST['id_proposta_3']=='3' && $_REQUEST['PrezzoP3']!=''){

                    $DataArrivo3         = $_REQUEST['DataArrivo3'];
                    $DataPartenza3       = $_REQUEST['DataPartenza3'];

                    $insertP3 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$DataArrivo3."',
                                                                '".$DataPartenza3."',
                                                                '".addslashes($_REQUEST['NomeProposta3'])."',
                                                                '".addslashes($_REQUEST['TestoProposta3'])."',
                                                                '".$_REQUEST['CheckProposta3']."',
                                                                '".$_REQUEST['PrezzoL3']."',
                                                                '".$_REQUEST['PrezzoP3']."',
                                                                '".$_REQUEST['AccontoPercentuale3']."',
                                                                '".$_REQUEST['AccontoImporto3']."',
                                                                '".addslashes($_REQUEST['EtichettaTariffa3'])."',
                                                                '".addslashes($_REQUEST['AccontoTesto3'])."')";

                    $resultP3    = $dbMysqli->query($insertP3);
                    $IdProposta3 = $dbMysqli->getInsertId($resultP3);

                        $n_camere3 = count($_REQUEST['TipoCamere3']);
                        for($i=0; $i<=($n_camere3-1); $i++){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$IdProposta3."',
                                                                '".$_REQUEST['TipoSoggiorno3'][$i]."',
                                                                '1',
                                                                '".$_REQUEST['TipoCamere3'][$i]."',
                                                                '".$_REQUEST['NumAdulti3'][$i]."',
                                                                '".$_REQUEST['NumBambini3'][$i]."',
                                                                '".$_REQUEST['EtaB3'][$i]."',
                                                                '".$_REQUEST['Prezzo3'][$i]."')");
                        }
                        
                        if($_REQUEST['PrezzoServizio3'] != '') {
                        
                            foreach($_REQUEST['PrezzoServizio3'] as $key3 => $value3){
                                $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta3."','".$key3."','".$_REQUEST['num_persone_3_'.$key3]."','".$_REQUEST['notti3_'.$key3]."')");
                            }
                        }
                        if($_REQUEST['VisibileServizio3'] != '' && $IdProposta3 != '') {
                            foreach($_REQUEST['VisibileServizio3'] as $key3 => $value3){
                                $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta3."','".$key3."','".$value3."')");
                            }
                        }
                 ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta3."','".$_REQUEST['SC3']."')");  

                }

            if($_REQUEST['id_proposta4']!=''){

                $DataArrivo4         = $_REQUEST['DataArrivo4'];
                $DataPartenza4       = $_REQUEST['DataPartenza4'];

                            $dbMysqli->query("UPDATE hospitality_proposte SET
                                                                Arrivo             = '".$DataArrivo4."',
                                                                Partenza           = '".$DataPartenza4."',
                                                                NomeProposta       = '".addslashes($_REQUEST['NomeProposta4'])."',
                                                                TestoProposta      = '".addslashes($_REQUEST['TestoProposta4'])."',
                                                                CheckProposta      = '".$_REQUEST['CheckProposta4']."',
                                                                PrezzoL            = '".$_REQUEST['PrezzoL4']."',
                                                                PrezzoP            = '".$_REQUEST['PrezzoP4']."',
                                                                AccontoPercentuale = '".$_REQUEST['AccontoPercentuale4']."',
                                                                AccontoImporto     = '".$_REQUEST['AccontoImporto4']."',
                                                                AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa4'])."',
                                                                AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto4'])."'
                                                                WHERE Id           = '".$_REQUEST['id_proposta4']."'");

                        $n_rich4 = count($_REQUEST['idrichiesta4']);
                        for($w=0; $w<=($n_rich4-1); $w++){
                            $dbMysqli->query("UPDATE hospitality_richiesta SET   TipoSoggiorno = '".$_REQUEST['TipoSoggiorno4'][$w]."',
                                                                        NumeroCamere  = '1',
                                                                        TipoCamere    = '".$_REQUEST['TipoCamere4'][$w]."',
                                                                        NumAdulti     = '".$_REQUEST['NumAdulti4'][$w]."',
                                                                        NumBambini    = '".$_REQUEST['NumBambini4'][$w]."',
                                                                        EtaB          = '".$_REQUEST['EtaB4'][$w]."',
                                                                        prezzo        = '".$_REQUEST['Prezzo4'][$w]."'
                                                                        WHERE Id      = '".$_REQUEST['idrichiesta4'][$w]."'");
                        if($_REQUEST['idrichiesta4'][$w]==''){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                    id_proposta,
                                                                    TipoSoggiorno,
                                                                    NumeroCamere,
                                                                    TipoCamere,
                                                                    NumAdulti,
                                                                    NumBambini,
                                                                    EtaB,
                                                                    Prezzo
                                                                    ) VALUES (
                                                                    '".$_REQUEST['Id']."',
                                                                    '".$_REQUEST['id_proposta4']."',
                                                                    '".$_REQUEST['TipoSoggiorno4'][$w]."',
                                                                    '1',
                                                                    '".$_REQUEST['TipoCamere4'][$w]."',
                                                                    '".$_REQUEST['NumAdulti4'][$w]."',
                                                                    '".$_REQUEST['NumBambini4'][$w]."',
                                                                    '".$_REQUEST['EtaB4'][$w]."',
                                                                    '".$_REQUEST['Prezzo4'][$w]."')");
                        }

                        }
                        if($_REQUEST['PrezzoServizio4'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta4']);
                        foreach($_REQUEST['PrezzoServizio4'] as $key4 => $value4){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta4']."','".$key4."','".$_REQUEST['num_persone_4_'.$key4]."','".$_REQUEST['notti4_'.$key4]."')");
                        }
                    }

                     if($_REQUEST['VisibileServizio4'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta4']);
                        foreach($_REQUEST['VisibileServizio4'] as $key4 => $value4){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta4']."','".$key4."','".$value4."')");
                        }
                    }

                ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                $dbMysqli->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta4']);
                $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta4']."','".$_REQUEST['SC4']."')");  
                    
                }

                
                if($_REQUEST['id_proposta_4']=='4' && $_REQUEST['PrezzoP4']!=''){


                        $DataArrivo4         = $_REQUEST['DataArrivo4'];
                        $DataPartenza4       = $_REQUEST['DataPartenza4'];

                        $insertP4 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$DataArrivo4."',
                                                                '".$DataPartenza4."',
                                                                '".addslashes($_REQUEST['NomeProposta4'])."',
                                                                '".addslashes($_REQUEST['TestoProposta4'])."',
                                                                '".$_REQUEST['CheckProposta4']."',
                                                                '".$_REQUEST['PrezzoL4']."',
                                                                '".$_REQUEST['PrezzoP4']."',
                                                                '".$_REQUEST['AccontoPercentuale4']."',
                                                                '".$_REQUEST['AccontoImporto4']."',
                                                                '".addslashes($_REQUEST['EtichettaTariffa4'])."',
                                                                '".addslashes($_REQUEST['AccontoTesto4'])."')";

                $resultP4    = $dbMysqli->query($insertP4);
                $IdProposta4 = $dbMysqli->getInsertId($resultP4);

                        $n_camere4 = count($_REQUEST['TipoCamere4']);
                        for($i=0; $i<=($n_camere4-1); $i++){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$IdProposta4."',
                                                                '".$_REQUEST['TipoSoggiorno4'][$i]."',
                                                                '1',
                                                                '".$_REQUEST['TipoCamere4'][$i]."',
                                                                '".$_REQUEST['NumAdulti4'][$i]."',
                                                                '".$_REQUEST['NumBambini4'][$i]."',
                                                                '".$_REQUEST['EtaB4'][$i]."',
                                                                '".$_REQUEST['Prezzo4'][$i]."')");
                        }

                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta4."','".$_REQUEST['SC4']."')");  


                

                if($_REQUEST['PrezzoServizio4'] != '') {
                
                    foreach($_REQUEST['PrezzoServizio4'] as $key4 => $value4){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta4."','".$key4."','".$_REQUEST['num_persone_4_'.$key4]."','".$_REQUEST['notti4_'.$key4]."')");
                    }
                }
                if($_REQUEST['VisibileServizio4'] != '' && $IdProposta4 != '') {
                    foreach($_REQUEST['VisibileServizio4'] as $key4 => $value4){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta4."','".$key4."','".$value4."')");
                    }
                } 
            }
            if($_REQUEST['id_proposta5']!=''){

                $DataArrivo5         = $_REQUEST['DataArrivo5'];
                $DataPartenza5       = $_REQUEST['DataPartenza5'];

                            $dbMysqli->query("UPDATE hospitality_proposte SET
                                                                Arrivo             = '".$DataArrivo5."',
                                                                Partenza           = '".$DataPartenza5."',
                                                                NomeProposta       = '".addslashes($_REQUEST['NomeProposta5'])."',
                                                                TestoProposta      = '".addslashes($_REQUEST['TestoProposta5'])."',
                                                                CheckProposta      = '".$_REQUEST['CheckProposta5']."',
                                                                PrezzoL            = '".$_REQUEST['PrezzoL5']."',
                                                                PrezzoP            = '".$_REQUEST['PrezzoP5']."',
                                                                AccontoPercentuale = '".$_REQUEST['AccontoPercentuale5']."',
                                                                AccontoImporto     = '".$_REQUEST['AccontoImporto5']."',
                                                                AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa5'])."',
                                                                AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto5'])."'
                                                                WHERE Id           = '".$_REQUEST['id_proposta5']."'");

                        $n_rich5 = count($_REQUEST['idrichiesta5']);
                        for($a=0; $a<=($n_rich5-1); $a++){
                            $dbMysqli->query("UPDATE hospitality_richiesta SET   TipoSoggiorno = '".$_REQUEST['TipoSoggiorno5'][$a]."',
                                                                        NumeroCamere  = '1',
                                                                        TipoCamere    = '".$_REQUEST['TipoCamere5'][$a]."',
                                                                        NumAdulti     = '".$_REQUEST['NumAdulti5'][$a]."',
                                                                        NumBambini    = '".$_REQUEST['NumBambini5'][$a]."',
                                                                        EtaB          = '".$_REQUEST['EtaB5'][$a]."',
                                                                        prezzo        = '".$_REQUEST['Prezzo5'][$a]."'
                                                                        WHERE Id      = '".$_REQUEST['idrichiesta5'][$a]."'");
                        if($_REQUEST['idrichiesta5'][$a]==''){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                    id_proposta,
                                                                    TipoSoggiorno,
                                                                    NumeroCamere,
                                                                    TipoCamere,
                                                                    NumAdulti,
                                                                    NumBambini,
                                                                    EtaB,
                                                                    Prezzo
                                                                    ) VALUES (
                                                                    '".$_REQUEST['Id']."',
                                                                    '".$_REQUEST['id_proposta5']."',
                                                                    '".$_REQUEST['TipoSoggiorno5'][$a]."',
                                                                    '1',
                                                                    '".$_REQUEST['TipoCamere5'][$a]."',
                                                                    '".$_REQUEST['NumAdulti5'][$a]."',
                                                                    '".$_REQUEST['NumBambini5'][$a]."',
                                                                    '".$_REQUEST['EtaB5'][$a]."',
                                                                    '".$_REQUEST['Prezzo5'][$a]."')");
                        }

                        }
                        if($_REQUEST['PrezzoServizio5'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta5']);
                        foreach($_REQUEST['PrezzoServizio5'] as $key5 => $value5){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta5']."','".$key5."','".$_REQUEST['num_persone_5_'.$key5]."','".$_REQUEST['notti5_'.$key5]."')");
                        }
                    }

                    if($_REQUEST['VisibileServizio5'] != '') {
                        $dbMysqli->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta5']);
                        foreach($_REQUEST['VisibileServizio5'] as $key5 => $value5){
                            $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta5']."','".$key5."','".$value5."')");
                        }
                    }

                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $dbMysqli->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta5']);
                    $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta5']."','".$_REQUEST['SC5']."')");  

                }
                if($_REQUEST['id_proposta_5']=='5' && $_REQUEST['PrezzoP5']!=''){

                    $DataArrivo5         = $_REQUEST['DataArrivo5'];
                    $DataPartenza5       = $_REQUEST['DataPartenza5'];

                    $insertP5 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$DataArrivo5."',
                                                                '".$DataPartenza5."',
                                                                '".addslashes($_REQUEST['NomeProposta5'])."',
                                                                '".addslashes($_REQUEST['TestoProposta5'])."',
                                                                '".$_REQUEST['CheckProposta5']."',
                                                                '".$_REQUEST['PrezzoL5']."',
                                                                '".$_REQUEST['PrezzoP5']."',
                                                                '".$_REQUEST['AccontoPercentuale5']."',
                                                                '".$_REQUEST['AccontoImporto5']."',
                                                                '".addslashes($_REQUEST['EtichettaTariffa5'])."',
                                                                '".addslashes($_REQUEST['AccontoTesto5'])."')";
                $resultP5    = $dbMysqli->query($insertP5);
                $IdProposta5 = $dbMysqli->getInsertId($resultP5);

                        $n_camere5 = count($_REQUEST['TipoCamere5']);
                        for($h=0; $h<=($n_camere5-1); $h++){
                            $dbMysqli->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$_REQUEST['Id']."',
                                                                '".$IdProposta5."',
                                                                '".$_REQUEST['TipoSoggiorno5'][$h]."',
                                                                '1',
                                                                '".$_REQUEST['TipoCamere5'][$h]."',
                                                                '".$_REQUEST['NumAdulti5'][$h]."',
                                                                '".$_REQUEST['NumBambini5'][$h]."',
                                                                '".$_REQUEST['EtaB5'][$h]."',
                                                                '".$_REQUEST['Prezzo5'][$h]."')");
                        }

                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta5."','".$_REQUEST['SC5']."')");  

            
            
                if($_REQUEST['PrezzoServizio5'] != '') {
                
                    foreach($_REQUEST['PrezzoServizio5'] as $key5 => $value5){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta5."','".$key5."','".$_REQUEST['num_persone_5_'.$key5]."','".$_REQUEST['notti5_'.$key5]."')");
                    }
                }
            
                if($_REQUEST['VisibileServizio5'] != '' && $IdProposta5 != '') {
                    foreach($_REQUEST['VisibileServizio5'] as $key5 => $value5){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta5."','".$key5."','".$value5."')");
                    }
                } 
            }
            if($_REQUEST['Chiuso'] == 1 && ($_REQUEST['DataChiuso'] != '0000-00-00' || $_REQUEST['DataChiuso'] != null)){
                $dbMysqli->query("UPDATE hospitality_guest SET DataModificaPrenotazione = '".date('Y-m-d')."' WHERE Id = ".$_REQUEST['Id']." AND idsito = ".IDSITO);
                popola_status_parity(IDSITO,$_REQUEST['NumeroPrenotazione'],8);
            }

            ## relazione per inserire info box visibili nel template
            if(is_array($_POST['id_infobox']) && !is_null($_POST['id_infobox']) && !empty($_POST['id_infobox'])) {
                $dbMysqli->query("DELETE FROM hospitality_rel_infobox_preventivo WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']);
                foreach($_POST['id_infobox'] as $key => $value){
                    $dbMysqli->query("INSERT INTO hospitality_rel_infobox_preventivo(idsito,id_richiesta,id_infobox) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$value."')");
                }
            }
        }
    ##ELIMINO LA RIGA PER IL CONTROLLO DELLA MODIFICA ###
    $deleteCheckOp = "DELETE FROM hospitality_check_modifica WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND operatore = '".$_SESSION['user_accesso']."'";
    $dbMysqli->query($deleteCheckOp);
    #####################################################
    include($_SERVER['DOCUMENT_ROOT'].'/include/template/moduli/logs.inc.php');

    if($_REQUEST['IdMotivazione']!=''){
        header('Location:'.BASE_URL_SITO.'buoni_voucher/');
    }
    if($_REQUEST['TipoRichiesta']=='Conferma' && $TipoRichiesta == 'Preventivo'){
        header('Location:'.BASE_URL_SITO.'conferme/');
    }
    if($_REQUEST['TipoRichiesta']=='Conferma'){

            echo'   <form name="redirect_c" id="redirect_c" method="POST" action="'.BASE_URL_SITO.'conferme/">
                        <input type="hidden" name="id_conferma" value="'.$_REQUEST['Id'].'">
                    </form>
                    <script language="JavaScript">
                        document.redirect_c.submit();
                    </script>'."\r\n"; 
        
    }
    if($_REQUEST['TipoRichiesta']=='Preventivo'){

             echo'   <form name="redirect_p" id="redirect_p" method="POST" action="'.BASE_URL_SITO.'preventivi/'.($_REQUEST['valore']?'&pag='.$_REQUEST['valore']:'').'">
                        <input type="hidden" name="id_preventivo" value="'.$_REQUEST['Id'].'">
                    </form>
                    <script language="JavaScript">
                        document.redirect_p.submit();
                    </script>'."\r\n";  
    }

}
?>