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

    $filter_query = " AND ((hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$DataRichiesta_dal' AND DATE(hospitality_guest.DataChiuso) <= '$DataRichiesta_al'))";

}else{

    $dal = mktime(0,0,0,01,01,date('Y'));

    $al  = mktime(0,0,0,date('m'),date('d'),date('Y'));

    $data_1_tmp       = date('d/m/Y',$dal);

    $data_2_tmp       = date('d/m/Y',$al);

    $DataRichiesta_dal = date('Y-m-d',$dal);

    $DataRichiesta_al = date('Y-m-d',$al);


    $filter_query = " AND ((hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$DataRichiesta_dal' AND DATE(hospitality_guest.DataChiuso) <= '$DataRichiesta_al'))";

}
$filter_query = urlencode($filter_query);