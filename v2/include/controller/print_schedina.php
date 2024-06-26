<?php
        //#### QUERY 
        $select = "SELECT DataArrivo, DataPartenza,NumeroPrenotazione FROM  hospitality_guest  
                    WHERE hospitality_guest.idsito = ".$_REQUEST['azione']." 
                    AND hospitality_guest.NumeroPrenotazione = ".$_REQUEST['valore']." 
                    AND hospitality_guest.TipoRichiesta = 'Conferma' 
                    AND hospitality_guest.Chiuso = 1";
        $result = $db->query($select);
        $row    = $db->row($result);
        $NumeroPrenotazione = $row['NumeroPrenotazione'];
        $DataArrivo         = gira_data($row['DataArrivo']);
        $DataPartenza       = gira_data($row['DataPartenza']);



        // query per alcuni dati inerenti al cliente: nome, Email, SitoWeb
        $db_suiteweb->query('SELECT siti.*,
                                    comuni.nome_comune as comune,
                                    province.sigla_provincia as prov
                                    FROM siti 
                                    INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                                    INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                                    WHERE siti.idsito = "'.IDSITO.'"');
        $rows =  $db_suiteweb->row();
        $sito_tmp  = str_replace("http://","",$rows['web']);
        $sito_tmp  = str_replace("www.","",$sito_tmp);
        if($rows['https']==1){
            $http = 'https://';
        }else{
            $http = 'http://';
        }
        $SitoWeb   = $http.'www.'.$sito_tmp;             
        $tel       = $rows['tel'];
        $fax       = $rows['fax'];
        $cap       = $rows['cap'];
        $indirizzo = $rows['indirizzo'];
        $comune    = $rows['comune'];
        $prov      = $rows['prov'];
        $hotel     = $rows['nome'];


        $output .= '<style>
                                .no_border_top_dx{
                                    border-top:0px!important;
                                   /* border-bottom:0px!important;*/
                                    border-right:0px!important;
                                }
                                .no_border_input{
                                    border-top:0px!important;
                                    border-bottom:0px!important;
                                    border-right:0px!important;
                                    border-left:0px!important;
                                }
                                .bold{
                                    font-weight:bold!important;
                                }
                                .center_small{
                                    text-align:center!important;
                                    font-size:90%!important;
                                }
                                .center{
                                    text-align:center!important;                                
                                }
                                .clear{
                                    clear:both!important;
                                    height:5px!important;
                                }
                                .small{
                                    font-size:90%!important;
                                }
                                .input_white{
                                    background-color:#FFFFFF!important;
                                }
    
                            </style>'."\r\n";


        $output .= 'Spett.le Questura, dati per schedina alloggiati della prenotazione nr.<b>'.$_REQUEST['valore'].'</b><br><br>';



        $output .='<b>'.$hotel.'</b>,</br>        
                                 '.$indirizzo.' - '.$cap.' '.$comune.' ('.$prov.')<br>
                                  Tel. '.$tel.' '.($fax!=''?' Fax. '.$fax:'').' E-mail: '.$rows['email'].'<br>
                                  SitoWeb: '.$SitoWeb.'<br><br>
                                  In base alla nostra prenotazione Nr.<b>'.$NumeroPrenotazione.'</b> avremo come ospiti Nr.<b>'.$_REQUEST['param'].'</b> persone, presso la nostra stuttura ricettiva dal <b>'.$DataArrivo.'</b> al <b>'.$DataPartenza.'</b>
                                    <br>';

                                    $select = "SELECT * FROM hospitality_checkin WHERE idsito = ".IDSITO." AND Prenotazione = ".$NumeroPrenotazione." ORDER BY Id ASC";
                                    $res = $db->query($select);
                                    $record = $db->result($res);  
                                    $i = 1;  
                                    foreach ($record as $key => $value) {
                                       $output .= '
                                                        <table cellpadding="3" cellspacing="3" align="left" width="80%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                            <tr>
                                                                <td style="width:20%"><b>Tipo Componente</b></td>
                                                                <td style="width:30%">'.$value['TipoComponente'].'</td>
                                                                <td style="width:20%"></td>
                                                                <td style="width:30%"></td>

                                                            </tr>
                                                            <tr>
                                                               <td style="width:20%"><b>Tipo Documento</b></td>
                                                                <td style="width:30%">'.$value['TipoDocumento'].'</td>
                                                                <td style="width:20%"><b>Numero Documento</b></td>
                                                                <td style="width:30%">'.$value['NumeroDocumento'].'</td>

                                                            </tr>
                                                            <tr>
                                                               <td style="width:20%"><b>Comune di Emissione</b></td>
                                                                <td style="width:30%">'.$value['ComuneEmissione'].'</td>
                                                                <td style="width:20%"><b>Stato di Emissione</b></td>
                                                                <td style="width:30%">'.$value['StatoEmissione'].'</td>

                                                            </tr>
                                                            <tr>
                                                                <td style="width:20%"><b>Data Rilascio</b></td>
                                                                <td style="width:30%">'.gira_data($value['DataRilascio']).'</td>
                                                                <td style="width:20%"><b>Data Scadenza</b></td>
                                                                <td style="width:30%">'.gira_data($value['DataScadenza']).'</td>
                                                            </tr>                                                            
                                                        </table>
                                                        <div style="clear:both;height:20px"></div>'; 
                                        $output .='
                                                        <table cellpadding="3" cellspacing="3" align="left" width="80%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                            <tr>
                                                                <td style="width:20%"><b>Nome</b></td>
                                                                <td style="width:30%">'.stripslashes($value['Nome']).'</td>
                                                                <td style="width:20%"><b>Cognome</b></td>
                                                                <td style="width:30%">'.stripslashes($value['Cognome']).'</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:20%"><b>Sesso</b></td>
                                                                <td style="width:30%">'.$value['Sesso'].'</td>
                                                                <td style="width:20%"><b>Cittadinanza</b></td>
                                                                <td style="width:30%">'.$value['Cittadinanza'].'</td>
                                                            </tr>';
                                        if($value['lang']=='it'){                   
                                            $output .= '<tr>
                                                                    <td style="width:20%"><b>Indirizzo</b></td>
                                                                    <td style="width:30%">'.$value['Indirizzo'].'</td>
                                                                    <td style="width:20%"><b>Città</b></td>
                                                                    <td style="width:30%">'.$value['Citta'].'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:20%"><b>Provincia</b></td>
                                                                    <td style="width:30%">'.$value['Provincia'].'</td>
                                                                    <td style="width:20%"><b>Cap</b></td>
                                                                    <td style="width:30%">'.$value['Cap'].'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:20%"><b>Data di Nascita</b></td>
                                                                    <td style="width:30%">'.gira_data($value['DataNascita']).'</td>
                                                                    <td style="width:20%"><b>Stato di Nascita</b></td>
                                                                    <td style="width:30%">'.$value['StatoNascita'].'</td>
                                                                </tr> 
                                                                <tr>
                                                                    <td style="width:20%"><b>Luogo di Nascita</b></td>
                                                                    <td style="width:30%">'.$value['LuogoNascita'].'</td>
                                                                    <td style="width:20%"><b>Provincia di Nascita</b></td>
                                                                    <td style="width:30%">'.$value['ProvinciaNascita'].'</td>
                                                                </tr> ';
                                        }else{
                                            $output .= '<tr>
                                                                        <td style="width:20%"><b>Indirizzo</b></td>
                                                                        <td style="width:30%">'.$value['Indirizzo'].'</td>
                                                                        <td style="width:20%"><b>Città</b></td>
                                                                        <td style="width:30%">'.$value['CittaBis'].'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width:20%"><b>Provincia</b></td>
                                                                        <td style="width:30%">'.$value['ProvinciaBis'].'</td>
                                                                        <td style="width:20%"><b>Cap</b></td>
                                                                        <td style="width:30%">'.$value['Cap'].'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width:20%"><b>Data di Nascita</b></td>
                                                                        <td style="width:30%">'.gira_data($value['DataNascita']).'</td>
                                                                        <td style="width:20%"><b>Stato di Nascita</b></td>
                                                                        <td style="width:30%">'.$value['StatoNascita'].'</td>
                                                                    </tr> 
                                                                    <tr>
                                                                        <td style="width:20%"><b>Luogo di Nascita</b></td>
                                                                        <td style="width:30%">'.$value['LuogoNascitaBis'].'</td>
                                                                        <td style="width:20%"><b>Provincia di Nascita</b></td>
                                                                        <td style="width:30%">'.$value['ProvinciaNascitaBis'].'</td>
                                                                    </tr> ';
                                        }
                                        $output .=     '<tr>
                                                                <td style="width:20%"><b>Note</b></td>
                                                                <td colspan="3" style="width:80%">'.$value['Note'].'</td>
                                                            </tr> 
                                                        </table>
                                                        <div style="clear:both;height:30px"></div>'; 
                                                                                       
                                    }


        $output .='            <div style="clear:both;height:50px"></div>
                                    Cordiali saluti.
                                    <br>
                                    <b>'.NOMEHOTEL.'</b>';






$pulsante_indietro ='<a class="btn btn-warning " href="'.BASE_URL_SITO.'checkinonline-schedine_alloggiati/"><i class="fa fa-arrow-left"></i> torna indietro</a>';
?>