<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");


$select = " SELECT 
                *
            FROM
                report_clienti
            WHERE 1 = 1
            ".($_REQUEST['idsito']!=''?' AND report_clienti.idsito = '.$_REQUEST['idsito']:'')."
            ".($_REQUEST['data_report']!=''?' AND report_clienti.data_report  = "'.$_REQUEST['data_report'].'"':'')."
            ORDER BY
                report_clienti.data_report
            DESC ";

$array_dati = $dbMysqli->query($select);

#dichiaro le variabili
$nomesito      = '';
$quoto         = '';
$ButtonQto     = '';
$ButtonPdfQto  = '';
$ButtonMerge   = '';


foreach($array_dati as $key => $row){


    $quoto       = $row['quoto'];

    $nomesito     = $fun->nomeSito($row['idsito']);

    $ButtonQto    = "<a href='".BASE_URL_ADMIN."report/quoto_mod/".$nomesito."/".$row['idsito']."/".$quoto."/' class='btn btn-sm btn-default  btn-custom ' title='Modifica report Quoto'><i class='fa fa-pencil'></i></a>";
    $ButtonPdfQto = "<a href='".BASE_URL_ADMIN."report/document/".$row['idsito']."/".$nomesito."_qto_".flip_data($row['data_report']).".pdf' target='_blank' class='btn btn-sm btn-default  btn-custom ' title='PDF report Quoto'><i class='fa fa-file-pdf-o'></i></a>";
    $ButtonDelQto = "<a href='javascript:;' onclick='validator(\"".BASE_URL_ADMIN."report/quoto_del/".$nomesito."/".$row['idsito']."/".$quoto."/".flip_data($row['data_report'])."\")' class='btn btn-sm btn-default btn-custom ' title='Elimina report Quoto'><i class='fa fa-remove'></i></a>";
   
    $ButtonDelMerge = "<a href='javascript:;' onclick='validator(\"".BASE_URL_ADMIN."report/merge_del/".$nomesito."/".$row['idsito']."/".flip_data($row['data_report'])."\")'  class='btn btn-sm btn-danger btn-custom '  title='Elimina tutto'><i class='fa fa-remove fa-fw'></i></a>";

    $data[] = array(													
                    "web"                 => '<a href="'.BASE_URL_ADMIN.'report/index/'.$row['idsito'].'/" title="Clicca per tornare alla creazione dei Report del cliente"><i class="fa fa-external-link fa-flip-horizontal"></i></a> '.$nomesito,
                    "data_report"         => '<span class="ordinamento">'.$row['data_report'].'</span>'.gira_data($row['data_report']),
                    "quoto"               => ($quoto!=''?$ButtonQto.' '.$ButtonPdfQto.' '.$ButtonDelQto:''),
                    "action"              =>  $ButtonDelMerge
                    );


}

$json_data = array(
    "draw"            => 1,
    "recordsTotal"    => sizeof($array_dati),
    "recordsFiltered" => sizeof($array_dati),
    "data" 			  => $data
    ); 



if(empty($json_data) || is_null($json_data)){
    $json_data = NULL;
}else{
    $json_data = json_encode($json_data);
} 

echo $json_data; 

?>