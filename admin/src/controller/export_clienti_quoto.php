<?

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');


    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=export_'.$_REQUEST['idsito'].'.csv');
    header('Pragma: no-cache');
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the column headings
    fputcsv($output, array('Tipo Richiesta', 'Fonte Prenotazione', 'Referer', 'Target', 'Lingua', 'Nome', 'Cognome', 'Email', 'Data Arrivo', 'Data Partenza', 'Prenotazione Chiusa', 'Prenotazione Disdetta', 'Consenso Privacy', 'Consenso Marketing'),';');


    $q = "SELECT * FROM hospitality_guest WHERE idsito = ".$_REQUEST['idsito']." ";


    $data_dal         = $_REQUEST['DataArrivo'];
    $data_al          = $_REQUEST['DataPartenza'];

    if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] ==''){
        $q .= " AND DataArrivo >= '".$data_dal."' ";            
    }
    if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] !=''){
        $q .= " AND (DataArrivo >= '".$data_dal."' AND DataPartenza <= '".$data_al."')";          
    }
    if($_REQUEST['TipoRichiesta']!=''){
         $q .= " AND TipoRichiesta = '".$_REQUEST['TipoRichiesta']."' "; 
    }
    if($_REQUEST['TipoVacanza']!=''){
         $q .= " AND TipoVacanza = '".$_REQUEST['TipoVacanza']."' "; 
    }         
    if($_REQUEST['FontePrenotazione']!=''){
        $q .= " AND FontePrenotazione = '".$_REQUEST['FontePrenotazione']."' "; 
    }
    if($_REQUEST['Chiuso']!=''){
        $q .= " AND Chiuso = '".$_REQUEST['Chiuso']."' "; 
    }
    if($_REQUEST['Disdetta']!=''){
        $q .= " AND Disdetta = '".$_REQUEST['Disdetta']."' "; 
    }
    if($_REQUEST['Lingua']!=''){
        $q .= " AND Lingua = '".$_REQUEST['Lingua']."' "; 
    }  
    if($_REQUEST['CheckConsensoPrivacy']!=''){
        $q .= " AND CheckConsensoPrivacy = '".$_REQUEST['CheckConsensoPrivacy']."' "; 
    } 
    if($_REQUEST['CheckConsensoMarketing']!=''){
        $q .= " AND CheckConsensoMarketing = '".$_REQUEST['CheckConsensoMarketing']."' "; 
    } 

    if($_REQUEST['order'] != "" && $_REQUEST['tipo'] != ""){
            $q .= " ORDER BY ".$_REQUEST['tipo']." ".$_REQUEST['order']." ";
    }else{
            $q .= " ORDER BY Id DESC ";
    }
    $rec = $dbMysqli->query($q);


    $valore_provenienza = '';
    $privacy            = ''; 
    $marketing          = '';
    foreach ($rec as $key => $val) {

        if($val['FontePrenotazione']=='Sito Web'){
            # provenienza referer
        		$select  = "	SELECT 
									hospitality_utm_ads.*
								FROM 
									hospitality_guest
								INNER JOIN 
                                    hospitality_utm_ads
                                ON 
                                    hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione 										
								WHERE 
									hospitality_guest.idsito = ".$val['idsito']."
                                AND 
                                    FontePrenotazione = 'Sito Web' 
								AND 
                                    hospitality_utm_ads.NumeroPrenotazione = ".$val['NumeroPrenotazione']." 
								AND 
									hospitality_utm_ads.idsito = ".$val['idsito']." ";
                $result  = $dbMysqli->query($select);
                $record  = $result[0];



		    if(sizeof($result)>0){


                if($record['utm_source'] != '' && $record['utm_medium'] != '' && $record['utm_campaign'] != ''){
                    $valore_provenienza = $record['utm_source'].'-'.$record['utm_medium'];
                }elseif($record['utm_source'] == '' && $record['utm_medium'] == '' && $record['utm_campaign'] == '' && $record['referrer'] == '/'){
					$valore_provenienza = 'Diretto';
                }elseif($record['utm_source'] == '' && $record['utm_medium'] == '' && $record['utm_campaign'] == '' && strstr($record['referrer'],SITOWEB,true)){
                    $valore_provenienza = 'Organico';
                }elseif($record['utm_source'] == '' && $record['utm_medium'] == '' && $record['utm_campaign'] == '' && strstr($record['referrer'],SITOWEB,false)){
                    $valore_provenienza = 'Organico';				
				}else{
					$valore_provenienza = 'Referral/Altro';
				}
            }

        }else{
            $valore_provenienza = '';
        }

 
            $privacy   = ($val['CheckConsensoPrivacy']==1?'Si':'No'); 
            $marketing = ($val['CheckConsensoMarketing']==1?'Si':'No');

        fputcsv($output, array($val['TipoRichiesta'],$val['FontePrenotazione'],$valore_provenienza,$val['TipoVacanza'],$val['Lingua'],$val['Nome'],$val['Cognome'],$val['Email'],gira_data($val['DataArrivo']),gira_data($val['DataPartenza']),($val['Chiuso']==1?'Si':'No'),($val['Disdetta']==1?'Si':'No'),$privacy,$marketing),';');

        
    }
    $privacy            = ''; 
    $marketing          = '';
