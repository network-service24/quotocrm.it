<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/class/statistiche.class.php');
$stat = new statistiche();

$idsito        =      $_REQUEST['idsito'];

$sorgente      =      explode("-",urldecode($_REQUEST['sorgente']));

if(count($sorgente)==3){
    $source    =      $sorgente[0].'-'.$sorgente[1];
    $medium    =      $sorgente[2];
}else{
    $source    =      $sorgente[0];
    $medium    =      $sorgente[1];
}

$filtroQuery   =      urldecode($_REQUEST['filtroQuery']);

$result   = $stat->dett_preno_sitoweb_utm($idsito,$filtroQuery,$source,$medium);

$tot      = count($result);

if($tot){

    echo '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-11">'."\r\n";
    echo '  <tr>
                <th class="text-center"></th>
                <th class="text-center"><b>Nr.preno</b></th>
                <th class="text-center"><b>Sorgente</b></th>
                <th class="text-center"><b>Tipo</b></th>
                <th class="text-center"><b>Data Conf/Data Preno</b></th>
                <th class="text-center"><b>Soggiorno</b></th>
            </tr>'."\r\n";
    $n = 1;
    foreach($result as $key => $record){

        $rec = $stat->fatt_dett_preno_sitoweb_utm($record['Id']);

        $totale_fatturato += $rec['fatturato'];

        echo '  <tr>
                    <td>'.$n.')</td>
                    <td>'.$record['NumeroPrenotazione'].'</td>
                    <td class="text-center">'.$source.'-'.$medium.'</td>
                    <td class="text-center">'.($record['DataChiuso']!=''?'<small class="text-green">Preno confermata</small>':'<small class="text-orange">Conferma in trattativa</small>').'</td>
                    <td class="text-center">'.($record['DataChiuso']!=''?gira_data($record['DataChiuso']):gira_data($record['DataRichiesta'])).'</td>
                    <td class="text-right"><i class="fa fa-euro"></i> '.number_format($rec['fatturato'],2,',','.').'</td>
                </tr>'."\r\n";
        $n++;
    }
    echo ' 
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-right"><b>Totale</b></td>
                <td class="text-right"><i class="fa fa-euro"></i> '.number_format($totale_fatturato,2,',','.').'</td>
            </tr>'."\r\n";
    echo '</table>';
}

?>