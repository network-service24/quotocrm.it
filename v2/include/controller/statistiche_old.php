<?
$split_graph = '';

if($_REQUEST['check_date']!='' || $_REQUEST['DataArrivo_al']!='' || $_REQUEST['DataPartenza_al']!=''){
    $split_graph = true;
}else{
    $split_graph = false;
}

if($_REQUEST['querydate']==''){

    $prima_data   = date('Y').'-01-01';
    $seconda_data = date('Y').'-12-31';
    $filter_query = " AND DataRichiesta >= '".$prima_data."' AND DataRichiesta <= '".$seconda_data."' ";

}else{

    $prima_data   = $_REQUEST['querydate'].'-01-01';
    $seconda_data = $_REQUEST['querydate'].'-12-31';
    $filter_query = " AND DataRichiesta >= '".$prima_data."' AND DataRichiesta <= '".$seconda_data."' ";
}

if($_REQUEST['action']=='check_date'){

    $DataArrivo_dal_tmp = explode("/",$_REQUEST['DataArrivo_dal']);
    $DataArrivo_dal = $DataArrivo_dal_tmp[2].'-'.$DataArrivo_dal_tmp[1].'-'.$DataArrivo_dal_tmp[0]; 
    
    $DataArrivo_al_tmp = explode("/",$_REQUEST['DataArrivo_al']);
    $DataArrivo_al = $DataArrivo_al_tmp[2].'-'.$DataArrivo_al_tmp[1].'-'.$DataArrivo_al_tmp[0]; 

    $DataPartenza_dal_tmp = explode("/",$_REQUEST['DataPartenza_dal']);
    $DataPartenza_dal = $DataPartenza_dal_tmp[2].'-'.$DataPartenza_dal_tmp[1].'-'.$DataPartenza_dal_tmp[0]; 

    $DataPartenza_al_tmp = explode("/",$_REQUEST['DataPartenza_al']);
    $DataPartenza_al = $DataPartenza_al_tmp[2].'-'.$DataPartenza_al_tmp[1].'-'.$DataPartenza_al_tmp[0];    

    if($_REQUEST['DataArrivo_dal']){
        $filter_query .= " AND DataArrivo >= '".$DataArrivo_dal."' ";
    }
    if($_REQUEST['DataPartenza_dal']){
        $filter_query .= " AND DataPartenza >= '".$DataPartenza_dal."'  ";
    }
    if($_REQUEST['DataArrivo_al']){
        $filter_query2 .= " AND DataArrivo <= '".$DataArrivo_al."' ";
    }
    if($_REQUEST['DataPartenza_al']){
        $filter_query2 .= " AND DataPartenza <= '".$DataPartenza_al."' ";
    }

}
if($_REQUEST['action']=='request_date'){

    $DataRichiesta_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
    $DataRichiesta_dal = $DataRichiesta_dal_tmp[2].'-'.$DataRichiesta_dal_tmp[1].'-'.$DataRichiesta_dal_tmp[0]; 
    $DataRichiesta_al_tmp = explode("/",$_REQUEST['DataRichiesta_al']);
    $DataRichiesta_al = $DataRichiesta_al_tmp[2].'-'.$DataRichiesta_al_tmp[1].'-'.$DataRichiesta_al_tmp[0]; 

    $filter_query = " AND DataRichiesta >= '".$DataRichiesta_dal."' AND DataRichiesta <= '".$DataRichiesta_al."'";
}

$diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
$anniprima = (date('Y')-$diff_anni);
    for($i=$anniprima; $i<=date('Y'); $i++){
        $lista_anni .='<option value="'.$i.'" '.(($_REQUEST['querydate']=='' || $i==$_REQUEST['querydate'])?'selected="selected"':'').'>'.$i.'</option>';
    }

