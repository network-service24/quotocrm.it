<?php
$VAUCHERCamere = '';
$sql = 'SELECT astext(coordinate),
                    siti.abilita_mappa,
                    siti.nome,
                    siti.https,
                    siti.web,
                    siti.indirizzo,
                    siti.tel,
                    siti.cap,
                    comuni.nome_comune,
                    province.nome_provincia,
                    province.sigla_provincia,
                    regioni.nome_regione,
                    utenti.logo
            FROM siti 
            INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
            INNER JOIN province ON province.codice_provincia = siti.codice_provincia
            INNER JOIN regioni ON regioni.codice_regione = siti.codice_regione
            INNER JOIN utenti ON utenti.idsito = siti.idsito 
            WHERE siti.idsito = '.IDSITO;
$rr = $db_suiteweb->query($sql); 
$row    =  $db_suiteweb->row($rr);

$NomeCliente    = $row['nome'];
$Indirizzo      = $row['indirizzo'];
$Tel            = $row['tel'];
$Localita       = $row['nome_comune'];
$Cap            = $row['cap'];
$Provincia      = $row['sigla_provincia'];
$abilita_mappa  = $row['abilita_mappa'];
$coor_tmp = str_replace("POINT(","",$row['astext(coordinate)']);
$coor_tmp = str_replace(")","",$coor_tmp);
$coor_tmp = explode(" ",$coor_tmp);
$latitudine = $coor_tmp[0];
$LatCliente = $coor_tmp[0];
$LonCliente = $coor_tmp[1];
$longitudine = $coor_tmp[1]; 
$sito_tmp    = str_replace("http://","",$row['web']);
$sito_tmp    = str_replace("www.","",$sito_tmp);
if($row['https']==1){
    $http = 'https://';
}else{
    $http = 'http://';
}
$SitoWeb   = $http.'www.'.$sito_tmp;     
$Logo        = $row['logo'];
if($abilita_mappa == 1){
    if($latitudine !='' && $longitudine != ''){
        $init_map = '<script>    
                    function init_map() {
                            var isDraggable = $(document).width() > 1024 ? true : false;
                            var var_location = new google.maps.LatLng('.$latitudine.','.$longitudine.');
                            
                                    var var_mapoptions = {
                                    center: var_location,
                                    zoom: 16
                                    };
                            
                            var var_marker = new google.maps.Marker({
                            position: var_location,
                            map: var_map,
                            scrollwheel: false,
                            draggable: isDraggable,
                            title:"'.$NomeCliente.'"});
                            
                            var var_map = new google.maps.Map(document.getElementById("map-container"),
                            var_mapoptions);
                        
                            var_marker.setMap(var_map); 
                
                    }
                
                    google.maps.event.addDomListener(window, \'load\', init_map);

                </script>'."\r\n"; 
    }
}
// query per estrarre dati social del cliente
$db->query("SELECT * FROM hospitality_social WHERE idsito = '".IDSITO."'");
$rw =  $db->row();

if($rw['Facebook']!=''){
   $Facebook   = '<a target="_blank" class="btn btn-social-icon btn-facebook btn-sm" href="'.$rw['Facebook'].'"><i class="fa fa-facebook"></i></a>'; 
}
if($rw['Twitter']!=''){
  $Twitter    = '<a target="_blank" class="btn btn-social-icon btn-twitter btn-sm" href="'.$rw['Twitter'].'"><i class="fa fa-twitter"></i></a>';  
}
if($rw['GooglePlus']!=''){
  $GooglePlus    = '<a target="_blank" class="btn btn-social-icon btn-google-plus btn-sm" href="'.$rw['GooglePlus'].'"><i class="fa fa-google-plus"></i></a>';  
}
if($rw['Instagram']!=''){
  $Instagram    = '<a target="_blank" class="btn btn-social-icon btn-instagram btn-sm" href="'.$rw['Instagram'].'"><i class="fa fa-instagram"></i></a>';  
}
if($rw['Linkedin']!=''){
  $Linkedin    = '<a target="_blank" class="btn btn-social-icon btn-linkedin btn-sm" href="'.$rw['Linkedin'].'"><i class="fa fa-linkedin"></i></a>' ; 
}
if($rw['Pinterest']!=''){
  $Pinterest    = '<a target="_blank" class="btn btn-social-icon btn-pinterest btn-sm" href="'.$rw['Pinterest'].'"><i class="fa fa-pinterest"></i></a>' ; 
}
if($rw['Tripadvisor']!=''){
    if(strstr($rw['Tripadvisor'], 'Hotel_Review')){
        $Tripadvisor = '<a target="_blank" href="'.$rw['Tripadvisor'].'" class="btn btn-social-icon btn-tripadvisor btn-sm"><i class="fa fa-tripadvisor"></i></a>';       
    }else{
        $Tripadvisor = '';
    }      
}


// query per estrarre dati della richiesta prenotazione
$select .= "SELECT hospitality_guest.* FROM hospitality_guest ";

if($_REQUEST['azione']==''){            
    $select .= " INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id";
}

$select .= " WHERE hospitality_guest.idsito = ".IDSITO." ";

if($_REQUEST['azione']!=''){
    $select .= " AND hospitality_guest.Id = ".$_REQUEST['azione'];
}else{
    $select .= " AND hospitality_guest.TipoRichiesta = 'Preventivo' AND hospitality_guest.Accettato = 0";
}

$select .= " ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.Id DESC";
$res =  $db->query($select);
$rows = $db->row($res);
if(is_array($rows)) {
    if($rows > count($rows)) 
        $tot = count($rows); 
}else{ 	
    $tot = 0;
}
if($tot > 0){
    $Id                 = $rows['Id'];
     if($_REQUEST['azione'] ==''){
        $TipoRichiesta = 'Preventivo';
    }else{
        $TipoRichiesta  = $rows['TipoRichiesta'];  
    }
    $Chiuso             = $rows['Chiuso'];
    $Archivia           = $rows['Archivia'];
    $id_politiche       = $rows['id_politiche'];
    $AccontoRichiesta   = $rows['AccontoRichiesta'];
    $AccontoLibero      = $rows['AccontoLibero'];
    $Operatore          = $rows['ChiPrenota'];
    $Nome               = stripslashes($rows['Nome']);
    $Cognome            = stripslashes($rows['Cognome']);
    $Email              = $rows['Email'];
    $Cellulare          = $rows['Cellulare'];
    $Lingua             = $rows['Lingua'];
    if($Lingua =='')$Lingua = 'it';
    $DataR_tmp          = explode("-",$rows['DataRichiesta']);
    $DataRichiestaCheck = $rows['DataRichiesta'];
    $DataRichiesta      = $DataR_tmp[2].'/'.$DataR_tmp[1].'/'.$DataR_tmp[0];
    $DataA_tmp          = explode("-",$rows['DataArrivo']);
    $DataArrivo         = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
    $DataP_tmp          = explode("-",$rows['DataPartenza']);
    $DataPartenza       = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];

    $DataValiditaVoucher_tmp  = explode("-",$rows['DataValiditaVoucher']);
    $DataValiditaVoucher      = $DataValiditaVoucher_tmp[2].'/'.$DataValiditaVoucher_tmp[1].'/'.$DataValiditaVoucher_tmp[0];
    $DataRiconferma     = $rows['DataRiconferma'];
    $_DataValiditaVoucher     = $rows['DataValiditaVoucher'];

    $NumeroPrenotazione = $rows['NumeroPrenotazione'];
    $NumeroAdulti       = $rows['NumeroAdulti'];
    $NumeroBambini      = $rows['NumeroBambini'];
    $DataS_tmp          = explode("-",$rows['DataScadenza']);
    $DataScadenza       = $DataS_tmp[2].'/'.$DataS_tmp[1].'/'.$DataS_tmp[0];    
    $EtaBambini1        = $rows['EtaBambini1'];
    $EtaBambini2        = $rows['EtaBambini2'];
    $EtaBambini3        = $rows['EtaBambini3'];
    $EtaBambini4        = $rows['EtaBambini4'];
    $EtaBambini5        = $rows['EtaBambini5'];
    $EtaBambini6        = $rows['EtaBambini6'];
    $start              = mktime(24,0,0,$DataA_tmp[1],$DataA_tmp[2],$DataA_tmp[0]);
    $end                = mktime(01,0,0,$DataP_tmp[1],$DataP_tmp[2],$DataP_tmp[0]);
    $formato="%a";
    $Notti = dateDiff($rows['DataArrivo'],$rows['DataPartenza'],$formato);


    $q_img = $db->query("SELECT img,NomeOperatore FROM hospitality_operatori WHERE  idsito = ".IDSITO." AND NomeOperatore = '".$Operatore."' AND Abilitato = 1");
    $img = $db->row($q_img);
    $ImgOp = $img['img'];
    if($img['NomeOperatore']==''){
        $disable = true;
      }else{
        $disable = false;
      }
      
    if($Nome == '' && $Cognome == '') {
        $Cliente = $NomeCliente;
    }else{
        $Cliente = $Nome.' '.$Cognome;
    }

    $q_t = $db->query("SELECT * FROM hospitality_contenuti_web WHERE TipoRichiesta = 'Conferma' AND idsito = ".IDSITO." AND Lingua = '".$Lingua."' AND Abilitato = 1");
    $s = $db->row($q_t);

    $q_text = $db->query("SELECT * FROM hospitality_contenuti_web WHERE TipoRichiesta = 'Preventivo' AND idsito = ".IDSITO." AND Lingua = '".$Lingua."' AND Abilitato = 1");
    $rs = $db->row($q_text);

    $q_text_alt = $db->query("SELECT * FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = '".$Id."' AND Lingua = '".$Lingua."' AND idsito = ".IDSITO."");
    $rs_alt     = $db->row($q_text_lat);
    if(is_array($rs_alt)) {
        if($rs_alt > count($rs_alt)) // se la pagina richiesta non esiste
            $tot_alt = count($rs_alt); // restituire la pagina con il numero più alto che esista
    }else{ 	
        $tot_alt = 0;
    }
    if($tot_alt>0 && $rs_alt['Testo']!=''){       
        $Testo         = str_replace("[cliente]",$Cliente,$rs_alt['Testo']);
        $TestoConferma = str_replace("[cliente]",$Cliente,$rs_alt['Testo']);
    }else{
        $Testo         = str_replace("[cliente]",$Cliente,$rs['Testo']);
        $TestoConferma = str_replace("[cliente]",$Cliente,$s['Testo']);
    }

    if(strstr($rs['Moduli'], 'Eventi')){
        $ModuliEventi  = true;   
    }else{
       $ModuliEventi  = false; 
    }
    if(strstr($rs['Moduli'], 'Punti di Interesse')){
        $ModuliPDI  = true;   
    }else{
       $ModuliPDI  = false; 
    }

    include(BASE_PATH_SITO.'/lingue/lang.php');

    switch($Lingua){
        case "it":
            $sconto = 'Sconto';
            $condizioni_tariffa  = 'Condizioni tariffa';
            $saldo_text = 'Cifra a saldo';
        break;
        case "en":
            $sconto = 'Discount';
            $condizioni_tariffa  = 'Tariff conditions';
            $saldo_text = 'Amount still to be paid';
        break;
        case "fr":
            $sconto = 'Réduction';
            $condizioni_tariffa  = 'Conditions tarifaires';
            $saldo_text = 'Montant restant à payer';
        break;
        case "de":
            $sconto = 'Rabatt';
            $condizioni_tariffa  = 'Tarifbedingungen';
        break;
        default:
            $sconto = 'Discount';
            $condizioni_tariffa  = 'Condizioni tariffa';
            $saldo_text = 'Noch zu zahlender Betrag';
        break;                                
    }    

    $db->query("SELECT 
            hospitality_proposte.Id as IdProposta,
            hospitality_proposte.Arrivo as Arrivo,
            hospitality_proposte.Partenza as Partenza,
            hospitality_proposte.NomeProposta as NomeProposta,
            hospitality_proposte.TestoProposta as TestoProposta,
            hospitality_proposte.CheckProposta as CheckProposta,
            hospitality_proposte.PrezzoL as PrezzoL,
            hospitality_proposte.PrezzoP as PrezzoP,
            hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
            hospitality_proposte.AccontoImporto as AccontoImporto,
            hospitality_proposte.AccontoTariffa as AccontoTariffa,
            hospitality_proposte.AccontoTesto as AccontoTesto
            FROM hospitality_proposte
                WHERE hospitality_proposte.id_richiesta = ".$Id."
                GROUP BY hospitality_proposte.Id");
    $rec = $db->result();
    //print_r($rec);
     $gallery_camera      = '';
     $CheckProposta       = '';            
     $TipoCamere          = ''; 
     $TipoSoggiorno       = '';        
     $PrezzoL             = '';
     $PrezzoP             = '';
     $NomeProposta        = ''; 
     $TestoProposta       = '';  
     $percentuale_sconto  = '';
     $AccontoPercentuale  = ''; 
     $AccontoImporto      = '';
     $AccontoTariffa      = '';  
     $AccontoTesto        = ''; 
     $Arrivo              = '';  
     $Partenza            = ''; 
     $A                   = '';  
     $P                   = ''; 

    $proposta .='<h3 class="proposta_title">'.($TipoRichiesta=='Preventivo'?PROPOSTE_PER_NR_ADULTI:SOGGIORNO_PER_NR_ADULTI).' <b>'.$NumeroAdulti .'</b>  '.($NumeroBambini!='0'?NR_BAMBINI.'  <b>'.$NumeroBambini .'</b>  '.($EtaBambini1!='' && $EtaBambini1!='0'?' - '.$EtaBambini1.' '.ANNI. ' ':'').($EtaBambini2!='' && $EtaBambini2!='0'?$EtaBambini2.' '.ANNI.' ':'').($EtaBambini3!='' && $EtaBambini3!='0'?$EtaBambini3.' '.ANNI.' ':'').($EtaBambini4!='' && $EtaBambini4!='0'?$EtaBambini4.' '.ANNI.' ':'').($EtaBambini5!='' && $EtaBambini5!='0'?$EtaBambini5.' '.ANNI.' ':'').($EtaBambini6!='' && $EtaBambini6!='0'?$EtaBambini6.' '.ANNI.' ':'').' ':'').' - '.NOTTI.' <b>'.$Notti.'</b></h3>';
    $proposta .='<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
    $n = 1;

    foreach ($rec as $key => $value) {

        $CheckProposta      = $value['CheckProposta'];                 
        $PrezzoL            = number_format($value['PrezzoL'],2,',','.');
        $PrezzoP            = number_format($value['PrezzoP'],2,',','.'); 
        $PrezzoPC           = $value['PrezzoP']; 
        $IdProposta         = $value['IdProposta'];  
        $NomeProposta       = stripslashes($value['NomeProposta']); 
        $TestoProposta      = stripslashes($value['TestoProposta']); 
        $AccontoPercentuale = $value['AccontoPercentuale'];
        $AccontoImporto     = $value['AccontoImporto'];
        $AccontoTariffa     = stripslashes($value['AccontoTariffa']); 
        $AccontoTesto       = stripslashes($value['AccontoTesto']); 
        $A_tmp              = explode("-",$value['Arrivo']);
        $A                  = $value['Arrivo'];
        $Arrivo             = $A_tmp[2].'/'.$A_tmp[1].'/'.$A_tmp[0];
        $P_tmp              = explode("-",$value['Partenza']);
        $P                  = $value['Partenza'];
        $Partenza           = $P_tmp[2].'/'.$P_tmp[1].'/'.$P_tmp[0];
        $Astart             = mktime(24,0,0,$A_tmp[1],$A_tmp[2],$A_tmp[0]);
        $Aend               = mktime(01,0,0,$P_tmp[1],$P_tmp[2],$P_tmp[0]);
        $formato="%a";
        $ANotti = dateDiff($value['Arrivo'],$value['Partenza'],$formato);

        if($PrezzoL!='0,00'){
            $percentuale_sconto =  str_replace(",00", "",number_format((100-(100*$value['PrezzoP'])/$value['PrezzoL']),2,',','.'));             
        }  
       

        if($n == 1){
            $style = 'style="height: auto;"';
            $class = 'class="panel-collapse in"';
        }else{
            $style = 'style="height: 0;"';
            $class = 'class="panel-collapse collapse"';                             
        }



    $proposta .= '<div class="panel panel-success" id="Proposte">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h3 class="panel-title" style="width:100%!important">
                          <a class="maiuscolo"  aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$n.'">
                            '.$n.'° '.($TipoRichiesta == 'Preventivo'?PROPOSTA:SOLUZIONECONFERMATA).'  <div class="box-tools pull-right"><i class="fa fa-caret-down text-white"></i>
                          </a>
                          
                        </h3>
                      </div>
                      <div '.$style.' id="collapse'.$n.'" '.$class.'>
                        <div class="panel-body">';
              if($NomeProposta!='' || $TestoProposta!=''){
                   $proposta .='<div class="row">
                                    <div class="col-md-12 text16">
                                        <b>'.$NomeProposta.'</b>
                                        <p>'.nl2br($TestoProposta).'</p>
                                    </div>
                                </div>';                
              }
              $select2 = "SELECT hospitality_richiesta.NumeroCamere,
                            hospitality_richiesta.Prezzo,
                            hospitality_richiesta.NumAdulti,
                            hospitality_richiesta.NumBambini,
                            hospitality_richiesta.EtaB,
                            hospitality_tipo_camere.Id as IdCamera,
                            
                            hospitality_tipo_camere.Servizi as Servizi,
                            hospitality_camere_testo.Camera as TitoloCamera,
                            hospitality_camere_testo.Descrizione as TestoCamera,
                            hospitality_tipo_soggiorno.TipoSoggiorno as TipoSoggiorno,
                            hospitality_tipo_soggiorno_lingua.Soggiorno as TitoloSoggiorno,
                            hospitality_tipo_soggiorno_lingua.Descrizione as TestoSoggiorno
                            FROM hospitality_richiesta 
                            INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                            INNER JOIN hospitality_camere_testo ON hospitality_camere_testo.camere_id = hospitality_tipo_camere.Id
                            INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                            INNER JOIN hospitality_tipo_soggiorno_lingua ON hospitality_tipo_soggiorno_lingua.soggiorni_id = hospitality_tipo_soggiorno.Id
                            WHERE hospitality_tipo_camere.idsito = ".IDSITO." 
                            AND hospitality_camere_testo.idsito = ".IDSITO." 
                            AND hospitality_tipo_soggiorno.idsito = ".IDSITO." 
                            AND hospitality_tipo_soggiorno_lingua.idsito = ".IDSITO." 
                            AND hospitality_richiesta.id_proposta = ".$IdProposta." 
                            AND hospitality_camere_testo.lingue = '".$Lingua."' 
                            AND hospitality_tipo_camere.Abilitato = 1
                            AND hospitality_tipo_soggiorno_lingua.lingue = '".$Lingua."'
                            AND hospitality_tipo_soggiorno.Abilitato = 1 
                            GROUP BY hospitality_richiesta.id
                            ORDER BY hospitality_richiesta.Id ASC " ;
                $result2 = $db->query($select2);
                $res2    = $db->result($result2); 

                $x       = 1;
                $Servizi = '';
                $serv    = '';
                $servizi = '';
                $services = '';
                $EtaB_ = '';
                $VAUCHERCamere = '';
                foreach ($res2 as $ky => $val) {
                    $Servizi         = $val['Servizi']; 
                    $NumeroCamere    = $val['NumeroCamere'];
                    $NumAdulti       = $val['NumAdulti'];
                    $NumBambini      = $val['NumBambini'];
                    switch($NumAdulti){
                        case 1:
                            $ico_adulti = '<i class="fa fa-male"></i>';
                        break;
                        case 2:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        case 3:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        case 4:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        case 5:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        case 6:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        default:
                            $ico_adulti = $NumAdulti;
                        break;
                    }
                    switch($NumBambini){
                        case 1:
                            $ico_bimbi = '<i class="fa fa-child"></i>';
                        break;
                        case 2:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        case 3:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        case 4:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        case 5:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        case 6:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        default:
                            $ico_bimbi = $NumBambini;
                        break;
                    }
                    
                    if($NumBambini>1){
                        $EtaB_           .= $val['EtaB'].',';
                        $EtaB            = substr($EtaB_,0,-1);
                        $EtaB            = (($EtaB!=' ,' && $EtaB!=',' && $EtaB!='' && $EtaB!=0 && !empty($EtaB))?$EtaB:''); 
                    }else{
                        $EtaB           = $val['EtaB'];
                    }

                    $IdCamera        = $val['IdCamera'];
                    $TipoCamere      = $val['TitoloCamera']; 
                    $TitoloCamera    = $val['TitoloCamera']; 
                    $TestoCamera     = $val['TestoCamera'];
                    $TipoSoggiorno   = $val['TipoSoggiorno'];  
                    $TitoloSoggiorno = $val['TitoloSoggiorno']; 
                    $TestoSoggiorno  = $val['TestoSoggiorno'];
                    $Prezzo          = number_format($val['Prezzo'],2,',','.');   
                    $FCamere .= $val['TitoloSoggiorno'].' - Nr. '.$val['NumeroCamere'].' '.$val['TitoloCamera'].' '.($DataRichiestaCheck > DATA_QUOTO_V2 ?($NumAdulti!=0?'A.'.$NumAdulti:'').' '.($NumBambini!=0?'B.'.$NumBambini:'').' '.($EtaB!=''?'<small>'.ETA.' '.$EtaB.'</small>':''):'').'- €. '.number_format($val['Prezzo'],2,',','.').' - ';
                
                    $VAUCHERCamere .= '<p>'.$val['TitoloSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TitoloCamera'].' '.($DataRichiestaCheck > DATA_QUOTO_V2 ?($NumAdulti!=0?$ico_adulti:'').' '.($NumBambini!=0?$ico_bimbi:'').' '.($NumBambini!=0?($EtaB!=''?''.ETA.' '.$EtaB.' ':''):''):'').' - €. '.number_format($val['Prezzo'],2,',','.').'</p>';
    
                if($Servizi != ''){

                  $serv = explode(",",$Servizi);
                  $services = array();
                  foreach ($serv as $key => $value) {
                          $q = "SELECT * FROM hospitality_servizi_camere_lingua WHERE Servizio = '".addslashes($serv[$key])."' AND idsito = ".IDSITO." ";
                          $r = $db->query($q);
                          $record = $db->row($r);
                          $id_servizio = $record['servizi_id'];
                          
                            if($id_servizio){
                              $qy = "SELECT * FROM hospitality_servizi_camere_lingua WHERE servizi_id = ".$id_servizio." AND lingue = '".$Lingua."' AND idsito = ".IDSITO." ";
                              $rs = $db->query($qy);
                              $val = $db->row($rs);    
                              $services[$record['servizi_id']] = $val['Servizio'];
                            }

                  }
                  //print_r($services);
                  $servizi = implode(", ",$services); 
                                   
                }


                if($x == 1){
                    $stile = 'style="height: auto;"';
                    $classe = 'class="panel-collapse in"';
                }else{
                    $stile = 'style="height: 0;"';
                    $classe = 'class="panel-collapse collapse"';                             
                }
              $proposta .='<div class="panel-group"  role="camere" aria-multiselectable="true">
                        <div class="panel panel-warning">
                          <div class="panel-heading" role="camere" >
                            <h3 class="panel-title" style="width:100%!important">
                              <a aria-expanded="true" data-toggle="collapse" data-parent="#camere" href="#collapse'.$x.'_'.$IdCamera.'">
                               '.$TitoloCamera.' <div class="box-tools pull-right"><i class="fa fa-caret-down"></i></div> 
                              </a>                             
                            </h3>
                          </div>
                          <div id="collapse'.$x.'_'.$IdCamera.'" '.$stile.' '.$classe.'>
                        <div class="panel-body panel-body-warning">';

     
            if($A != '' && $P != '' && $A != '0000-00-00' && $P != '0000-00-00'){
 
                    if($TipoRichiesta=='Preventivo'){
                        if($DataArrivo != $Arrivo || $DataPartenza != $Partenza){ 
                            $proposta .='   <div class="row">
                                                <div class="col-md-12">
                                                <b>'.DATEALTERNATIVE.':</b><br><i class="fa fa-calendar"></i> '.DATA_ARRIVO.' '.$Arrivo.' <i class="fa fa-calendar"></i> '.DATA_PARTENZA.' '.$Partenza.' <i class="fa fa-long-arrow-right"></i> '.NOTTI.' '.$ANotti.'
                                                </div>
                                            </div>
                                            <hr class="line_white">';
                        }
                      }elseif($TipoRichiesta=='Conferma'){
                          if($DataArrivo != $Arrivo ){
                              $DataArrivo = $Arrivo;
                              $Notti      = $ANotti;
                          }
                          if($DataPartenza != $Partenza){
                              $DataPartenza = $Partenza;
                              $Notti    = $ANotti;
                          }
                      }   

                }

                $proposta .='   <div class="row">
                                    <div class="col-md-12">';
                                       $proposta .= $TestoCamera;
                $proposta .='       </div>
                                </div>
                                <hr class="line_white">
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>'.SERVIZI_CAMERA.'</b>
                                        <p><em>'.$servizi.'</em></p>
                                    </div>
                                </div>
                                <hr class="line_white">
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>'.$TitoloSoggiorno.'</b><br>'; 
                                        $proposta .= $TestoSoggiorno;                                   
                $proposta .='            
                                </div>
                            </div>';

                                          
                $proposta .= '  <div class="row">
                                        <div class="col-md-12">
                                        <script>
                                        $(document).ready(function(){
                                                $("#slider'.$IdCamera.'_'.$IdProposta.'").responsiveSlides({
                                                        auto: true,
                                                        pager: false,
                                                        nav: true,
                                                        namespace: "centered-btns"
                                                    });
                                        });
                                        </script>';


                                            



                    $proposta .= ' 
                                </div>
                                </div>';



                    $proposta .= ' 
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                        </div>';

                    $proposta .='<table class="table table-bordered no_border_td">
                                    <tr>
                                        <td class="no_border_td"><b>'.SOGGIORNO.'<b></td>
                                        '.($DataRichiestaCheck > DATA_QUOTO_V2 && $NumAdulti!=0?'<td class="no_border_td" align="center"><b>'.ucfirst(strtolower(PERSONE)).'</b></td>':'').'
                                        <td class="no_border_td" align="center"><b>'.($DataRichiestaCheck > DATA_QUOTO_V2?NOTTI:'Nr. '.CAMERA).'</b></td>                                     
                                        <td class="no_border_td" align="center"><b>'.PREZZO_CAMERA.'</b></td>
                                    </tr>
                                    <tr>
                                        <td class="panel-body-warning border_td_white"><p>
                                            <a href="javascript:;" data-toggle="tooltip" title="'.(strlen($TestoSoggiorno)>=300?strip_tags(substr($TestoSoggiorno,0,300).' ...'):strip_tags($TestoSoggiorno)).'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>
                                            '.$TitoloSoggiorno.' - '.($DataRichiestaCheck > DATA_QUOTO_V2?'nr.'.$NumeroCamere:'').' '.$TitoloCamera.'</p>
                                        </td>
                                        '.($DataRichiestaCheck > DATA_QUOTO_V2  && $NumAdulti!=0?'<td align="center" class="panel-body-warning border_td_white"><span data-toogle="tooltip" data-html="true" title="'.($NumAdulti!=0?ADULTI.' <b>'.$NumAdulti.'</b>':'').' <br>'.($NumBambini!=0?BAMBINI.' <b>' .$NumBambini.'</b>':'').'">'.($NumAdulti!=0?$ico_adulti:'').' '.($NumBambini!=0?$ico_bimbi:'').' '.($EtaB!=''?'<small>'.ETA.' '.$EtaB.'</small>':'').'</span></td>':'').'
                                        <td align="center" class="panel-body-warning border_td_white"><p>'.($DataRichiestaCheck > DATA_QUOTO_V2?($ANotti!=''?$ANotti:$Notti):$NumeroCamere).'</p></td>
                                        <td align="center" class="panel-body-warning border_td_white"><p>€. '.$Prezzo .'</p></td>
                                    </tr>
                                </table>';  
                  
    $x++;

    }
        // Query per servizi aggiuntivi
        $query  = "SELECT hospitality_tipo_servizi.*,hospitality_relazione_servizi_proposte.num_persone,hospitality_relazione_servizi_proposte.num_notti FROM hospitality_relazione_servizi_proposte 
                    INNER JOIN hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id 
                    WHERE hospitality_tipo_servizi.idsito = ".IDSITO." 
                    AND hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta."' 
                    AND hospitality_tipo_servizi.Abilitato = 1
                    ORDER BY hospitality_tipo_servizi.TipoServizio ASC";
        $risultato_query = $db->query($query);
        $record          = $db->result($risultato_query);
        if(sizeof($record)>0){



            $q = "SELECT * FROM hospitality_relazione_servizi_proposte WHERE id_richiesta = ".$Id." AND id_proposta = ".$IdProposta;
            $r = $db->query($q);
            $r = $db->result($r);
            $IdServizio = array();
            foreach($r as $k => $v){
                $IdServizio[$v['servizio_id']]=1;
            }

            #### CONTROLLO I SERVIZI AGGIUNTIVI SCELTI DALL'UTENTE FINALE
            $quy = "SELECT Id FROM hospitality_guest WHERE NumeroPrenotazione = ".$NumeroPrenotazione."  AND TipoRichiesta = 'Preventivo' AND idsito = ".IDSITO." ";
            $ese = $db->query($quy);
            $rec = $db->row($ese);
            if(is_array($rec)) {
                if($rec > count($rec))
                    $checkRec = count($rec);
            }else{
                $checkRec = 0;
            }
            if($checkRec>0){
                $qry = "SELECT hospitality_relazione_servizi_proposte.servizio_id FROM hospitality_relazione_servizi_proposte WHERE id_richiesta = ".$rec['Id']." AND idsito = ".IDSITO." ";
                $exe = $db->query($qry);
                $rce = $db->result($exe);
                $IdServizioScelto = array();
                foreach($rce as $ki => $vl){
                    $IdServizioScelto[$vl['servizio_id']]=1;

                }
            }
            ### FINE CONTROLLO


            $SERVIZIAGGIUNTIVI .='<style>
                                        .iconaDimension {
                                            width:auto !important;
                                            height:32px !important;
                                        } 
                                        .bg-transparent{
                                            background:transparent !important;
                                            background-color:transparent !important;
                                        }
                                        .small-padding{
                                            padding:2px !important;
                                        }
                                    </style>
                                    <table class="table table-responsive bg-transparent">
                                <tr>
                                    <td class="no_border_td" colspan="4" style="width:100%" ><b>'.SERVIZI_AGGIUNTIVI.'</b></td>
                                </tr>';
            $n_notti = '';
            foreach($record as $chiave => $campo){

                $q   = "SELECT hospitality_tipo_servizi_lingua.* FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".IDSITO." AND hospitality_tipo_servizi_lingua.lingue = '".$Lingua."'";
                $r   = $db->query($q);
                $rec = $db->row($r);

                if($TipoRichiesta=='Preventivo'){
                    if($DataArrivo != $Arrivo || $DataPartenza != $Partenza){
                      $n_notti = $ANotti;
                    }else{
                      $n_notti = $Notti;
                    }
                  }elseif($TipoRichiesta=='Conferma'){
                    if($DataArrivo != $Arrivo ){
                        $n_notti = $ANotti;
                    }
                    if($DataPartenza != $Partenza){
                        $n_notti = $ANotti;
                    }
                }  
                switch($campo['CalcoloPrezzo']){
                    case "Al giorno":
                        $calcoloprezzo = AL_GIORNO;
                        $num_persone = '';
                        $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.($ANotti!=''?$ANotti:$Notti).')</small>':'');
                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*($ANotti!=''?$ANotti:$Notti)),2,',','.'):'<small class="text-green">Gratis</small>');
                    break;
                    case "A percentuale":
                        $calcoloprezzo = 'A percentuale';
                        $num_persone = '';
                        $CalcoloPrezzoServizio = '';
                        $PrezzoServizio = ($campo['PercentualeServizio']!=''?'<i class="fa fa-percent"></i>&nbsp;&nbsp;'.number_format(($campo['PercentualeServizio']),2):'');
                      break;
                    case "Una tantum":
                        $calcoloprezzo = UNA_TANTUM;
                        $num_persone = '';
                        $CalcoloPrezzoServizio = '';
                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format($campo['PrezzoServizio'],2,',','.'):'<small class="text-green">Gratis</small>');
                    break;
                    case "A persona":
                      $calcoloprezzo = A_PERSONA;
                      $num_persone = $campo['num_persone'];
                      $num_notti = $campo['num_notti'];
                      $CalcoloPrezzoServizio = '<span style="font-size:80%">'.($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.$campo['num_notti'].'  <span style="font-size:80%">gg</span> x '.$campo['num_persone'].' <small>pax</small>)</small>':'('.$campo['num_notti'].'  <span style="font-size:80%">gg</span> x '.$campo['num_persone'].' <small>pax</small>)').'</span>';
                      $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*$campo['num_notti']*$campo['num_persone']),2,',','.'):'<small class="text-green">Gratis</small>');
                    break;
                  }               
                    $SERVIZIAGGIUNTIVI .='<tr>
                                    <td style="width:1%" class="no_border_td text-center"> '.((!$IdServizioScelto[$campo['Id']] && $IdServizio[$campo['Id']]==1)? '<small><i class="fa fa-user"></i></small>':'').'</td>
                                    <td style="width:9%" class="no_border_td text-center"><img src="'.BASE_URL_ROOT.'class/resize.class.php?src='.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'&w=32&h=32&a=c&q=100" class="iconaDimension"></td>
                                    <td style="width:35%"  class="no_border_td"><p>
                                    '.($rec['Descrizione']!=''?'<a href="javascript:;" data-toggle="tooltip" title="'.(strlen($rec['Descrizione'])<=300?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,300).'...').'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>':'').' '.$rec['Servizio'].'</p></td>
                                    <td style="width:30%"  class="no_border_td text-center"><p><small>'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</small></p></td>
                                    <td style="width:25%"  class="no_border_td text-center"><p>'.$PrezzoServizio.'</p></td>
                                
                                </tr>';

            }
            $SERVIZIAGGIUNTIVI .='</table>';
        }  
        $proposta .= $SERVIZIAGGIUNTIVI;
                $proposta .= ' <div class="row">
                                            <div class="col-md-8">
                                                '.($PrezzoL!='0,00'?'<h5 class="text20"> '.PREZZO.' '.DA_LISTINO.'   <b class="text30">€. <strike>'.$PrezzoL.'</strike></b></h5>':'').'
                                                '.($PrezzoL!='0,00'?'<h5 class="text20"> '.$sconto.' <b class="text20 text-green">'.$percentuale_sconto.' %</b></h5>':'').'
                                                <h5 class="text22">'.PREZZO.' '.E_PROPOSTO.' <b class="text38red">€. '.$PrezzoP.'</b></h5>';
                            if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                                 $proposta .= '<br><h5 class="text20">'.CAPARRA.': '.$AccontoPercentuale.' %  - <b class="text20">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b></h5>';                                     
                            }
                            if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                                if($AccontoImporto >= 1){
                                    $proposta .= '<br><h5 class="text20">'.CAPARRA.':  <b class="text20">€. '.number_format($AccontoImporto,2,',','.').'</b></h5>';
                                }else{
                                    $proposta .= '<br><h5 class="text20">'.CARTACREDITOGARANZIA.'</h5>';
                                }                                     
                            }
                            if($AccontoTariffa!='' || $AccontoTesto!=''){
                               
                                $proposta .= '<br><h5 class="text20"><span id="tarif'.$n.'" style="cursor:pointer"><i class="fa fa-question-circle" aria-hidden="true"></i> '.($AccontoTariffa!=''?$AccontoTariffa:$condizioni_tariffa).'</span></h5>
                                                <script>
                                                    $( "#tarif'.$n.'" ).click(function() {
                                                      $( "#cond_tarif'.$n.'" ).toggle( "slow", function() {
                                                        // Animation complete.
                                                      });
                                                    });
                                                </script>';
                            }
                                               
                $proposta .= '              </div>
                                            <div class="col-md-4 text-right">';

                                            if($TipoRichiesta == 'Preventivo'){

                                                    if(!$_REQUEST['result']){  
                                                        $proposta .= '<button href="#" class="btn btn-danger btn-lg '.($Lingua =='it'?'text24':'text18').'" id="button_conf'.$n.'">'.CONFERMA.' '.PROPOSTA.' <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                                                                      <br><br>
                                                                      <button href="#" id="button_footer" class="btn btn-warning '.($Lingua =='it'?'':'text12').'"><i class="fa fa-comments-o fa-2x"></i> '.SCRIVICI_SE_HAI_BISOGNO.'</button>';

                                                    }
                                            }  

                $proposta .='               </div>
                                        </div>';
                if($AccontoTariffa!='' || $AccontoTesto!=''){
                    $proposta .= '<div id="cond_tarif'.$n.'" style="display:none">
                                    <div class="row">
                                            <div class="col-md-12">
                                                <p><small>'.nl2br($AccontoTesto).'</small></p>
                                            </div>
                                    </div>
                                </div>';
                }

            $proposta .='      </div>';                    
            $proposta .= '</div>
            </div>';
    $n++;
}
$AccontoTariffa     = ''; 


