<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$IdRichiesta = $_REQUEST['id'];
$Operatore   = urldecode($_REQUEST['Operatore']);
$idsito      = $_REQUEST['idsito'];

$val = '';

if ($Operatore!='null') {

    $q = $dbMysqli->query('SELECT img,idsito,Abilitato from hospitality_operatori WHERE NomeOperatore LIKE "' . $Operatore . '" AND idsito = ' . $idsito);
    $rec = $q[0];
    $Img = $rec['img'];
    $idsito = $rec['idsito'];
    $Abilitato = $rec['Abilitato'];
    if ($Img) {
        $val = '<img src="https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $idsito . '/' . $Img . '" class="img-circle" data-toogle="tooltip" title="Operatore ' . ($Abilitato == 0 ? 'DISABILITATO' : '') . ': ' . $Operatore . '" style="width:18px;height:18px;' . ($Abilitato == 0 ? 'opacity:0.5' : '') . '">';
    } else {
        $val = '<i class="fa fa-user" data-toogle="tooltip" ' . ($Abilitato == 0 ? 'style="opacity:0.5"' : '') . ' title="Operatore ' . ($Abilitato == 0 ? 'DISABILITATO' : '') . ': ' . $Operatore . '"></i>';
    }
} else {
    $val = '<div style="width:100%!important">
                <i class="fa fa-user text-red" data-toogle="tooltip" title="Operatore: ancora da assegnare"></i>
                ' . ($_SERVER['REQUEST_URI'] == '/preventivi/' ? '<label data-toogle="tooltip" title="Assegna un Operatore al Preventivo" class="cont_check_op" style="float:right;margin-top:15px"><input type="checkbox" name="IdPrev" value="' . $IdRichiesta. '" /><span class="checkmark_op"></span></label>' : '') . '
            </div>';
}

echo $val;

?>
