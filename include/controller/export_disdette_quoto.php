<?php
error_reporting(0);
if($_REQUEST['action']=='export'){
    
    include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
    include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
    include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');
    
    $inner = 'INNER JOIN hospitality_tipo_voucher_cancellazione ON hospitality_tipo_voucher_cancellazione.Id = hospitality_guest.IdMotivazione';


    $q = "SELECT         
            hospitality_guest.Id,        
            hospitality_guest.DataValiditaVoucher,
            hospitality_guest.DataVoucherRecSend, 
            hospitality_guest.DataChiuso,
            hospitality_guest.NumeroPrenotazione,
            hospitality_guest.Nome,
            hospitality_guest.Cognome,
            hospitality_guest.Email,
            hospitality_guest.Cellulare,
            hospitality_tipo_voucher_cancellazione.Motivazione 
        FROM 
            hospitality_guest ".$inner." 
        WHERE 
            hospitality_guest.idsito = ".$_REQUEST['idsito']." ";



    if($_REQUEST['DataVoucherRecSend_dal']!=''){
      $data_dal_tmp_     = explode("/",$_REQUEST['DataVoucherRecSend_dal']);
      $data_dal          = $data_dal_tmp_[2].'-'.$data_dal_tmp_[1].'-'.$data_dal_tmp_[0]. ' 00:00:00';
    }
    if($_REQUEST['DataVoucherRecSend_al'] !=''){
      $data_al_tmp_      = explode("/",$_REQUEST['DataVoucherRecSend_al']);
      $data_al           = $data_al_tmp_[2].'-'.$data_al_tmp_[1].'-'.$data_al_tmp_[0] . ' 23:59:59';
    }
    if($_REQUEST['DataVoucherRecSend_dal']!='' && $_REQUEST['DataVoucherRecSend_al'] ==''){
        $q .= " AND hospitality_guest.DataChiuso >= '".$data_dal."' ";
    }
    if($_REQUEST['DataVoucherRecSend_dal']!='' && $_REQUEST['DataVoucherRecSend_al'] !=''){
        $q .= " AND (hospitality_guest.DataChiuso >= '".$data_dal."' AND hospitality_guest.DataChiuso <= '".$data_al."') ";
    }

    if($_REQUEST['motivazione']!=''){
         $q .= " AND hospitality_guest.IdMotivazione = '".$_REQUEST['motivazione']."' ";
    }
    if($_REQUEST['DataRiconferma']!=''){   

        if($_REQUEST['DataRiconferma']=='pending'){
    
            $q  .= "AND 
                        hospitality_guest.DataChiuso IS NULL";
    
        }else{
    
            $q  .= "AND 
                        hospitality_guest.DataRiconferma ".($_REQUEST['DataRiconferma']=='sale'?'IS NOT NULL AND 
                        hospitality_guest.DataChiuso IS NOT NULL':'').
                        ($_REQUEST['DataRiconferma']=='wait'?'IS NULL':'')." ";
        }
    
    }

    $q .= " ORDER BY hospitality_guest.DataChiuso DESC ";



    $rec    = $dbMysqli->query($q);
    $tot    = sizeof($rec);
    $valori = array();

    if($tot > 0){

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=export_'.$_REQUEST['idsito'].'_'.date('d-m-Y').'.csv');
        header('Pragma: no-cache');
        error_reporting(0);
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // output the column headings
        fputcsv($output, array('Nr.Prenotazione', 'Nome', 'Cognome', 'Email', 'Telefono', 'Data Prenotazione', 'Motivazione', 'Data invio email disdetta', 'Data validita voucher', 'Caparra', 'Cifra a saldo', 'Prezzo Ssoggiorno'),';');

        error_reporting(0);
        foreach ($rec as $key => $val) {


                $query = "SELECT 
                                hospitality_proposte.Id                 as IdProposta,
                                hospitality_proposte.Arrivo             as Arrivo,
                                hospitality_proposte.Partenza           as Partenza,
                                hospitality_proposte.NomeProposta       as NomeProposta,
                                hospitality_proposte.TestoProposta      as TestoProposta,
                                hospitality_proposte.CheckProposta      as CheckProposta,
                                hospitality_proposte.PrezzoL            as PrezzoL,
                                hospitality_proposte.PrezzoP            as PrezzoP,
                                hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
                                hospitality_proposte.AccontoImporto     as AccontoImporto,
                                hospitality_proposte.AccontoTariffa     as AccontoTariffa,
                                hospitality_proposte.AccontoTesto       as AccontoTesto
                            FROM 
                                hospitality_proposte
                            WHERE 
                                hospitality_proposte.id_richiesta = ".$val['Id']."
                            GROUP BY 
                                hospitality_proposte.Id";

                $array_record      = $dbMysqli->query($query);

                $PrezzoL            = '';
                $PrezzoP            = ''; 
                $PrezzoPC           = ''; 
                $AccontoPercentuale = ''; 
                $AccontoImporto     = ''; 
                $AccontoTariffa     = '';  
                $AccontoTesto       = '';  
                $percentuale_sconto = '';
                $saldo              = '';
                $acconto            = '';
                $saldo              = floatval($saldo);

                foreach($array_record as $key => $rec){

            
                    $PrezzoL            = number_format($rec['PrezzoL'],2,',','.');
                    $PrezzoP            = number_format($rec['PrezzoP'],2,',','.'); 
                    $PrezzoPC           = $rec['PrezzoP']; 
                    $AccontoPercentuale = $rec['AccontoPercentuale'];
                    $AccontoImporto     = $rec['AccontoImporto'];
                    $AccontoTariffa     = stripslashes($rec['AccontoTariffa']); 
                    $AccontoTesto       = stripslashes($rec['AccontoTesto']); 


                    if($PrezzoL!='0,00'){
                        $percentuale_sconto =  str_replace(",00", "",number_format((100-(100*$rec['PrezzoP'])/$rec['PrezzoL']),2,',','.'));             
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
                        $saldo   = ($PrezzoPC-$AccontoImporto);
                        $acconto = number_format($AccontoImporto,2,',','.');
                    }
                    
                    if($record['DataVoucherRecSend']!='' && $record['DataVoucherRecSend']!='0000-00-00'){
                    $totale  += ($acconto!=''?$acconto:0);
                    }

                
                }


                if($val['DataVoucherRecSend']!='' && $val['DataVoucherRecSend']!='0000-00-00'){

                    $valori = array($val['NumeroPrenotazione'],$val['Nome'],$val['Cognome'],$val['Email'],$val['Cellulare'],gira_data($val['DataChiuso']),$val['Motivazione'],gira_data($val['DataVoucherRecSend']),gira_data($val['DataValiditaVoucher']),($acconto!=''?$acconto:'00,0'),($acconto!=''?$acconto:'00,0'),number_format(floatval($saldo),2,',','.'),$PrezzoP);
           
                 }
                  fputcsv($output,$valori,';');

        }
        fclose($output);

    }

}
