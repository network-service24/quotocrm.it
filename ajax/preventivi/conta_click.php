<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$id   = $_REQUEST['id'];
$idsito        = $_REQUEST['idsito'];
$data_invio    = $_REQUEST['data_invio']; 
$data_scadenza = $_REQUEST['data_scadenza'];

$aperture = '';
$GiornoPassato = '';

$query = "SELECT COUNT(Id) as Click FROM hospitality_traccia_email WHERE IdRichiesta = " . $id . " AND idsito = " . $idsito;
$res = $dbMysqli->query($query);
$rw = $res[0];

$aperture = $rw['Click'];

if($data_invio != 'null' && $data_scadenza != 'null'){
    if ($aperture == 0 && $data_invio < date('Y-m-d') && $data_scadenza > date('Y-m-d')) {
        $GiornoPassato = '<div style="clear:both!important;text-align:right!important" id="notify' . $id . '">
                                <i class="fa fa-question-circle  text-info" data-toogle="tooltip" title="Sono passate più di 24 ore dall\'invio dell\'email!!"></i>
                            </div>';
    } else {
        $GiornoPassato = '';
    }
} 
echo $aperture . $GiornoPassato;
       
?>