$select = "SELECT FontePrenotazione, Abilitato FROM hospitality_fonti_prenotazione WHERE idsito = ".IDSITO."";
$res = $db->query($select);
$rws = $db->result($res);
$tot = sizeof($rws);
if($tot>0){
    foreach ($rws as $key => $value) {

        $select2 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                FROM hospitality_guest 
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                WHERE hospitality_guest.FontePrenotazione = '".$value['FontePrenotazione']."'
                                ".$filter_query ."
                                AND hospitality_guest.idsito = ".IDSITO." 
                                AND hospitality_guest.Chiuso = 1  
                                AND hospitality_guest.Disdetta = 0 
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res2 = $db->query($select2);
        $rws2 = $db->row($res2);
        $fatturato = $rws2['fatturato'];
        if($fatturato == '')$fatturato = 0;
        $array_fatturato[$value['FontePrenotazione'].'_'.$value['Abilitato']]  = $fatturato;

    }

    $k = '';
    foreach ($array_fatturato as $k => $v) {

        $k_tmp     =explode("_",$k);
        $k         = $k_tmp[0];
        $abilitato = $k_tmp[1];

        switch(strtolower($k)){
            case 'sito web':
                $color = '#f39c12';
                $highlight = '#f39c12';
                $label = 'Sito Web';
            break;
            case 'posta elettronica':
                $color = '#f56954';
                $highlight = '#f56954';
                $label = 'Posta Elettronica';
            break;
            case 'info alberghi':
                $color = '#605ca8';
                $highlight = '#605ca8';
                $label = 'Info Alberghi';
            break;
            case 'gabiccemare.com':
                $color = '#dd4b39';
                $highlight = '#dd4b39';
                $label = 'gabiccemare.com';
            break;            
            case 'reception':
                $color = '#39cccc';
                $highlight = '#39cccc';
                $label = 'Reception';
            break; 
            case 'telefono':
                $color = '#f012be';
                $highlight = '#f012be';
                $label = 'Telefono';
            break;
            case 'telefonata':
                $color = '#f012be';
                $highlight = '#f012be';
                $label = 'Telefonata';
            break;            
            case 'whatsapp':
                $color = '#00a65a';
                $highlight = '#00a65a';
                $label = 'Whatsapp';
            break;
            case 'facebook':
                $color = '#3c8dbc';
                $highlight = '#3c8dbc';
                $label = 'Facebook';
            break;        
            default:
                $color = colorGen();
                $highlight = colorGen();
                $label = $k;
            break;

        }

        if($v!="" || $v!=0){
            $etichette_f[] = "'".$k."'";
            $torta[] = "{value: ".$v.", name: '".$label."'}";
        }
            
        $legenda .= '<div class="row">';
        $legenda .= '<div class="col-md-6"><label class="badge" style="background-color:'.$color.'">'.$label.'</label>'.($abilitato==0?' <small>(non attivo)</small>':'').'</div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($v,2,',','.').'</div>';
        $legenda .= '</div>';

        $totale += $v;

    }
        $legenda .= '<div class="row">';
        $legenda .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($totale,2,',','.').'</div>';
        $legenda .= '</div>';
}
//PROVENINEZA DA SITO Web

