<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/v2/include/function.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

$idsito        = $_REQUEST['idsito'];
$filtroQuery   = urldecode($_REQUEST['filtroQuery']);

$sql      = "   SELECT 
                    * 
                FROM 
                    hospitality_guest 
                WHERE 
                    1 = 1
                    ".$filtroQuery."
                AND 
                    hospitality_guest.idsito = ".$idsito." 
                AND 
                    hospitality_guest.TipoRichiesta = 'Conferma' 
                AND 
                    hospitality_guest.FontePrenotazione = 'Sito Web' 
                AND 
                    hospitality_guest.NoDisponibilita = 0
                AND 
                    hospitality_guest.Disdetta = 0
                AND 
                    hospitality_guest.Hidden = 0";

$result   = mysqli_query($conn,$sql) or die('Error, connesione'.$conn);
$tot      = mysqli_num_rows($result);

if($tot){

    echo '  <div class="row">
                <div class="col-md-3"><b>Numero Preno</b></div>
                <div class="col-md-3"></div>
                <div class="col-md-3"><b>Data Conf/Data Preno</b></div>
                <div class="col-md-3"><b>Prezzo Soggiorno</b></div>
            </div>
            <br/>'."\r\n";

    while($record = mysqli_fetch_assoc($result)){




        $sel = "SELECT 
                    SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM 
                    hospitality_guest
                INNER JOIN 
                    hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE 
                    hospitality_guest.Id = ".$record['Id']."";
        $res = mysqli_query($conn,$sel) or die('Error, connesione'.$conn);
        $rec = mysqli_fetch_assoc($res);
        $totale_fatturato += $rec['fatturato'];
    echo '  <div class="row">
            <div class="col-md-3">'.$record['NumeroPrenotazione'].'</div>
            <div class="col-md-3">'.($record['DataChiuso']!=''?'<small class="text-green">Prenotazione confermata</small>':'<small class="text-orange">Conferma in trattativa</small>').'</div>
            <div class="col-md-3">'.($record['DataChiuso']!=''?gira_data($record['DataChiuso']):gira_data($record['DataRichiesta'])).'</div>
            <div class="col-md-3"><i class="fa fa-euro"></i> '.number_format($rec['fatturato'],2,',','.').'</div>
        </div>'."\r\n";

    }
    echo '  <br/>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3"><b>Totale</b></div>
                <div class="col-md-3"><i class="fa fa-euro"></i> '.number_format($totale_fatturato,2,',','.').'</div>
            </div>'."\r\n";
}


mysqli_close($conn);
?>