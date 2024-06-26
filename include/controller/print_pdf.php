<?php
error_reporting(0);
    function replace_euro($stringa){
        $replace = str_replace ("€", "&euro;", $stringa);
        return($replace);
    }
    function clean($stringa){
        $clean_title = str_replace("’","'",$stringa);
        $clean_title = str_replace ("°","",$clean_title);
        $clean_title = str_replace ('⟶','->',$clean_title);
        $clean_title = str_replace ("&","e",$clean_title);
        $clean_title = str_replace ("€", "&euro;", $clean_title); 
        $clean_title = utf8_encode($clean_title);
       // $clean_title = strip_tags($clean_title);
        return($clean_title);
    }
    function letter_clean($stringa){
        $clean_title = str_replace( "à", "a", $stringa );
        $clean_title = str_replace( "è", "e", $clean_title );
        $clean_title = str_replace( "é", "e", $clean_title );
        $clean_title = str_replace( "ì", "i", $clean_title );
        $clean_title = str_replace( "ò", "o", $clean_title );
        $clean_title = str_replace( "ù", "u", $clean_title );
        return($clean_title);
    }

    $_REQUEST['azione'] = base64_decode($_REQUEST['azione']);
    ### GUEST RICHIESTA

  $select = "SELECT hospitality_proposte.Id as IdProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,
                        hospitality_proposte.NomeProposta,hospitality_proposte.TestoProposta,
                        hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTariffa,hospitality_proposte.AccontoTesto,
                        hospitality_guest.DataRichiesta,hospitality_guest.DataChiuso,hospitality_guest.Chiuso,
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
                        hospitality_guest.TipoRichiesta,hospitality_guest.Note,hospitality_guest.AccontoLibero,
                        hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.ChiPrenota,
                        hospitality_guest.Lingua
                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_proposte.id_richiesta = ".$_REQUEST['azione'];
    $res = $dbMysqli->query($select);

    $NomeProposta    = '';
    $TestoProposta   = '';
    $Chiuso          = '';
    $Camere          = array();
    $acconto         = '';
    $AccontoTariffa  = '';
    $AccontoTesto    = '';
    $n               = 1;
    $sistemazione    = '';
    $saldo           = '';
    $etichetta_saldo = '';

    foreach ($res as $key => $value) {

        $PrezzoL              = number_format($value['PrezzoL'],2,',','.');
        $PrezzoP              = number_format($value['PrezzoP'],2,',','.');
        $IdProposta           = $value['IdProposta'];
        $PrezzoPC             = $value['PrezzoP'];
        $AccontoRichiesta     = $value['AccontoRichiesta'];
        $AccontoLibero        = $value['AccontoLibero'];
        $TipoRichiesta        = $value['TipoRichiesta'];
        $NumeroPrenotazione   = $value['NumeroPrenotazione'];
        $NumeroAdulti         = $value['NumeroAdulti'];
        $NumeroBambini        = $value['NumeroBambini'];
        $EtaBambini1          = $value['EtaBambini1'];
        $EtaBambini2          = $value['EtaBambini2'];
        $EtaBambini3          = $value['EtaBambini3'];
        $EtaBambini4          = $value['EtaBambini4'];
        $EtaBambini5          = $value['EtaBambini5'];
        $EtaBambini6          = $value['EtaBambini6'];
        $Cellulare            = $value['Cellulare'];
        $Lingua               = $value['Lingua'];
        $FontePrenotazione    = $value['FontePrenotazione'];
        $NumeroPrenotazione   = $value['NumeroPrenotazione'];
        $NomeProposta         = $value['NomeProposta'];
        $TestoProposta        = nl2br($value['TestoProposta']);
        $Operatore            = stripslashes($value['ChiPrenota']);
        $Nome                 = stripslashes($value['Nome']);
        $Cognome              = stripslashes($value['Cognome']);
        $Note                 = stripslashes(nl2br($value['Note']));
        $Email                = $value['Email'];
        $Chiuso               = $value['Chiuso'];
        $Arrivo_tmp           = explode("-",$value['DataArrivo']);
        $Arrivo               = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
        $Partenza_tmp         = explode("-",$value['DataPartenza']);
        $Partenza             = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
        $DataRichiesta_tmp    = explode("-",$value['DataRichiesta']);
        $DataRichiesta        = $DataRichiesta_tmp[2].'-'.$DataRichiesta_tmp[1].'-'.$DataRichiesta_tmp[0];
        $DataPrenotazione_tmp = explode(" ",$value['DataChiuso']);
        $DataPrenotazione_gg  = explode("-",$DataPrenotazione_tmp[0]);
        $DataPrenotazione     = $DataPrenotazione_gg[2].'-'.$DataPrenotazione_gg[1].'-'.$DataPrenotazione_gg[0].' '.$DataPrenotazione_tmp[1];
        $AccontoPercentuale   = $value['AccontoPercentuale'];
        $AccontoImporto       = $value['AccontoImporto'];
        $AccontoTariffa       = stripslashes($value['AccontoTariffa']);
        $AccontoTesto         = stripslashes($value['AccontoTesto']);

        $start              = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
        $end                = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
        $formato="%a";
        $Notti = dateDiff($value['DataArrivo'],$value['DataPartenza'],$formato);
        // date alternative
        $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
        $re = $dbMysqli->query($se);
        $rc = $re[0];

        if(sizeof($re)>0){
            $DArrivo_tmp    = explode("-",$rc['Arrivo']);
            $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
            $DPartenza_tmp  = explode("-",$rc['Partenza']);
            $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
            $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
            $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));

            $formato="%a";
            $DNotti = dateDiff($rc['Arrivo'],$rc['Partenza'],$formato);
        }
        if($rc['Arrivo'] != '' && $rc['Partenza'] != ''){
            if($value['TipoRichiesta']=='Preventivo'){
                if($Arrivo != $DArrivo || $Partenza != $DPartenza){
                    $DateAlternative = '<tr>
                                        <td style="height:25px;width:20%"><b>Data Arrivo alternativa:</b></td>
                                        <td style="height:25px;width:30%">'.$DArrivo.'</td>
                                        <td style="height:25px;width:20%"><b>Data Partenza alternativa:</b></td>
                                        <td style="height:25px;width:30%">'.$DPartenza.'</td>
                                    </tr>
                                    <tr>
                                        <td style="height:25px;width:40%"><b>Nr. di Notti (su date alternative):</b></td>
                                        <td style="height:25px;width:60%">'.$DNotti.'</td>
                                    </tr>';
                }

            }elseif($value['TipoRichiesta']=='Conferma'){
                if($rc['Arrivo']!= $value['DataArrivo'] && $rc['Arrivo'] != '0000-00-00'){

                    $Arrivo   = $DArrivo;
                    $Notti    = $DNotti;
                }
                if($rc['Partenza']!= $value['DataPartenza'] && $rc['Partenza'] != '0000-00-00'){
                    $Partenza   = $DPartenza;
                    $Notti    = $DNotti;
                }
            }

        }
        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
            $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
            $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
        }
        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
            $saldo   = ($PrezzoPC-$AccontoLibero);
            $acconto = number_format($AccontoLibero,2,',','.');
        }

        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
            $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
            $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
        }
        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
            if($AccontoImporto >= 1) {
                $etichetta_caparra  = '';
            }else{
                $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
            }
            $saldo   = ($PrezzoPC-$AccontoImporto);
            $acconto = number_format($AccontoImporto,2,',','.');
        }
        if($PrezzoPC==$saldo){
            $etichetta_saldo = '0,00';
        }else{
            $etichetta_saldo = number_format(floatval($saldo),2,',','.');
        }

            $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                        FROM hospitality_richiesta
                        INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                        INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                        WHERE hospitality_richiesta.id_proposta = ".$IdProposta." AND hospitality_richiesta.id_richiesta = ".$_REQUEST['azione'] ;
            $res2 = $dbMysqli->query($select2);
            $Camere  = array();
            $eta     = '';
            $NAdulti = '';
            $NBimbi  = '';
            foreach ($res2 as $ky => $val) {
                if($val['EtaB']!='' && !is_null($val['EtaB']) && $val['EtaB'] != NULL){
                    $eta = ' anni: '.$val['EtaB'];
                }else{
                    $eta = '';
                }
                if($val['NumAdulti']!=0){
                    $NAdulti =' A: '.$val['NumAdulti'];
                }else{
                    $NAdulti ='';
                }
                if($val['NumBambini']!=0){
                    $NBimbi =' B: '.$val['NumBambini'];
                }else{
                    $NBimbi ='';
                }
            $Camere[] = ' <tr>
                                <td style="height:25px;width:20%"><b>Camera:</b></td>
                                <td colspan="3" style="height:25px;width:80%">
                                    Nr. '.$val['NumeroCamere'].' '.($val['TipoCamere']).'<br>
                                    -> '.$val['TipoSoggiorno'].' '.$NAdulti.$NBimbi.$eta.' - &euro;  '.number_format($val['Prezzo'],2,',','.').'
                                </td>
                            </tr>';
            }

            // Query per servizi aggiuntivi
            $query  = "SELECT hospitality_tipo_servizi.*,hospitality_relazione_servizi_proposte.num_persone,hospitality_relazione_servizi_proposte.num_notti FROM hospitality_relazione_servizi_proposte
                        INNER JOIN hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
                        WHERE hospitality_tipo_servizi.idsito = ".IDSITO."
                        AND hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta."'
                        ORDER BY hospitality_tipo_servizi.Id ASC";
            $record = $dbMysqli->query($query);

            if(sizeof($record)>0){
                $ServiziAgg = '';
                foreach($record as $chiave => $campo){

                    switch($campo['CalcoloPrezzo']){
                        case "Al giorno":
                            $calcoloprezzo = 'Al giorno';
                            $num_persone = '';
                            $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0 ?'<span style="font-size:80%">('.number_format($campo['PrezzoServizio'],2,',','.').' x '.($ANotti!=''?$ANotti:$Notti).')</span>':'');
                            $PrezzoServizio = ($campo['PrezzoServizio']!=0 ?'&euro;. '.number_format(($campo['PrezzoServizio']*($ANotti!=''?$ANotti:$Notti)),2,',','.'):'Gratis');
                        break;
                        case "Una tantum":
                            $calcoloprezzo = 'Una tantum';
                            $num_persone = '';
                            $CalcoloPrezzoServizio = '';
                            $PrezzoServizio = '&euro;. '.number_format($campo['PrezzoServizio'],2,',','.');
                        break;
                        case "A persona":
                          $calcoloprezzo = 'A persona';
                          $num_persone = $campo['num_persone'];
                          $num_notti = $campo['num_notti'];
                          $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0 ?'<span style="font-size:80%">('.number_format($campo['PrezzoServizio'],2,',','.').' x '.$num_notti.' <span style="font-size:80%">gg</span> x '.$campo['num_persone'].' <span style="font-size:80%">pax</span>)</span>':'<span style="font-size:80%">('.$num_notti.'  <span style="font-size:80%">gg</span> x '.$campo['num_persone'].' <span style="font-size:80%">pax</span>)</span>');
                          $PrezzoServizio = ($campo['PrezzoServizio']!=0?'&euro;. '.number_format(($campo['PrezzoServizio']*$num_notti*$campo['num_persone']),2,',','.'):'Gratis');
                        break;
                        case "A percentuale":
                            $calcoloprezzo = 'A percentuale';
                            $num_persone   = '';
                            $CalcoloPrezzoServizio = '';
                            $PrezzoServizio = ($campo['PercentualeServizio']!=''?'% '.number_format(($campo['PercentualeServizio']),2):'');
                          break;
                      }

                        $ServiziAgg .='<tr>
                                        <td  style="height:25px;width:20%"><b>Servizio:</b></td>
                                        <td  style="height:25px;width:30%">'.(strlen($campo['TipoServizio'])<=50?letter_clean($campo['TipoServizio']):(strstr($campo['TipoServizio'],"+")?str_replace("+","<br>",letter_clean($campo['TipoServizio'])):substr(letter_clean($campo['TipoServizio']),0,50).'...')).'</td>
                                        <td  style="height:25px;width:30%">'.$PrezzoServizio.'</td>
                                        <td  style="height:25px;width:20%">'.$campo['CalcoloPrezzo'].' '.$CalcoloPrezzoServizio.'</td>
                                    </tr>';

                }
            }


        if($value['TipoRichiesta']=='Preventivo'){
            $sistemazione .= 'Richiesta del '.$DataRichiesta.' - Operatore: '.$Operatore.'';

            if($NomeProposta != ''){
                $sistemazione .= '<br><br><b>'.$NomeProposta.'</b>';
            }
            if($TestoProposta != ''){
                $sistemazione .= '<br><br><table><tr><td style="width:100%;">'.clean($TestoProposta).'</td></tr></table>';
            }

            $sistemazione .= '<br><br><b>'.$n.'°) PROPOSTA Nr. '.$NumeroPrenotazione.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em style="margin-top:5px;font-size:12px"><b>Fonte:</b> '.$FontePrenotazione.'</em><br><br>
                        <table>
                            <tr>
                                <td style="height:25px;width:20%"><b>Nome:</b></td>
                                <td style="height:25px;width:30%">'.$Nome.'</td>
                                <td style="height:25px;width:20%"><b>Cognome:</b></td>
                                <td style="height:25px;width:30%">'.$Cognome.'</td>
                            </tr>
                            <tr>
                                <td style="height:25px;width:20%"><b>Email:</b></td>
                                <td style="height:25px;width:30%">'.$Email.'</td>
                                <td style="height:25px;width:20%"><b>Tel.:</b></td>
                                <td style="height:25px;width:30%">'.$Cellulare.'</td>
                            </tr>
                            <tr>
                                <td style="height:25px;width:20%"><b>Data Arrivo:</b></td>
                                <td style="height:25px;width:30%">'.$Arrivo.'</td>
                                <td style="height:25px;width:20%"><b>Data Partenza:</b></td>
                                <td style="height:25px;width:30%">'.$Partenza.'</td>
                            </tr>
                            <tr>
                                <td style="height:25px;width:40%"><b>Numero di Notti:</b></td>
                                <td style="height:25px;width:60%">'.$Notti.'</td>
                            </tr>';
        $sistemazione .= $DateAlternative;
        $sistemazione .= '  <tr>
                                <td style="height:25px;width:20%"><b>Adulti:</b></td>
                                <td style="height:25px;width:30%">'.$NumeroAdulti.'</td>
                                <td style="height:25px;width:20%"><b>Bambini:</b></td>
                                <td style="height:25px;width:30%">
                                '.$NumeroBambini.'
                                </td>
                            </tr>';
        foreach ($Camere as $y => $rooms) {
          $sistemazione .= utf8_encode($rooms);
        }
        $sistemazione .= $ServiziAgg;
        if(($PrezzoL!='0,00' && $PrezzoL > $PrezzoP)){
            $sistemazione .= '<tr>
                                <td colspan="2" style="height:25px;width:20%"><b>Prezzo Listino:</b></td>
                                <td colspan="2" style="height:25px;width:80%">&euro;. <s>'.$PrezzoL.'</s></td>
                            </tr>';
        }
        $sistemazione .= '<tr>
                                <td colspan="2" style="height:25px;width:20%"><b>Prezzo Proposto:</b></td>
                                <td colspan="2" style="height:25px;width:80%">&euro;. '.$PrezzoP.'</td>
                            </tr>';
        if($Note!=''){
            $sistemazione .= '<tr>
                                <td colspan="4" style="height:25px;"><b>Note:</b></td>
                            </tr>';
           $sistemazione .= '<tr>
                                <td colspan="4">'.clean($Note).'</td>
                            </tr>';
        }
        $sistemazione .= '</table><br><br>';


        }else{

            $sistemazione .= 'Richiesta del '.$DataRichiesta.' ';

            if($Chiuso == 1){
                $sistemazione .= ' e prenotazione chiusa il '.$DataPrenotazione.'';
            }

            $sistemazione .= '<br>Operatore: '.$Operatore.'';


            if($NomeProposta  != ''){
                $sistemazione .= '<br><br><b>'.$NomeProposta.'</b>';
            }

            if($TestoProposta != ''){
                $sistemazione .= '<br><br><table><tr><td style="width:100%;">'.clean($TestoProposta).'</td></tr></table>';
            }

            $sistemazione .= '<br><br><b>SOLUZIONE CONFERMATA Nr.'.$NumeroPrenotazione.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em style="margin-top:5px;font-size:12px"><b>Fonte:</b> '.$FontePrenotazione.'</em><br><br>
                        <table>
                            <tr>
                                <td style="height:25px;width:20%"><b>Nome:</b></td>
                                <td style="height:25px;width:30%">'.$Nome.'</td>
                                <td style="height:25px;width:20%"><b>Cognome:</b></td>
                                <td style="height:25px;width:30%">'.$Cognome.'</td>
                            </tr>
                            <tr>
                                <td style="height:25px;width:20%"><b>Email:</b></td>
                                <td style="height:25px;width:30%">'.$Email.'</td>
                                <td style="height:25px;width:20%"><b>Tel.:</b></td>
                                <td style="height:25px;width:30%">'.$Cellulare.'</td>
                            </tr>
                            <tr>
                                <td style="height:25px;width:20%"><b>Data Arrivo:</b></td>
                                <td style="height:25px;width:30%">'.$Arrivo.'</td>
                                <td style="height:25px;width:20%"><b>Data Partenza:</b></td>
                                <td style="height:25px;width:30%">'.$Partenza.'</td>
                            </tr>
                            <tr>
                                <td style="height:25px;width:40%"><b>Numero di Notti:</b></td>
                                <td style="height:25px;width:60%">'.$Notti.'</td>
                            </tr>';
            $sistemazione .= $DateAlternative;
            $sistemazione .= '<tr>
                                <td style="height:25px;width:20%"><b>Adulti:</b></td>
                                <td style="height:25px;width:30%">'.$NumeroAdulti.'</td>
                                <td style="height:25px;width:20%"><b>Bambini:</b></td>
                                <td style="height:25px;width:30%">
                                '.$NumeroBambini.'
                                </td>
                            </tr>';
            foreach ($Camere as $y => $rooms) {
              $sistemazione .= utf8_encode($rooms);
            }
            $sistemazione .= $ServiziAgg; 
                     if(($PrezzoL!='0,00' && $PrezzoL > $PrezzoP)){
                        $sistemazione .= '<tr>
                                            <td colspan="2" style="height:25px;width:20%"><b>Prezzo Listino:</b></td>
                                            <td colspan="2" style="height:25px;width:80%">&euro;. <s>'.$PrezzoL.'</s></td>
                                        </tr>';
                    }
                    $sistemazione .= '<tr>
                                            <td colspan="2" style="height:25px;width:20%"><b>Prezzo Proposto:</b></td>
                                            <td colspan="2" style="height:25px;width:80%">&euro;. '.$PrezzoP.'</td>
                                        </tr>';
                    if($acconto!=''){
                        $sistemazione .= '<tr>
                                            <td colspan="2" style="height:25px;width:20%"><b>Caparra versata o da prelevare:</b></td>
                                            <td colspan="2" style="height:25px;width:80%">&euro;. '.$acconto.'</td>
                                        </tr>';
                        if($etichetta_caparra !=''){
                            $sistemazione .= '<tr>
                                                <td colspan="2" style="height:25px;width:20%"><b>Carta di Credito a Garanzia</b></td>
                                                <td colspan="2" style="height:25px;width:80%"></td>
                                            </tr>';
                        }
                        $sistemazione .= '<tr>
                                                <td colspan="2" style="height:25px;width:20%"><b>Cifra a saldo:</b></td>
                                                <td colspan="2" style="height:25px;width:80%">&euro;. '.$etichetta_saldo.'</td>
                                            </tr>';
                        if($AccontoTariffa !='' || $AccontoTesto!=''){
                            $sistemazione .= '<tr>
                                                <td colspan="4" style="width:100%"><b>'.($AccontoTariffa!=''?$AccontoTariffa:'Condizioni Tariffa').':</b><br>
                                                <span style="font-size:10px">'.nl2br((strlen($AccontoTesto>=220)?strip_tags($AccontoTesto):substr(strip_tags($AccontoTesto),0,220).'...continua')).'</span></td>
                                            </tr>';
                        }

                    } 

                    if($Note!=''){
                        $sistemazione .= '<tr>
                                            <td colspan="4" style="height:25px;"><b>Note:</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">'.clean($Note).'</td>
                                        </tr>';
                    }
                     $sistemazione .='</table>';

        }

    $n++;
    }



    ### CARTA DI CREDITO
    $cc = 'SELECT * FROM hospitality_carte_credito WHERE id_richiesta = '.$_REQUEST['azione'].' AND idsito = '.IDSITO;
    $rec             = $dbMysqli->query($cc);
    $row             = $rec[0];
    $Carta           = $row['carta'];

    $NumeroCarta_hidden = '**** **** **** '.substr(base64_decode($row['numero_carta']),0,4);
    $NumeroCarta        = base64_decode($row['numero_carta']);
    $Intestatario       = $row['intestatario'];
    $Scadenza           = $row['scadenza'];
    $CVV                = $row['cvv'];

    ### CALTRI PAGAMENTI
    $pg = 'SELECT * FROM hospitality_altri_pagamenti WHERE id_richiesta = '.$_REQUEST['azione'].' AND idsito = '.IDSITO;
    $res           = $dbMysqli->query($pg);
    $rw            = $res[0];
    $TipoPagamento = $rw['TipoPagamento'];


    ### HEADER E FOOTER
    $sel = 'SELECT siti.*,
                                comuni.nome_comune as comune,
                                province.sigla_provincia as prov
                                FROM siti
                                RIGHT JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                RIGHT JOIN province ON province.codice_provincia = siti.codice_provincia
                                WHERE siti.idsito = "'.$_SESSION['IDSITO'].'"';
    $rec       = $dbMysqli->query($sel);
    $rows      = $rec[0];
    $NomeHotel = $rows['nome'];
    $tel       = $rows['tel'];
    $fax       = $rows['fax'];
    $cell      = $rows['cell'];
    $cap       = $rows['cap'];
    $indirizzo = $rows['indirizzo'];
    $comune    = $rows['comune'];
    $prov      = $rows['prov'];


