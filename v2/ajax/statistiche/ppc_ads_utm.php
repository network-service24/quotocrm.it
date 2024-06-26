<?php
include($_SERVER['DOCUMENT_ROOT'].'/v2/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/v2/include/declaration.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/v2/class/functions.class.php');
$fun = new functions();

$idsito                        = $_REQUEST['idsito'];

$filter_query                  = $_REQUEST['filter_query'];

$totalePPCn = $fun->fatt_utm($idsito,$filter_query,'google','cpc');

$rws9n      = $fun->campagne_utm($idsito,'google','cpc');

$totCampn = count($rws9n);

$output = '';

if ($totCampn > 0) {

    $output = '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                            <tr>
                                <th class="nowrap thStatistiche">Campagne</th>
                                <th class="nowrap text-center thStatistiche">Ricevute</th>
                                <th class="nowrap text-center thStatistiche">Inviate</th>
                                <th class="nowrap text-center thStatistiche">Confermate</th>
                                <th class="nowrap text-center thStatistiche">Conversione %</th>                          
                                <th class="nowrap text-center thStatistiche">Fatturato</th>
                            </tr>';

    $numero_landing       = '';
    $numero_sito          = '';
    $n_landing            = '';
    $n_sito               = '';
    $preno_chiuse         = '';
    $numero_prev_send     = '';

    $tot_ricevute   = '';
    $tot_inviate    = '';
    $tot_confermate = '';

    foreach ($rws9n as $key9n => $value9n) {

        $numero_campagne   = $fun->CountRicevuteCampagnaAds($idsito,$value9n['Campagna'],'google','cpc',$filter_query);
        $numero_prev_send  = $fun->CountInviateCampagnaAds($idsito,$value9n['Campagna'],'google','cpc',$filter_query);
        $preno_chiuse      = $fun->CountConfermateCampagnaAds($idsito,$value9n['Campagna'],'google','cpc',$filter_query);
        $totalePerCampagna = $fun->fatturato_per_campagna($idsito, $value9n['Campagna'],'google','cpc',$filter_query);

        $totRichieste += $numero_campagne;
        
        $fatturatoCampn = $totalePPCn;
        if ($fatturatoCampn == '') $fatturatoCampn = 0;
        $array_fatturatoSn[] = $fatturatoCampn;


        $tassoConvConferme = $numero_prev_send > 0 ? number_format($preno_chiuse * 100 / $numero_prev_send, 2, ',', '.') . '%' : '-';

        $output .= '<tr>
                        <td class="text-left nowrap">' . $value9n['Campagna'] . '</td>
                        <td class="text-center">' . $numero_campagne . '</td>   
                        <td class="text-center">' . $numero_prev_send . '</td> 
                        <td class="text-center">' . $preno_chiuse . '</td>
                        <td class="text-center">' . $tassoConvConferme . '</td>                     
                        <td class="text-right nowrap"><i class="fa fa-euro"></i> ' . number_format($totalePerCampagna, 2, ',', '.') . '</td>
                    </tr>';


        $numero_landing       = '';
        $numero_sito          = '';
        $n_landing            = '';
        $n_sito               = '';
        $preno_chiuse         = '';
        $numero_prev_send     = '';


    }
    
    $numero_landing       = '';
    $numero_sito          = '';
    $n_landing            = '';
    $n_sito               = '';
    $preno_chiuse         = '';
    $numero_prev_send     = '';

    $output .= '<tr>
                    <td><b>TOTALE</b></td>
                    <td></td>
                    <td class="text-center"></td>   
                    <td class="text-center"></td> 
                    <td class="text-center"></td>
                    <td class="text-right nonowrap"><b><i class="fa fa-euro"></i><b> ' . number_format($totalePPCn, 2, ',', '.') . '</b></td>
                </tr>';
    $output .= '</table>';

}


echo $output;