$proposta .= '</div>';




$sel_cg = "SELECT * FROM hospitality_politiche_lingua WHERE idsito = ".IDSITO." AND id_politiche = ".$id_politiche." AND Lingua = '".$Lingua."' ORDER BY id DESC";
$re_cg  = $db->query($sel_cg);
$rw     = $db->row($re_cg);

}
 $select = " SELECT 
                hospitality_carte_credito.*
            FROM 
                hospitality_carte_credito
            WHERE 
                hospitality_carte_credito.id_richiesta = ".$Id." 
            AND 
                hospitality_carte_credito.idsito = ".IDSITO." ";

    $result = $db->query($select);
    $row    = $db->row($result);

    if(is_array($row)) {
        if($row > count($row)) 
            $check_cc = count($row); 
    }else{ 	
        $check_cc = 0;
    }

    if($check_cc > 0){

        $TipologiaPagamento = $row['carta'];

        $GiaPagatoCC = true;
    }else{
        $GiaPagatoCC = false;
    }

    $select2 = " SELECT 
                    hospitality_altri_pagamenti.*
                FROM 
                    hospitality_altri_pagamenti
                WHERE 
                    hospitality_altri_pagamenti.id_richiesta = ".$Id." 
                AND 
                    hospitality_altri_pagamenti.idsito = ".IDSITO." ";

    $result2 = $db->query($select2);
    $row2    = $db->row($result);
    
    if(is_array($row2)) {
        if($rows > count($row2)) 
            $check_pay = count($row2); 
    }else{ 	
        $check_pay = 0;
    }

    if($check_pay > 0){

        $TipologiaPagamento = $row2['TipoPagamento'];

       $GiaPagatoPAY = true;
    }else{
        $GiaPagatoPAY = false;
    }