############ creo  PDF ################################################
ob_start();
$content .= '<style type="text/css">
<!--
    table.page_header {width: 100%; border: none; background-color: #FFFFFF; padding: 20mm }
    table.page_footer {width: 100%; border: none; background-color: #FFFFFF; padding: 20mm}
-->
</style>'."\r\n";
$content .='<page backtop="28mm" backbottom="40mm" backleft="10mm" backright="10mm" pagegroup="new">';

/* $content .='<page_header>
            <table align="center">
                <tr>
                    <td>
                       <img src="img/logo.jpg" alt="QUOTO">
                    </td>
                </tr>
          </table>
        </page_header>
        <page_footer>
            <table>
                <tr>
                    <td style="vertical-align:top;text-align:left;padding-left:40px">
                       <b>'.ucfirst($NomeHotel).'</b><br>
                        '.$indirizzo.' - '.$cap.' '.$comune.' ('.$prov.')<br>
                        Tel. '.$tel.' '.($fax!=''?' Fax. '.$fax:'').' E-mail: '.$rows['email'].'
                    </td>
                </tr>
            </table>
        </page_footer>'."\r\n"; */
$content .='<page_header>
                <div style="margin-left:40px;width:auto;height:auto;border: 1px solid; border-radius: 10px; padding-top:20px;padding-bottom:20px;padding-right:20px;">
                    <table>
                        <tr>
                            <td style="vertical-align:top;text-align:left;padding-left:40px">
                            <b>'.ucfirst($NomeHotel).'</b><br>
                                '.$indirizzo.' - '.$cap.' '.$comune.' ('.$prov.')<br>
                                Tel. '.$tel.' '.($cell!=''?' Cell. '.$cell:'').' E-mail: '.$rows['email'].'
                            </td>
                        </tr>
                    </table>
                </div>
            </page_header>
            <page_footer>
                <hr style="height:1px;border-width:0;color:gray;background-color:gray"><div style="width:100%;text-align:right;font-size:12px;"><small>Powered By QUOTO! - <a href="https://www.network-service.it">Network Service s.r.l.</a> &copy; '.date('Y').'</small> </div>
            </page_footer>'."\r\n";
$content .='<br><br><br><table style="width:100%">
                <tr>
                    <td style="font-size:35px">
                      <b>'.ucwords($NomeHotel).'</b>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <em style="margin-top:20px;font-size:12px">'.$comune.' li, '.date('d-m-Y').'</em>
                    </td>
                </tr>
            </table><br>';
$content .= $sistemazione;

if($Carta != '' && $NumeroCarta != ''){
    $content .='<table style="width:100%;font-size:16px">
                    <tr>
                        <td  style="height:25px;width:50%;"><b>Carta:</b></td>
                        <td  style="height:25px;width:50%;">'.ucfirst($Carta).'</td>
                    </tr>
                    <tr>
                        <td  style="height:25px;width:50%;"><b>Numero Carta:</b></td>
                        <td  style="height:25px;width:50%;">'.$NumeroCarta_hidden.'</td>
                    </tr>
                    <tr>
                        <td  style="height:25px;width:50%;"><b>Intestatario Carta:</b></td>
                        <td  style="height:25px;width:50%;">'.$Intestatario.'</td>
                    </tr>
                    <!--<tr>
                        <td  style="height:25px;width:50%;"><b>Scadenza Carta:</b></td>
                        <td  style="height:25px;width:50%;">'.$Scadenza.'</td>
                    </tr>
                    <tr>
                        <td  style="height:25px;width:50%;"><b>Codice CVV2:</b></td>
                        <td  style="height:25px;width:50%;">'.$CVV.'</td>
                    </tr>-->
                </table>';
            }
if($TipoPagamento != ''){
    $content .='<table style="width:100%;font-size:16px">
                    <tr>
                        <td  style="height:25px;width:50%;"><b>Tipo di Pagamento scelto:</b></td>
                        <td  style="height:25px;width:50%;">'.$TipoPagamento.'</td>
                    </tr>
                </table>';
            }
$content .='</page>'."\r\n";
$content .= ob_get_clean();

$print_pdf = 'prenotazione_'.$_REQUEST['azione'];

require_once(BASE_PATH_SITO.'html2pdf-master/vendor/autoload.php');
error_reporting(0);
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$html2pdf = new Html2Pdf('P', 'A4', 'it');
$html2pdf->writeHTML(utf8_decode($content));
$html2pdf->output(BASE_PATH_SITO.'uploads/'.IDSITO.'/'.$print_pdf.'.pdf','FI'); 

$url = BASE_URL_SITO.'uploads/'.IDSITO.'/'.$print_pdf.'.pdf';
echo "<script language=\"javascript\">document.location='$url'</script>Se il tuo browser non supporta javascript clicca <a href=\"$url\">qui</a>";
?>
