<?php
include($_SERVER['DOCUMENT_ROOT'].'/v2/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/v2/include/declaration.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/v2/include/function.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/v2/class/functions.class.php');
$fun = new functions();

$idsito        =      $_REQUEST['idsito'];

$sorgente      =      explode("-",urldecode($_REQUEST['sorgente']));

$source        =      $sorgente[0];

$medium        =      $sorgente[1];

$filtroQuery   =      urldecode($_REQUEST['filtroQuery']);

$result   = $fun->dett_preno_sitoweb_referrer($idsito,$filtroQuery);

$tot      = count($result);

if($tot){

    echo '  <div class="row">
                <div class="col-md-1"><b>Nr.</b></div>
                <div class="col-md-3"><b>Sorgente</b></div>
                <div class="col-md-2"></div>
                <div class="col-md-3"><b>Data Conf/Data Preno</b></div>
                <div class="col-md-3"><b>Prezzo Soggiorno</b></div>
            </div>
            <br/>'."\r\n";
    $n = 1;
    foreach($result as $key => $record){

        $rec = $fun->fatt_dett_preno_sitoweb_utm($record['Id']);

        $totale_fatturato += $rec['fatturato'];

        echo '  <div class="row">
                <div class="col-md-1 nowrap">'.$n.') '.$record['NumeroPrenotazione'].'</div>
                <div class="col-md-3">'.$record['utm_source'].'-'.$medium.'</div>
                <div class="col-md-2">'.($record['DataChiuso']!=''?'<small class="text-green">Preno confermata</small>':'<small class="text-orange">Conferma in trattativa</small>').'</div>
                <div class="col-md-3">'.($record['DataChiuso']!=''?gira_data($record['DataChiuso']):gira_data($record['DataRichiesta'])).'</div>
                <div class="col-md-3"><i class="fa fa-euro"></i> '.number_format($rec['fatturato'],2,',','.').'</div>
            </div>'."\r\n";
        $n++;

    }
    echo '  <br/>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3"></div>
                <div class="col-md-2"></div>
                <div class="col-md-3"><b>Totale</b></div>
                <div class="col-md-3"><i class="fa fa-euro"></i> '.number_format($totale_fatturato,2,',','.').'</div>
            </div>'."\r\n";
}

?>