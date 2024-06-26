<?php
if ($_REQUEST['action'] == 'request_date') {
	if($_REQUEST['date']!= ''){
		$date_tmp         = explode("-",$_REQUEST['date']);
		$data_1_tmp       = trim($date_tmp[0]);
		$data_2_tmp       = trim($date_tmp[1]);
		$prima_data_tmp   = explode("/",$data_1_tmp);
		$seconda_data_tmp = explode("/",$data_2_tmp);
		$prima_data       = $prima_data_tmp[2].'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
		$primo_anno       = $prima_data_tmp[2];
		$seconda_data     = $seconda_data_tmp[2].'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];
		$secondo_anno     = $seconda_data_tmp[2];
		$prima_data_it    = $prima_data_tmp[0].'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[2];
		$seconda_data_it  = $seconda_data_tmp[0].'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[2];
		$prima_data_p     = $prima_data_tmp[2].'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0].'';
		$seconda_data_p   =  $seconda_data_tmp[2].'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0].'';
	}
    $DataRichiesta_dal = $prima_data;

    $DataRichiesta_al = $seconda_data;

    $filter = " AND (hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al')";
    $filter_ads = " AND (hospitality_adCost_transactionRevenue_ga4.datastart >= '$DataRichiesta_dal' AND hospitality_adCost_transactionRevenue_ga4.dataend <= '$DataRichiesta_al')";
    $filter_query = " AND ((hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al') OR (date(hospitality_guest.DataChiuso) IS NOT NULL AND date(hospitality_guest.DataChiuso) >= '$DataRichiesta_dal' AND date(hospitality_guest.DataChiuso) <= '$DataRichiesta_al'))";
    $filter_query_custom_client_id = " AND hospitality_custom_dimension_ga4.datesession >= '".$DataRichiesta_dal."' AND hospitality_custom_dimension_ga4.datesession <= '".$DataRichiesta_al."'";
    
}else{
    $dal = mktime(0,0,0,01,01,date('Y'));

    $al  = mktime(0,0,0,date('m'),date('d'),date('Y'));

    $data_1_tmp       = date('d/m/Y',$dal);

    $data_2_tmp       = date('d/m/Y',$al);

    $DataRichiesta_dal = date('Y-m-d',$dal);

    $DataRichiesta_al = date('Y-m-d',$al);

    $filter = " AND (hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al')";
    $filter_ads = " AND (hospitality_adCost_transactionRevenue_ga4.datastart >= '$DataRichiesta_dal' AND hospitality_adCost_transactionRevenue_ga4.dataend <= '$DataRichiesta_al')";
    $filter_query = " AND ((hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al') OR (date(hospitality_guest.DataChiuso) IS NOT NULL AND date(hospitality_guest.DataChiuso) >= '$DataRichiesta_dal' AND date(hospitality_guest.DataChiuso) <= '$DataRichiesta_al'))";
    $filter_query_custom_client_id = " AND hospitality_custom_dimension_ga4.datesession >= '".$DataRichiesta_dal."' AND hospitality_custom_dimension_ga4.datesession <= '".$DataRichiesta_al."'";
}

$legendaSn_BOX .= ' <div id="loading_ppc"></div>
                    <div id="ppc_ads"></div>'."\r\n";

$legendaSn_BOX .= ' <script>
            $(document).ready(function() {
                $("#loading_ppc").html(\'<div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.svg"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del caricamento dati!</small></div>\');
                $.ajax({								 
                    type: "POST",								 
                    url: "'.BASE_URL_SITO.'ajax/statistiche/ppc_ads_ga4.php",								 
                    data: "idsito='.IDSITO.'&filter_query_custom_client_id='.$filter_query_custom_client_id.'&filter_query='.$filter_query.'&filter='.$filter.'&filter_ads='.$filter_ads.'&action='.$_REQUEST['action'].'&querydate='.$_REQUEST['querydate'].'",
                    dataType: "html",
                        success: function(msg){
                            $("#ppc_ads").html(msg);
                            $("#loading_ppc").hide();
                        },
                        error: function(){
                            alert("Risultato non raggiunto, si prega di riprovare abbassando il range temporale!");  
                        }
                });                        
            });
        </script>'."\r\n";

$js_load = '
<script>
    $(document).ready(function() {
        $("#request_date").on("submit",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="' . BASE_URL_SITO . 'img/Ellipsis-1s-200px.svg"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del filtro!</small></div></div>\');
        });
    });
</script>' . "\r\n";