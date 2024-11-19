<?php
// ribadisco error_reporting, perchè escludere alcuni warning
//error_reporting(0);

$DataDiOggi = date('Y-m-d');
$GiornoInPiu = mktime (0,0,0,date('m'),(date('d')+1),date('Y'));
$DataDiDomani = date('Y-m-d',$GiornoInPiu);
// nuovo numero preventivo
$nuovoNumeroPreventivo = $fun->nextNumberPrev(IDSITO);

// chiamate per popolare la lista select del target cliente
$listaTarget = $fun->lista_target(IDSITO);
foreach($listaTarget as $key => $value){
    $target .='<option value="'.$value['Target'].'">'.$value['Target'].'</option>';
}

// chiamate per popolare la lista select degli operatori
$listaOperatori = $fun->lista_operatori(IDSITO);
    $Operatori .='<option value="">scegli</option>';
foreach($listaOperatori as $key => $value){
    $Operatori .='<option value="'.$value['NomeOperatore'].'">'.$value['NomeOperatore'].'</option>';
}

// lisat delle lingue disponibili in QUOTO
$ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/it.png" data-img-label="Italiano" value="it">Italiano</option>';
$ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/en.png" data-img-label="Inglese"  value="en">Inglese</option>';
$ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/fr.png" data-img-label="Francese" value="fr">Francese</option>';
$ListaLingue .='<option data-img-src="'.BASE_URL_SITO.'img/flags/big/de.png" data-img-label="Tedesco"  value="de">Tedesco</option>';

// lista dei template disponibili in QUOTO
$ListaTemplate = $fun->lista_template(IDSITO);

// lista fonti di prenotazione
$listaFonti = $fun->lista_fonti(IDSITO);
    $fonti .='<option value="">scegli</option>';
foreach($listaFonti as $key => $value){
    $fonti .='<option value="'.$value['FontePrenotazione'].'" '.($value['FontePrenotazione']=='Sito Web'?'disabled="disabled"':'').'>'.($value['FontePrenotazione']=='Sito Web'?$value['FontePrenotazione'].' / Landing':$value['FontePrenotazione']).'</option>';
}

// lista politiche
$listaPolitiche = $fun->lista_politiche(IDSITO);
    $politiche .='<option value="">scegli</option>';
foreach($listaPolitiche as $ch => $vl){
    $politiche .='<option value="'.$vl['id'].'">'.$vl['etichetta'].'</option>';
}

// lista clienti per la ricerca sul campo nome e cognome
$lista_nomi = $fun->lista_clienti(IDSITO);

// Ciclo per il select Numero Totale Adulti
$i = 1;
    $NumeroAdulti .='<option value="">scegli</option>';
for($i==1; $i<=20; $i++){
    $NumeroAdulti .='<option value="'.$i.'">'.$i.'</option>';
}
    $NumeroAdulti .='<option value="25">25</option>';
    $NumeroAdulti .='<option value="30">30</option>';
    $NumeroAdulti .='<option value="35">35</option>';
    $NumeroAdulti .='<option value="40">40</option>';
    $NumeroAdulti .='<option value="45">45</option>';
    $NumeroAdulti .='<option value="50">50</option>';
    $NumeroAdulti .='<option value="60">60</option>';
    $NumeroAdulti .='<option value="70">70</option>';

// Ciclo per il select Numero Totale Bambini
$n = 1;
    $NumeroBambini .='<option value="">scegli</option>';
