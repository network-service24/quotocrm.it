<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

$notti         = $_REQUEST['notti'];
$idsito        = $_REQUEST['idsito'];
$n_proposta    = $_REQUEST['n_proposta'];
$id_proposta   = $_REQUEST['id_proposta'];
$id_servizio   = $_REQUEST['id_servizio'];
$action        = $_REQUEST['action'];
$prezzo        = $_REQUEST['prezzo'];
$NPersone      = $_REQUEST['NPersone'];
$ReCalPrezzo   = $_REQUEST['ReCalPrezzo'];
$check         = $_REQUEST['check'];
$ReCalCaparra  = $_REQUEST['ReCalCaparra'];
$PercentualeCaparra   = $_REQUEST['PercCaparra'];

if($action == 're_calc'){
    if($prezzo == 0){
        $prezzo = 'gratis';
    }else{
        $prezzo = number_format($prezzo,2,',','.');
    }
    $totale_unitaro_servizio = (($prezzo * $NPersone)*$notti);
    if($totale_unitaro_servizio == 0){
        $totale_unitaro_servizio = '';
    }else{
        if($check == 1){
            $totale_soggiorno = ($ReCalPrezzo+$totale_unitaro_servizio);
        }
        if($check == 0){
            $totale_soggiorno = ($ReCalPrezzo-$totale_unitaro_servizio);
        }
    }

    echo'   <script type="text/javascript">
                $(document).ready(function() {';
    echo '          $("#RecPrezzo_Servizio_'.$n_proposta.'_'.$id_servizio.'").val(\''.number_format($totale_unitaro_servizio,2,',','.').'\');';
    echo'           $("#Prezzo_Servizio_'.$n_proposta.'_'.$id_servizio.'").html(\'<span class="nowrap" style="font-size:70%;padding-right:10px">('.$prezzo.' <span class="text-red">X</span> '.$notti.' <span class="text-red">X</span> '.$NPersone.')</span> <i class="fa fa-euro"></i>  '.number_format($totale_unitaro_servizio,2,',','.').'\');';       
    echo '          $("#PrezzoPC'.$n_proposta.'_'.$id_proposta.'").html(\''.number_format($totale_soggiorno,2,',','.').'\');';
    echo '          $("#ReCalPrezzo'.$n_proposta.'_'.$id_proposta.'").val(\''.$totale_soggiorno.'\');';  
    echo '          $("#ReCalCaparra'.$n_proposta.'_'.$id_proposta.'").html(\''.number_format(($totale_soggiorno*$PercentualeCaparra/100),2,',','.').'\');';
    echo '          $("#PrezzoTitolo'.$n_proposta.'").html(\''.number_format($totale_soggiorno,2,',','.').'\');';
    echo '          $("#PrezzoSpecchietto'.$n_proposta.'").html(\''.number_format($totale_soggiorno,2,',','.').'\');';
    echo '          $("#PrezzoForm'.$n_proposta.'").html(\''.number_format($totale_soggiorno,2,',','.').'\');';
    echo'       
                });
            </script>';	

}