$select3 = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = ".IDSITO." AND Provenienza LIKE '%google%' AND Timeline NOT LIKE '%gclid%'";
$res3 = $db->query($select3);
$rws3 = $db->result($res3);
$totOrganico = sizeof($rws3);
if($totOrganico>0){
    foreach ($rws3 as $key3 => $value3) {
        $NumeriPreno[] = $value3['NumeroPrenotazione'];
    }
        $NumeriO = implode(',',$NumeriPreno);

         $select4 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                    FROM hospitality_guest 
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                    WHERE hospitality_guest.NumeroPrenotazione IN (".$NumeriO.")
                                    ".$filter_query ."
                                    AND hospitality_guest.idsito = ".IDSITO." 
                                    AND hospitality_guest.Chiuso = 1 
                                    AND hospitality_guest.FontePrenotazione = 'Sito Web' 
                                    AND hospitality_guest.Disdetta = 0 
                                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res4 = $db->query($select4);
            $rws4 = $db->row($res4);
            $fatturatoOrganico = $rws4['fatturato'];
            if($fatturatoOrganico == '')$fatturatoOrganico = 0;
            $array_fatturatoS['Organico']  = $fatturatoOrganico;
}
$select5 = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = ".IDSITO." AND Provenienza LIKE '%".SITOWEB."%' AND Provenienza NOT LIKE '%gclid%' AND Provenienza NOT LIKE '%utm_source%' AND Provenienza NOT LIKE '%facebook%' AND Timeline NOT LIKE '%gclid%'";
$res5 = $db->query($select5);
$rws5 = $db->result($res5);
$totDirect = sizeof($rws5);
if($totDirect>0){
    foreach ($rws5 as $key5 => $value5) {
        $NumeriPrenoD[] = $value5['NumeroPrenotazione'];
    }
       $NumeriD = implode(',',$NumeriPrenoD);

         $select6 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                    FROM hospitality_guest 
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                    WHERE hospitality_guest.NumeroPrenotazione IN (".$NumeriD.")
                                    ".$filter_query ."
                                    AND hospitality_guest.idsito = ".IDSITO." 
                                    AND hospitality_guest.Chiuso = 1 
                                    AND hospitality_guest.FontePrenotazione = 'Sito Web' 
                                    AND hospitality_guest.Disdetta = 0 
                                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res6 = $db->query($select6);
            $rws6 = $db->row($res6);
            $fatturatoDirect = $rws6['fatturato'];
            if($fatturatoDirect == '')$fatturatoDirect = 0;
            $array_fatturatoS['Diretto']  = $fatturatoDirect;
}
$select7 = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = ".IDSITO." AND (Provenienza LIKE '%facebook%'  OR Timeline LIKE '%facebook%')";
$res7 = $db->query($select7);
$rws7 = $db->result($res7);
$totSocial = sizeof($rws7);
if($totSocial>0){
    foreach ($rws7 as $key7 => $value7) {
        $NumeriPrenoS[] = $value7['NumeroPrenotazione'];
    }
       $NumeriS = implode(',',$NumeriPrenoS);

         $select8 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                    FROM hospitality_guest 
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                    WHERE hospitality_guest.NumeroPrenotazione IN (".$NumeriS.")
                                   ".$filter_query ."
                                    AND hospitality_guest.idsito = ".IDSITO." 
                                    AND hospitality_guest.Chiuso = 1 
                                    AND hospitality_guest.FontePrenotazione = 'Sito Web' 
                                    AND hospitality_guest.Disdetta = 0 
                                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res8 = $db->query($select8);
            $rws8 = $db->row($res8);
            $fatturatoSocial = $rws8['fatturato'];
            if($fatturatoSocial == '')$fatturatoSocial = 0;           
            $array_fatturatoS['Facebook']  = $fatturatoSocial;
}
$select9 = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = ".IDSITO." AND (Provenienza LIKE '%utm_medium%' OR Timeline LIKE '%utm_medium%')";
$res9 = $db->query($select9);
$rws9 = $db->result($res9);
$totMail = sizeof($rws9);
if($totMail>0){
    foreach ($rws9 as $key9 => $value9) {
        $NumeriPrenoM[] = $value9['NumeroPrenotazione'];
    }
       $NumeriM = implode(',',$NumeriPrenoM);

         $select10 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                    FROM hospitality_guest 
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                    WHERE hospitality_guest.NumeroPrenotazione IN (".$NumeriM.")
                                    ".$filter_query ."
                                    AND hospitality_guest.idsito = ".IDSITO." 
                                    AND hospitality_guest.Chiuso = 1 
                                    AND hospitality_guest.FontePrenotazione = 'Sito Web' 
                                    AND hospitality_guest.Disdetta = 0 
                                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res10 = $db->query($select10);
            $rws10 = $db->row($res10);
            $fatturatoMail = $rws10['fatturato'];
            if($fatturatoMail == '')$fatturatoMail = 0;           
            $array_fatturatoS['Newsletter']  = $fatturatoMail;
}
$select11 = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = ".IDSITO." AND (Provenienza LIKE '%gclid%' OR Timeline LIKE '%gclid%')";
$res11 = $db->query($select11);
$rws11 = $db->result($res11);
$totPPC = sizeof($rws11);
if($totPPC>0){
    foreach ($rws11 as $key11 => $value11) {
        $NumeriPrenoPPC[] = $value11['NumeroPrenotazione'];
    }
       $NumeriPPC = implode(',',$NumeriPrenoPPC);

         $select12 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                    FROM hospitality_guest 
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                    WHERE hospitality_guest.NumeroPrenotazione IN (".$NumeriPPC.")
                                    ".$filter_query ."
                                    AND hospitality_guest.idsito = ".IDSITO." 
                                    AND hospitality_guest.Chiuso = 1 
                                    AND hospitality_guest.FontePrenotazione = 'Sito Web' 
                                    AND hospitality_guest.Disdetta = 0 
                                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res12 = $db->query($select12);
            $rws12 = $db->row($res12);
            $fatturatoPPC = $rws12['fatturato'];
            if($fatturatoPPC == '')$fatturatoPPC = 0;           
            $array_fatturatoS['PPC']  = $fatturatoPPC;
}
$select13 = "SELECT * FROM hospitality_fonti_provenienza WHERE idsito = ".IDSITO." AND Provenienza NOT LIKE '%facebook%' AND Provenienza NOT LIKE '%".SITOWEB."%' AND Provenienza NOT LIKE '%google%' AND Timeline NOT LIKE '%gclid%' AND Timeline NOT LIKE '%utm_medium=email%'";
$res13 = $db->query($select13);
$rws13 = $db->result($res13);
$totOTH = sizeof($rws13);
if($totOTH>0){
    foreach ($rws13 as $key13 => $value13) {
        $NumeriPrenoOTH[] = $value13['NumeroPrenotazione'];
    }
       $NumeriOTH = implode(',',$NumeriPrenoOTH);

         $select14 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                    FROM hospitality_guest 
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                    WHERE hospitality_guest.NumeroPrenotazione IN (".$NumeriOTH.")
                                    ".$filter_query ."
                                    AND hospitality_guest.idsito = ".IDSITO." 
                                    AND hospitality_guest.Chiuso = 1 
                                    AND hospitality_guest.FontePrenotazione = 'Sito Web' 
                                    AND hospitality_guest.Disdetta = 0 
                                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res14 = $db->query($select14);
            $rws14 = $db->row($res14);
            $fatturatoOTH = $rws14['fatturato'];
            if($fatturatoOTH == '')$fatturatoOTH = 0;           
            $array_fatturatoS['Referral/Altro']  = $fatturatoOTH;
}
if(!empty($array_fatturatoS) || !is_null($array_fatturatoS)){
    $x = '1';
    foreach ($array_fatturatoS as $y => $val) {

        switch(($x)){
            case '1':
                $colorS = '#f39c12';
                $highlightS = '#f39c12';

            break;
            case '2':
                $colorS = '#f56954';
                $highlightS = '#f56954';

            break;
            case '3':
                $colorS = '#605ca8';
                $highlightS = '#605ca8';

            break;
            case '4':
                $colorS = '#39cccc';
                $highlightS = '#39cccc';

            break; 
            case '5':
                $colorS = '#f012be';
                $highlightS = '#f012be';

            break;
            case '6':
                $colorS = '#00a65a';
                $highlightS = '#00a65a';

            break;
            case '7':
                $colorS = '#3c8dbc';
                $highlightS = '#3c8dbc';

            break;        
            default:
                $colorS = colorGen();
                $highlight = colorGen();

            break;

        }
        if($val!="" || $val != 0){

            $etichette_S[] = "'".$y."'";
            $tortaS[] = "{value: ".$val.", name: '".$y."'}";

            $totaleS += $val;

            $legendaS .= '<div class="row">';
            $legendaS .= '<div class="col-md-6"><label class="badge" style="background-color:'.$colorS.'">'.str_replace("http://","",$y).'</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($val,2,',','.').'</div>';
            $legendaS .= '</div>';
        }
    $x++;
    }
        $legendaS .= '<div class="row">';
        $legendaS .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($totaleS,2,',','.').'</div>';
        $legendaS .= '</div>';

}