for($n==1; $n<=20; $n++){
    $NumeroBambini .='<option value="'.$n.'">'.$n.'</option>';
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
$num_sconto = 1;
$percentuali_sconto .='<option value="0">--</option>';
for($num_sconto==1; $num_sconto<=25; $num_sconto++){
    $percentuali_sconto .='<option value="'.$num_sconto.'">'.$num_sconto.'%</option>';
}
$percentuali_sconto .='<option value="30">30%</option>';
$percentuali_sconto .='<option value="35">35%</option>';
$percentuali_sconto .='<option value="40">40%</option>';
$percentuali_sconto .='<option value="45">45%</option>';
$percentuali_sconto .='<option value="50">50%</option>';
$percentuali_sconto .='<option value="100">100%</option>';

$AccontoRichiesta = $fun->dati_caparra(IDSITO);

$listaServizi = $fun->lista_servizi_aggiuntivi(IDSITO);

$TipiPagamento = $fun->get_tipo_pagamenti(IDSITO);

$ListaPrefissi = $fun->get_prefissi();

// chiamate per popolare la lista select degli INFO BOX
$listaInfoBox = $fun->lista_infoBox(IDSITO);
foreach($listaInfoBox as $key => $value){
    $infoBox .='<option value="'.$value['Id'].'">'.$value['Titolo'].'</option>';
}

###SALVATAGGIO#####
if($_POST['action']=='create'){

        if($_POST['PrezzoL1'] == $_POST['PrezzoP1']) {
            $_POST['PrezzoL1'] = 0;
        }
        if($_POST['PrezzoL2'] == $_POST['PrezzoP2']) {
            $_POST['PrezzoL2'] = 0;
        }
        if($_POST['PrezzoL3'] == $_POST['PrezzoP3']) {
            $_POST['PrezzoL3'] = 0;
        }
        if($_POST['PrezzoL4'] == $_POST['PrezzoP4']) {
            $_POST['PrezzoL4'] = 0;
        }
        if($_POST['PrezzoL5'] == $_POST['PrezzoP5']) {
            $_POST['PrezzoL5'] = 0;
        }
       // dati richiesta
       $DataRichiesta      = date('Y-m-d');
       $id_politiche       = $_POST['id_politiche'];
       $id_template        = $_POST['id_template'];
       $acconto_richiesta  = $_POST['acconto_richiesta'];
       $AccontoLibero      = $_POST['acconto_libero'];
       $Lingua             = $_POST['Lingua'];
       $TipoRichiesta      = $_POST['TipoRichiesta'];
       $TipoVacanza        = $_POST['TipoVacanza'];
       $ChiPrenota         = addslashes($_POST['ChiPrenota']);
       $EmailSegretaria    = $_POST['EmailSegretaria'];
       $idsito             = $_POST['idsito'];
       // dati cliente
       $Nome                    = addslashes(ucfirst($_POST['Nome']));
       $Cognome                 = addslashes(ucfirst($_POST['Cognome']));
       $Email                   = $_POST['Email'];
       $PrefissoInternazionale  = $_POST['PrefissoInternazionale'];
       $Cellulare               = $_POST['Cellulare'];
       $DataNascita             = $_POST['DataNascita'];
       // dati prenotazione
       $DataArrivo         = $_POST['DataArrivo'];
       $DataPartenza       = $_POST['DataPartenza'];
       $NumeroPrenotazione = $fun->new_Npreno('hospitality_guest',IDSITO);
       $NumeroAdulti       = $_POST['NumeroAdulti'];
       $NumeroBambini      = $_POST['NumeroBambini'];
       $EtaBambini1        = ($_POST['EtaBambini1']==''?NULL:$_POST['EtaBambini1']);
       $EtaBambini2        = ($_POST['EtaBambini2']==''?NULL:$_POST['EtaBambini2']);
       $EtaBambini3        = ($_POST['EtaBambini3']==''?NULL:$_POST['EtaBambini3']);
       $EtaBambini4        = ($_POST['EtaBambini4']==''?NULL:$_POST['EtaBambini4']);
       $EtaBambini5        = ($_POST['EtaBambini5']==''?NULL:$_POST['EtaBambini5']);
       $EtaBambini6        = ($_POST['EtaBambini6']==''?NULL:$_POST['EtaBambini6']);
       // dati informativi
       $FontePrenotazione  = $_POST['FontePrenotazione'];
       $TipoPagamento      = $_POST['TipoPagamento'];
       $DataScadenza       = $_POST['DataScadenza'];
       $Note               = $_POST['Note'];
       // ABILITAZIONE A INVIO EMAIL
       $AbilitaInvio       = $_POST['AbilitaInvio'];
        // ABILITAZIONE TIPO DI PAGAMENTI
        $CC   = $_POST['CC'];
        $BB   = $_POST['BB'];
        $VP   = $_POST['VP'];
        $PP   = $_POST['PP'];
        $GB   = $_POST['GB'];
        $GBVP = $_POST['GBVP'];
        $GBS  = $_POST['GBS'];
        $linkStripe  = $_POST['linkStripe'];
        $GBNX = $_POST['GBNX'];

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
                                                AbilitaInvio
                                                ) VALUES (
                                                '".$id_politiche."',
                                                '".$id_template."',
                                                '".$acconto_richiesta."',
                                                '".$AccontoLibero."',
                                                '".$DataRichiesta."',
                                                '".$TipoRichiesta."',
                                                '".$TipoVacanza."',
                                                '".$ChiPrenota."',
                                                '".$EmailSegretaria."',
                                                '".$idsito."',
                                                '".$Nome."',
                                                '".$Cognome."',
                                                '".$Email."',
                                                '".$PrefissoInternazionale."',
                                                '".$Cellulare."',
                                                '".$DataNascita."',
                                                '".$Lingua."',
                                                '".$DataArrivo."',
                                                '".$DataPartenza."',
                                                '".$NumeroPrenotazione."',
                                                '".$NumeroAdulti."',
                                                '".$NumeroBambini."',
                                                '".$EtaBambini1."',
                                                '".$EtaBambini2."',
                                                '".$EtaBambini3."',
                                                '".$EtaBambini4."',
                                                '".$EtaBambini5."',
                                                '".$EtaBambini6."',
                                                '".$FontePrenotazione."',
                                                '".$TipoPagamento."',
                                                '".$DataScadenza."',
                                                '".addslashes($Note)."',
                                                '".$AbilitaInvio."')";
      $primo_insert = $dbMysqli->query($insert);

      $IdRichiesta = $dbMysqli->getInsertId($primo_insert);

      $record_template = $fun->check_nome_template_by_id($id_template,$idsito);
      $nome_template_scelto = ucfirst($record_template['TemplateName']);
      $tipo_template_scelto = strtoupper($record_template['TemplateType']);

            if(ucfirst($TipoVacanza) == $nome_template_scelto && $TipoRichiesta == 'Preventivo'){
                // query per testo default landing page
                $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                            INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                            WHERE hospitality_dizionario.idsito = ".$idsito."
                            AND hospitality_dizionario.etichetta = 'PREVENTIVO_".$tipo_template_scelto."'
                            AND hospitality_dizionario_lingua.idsito =  ".$idsito."
                            AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
                $re = $dbMysqli->query($sele);
                $v  = $re[0];
                $TestoAlternativoFP = stripslashes($v['testo']);

                $in ="INSERT INTO hospitality_contenuti_web_lingua(
                            idsito,
                            IdRichiesta,
                            Lingua,
                            Testo)
                        VALUES (
                            '".$idsito."',
                            '".$IdRichiesta."',
                            '".$Lingua."',
                            '".addslashes($TestoAlternativoFP)."')";
                $dbMysqli->query($in);

            }elseif(ucfirst($TipoVacanza) == $nome_template_scelto && $TipoRichiesta == 'Conferma'){

                // query per testo default landing page
                $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                            INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                            WHERE hospitality_dizionario.idsito = ".$idsito."
                            AND hospitality_dizionario.etichetta = 'CONFERMA_".$tipo_template_scelto."'
                            AND hospitality_dizionario_lingua.idsito =  ".$idsito."
                            AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
                $re = $dbMysqli->query($sele);
                $v = $re[0];
                $TestoAlternativoFC = stripslashes($v['testo']);

                $in ="INSERT INTO hospitality_contenuti_web_lingua(
                            idsito,
                            IdRichiesta,
                            Lingua,
                            Testo)
                        VALUES (
                            '".$idsito."',
                            '".$IdRichiesta."',
                            '".$Lingua."',
                            '".addslashes($TestoAlternativoFC)."')";
                $dbMysqli->query($in);


            }


      $ins_template = "INSERT INTO hospitality_template_link_landing(id_richiesta,id_template,idsito) VALUES ('".$IdRichiesta."','".$id_template."','".$idsito."')";
      $dbMysqli->query($ins_template);
    /**
     * * inserire le scelate dei tipi di pagamento
     */
    $ins_pag = "INSERT INTO hospitality_rel_pagamenti_preventivi(idsito,id_richiesta,CC,BB,VP,PP,GB,GBVP,GBS,linkStripe,GBNX) VALUES ('".$idsito."','".$IdRichiesta."','".$CC."','".$BB."','".$VP."','".$PP."','".$GB."','".$GBVP."','".$GBS."','".$linkStripe."','".$GBNX."')";
    $dbMysqli->query($ins_pag);

      // se la prima proposta è compilata
      if($_POST['PrezzoP1']!=''){

        $DataArrivo1         = $_POST['DataArrivo1'];
        $DataPartenza1       = $_POST['DataPartenza1'];

            $insProposta =  "INSERT INTO hospitality_proposte(id_richiesta,
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
                                                      '".addslashes($_POST['NomeProposta1'])."',
                                                      '".addslashes($_POST['TestoProposta1'])."',
                                                      '".$_POST['CheckProposta1']."',
                                                      '".$_POST['PrezzoL1']."',
                                                      '".$_POST['PrezzoP1']."',
                                                      '".$_POST['AccontoPercentuale1']."',
                                                      '".$_POST['AccontoImporto1']."',
                                                      '".addslashes($_POST['EtichettaTariffa1'])."',
                                                      '".addslashes($_POST['AccontoTesto1'])."')";
            $primaProposta = $dbMysqli->query($insProposta);
            $IdProposta    = $dbMysqli->getInsertId($primaProposta);
            $n_camere      = count($_POST['TipoCamere1']);
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
                                                      '".$IdRichiesta."',
                                                      '".$IdProposta."',
                                                      '".$_POST['TipoSoggiorno1'][$i]."',
                                                      '1',
                                                      '".$_POST['TipoCamere1'][$i]."',
                                                      '".$_POST['NumAdulti1'][$i]."',
                                                      '".$_POST['NumBambini1'][$i]."',
                                                      '".$_POST['EtaB1'][$i]."',
                                                      '".$_POST['Prezzo1'][$i]."')");
             }
             if($_POST['PrezzoServizio1'] != '') {
                foreach($_POST['PrezzoServizio1'] as $key => $value){
                    $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$key."','".$_POST['num_persone_1_'.$key]."','".$_POST['notti1_'.$key]."')");
                }
            }
            if($_POST['VisibileServizio1'] != '') {
                foreach($_POST['VisibileServizio1'] as $key => $value){
                    $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$key."','".$value."')");
                }
            }
            ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
            $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$_POST['SC1']."')");
      }
      // se la seconda proposta è compilata
      if($_POST['PrezzoP2']!=''){

        $DataArrivo2         = $_POST['DataArrivo2'];
        $DataPartenza2       = $_POST['DataPartenza2'];

                 $insProposta2 =  "INSERT INTO hospitality_proposte(id_richiesta,
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
                                                      '".addslashes($_POST['NomeProposta2'])."',
                                                      '".addslashes($_POST['TestoProposta2'])."',
                                                      '".$_POST['CheckProposta2']."',
                                                      '".$_POST['PrezzoL2']."',
                                                      '".$_POST['PrezzoP2']."',
                                                      '".$_POST['AccontoPercentuale2']."',
                                                      '".$_POST['AccontoImporto2']."',
                                                      '".addslashes($_POST['EtichettaTariffa2'])."',
                                                      '".addslashes($_POST['AccontoTesto2'])."')";

            $secondaProposta = $dbMysqli->query($insProposta2);
            $IdProposta2     = $dbMysqli->getInsertId( $secondaProposta);
            $n_camere2       = count($_POST['TipoCamere2']);
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
                                                      '".$IdRichiesta."',
                                                      '".$IdProposta2."',
                                                      '".$_POST['TipoSoggiorno2'][$i]."',
                                                      '1',
                                                      '".$_POST['TipoCamere2'][$i]."',
                                                      '".$_POST['NumAdulti2'][$i]."',
                                                      '".$_POST['NumBambini2'][$i]."',
                                                      '".$_POST['EtaB2'][$i]."',
                                                      '".$_POST['Prezzo2'][$i]."')");
             }

             if($_POST['PrezzoServizio2'] != '') {
                foreach($_POST['PrezzoServizio2'] as $key2 => $value2){
                    $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta2."','".$key2."','".$_POST['num_persone_2_'.$key2]."','".$_POST['notti2_'.$key2]."')");
                }
            }
            if($_POST['VisibileServizio2'] != '') {
                foreach($_POST['VisibileServizio2'] as $key2 => $value2){
                    $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta2."','".$key2."','".$value2."')");
                }
            }
            ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
            $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta2."','".$_POST['SC2']."')");
      }
      // se la terza proposta è compilata
      if($_POST['PrezzoP3']!=''){

        $DataArrivo3         = $_POST['DataArrivo3'];
        $DataPartenza3       = $_POST['DataPartenza3'];

                 $insProposta3 =  "INSERT INTO hospitality_proposte(id_richiesta,
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
                                                      '".addslashes($_POST['NomeProposta3'])."',
                                                      '".addslashes($_POST['TestoProposta3'])."',
                                                      '".$_POST['CheckProposta3']."',
                                                      '".$_POST['PrezzoL3']."',
                                                      '".$_POST['PrezzoP3']."',
                                                      '".$_POST['AccontoPercentuale3']."',
                                                      '".$_POST['AccontoImporto3']."',
                                                      '".addslashes($_POST['EtichettaTariffa3'])."',
                                                      '".addslashes($_POST['AccontoTesto3'])."')";
            $terzaProposta = $dbMysqli->query($insProposta3);
            $IdProposta3   = $dbMysqli->getInsertId($terzaProposta);
            $n_camere3     = count($_POST['TipoCamere3']);
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
                                                      '".$IdRichiesta."',
                                                      '".$IdProposta3."',
                                                      '".$_POST['TipoSoggiorno3'][$i]."',
                                                      '1',
                                                      '".$_POST['TipoCamere3'][$i]."',
                                                      '".$_POST['NumAdulti3'][$i]."',
                                                      '".$_POST['NumBambini3'][$i]."',
                                                      '".$_POST['EtaB3'][$i]."',
                                                      '".$_POST['Prezzo3'][$i]."')");
             }

             if($_POST['PrezzoServizio3'] != '') {
                foreach($_POST['PrezzoServizio3'] as $key3 => $value3){
                    $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta3."','".$key3."','".$_POST['num_persone_3_'.$key3]."','".$_POST['notti3_'.$key3]."')");
                }
            }
            if($_POST['VisibileServizio3'] != '') {
                foreach($_POST['VisibileServizio3'] as $key3 => $value3){
                    $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta3."','".$key3."','".$value3."')");
                }
            }
            ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
            $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta3."','".$_POST['SC3']."')");
      }

        // se la quarta proposta è compilata
        if($_POST['PrezzoP4']!=''){

            $DataArrivo4         = $_POST['DataArrivo4'];
            $DataPartenza4       = $_POST['DataPartenza4'];

                    $insProposta4 = "INSERT INTO hospitality_proposte(id_richiesta,
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
                                                        '".addslashes($_POST['NomeProposta4'])."',
                                                        '".addslashes($_POST['TestoProposta4'])."',
                                                        '".$_POST['CheckProposta4']."',
                                                        '".$_POST['PrezzoL4']."',
                                                        '".$_POST['PrezzoP4']."',
                                                        '".$_POST['AccontoPercentuale4']."',
                                                        '".$_POST['AccontoImporto4']."',
                                                        '".addslashes($_POST['EtichettaTariffa4'])."',
                                                        '".addslashes($_POST['AccontoTesto4'])."')";
                $quartaProposta = $dbMysqli->query($insProposta4);
                $IdProposta4    = $dbMysqli->getInsertId($quartaProposta);
                $n_camere4      = count($_POST['TipoCamere4']);
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
                                                        '".$IdRichiesta."',
                                                        '".$IdProposta4."',
                                                        '".$_POST['TipoSoggiorno4'][$i]."',
                                                        '1',
                                                        '".$_POST['TipoCamere4'][$i]."',
                                                        '".$_POST['NumAdulti4'][$i]."',
                                                        '".$_POST['NumBambini4'][$i]."',
                                                        '".$_POST['EtaB4'][$i]."',
                                                        '".$_POST['Prezzo4'][$i]."')");
                }

                if($_POST['PrezzoServizio4'] != '') {
                    foreach($_POST['PrezzoServizio4'] as $key4 => $value4){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta4."','".$key4."','".$_POST['num_persone_4_'.$key4]."','".$_POST['notti4_'.$key4]."')");
                    }
                }
                if($_POST['VisibileServizio4'] != '') {
                    foreach($_POST['VisibileServizio4'] as $key4 => $value4){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta4."','".$key4."','".$value4."')");
                    }
                }
            ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
            $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta4."','".$_POST['SC4']."')");
        }

        // se la quinta proposta è compilata
        if($_POST['PrezzoP5']!=''){

            $DataArrivo5         = $_POST['DataArrivo5'];
            $DataPartenza5       = $_POST['DataPartenza5'];

                    $insProposta5 = "INSERT INTO hospitality_proposte(id_richiesta,
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
                                                        '".addslashes($_POST['NomeProposta5'])."',
                                                        '".addslashes($_POST['TestoProposta5'])."',
                                                        '".$_POST['CheckProposta5']."',
                                                        '".$_POST['PrezzoL5']."',
                                                        '".$_POST['PrezzoP5']."',
                                                        '".$_POST['AccontoPercentuale5']."',
                                                        '".$_POST['AccontoImporto5']."',
                                                        '".addslashes($_POST['EtichettaTariffa5'])."',
                                                        '".addslashes($_POST['AccontoTesto5'])."')";
                $quintaProposta = $dbMysqli->query($insProposta5);
                $IdProposta5    = $dbMysqli->getInsertId($quintaProposta);
                $n_camere5      = count($_POST['TipoCamere5']);
                for($i=0; $i<=($n_camere5-1); $i++){
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
                                                        '".$IdRichiesta."',
                                                        '".$IdProposta5."',
                                                        '".$_POST['TipoSoggiorno5'][$i]."',
                                                        '1',
                                                        '".$_POST['TipoCamere5'][$i]."',
                                                        '".$_POST['NumAdulti5'][$i]."',
                                                        '".$_POST['NumBambini5'][$i]."',
                                                        '".$_POST['EtaB5'][$i]."',
                                                        '".$_POST['Prezzo5'][$i]."')");
                }

                if($_POST['PrezzoServizio5'] != '') {
                    foreach($_POST['PrezzoServizio5'] as $key5 => $value5){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta5."','".$key5."','".$_POST['num_persone_5_'.$key5]."','".$_POST['notti5_'.$key5]."')");
                    }
                }
                if($_POST['VisibileServizio5'] != '') {
                    foreach($_POST['VisibileServizio5'] as $key5 => $value5){
                        $dbMysqli->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta5."','".$key5."','".$value5."')");
                    }
                }
                ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                $dbMysqli->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta5."','".$_POST['SC5']."')");
        }
            ## relazione per inserire info box visibili nel template
            if(is_array($_POST['id_infobox']) && !is_null($_POST['id_infobox']) && !empty($_POST['id_infobox'])) {
                foreach($_POST['id_infobox'] as $key => $value){
                    $dbMysqli->query("INSERT INTO hospitality_rel_infobox_preventivo(idsito,id_richiesta,id_infobox) VALUES('".IDSITO."','".$IdRichiesta."','".$value."')");
                }
            }

            include($_SERVER['DOCUMENT_ROOT'].'/include/template/moduli/logs.inc.php');

            if($TipoRichiesta=='Conferma'){
                 header('Location:'.BASE_URL_SITO.'conferme/');
            }
            if($TipoRichiesta=='Preventivo'){
                header('Location:'.BASE_URL_SITO.'preventivi/');
            }

}
?>
