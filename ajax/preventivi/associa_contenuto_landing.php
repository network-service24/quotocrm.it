<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$TipoRichiesta  =   $_REQUEST['tiporichiesta'];
$Id             =   $_REQUEST['id_richiesta'];
$idsito         =   $_REQUEST['idsito'];
$Lingua         =   $_REQUEST['lingua'];
$id_template    =   $_REQUEST['id_template'];
$template       =   $_REQUEST['template'];


if($template != "default" || $template != "smart" || $template != ""){


    if($id_template != ''){
        $record_template      = $fun->check_nome_template_by_id($id_template,$idsito);
        $tipo_template_scelto = strtoupper($record_template['TemplateType']);
    }

    if($TipoRichiesta == 'Preventivo'){

        // query per testo default landing page
        $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario 
                    INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                    WHERE hospitality_dizionario.idsito = ".$idsito." 
                    AND hospitality_dizionario.etichetta = 'PREVENTIVO_".$tipo_template_scelto."'
                    AND hospitality_dizionario_lingua.idsito =  ".$idsito." 
                    AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
        $re = $dbMysqli->query($sele);
        $v = $re[0];
        $TestoAlternativo = stripslashes($v['testo']);

    }else{

        // query per testo default landing page
        $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario 
                    INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                    WHERE hospitality_dizionario.idsito = ".$idsito." 
                    AND hospitality_dizionario.etichetta = 'CONFERMA_".$tipo_template_scelto."'
                    AND hospitality_dizionario_lingua.idsito =  ".$idsito." 
                    AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
        $re = $dbMysqli->query($sele);
        $v = $re[0];
        $TestoAlternativo = stripslashes($v['testo']);
    }
}else{

    // query per testo alternativo landing page
    $select = "SELECT Testo,Id FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = ".$Id." AND idsito = ".$idsito." AND Lingua = '".$Lingua."' ORDER BY Id DESC";
    $res = $dbMysqli->query($select);
    $tot = sizeof($res);

    if($tot>0){
        $TestoAlternativo = $res[0]['Testo'];
    }
    else{
        // query per testo default landing page
        $sele = "SELECT Testo FROM hospitality_contenuti_web WHERE TipoRichiesta = '".$TipoRichiesta."' AND idsito = ".$idsito." AND Lingua = '".$Lingua."' AND Abilitato = 1";
        $re = $dbMysqli->query($sele);
        $v = $re[0];
        $TestoAlternativo = stripslashes($v['Testo']);
    }
       
}   


echo $TestoAlternativo;

?>