// FATTURATO PER OPERATORI
// 
// Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
$select15 = "SELECT * FROM hospitality_operatori WHERE idsito = ".IDSITO."";
$res15 = $db->query($select15);
$rws15 = $db->result($res15);
$totOperatore = sizeof($rws15);
if($totOperatore>0){

    $operatore = '';
    $abilitatoOP = '';

    foreach ($rws15 as $key15 => $value15) {

        $operatore = trim(addslashes($value15['NomeOperatore']));
        $abilitatoOP = $value15['Abilitato'];


                $select16  = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                        FROM hospitality_guest 
                                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                        WHERE hospitality_guest.ChiPrenota = '".$operatore."' 
                                        ".$filter_query ."
                                        AND hospitality_guest.idsito = ".IDSITO." 
                                        AND hospitality_guest.Chiuso = 1                                     
                                        AND hospitality_guest.DataChiuso IS NOT NULL
                                        AND hospitality_guest.Disdetta = 0 
                                        AND hospitality_guest.TipoRichiesta = 'Conferma' ";
                $res16 = $db->query($select16);
                $rws16 = $db->row($res16);
                $fatturatoOperatore = $rws16['fatturato'];
                if($fatturatoOperatore == '')$fatturatoOperatore = 0;           
                $array_fatturatoOperatore[$operatore.'_'.$abilitatoOP]  = $fatturatoOperatore;
    }       
    $z = '1';
    foreach ($array_fatturatoOperatore as $ky => $val) {

        $ky_tmp      =explode("_",$ky);
        $ky          = $ky_tmp[0];
        $abilitatoOP = $ky_tmp[1];

        switch(($z)){
            case '1':
                $colorOP = '#f39c12';
                $highlightOP = '#f39c12';

            break;
            case '2':
                $colorOP = '#f56954';
                $highlightOP = '#f56954';

            break;
            case '3':
                $colorOP = '#605ca8';
                $highlightOP = '#605ca8';

            break;
            case '4':
                $colorOP = '#39cccc';
                $highlightOP = '#39cccc';

            break; 
            case '5':
                $colorOP = '#f012be';
                $highlightOP = '#f012be';

            break;
            case '6':
                $colorOP = '#00a65a';
                $highlightOP = '#00a65a';

            break;
            case '7':
                $colorOP = '#3c8dbc';
                $highlightOP = '#3c8dbc';

            break;        
            default:
                $colorOP = colorGen();
                $highlight = colorGen();

            break;

        }

        if($val!="" || $val != 0){
            $etichette_OP[] = "'".$ky."'";
            $tortaOP[] = "{value: ".$val.", name: '".$ky."'}";
        }

        $totaleOP += $val;

        $legendaOP .= '<div class="row">';
        $legendaOP .= '<div class="col-md-6"><label class="badge" style="background-color:'.$colorOP.'">'.$ky.'</label>'.($abilitatoOP==0?' <small>(non attivo)</small>':'').'</div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($val,2,',','.').'</div>';
        $legendaOP .= '</div>';

    $z++;
    }
        $legendaOP .= '<div class="row">';
        $legendaOP .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($totaleOP,2,',','.').'</div>';
        $legendaOP .= '</div>';

}
//PER TARGET CLIENTE
$select18 = "SELECT Target FROM hospitality_target WHERE idsito = ".IDSITO." ORDER BY Id ASC";
$res18 = $db->query($select18);
$rws18 = $db->result($res18);
$totTARGET = sizeof($rws18);
if($totTARGET>0){
    foreach ($rws18 as $key18 => $value18) {

        $select19 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                FROM hospitality_guest 
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                WHERE hospitality_guest.TipoVacanza = '".$value18['Target']."'
                                ".$filter_query ."
                                AND hospitality_guest.idsito = ".IDSITO." 
                                AND hospitality_guest.Chiuso = 1  
                                AND hospitality_guest.Disdetta = 0 
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res19 = $db->query($select19);
        $rws19 = $db->row($res19);
        $fatturatoTARGET = $rws19['fatturato'];
        if($fatturatoTARGET == '')$fatturatoTARGET = 0;
        if($fatturatoTARGET != '' || $fatturatoTARGET != 0){

                $array_fatturatoTARGET[$value18['Target']]  = $fatturatoTARGET;
        }

    }

if(isset($array_fatturatoTARGET)){
    foreach ($array_fatturatoTARGET as $T => $vT) {

        switch(strtolower($T)){
            case 'family':
                $colorT = '#f39c12';
                $highlightT = '#f39c12';
                $labelT = 'Family';
            break;
            case 'business':
                $colorT = '#f56954';
                $highlightT = '#f56954';
                $labelT = 'Business';
            break;
            case 'benessere':
                $colorT = '#d81b60';
                $highlightT = '#d81b60';
                $labelT = 'Benessere';
            break;            
            case 'fiera':
                $colorT = '#605ca8';
                $highlightT = '#605ca8';
                $labelT = 'Fiera';
            break;
            case 'bike':
                $colorT = '#39cccc';
                $highlightT = '#39cccc';
                $labelT = 'Bike';
            break; 
            case 'sport':
                $colorT = '#f012be';
                $highlightT = '#f012be';
                $labelT = 'Sport';
            break;
            case 'divertimento':
                $colorT = '#00a65a';
                $highlightT = '#00a65a';
                $labelT = 'Divertimento';
            break;            
            case 'romantico':
                $colorT = '#f012be';
                $highlightT = '#f012be';
                $labelT = 'Romantico';
            break;
            case 'culturale':
                $colorT = '#3c8dbc';
                $highlightT = '#3c8dbc';
                $labelT = 'Culturale';
            break;
            case 'enogastronomico':
                $colorT = '#39cccc';
                $highlightT = '#39cccc';
                $labelT = 'Enogastronomico';
            break;                    
            default:
                $colorT = colorGen();
                $highlightT = colorGen();
                $labelT = $T;
            break;

        }

        if($vT!="" || $vT != 0){
            $etichette_T[] = "'".$labelT."'";
            $tortaT[] = "{value: ".$vT.", name: '".$labelT."'}";
        }
        $totaleT += $vT;

        $legendaT .= '<div class="row">';
        $legendaT .= '<div class="col-md-6"><label class="badge" style="background-color:'.$colorT.'">'.$labelT.'</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($vT,2,',','.').'</div>';
        $legendaT .= '</div>';
    }
}
        $legendaT .= '<div class="row">';
        $legendaT .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($totaleT,2,',','.').'</div>';
        $legendaT .= '</div>';
}

