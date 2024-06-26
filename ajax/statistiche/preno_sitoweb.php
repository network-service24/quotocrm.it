<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");
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

    echo '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-11">'."\r\n";
    echo '  <tr>
                <th class="text-center"></th>
                <th class="text-center"><b>Nr.preno</b></th>
                <th class="text-center"><b>Tipo</b></th>
                <th class="text-center"><b>Data Conf/Data Preno</b></th>
                <th class="text-center"><b>Soggiorno</b></th>
            </tr>'."\r\n";
    $n = 1;
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
    echo '  <tr>
            <td class="text-center">'.$n.')</td>
            <td class="text-center">'.$record['NumeroPrenotazione'].'</td>
            <td class="text-center">'.($record['DataChiuso']!=''?'<small class="text-green">Prenotazione confermata</small>':'<small class="text-orange">Conferma in trattativa</small>').'</td>
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
                <td class="text-right"><b>Totale</b></td>
                <td class="text-right"><i class="fa fa-euro"></i> '.number_format($totale_fatturato,2,',','.').'</td>
            </tr>'."\r\n";
    echo '</table>';
}


mysqli_close($conn);
?>