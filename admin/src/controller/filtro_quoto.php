<?


    // query per il select della lista anagrafiche
      $sql = "SELECT siti.idsito,siti.web, siti.data_end_hospitality
              FROM siti
              WHERE siti.hospitality = 1
              AND siti.web != ''
              GROUP BY siti.web
              ORDER BY siti.web ASC";
    $risultati = $dbMysqli->query($sql);   
    foreach($risultati as $k => $rw){
      $lista_siti .= '<option value="'.$rw['idsito'].'" '.($rw['idsito']==$_REQUEST['idsito']?'selected="selected"':'').' '.($rw['data_end_hospitality']<=date('Y-m-d')?'style="color:#FF0000!important"':'').'>'.$rw['web'].'</option>';
    }
          

    $lang = array('it','en','fr','de');
    foreach ($lang as $ky => $v) {
        $Lingua .= '<option value="'.$v.'" '.($v==$_REQUEST['Lingua']?'selected="selected"':'').'>'.$v.'</option>';
    }


    $ris    = array('Preventivo','Conferma');
    foreach ($ris as $y => $vl) {
        $TipoRichiesta.= '<option value="'.$vl.'" '.($vl==$_REQUEST['TipoRichiesta']?'selected="selected"':'').'>'.$vl.'</option>';
    }

if($_REQUEST['idsito'] != ''){


    $q = "SELECT * FROM hospitality_guest WHERE idsito = ".$_REQUEST['idsito']." ";

    $data_dal         = $_REQUEST['DataArrivo'];
    $data_al          = $_REQUEST['DataPartenza'];

    if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] ==''){
        $q .= " AND DataArrivo >= '".$data_dal."' ";            
    }
    if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] !=''){
        $q .= " AND DataArrivo >= '".$data_dal."' AND DataPartenza <= '".$data_al."'";          
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
    $totale = sizeof($rec);




    $lista .= '<table class="table table-hover table-striped table-bordered pl-2 pr-2 small">
                    <tr>
                        <th style="width:15%" class="nowrap">Tipo Richiesta &nbsp;<a href="'.($_REQUEST['page']!=''?'&page='.$_REQUEST['page']:'').'&order=ASC&tipo=TipoRichiesta&idsito='.$_REQUEST['idsito'].'"><i class="fa fa-sort-asc"></i></a>&nbsp;<a href="'.($_REQUEST['page']!=''?'&page='.$_REQUEST['page']:'').'&order=DESC&tipo=TipoRichiesta&idsito='.$_REQUEST['idsito'].'"><i class="fa fa-sort-desc"></i></a></th>
                        <th style="width:15%" class="nowrap">Fonte di Prenotazione &nbsp;<a href="'.($_REQUEST['page']!=''?'&page='.$_REQUEST['page']:'').'&order=ASC&tipo=FontePrenotazione&idsito='.$_REQUEST['idsito'].'"><i class="fa fa-sort-asc"></i></a>&nbsp;<a href="'.($_REQUEST['page']!=''?'&page='.$_REQUEST['page']:'').'&order=DESC&tipo=FontePrenotazione&idsito='.$_REQUEST['idsito'].'"><i class="fa fa-sort-desc"></i></a></th>
                        <th style="width:10%" class="nowrap">Target <small>(Cliente)</small> &nbsp;<a href="'.($_REQUEST['page']!=''?'&page='.$_REQUEST['page']:'').'&order=ASC&tipo=TipoVacanza&idsito='.$_REQUEST['idsito'].'"><i class="fa fa-sort-asc"></i></a>&nbsp;<a href="'.($_REQUEST['page']!=''?'&page='.$_REQUEST['page']:'').'&order=DESC&tipo=TipoVacanza&idsito='.$_REQUEST['idsito'].'"><i class="fa fa-sort-desc"></i></a></th>
                        <th style="width:2%"  class="text-center">Lingua</th> 
                        <th style="width:10%" class="text-center">Nome</th>                           
                        <th style="width:10%" class="text-center">Cognome</th>
                        <th style="width:10%" class="text-center">Email</th>
                        <th style="width:10%" class="text-center nowrap">Data Arrivo  &nbsp;<a href="'.($_REQUEST['page']!=''?'&page='.$_REQUEST['page']:'').'&order=ASC&tipo=DataArrivo&idsito='.$_REQUEST['idsito'].'"><i class="fa fa-sort-asc"></i></a>&nbsp;<a href="'.($_REQUEST['page']!=''?'&page='.$_REQUEST['page']:'').'&order=DESC&tipo=DataArrivo&idsito='.$_REQUEST['idsito'].'"><i class="fa fa-sort-desc"></i></a> </th>
                        <th style="width:10%" class="text-center nowrap">Data Partenza</th>
                        <th style="width:2%">Chiusa</th>
                        <th style="width:2%">Disdetta</th>
                        <th style="width:2%" class="nowrap"><small>Consenso Privacy<small></th>
                        <th style="width:1%" class="nowrap"><small>Consenso Marketing<small></th>                        
                    </tr>';

    $valore_provenienza = '';

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
                }elseif($record['utm_source'] == '' && $record['utm_medium'] == '' && $record['utm_campaign'] == '' && strstr($record['referrer'],@SITOWEB,true)){
                    $valore_provenienza = 'Organico';
                }elseif($record['utm_source'] == '' && $record['utm_medium'] == '' && $record['utm_campaign'] == '' && strstr($record['referrer'],@SITOWEB,false)){
                    $valore_provenienza = 'Organico';				
				}else{
					$valore_provenienza = 'Referral/Altro';
				}
            }
        }else{
            $valore_provenienza = '';
        }



            $lista .= '<tr>
                            <td class="nowrap"><b>'.$val['TipoRichiesta'].'</b></td>
                            <td>'.$val['FontePrenotazione'].' '.($valore_provenienza!=''?'&nbsp;&nbsp; <i class="fa fa-arrow-right"></i> '.$valore_provenienza.'':'').'</td>
                            <td>'.$val['TipoVacanza'].'</td>
                            <td>'.$val['Lingua'].'</td>
                            <td>'.$val['Nome'].'</td>
                            <td>'.$val['Cognome'].'</td>  
                            <td class="nowrap">'.$val['Email'].'</td>                           
                            <td class="text-center">'.gira_data($val['DataArrivo']).'</td>
                            <td class="text-center">'.gira_data($val['DataPartenza']).'</td>';    
            $lista .= '     <td class="text-center">'.($val['Chiuso']==1?'Si':'No').' </td> 
                            <td class="text-center">'.($val['Disdetta']==1?'Si':'No').' </td>';

            $lista .= '     <td class="text-center">'.($val['CheckConsensoPrivacy']==1?'Si':'No').' </td> 
                            <td class="text-center">'.($val['CheckConsensoMarketing']==1?'Si':'No').' </td>';

            $lista .= ' </tr>';



      
        }

        $lista .= '</table>';
    }