// FATTURATO PER TEMPLATE
// 
// Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
$select20 = "SELECT * FROM hospitality_template_background WHERE idsito = ".IDSITO."";
$res20 = $db->query($select20);
$rws20 = $db->result($res20);
$totTemplate = sizeof($rws20);

if($totTemplate>0){

    $template = '';
    $NomeTemplate = '';

    foreach ($rws20 as $key20 => $value20) {


        $template = $value20['Id'];
        $NomeTemplate = $value20['TemplateName'];

                $select21  = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato 
                                        FROM hospitality_guest 
                                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                                        WHERE 1=1
                                        AND hospitality_guest.id_template = '".$template."'
                                        ".$filter_query ."
                                        AND hospitality_guest.idsito = ".IDSITO." 
                                        AND hospitality_guest.Chiuso = 1                                     
                                        AND hospitality_guest.DataChiuso IS NOT NULL
                                        AND hospitality_guest.Disdetta = 0 
                                        AND hospitality_guest.TipoRichiesta = 'Conferma' ";
                $res21 = $db->query($select21);
                $rws21 = $db->row($res21);
                $fatturatoTemplate = $rws21['fatturato'];
                if($fatturatoTemplate == '')$fatturatoTemplate = 0;           
                $array_fatturatoTemplate[$NomeTemplate]  = $fatturatoTemplate;
    }

    foreach ($array_fatturatoTemplate as $ky => $val) {



        switch(($ky)){
            case 'default':
                $colorTP = '#f39c12';
                $highlightTP = '#f39c12';

            break;
            case 'smart':
                $colorTP = '#f56954';
                $highlightTP = '#f56954';

            break;
           
        }

        if($val!="" || $val != 0){
            $etichette_TP[] = "'".$ky."'";
            $tortaTP[] = "{value: ".$val.", name: '".$ky."'}";
        }

        $totaleTP += $val;

        $legendaTP .= '<div class="row">';
        $legendaTP .= '<div class="col-md-6"><label class="badge" style="background-color:'.$colorTP.'">'.$ky.'</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($val,2,',','.').'</div>';
        $legendaTP .= '</div>';


    }
        $legendaTP .= '<div class="row">';
        $legendaTP .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($totaleTP,2,',','.').'</div>';
        $legendaTP .= '</div>';

}


