<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$idsito  = $_REQUEST['idsito'];
$Nome    = urldecode($_REQUEST['Nome']);
$Cognome = urldecode($_REQUEST['Cognome']);
$Email   = $_REQUEST['Email'];

    $select = "SELECT count(Id) as num_cl
                FROM hospitality_guest
            WHERE hospitality_guest.Nome = '".$dbMysqli->escape($Nome)."'
                AND hospitality_guest.Cognome = '".$dbMysqli->escape($Cognome)."'
                AND hospitality_guest.Email = '".$dbMysqli->escape($Email)."'
                AND hospitality_guest.TipoRichiesta = 'Preventivo'
                AND hospitality_guest.idsito = ".$idsito;

    $result = $dbMysqli->query($select);
    $row = $result[0];

    if($row['num_cl']>1){
        echo '<i class="fa fa-star text-red" style="font-size:60%!important" title="Cliente già presente nel DB di QUOTO!"></i>';
    }else{
        echo '';
    }
?>