switch($Lingua){
    case "it":
        $FRASE_CAPARRA = 'L\'importo richiesto è stato pagato tramite [tipopagamento]';
        $CARTA_A_GARANZIA = 'L\'importo richiesto è stato fissato con carta [tipopagamento]  a garanzia';
        $NESSUN_PAGAMENTO = 'Nessun pagamento è stato ancora effettuato!';
    break;
    case "en":
        $FRASE_CAPARRA = 'The requested amount has been paid via [tipopagamento]';
        $CARTA_A_GARANZIA = 'The amount requested was fixed with a [tipopagamento] guarantee card';
        $NESSUN_PAGAMENTO = 'No payment has been made yet! ';
    break;
    case "fr":
        $FRASE_CAPARRA = 'Le montant demandé a été payé via [tipopagamento]';
        $CARTA_A_GARANZIA = 'Le montant demandé a été fixé avec une carte [tipopagamento] comme garantie';
        $NESSUN_PAGAMENTO = 'Aucun paiement n\'a encore été effectué! ';
    break;
    case "de":
        $FRASE_CAPARRA = 'Der angeforderte Betrag wurde über [tipopagamento] bezahlt';
        $CARTA_A_GARANZIA = 'Der angeforderte Betrag wurde mit einer [tipopagamento] -Karte als Garantie festgelegt';
        $NESSUN_PAGAMENTO = 'Es wurde noch keine Zahlung geleistet!' ;
    break;

}

#pulsante indietro per il preview
if($_REQUEST['azione']!=''){
    if($TipoRichiesta == 'Preventivo' && $Archivia == 0){
      $TornaA = BASE_URL_SITO.'preventivi/';
      $Etichetta = 'ai Preventivi';
    }elseif($TipoRichiesta == 'Conferma' && $Chiuso == 0 && $Archivia == 0){
      $TornaA = BASE_URL_SITO.'conferme/';
      $Etichetta = 'alle Conferme';
    }elseif($TipoRichiesta == 'Conferma' && $Chiuso == 1 && $Archivia == 0){
      $TornaA = BASE_URL_SITO.'prenotazioni/';
      $Etichetta = 'alle Prenotazioni';
    }elseif($Archivia == 1){
      $TornaA = BASE_URL_SITO.'archivio/';
      $Etichetta = 'all\'Archivio';
    }
    $PulsanteIndietro = '<a class="btn btn-warning" href="'.$TornaA.'"><i class="fa fa-arrow-left"></i> Torna indietro '.$Etichetta.'</a>';
  }