if(is_array($torta)){
	$data_torta = implode(',',$torta);
}
if(is_array($etichette_f)){
	$data_etichette_f = implode(',',$etichette_f);
}

if(is_array($tortaS)){
	$data_tortaS = implode(',',$tortaS);
}
if(is_array($etichette_S)){
	$data_etichette_S = implode(',',$etichette_S);
}

if(is_array($tortaOP)){
	$data_tortaOP = implode(',',$tortaOP);
}
if(is_array($etichette_OP)){
	$data_etichette_OP = implode(',',$etichette_OP);
}

if(is_array($tortaT)){
	$data_tortaT = implode(',',$tortaT);
}
if(is_array($etichette_T)){
	$data_etichette_T = implode(',',$etichette_T);
}

if(is_array($tortaTP)){
	$data_tortaTP = implode(',',$tortaTP);
}
if(is_array($etichette_TP)){
	$data_etichette_TP = implode(',',$etichette_TP);
}

$js_script_grafici .='
<script>
    $(document).ready(function(){'."\r\n";

      if($tot >0){
        if($array_fatturato>0){  

            $js_script_grafici .="
            var pieChart = echarts.init(document.getElementById('pieChart'));

            // specify chart configuration item and data
            option = {
    
                    tooltip: {
                            trigger: 'item',
                            formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                    },
                    legend: {
                            x: 'center',
                            y: 'top',
                            data: [".$data_etichette_f."],
                    },
                    toolbox: {
                            show: true,
                            feature: {
    
                                    dataView: { show: true, readOnly: false },
                                    magicType: {
                                            show: true,
                                            type: ['pie']
                                    },
                                    restore: { show: true },
                                    saveAsImage: { show: true }
                            }
                    },
                calculable: true,
                series : [
                    {
                        name: 'Fatturato',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[".$data_torta."],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // use configuration item and data specified to show chart
            pieChart.setOption(option, true), $(function() {
                    function resize() {
                            setTimeout(function() {
                                    pieChart.resize()
                            }, 100)
                    }
                    $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
            });"."\r\n";
        }
      }
      if($array_fatturatoS['Organico']>0 || $array_fatturatoS['Diretto']>0  || $array_fatturatoS['Facebook']>0  || $array_fatturatoS['Newsletter']>0 || $array_fatturatoS['PPC']>0 || $array_fatturatoS['Referral/Altro']>0){
        $js_script_grafici .="
        var pieChart = echarts.init(document.getElementById('pieChart2'));

        // specify chart configuration item and data
        option = {

                tooltip: {
                        trigger: 'item',
                        formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                },
                legend: {
                        x: 'center',
                        y: 'top',
                        data: [".$data_etichette_S."],
                },
                toolbox: {
                        show: true,
                        feature: {

                                dataView: { show: true, readOnly: false },
                                magicType: {
                                        show: true,
                                        type: ['pie']
                                },
                                restore: { show: true },
                                saveAsImage: { show: true }
                        }
                },
            calculable: true,
            series : [
                {
                    name: 'Fatturato',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[".$data_tortaS."],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        // use configuration item and data specified to show chart
        pieChart.setOption(option, true), $(function() {
                function resize() {
                        setTimeout(function() {
                                pieChart.resize()
                        }, 100)
                }
                $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
        });"."\r\n";
      }
      if($totOperatore >0){
        if($array_fatturatoOperatore>0){
            $js_script_grafici .="
            var pieChart = echarts.init(document.getElementById('pieChart3'));

            // specify chart configuration item and data
            option = {
    
                    tooltip: {
                            trigger: 'item',
                            formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                    },
                    legend: {
                            x: 'center',
                            y: 'top',
                            data: [".$data_etichette_OP."],
                    },
                    toolbox: {
                            show: true,
                            feature: {
    
                                    dataView: { show: true, readOnly: false },
                                    magicType: {
                                            show: true,
                                            type: ['pie']
                                    },
                                    restore: { show: true },
                                    saveAsImage: { show: true }
                            }
                    },
                calculable: true,
                series : [
                    {
                        name: 'Fatturato',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[".$data_tortaOP."],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // use configuration item and data specified to show chart
            pieChart.setOption(option, true), $(function() {
                    function resize() {
                            setTimeout(function() {
                                    pieChart.resize()
                            }, 100)
                    }
                    $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
            });"."\r\n";
        }
      }
     if($totTARGET >0){
        if($array_fatturatoTARGET>0){
            $js_script_grafici .="                   
            var pieChart = echarts.init(document.getElementById('pieChart4'));

            // specify chart configuration item and data
            option = {
    
                    tooltip: {
                            trigger: 'item',
                            formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                    },
                    legend: {
                            x: 'center',
                            y: 'top',
                            data: [".$data_etichette_T."],
                    },
                    toolbox: {
                            show: true,
                            feature: {
    
                                    dataView: { show: true, readOnly: false },
                                    magicType: {
                                            show: true,
                                            type: ['pie']
                                    },
                                    restore: { show: true },
                                    saveAsImage: { show: true }
                            }
                    },
                calculable: true,
                series : [
                    {
                        name: 'Fatturato',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[".$data_tortaT."],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // use configuration item and data specified to show chart
            pieChart.setOption(option, true), $(function() {
                    function resize() {
                            setTimeout(function() {
                                    pieChart.resize()
                            }, 100)
                    }
                    $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
            });"."\r\n";
        }
    }
    if($totTemplate >0){
        if($array_fatturatoTemplate>0){
            $js_script_grafici .="                   
            var pieChart = echarts.init(document.getElementById('pieChart5'));

            // specify chart configuration item and data
            option = {
    
                    tooltip: {
                            trigger: 'item',
                            formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                    },
                    legend: {
                            x: 'center',
                            y: 'top',
                            data: [".$data_etichette_TP."],
                    },
                    toolbox: {
                            show: true,
                            feature: {
    
                                    dataView: { show: true, readOnly: false },
                                    magicType: {
                                            show: true,
                                            type: ['pie']
                                    },
                                    restore: { show: true },
                                    saveAsImage: { show: true }
                            }
                    },
                calculable: true,
                series : [
                    {
                        name: 'Fatturato',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[".$data_tortaTP."],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // use configuration item and data specified to show chart
            pieChart.setOption(option, true), $(function() {
                    function resize() {
                            setTimeout(function() {
                                    pieChart.resize()
                            }, 100)
                    }
                    $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
            });"."\r\n";
        }
    }
$js_script_grafici .='    });
</script>'."\r\n";
$js_date .=' 
<script>
$(document).ready(function() { 

    '.($_REQUEST['action']!=''?'
        $("#avanzati").show();
        $("#compress").show();
        $("#expand").hide();'
    :'').'

    $("#view_avanzati").on("click",function(){
        $("#avanzati").toggle("slow");
        $(this).find(\'span\').toggle();
    });
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
        $( "#DataRichiesta_dal" ).datepicker({
              numberOfMonths: 1,
              language:"it",
              showButtonPanel: true
        });
        $( "#DataRichiesta_al" ).datepicker({
            numberOfMonths: 1,
            language:"it",
            showButtonPanel: true
      });
        $( "#DataArrivo_dal" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true
        });
      $( "#DataPartenza_dal" ).datepicker({
        numberOfMonths: 2,
        language:"it",
        showButtonPanel: true
        }); 
        $( "#DataArrivo_al" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true
        });
      $( "#DataPartenza_al" ).datepicker({
        numberOfMonths: 2,
        language:"it",
        showButtonPanel: true
        });        
});  
</script>'."\r\n";
$js_toggle ='
<script> 
    $(document).ready(function() { 
        setTimeout(function(){
            //'.($_REQUEST['action']==''?'$("#fatturato").addClass("collapsed-box");':'').'     
            //$("#camere").addClass("collapsed-box");
        }, 500);
    }); 
</script>'."\r\n";