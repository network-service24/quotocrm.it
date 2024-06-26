<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$notti         = $_REQUEST['notti'];
$idsito        = $_REQUEST['idsito'];
$n_proposta    = $_REQUEST['n_proposta'];
$id_servizio   = $_REQUEST['id_servizio'];
$action        = $_REQUEST['action'];
$prezzo        = $_REQUEST['prezzo'];
$NPersone      = $_REQUEST['NPersone'];


if($action == 're_calc'){
    if($prezzo == 0){
        $prezzo = 'gratis';
    }else{
        $prezzo = $prezzo;
    }
    $totale_unitaro_servizio = (($prezzo * $NPersone)*$notti);
    if($totale_unitaro_servizio == 0){
        $totale_unitaro_servizio = 'gratis';
    }else{
        $totale_unitaro_servizio = number_format($totale_unitaro_servizio,2,',','.');
    }
    $re_testo .='<div><small>(<b>'.$prezzo.'</b> <span class="text-primary">X</span> <b>'.$notti.'</b> <span class="text-primary">X</span> <b>'.$NPersone.'</b> <span class="text-primary">=</span> <b>'.$totale_unitaro_servizio.'</b>)</small></div>';
    $re_testo .='<input type="hidden" name="notti'.$n_proposta.'_'.$id_servizio.'" id="notti'.$n_proposta.'_'.$id_servizio.'"  value="'.$notti .'"/><input type="hidden" name="num_persone_'.$n_proposta.'_'.$id_servizio.'" id="num_persone'.$n_proposta.'_'.$id_servizio.'" value="'.$NPersone .'"/>';
    
    echo $re_testo;
}