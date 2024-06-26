<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");

error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, "utf8");


function check_nome_template_by_id($id_template,$idsito)
{
    global $conn;

        $sel      = "SELECT TemplateName,TemplateType FROM hospitality_template_background  WHERE Id = ".$id_template." AND idsito = " . $idsito . " ";
        $res      = mysqli_query($conn,$sel);
        $record   = mysqli_fetch_assoc($res);
        $tot      = mysqli_num_rows($res);

        if($tot>0){
            $output = $record;
        }else{
            $output = '';
        }


    return $output;
}
function check_nome_template_default($idsito)
{
    global $conn;
        $sel      = "SELECT Template FROM hospitality_template_landing  WHERE idsito = " . $idsito . " ";
        $res      = mysqli_query($conn,$sel);
        $record   = mysqli_fetch_assoc($res);
        $tot      = mysqli_num_rows($res);

        if($tot>0){
            $output = $record;
        }
    

    return $output;
}


$TipoRichiesta  =   $_REQUEST['tiporichiesta'];
$Id             =   $_REQUEST['id_richiesta'];
$idsito         =   $_REQUEST['idsito'];
$Lingua         =   $_REQUEST['lingua'];
$TipoVacanza    =   $_REQUEST['target'];
$id_template    =   $_REQUEST['id_template'];
$template       =   $_REQUEST['template'];

if($id_template != ''){
    $record_template      = check_nome_template_by_id($id_template,$idsito);
    $nome_template_scelto = ucfirst($record_template['TemplateName']);
    $tipo_template_scelto = strtoupper($record_template['TemplateType']);
}else{
    $record_template      = check_nome_template_default($idsito);
    $nome_template_scelto = $record_template['Template'];
}

    if($TipoVacanza == $nome_template_scelto && $TipoRichiesta == 'Preventivo'){

        // query per testo default landing page
        $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario 
                    INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                    WHERE hospitality_dizionario.idsito = ".$idsito." 
                    AND hospitality_dizionario.etichetta = 'PREVENTIVO_".$tipo_template_scelto."'
                    AND hospitality_dizionario_lingua.idsito =  ".$idsito." 
                    AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
        $re = mysqli_query($conn,$sele);
        $v = mysqli_fetch_assoc($re);
        $TestoAlternativo = stripslashes($v['testo']);

    }elseif($TipoVacanza == $nome_template_scelto && $TipoRichiesta == 'Conferma'){

        // query per testo default landing page
        $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario 
                    INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                    WHERE hospitality_dizionario.idsito = ".$idsito." 
                    AND hospitality_dizionario.etichetta = 'CONFERMA_".$tipo_template_scelto."'
                    AND hospitality_dizionario_lingua.idsito =  ".$idsito." 
                    AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
        $re = mysqli_query($conn,$sele);
        $v = mysqli_fetch_assoc($re);
        $TestoAlternativo = stripslashes($v['testo']);

    }else{

        // query per testo alternativo landing page
        $select = "SELECT Testo,Id FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = ".$Id." AND idsito = ".$idsito." AND Lingua = '".$Lingua."' ORDER BY Id DESC";
        $res = mysqli_query($conn,$select);
        $tot = mysqli_num_rows($res);

        if($tot>0){
            $IdTestoAlternativo = $vl['Id'];
            $TestoAlternativo = $vl['Testo'];
        }else{

                // query per testo default landing page
                $sele = "SELECT Testo FROM hospitality_contenuti_web WHERE TipoRichiesta = '".$TipoRichiesta."' AND idsito = ".$idsito." AND Lingua = '".$Lingua."' AND Abilitato = 1";
                $re = mysqli_query($conn,$sele);
                $v = mysqli_fetch_assoc($re);
                $TestoAlternativo = stripslashes($v['Testo']);
        }
    }   


echo $TestoAlternativo;


mysqli_close($conn);
?>