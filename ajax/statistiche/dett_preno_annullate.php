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

$idsito        =      $_REQUEST['idsito'];

$fonte         =      urldecode($_REQUEST['sorgente']);

$filtroQuery   =      urldecode($_REQUEST['filtroQuery']);

$sql      = "   SELECT 
                        hospitality_guest.* ,hospitality_motivi_disdetta.Motivo,hospitality_motivi_disdetta.MotivoCustom
                    FROM 
                        hospitality_guest 
                    INNER JOIN 
                        hospitality_motivi_disdetta ON hospitality_motivi_disdetta.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                    WHERE 
                        1 = 1
                        ".$filtroQuery."
                    AND 
                        hospitality_guest.TipoRichiesta =  'Conferma'
                    AND 
                        hospitality_guest.idsito = ".$idsito." 
                    AND 
                        hospitality_guest.FontePrenotazione = '".$fonte."' 
                    AND 
                        hospitality_guest.NoDisponibilita = 1
                    AND 
                        hospitality_guest.Disdetta = 0
                    AND 
                        hospitality_guest.Hidden = 0
                    AND 
                        hospitality_motivi_disdetta.idsito = ".$idsito." 
                    GROUP BY
                        hospitality_guest.NumeroPrenotazione
                    ORDER BY 
                    hospitality_guest.TipoRichiesta ASC";

$result   = mysqli_query($conn,$sql) or die('Error, connesione'.$conn);
$tot      = mysqli_num_rows($result);

if($tot){
    echo '<b>CONFERME</b><br>'."\r\n";
    echo '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-11">'."\r\n";
    echo '  <tr>
                <th class="text-center"></th>
                <th class="text-center"><b>Nr.preno</b></th>
                <th class="text-center"><b>Motivo</b></th>
                <th class="text-center">Tipo</th>
                <th class="text-center"><b>Data</b></th>
                <th class="text-center"><b>Prezzo</b></th>
            </tr>'."\r\n";
    $n = 1;
    $x = 1;
    $totale_fatturatoD = '';

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

        $totale_fatturatoD += $rec['fatturato'];


            echo '  <tr>
                        <td class="text-center">'.$n.')</td>
                        <td class="text-center">'.$record['NumeroPrenotazione'].'</td>
                        <td class="text-center">'.$record['Motivo'].($record['MotivoCustom']!=''?' <br><small>'.$record['MotivoCustom'].'</small>':'').'</td>
                        <td class="text-center">'.($record['TipoRichiesta']=='Preventivo'?'<small class="text-green">Preventivo</small>':'<small class="text-orange">Conferma</small>').'</td>
                        <td class="text-center">'.gira_data($record['DataRichiesta']).'</td>
                        <td class="text-right">'.($record['TipoRichiesta']=='Conferma'?'<i class="fa fa-euro"></i> '.number_format($rec['fatturato'],2,',','.'):'').'</td>
                    </tr>'."\r\n";
                    $n++;
      
        

    }
    echo ' 
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-right"><b>Totale</b></td>
                <td class="text-right"><i class="fa fa-euro"></i> '.number_format($totale_fatturatoD,2,',','.').'</td>
            </tr>'."\r\n";
    echo '</table>';
}

$sql2      = "   SELECT 
                        hospitality_guest.* ,hospitality_motivi_disdetta.Motivo,hospitality_motivi_disdetta.MotivoCustom
                    FROM 
                        hospitality_guest 
                    INNER JOIN 
                        hospitality_motivi_disdetta ON hospitality_motivi_disdetta.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                    WHERE 
                        1 = 1
                        ".$filtroQuery."
                    AND 
                        hospitality_guest.TipoRichiesta =  'Preventivo'
                    AND 
                        hospitality_guest.idsito = ".$idsito." 
                    AND 
                        hospitality_guest.FontePrenotazione = '".$fonte."' 
                    AND 
                        hospitality_guest.NoDisponibilita = 1
                    AND 
                        hospitality_guest.Disdetta = 0
                    AND 
                        hospitality_guest.Hidden = 0
                    AND 
                        hospitality_motivi_disdetta.idsito = ".$idsito." 
                    GROUP BY
                        hospitality_guest.NumeroPrenotazione
                    ORDER BY 
                    hospitality_guest.TipoRichiesta ASC";

$result2   = mysqli_query($conn,$sql2) or die('Error, connesione'.$conn);
$tot2      = mysqli_num_rows($result2);

if($tot2){
    echo '<b>PREVENTIVI</b><br>'."\r\n";
    echo '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-11">'."\r\n";
    echo '  <tr>
                <th class="text-center"></th>
                <th class="text-center"><b>Nr.preno</b></th>
                <th class="text-center"><b>Motivo</b></th>
                <th class="text-center">Tipo</th>
                <th class="text-center"><b>Data</b></th>
            </tr>'."\r\n";

    $x = 1;
    while($record2 = mysqli_fetch_assoc($result2)){


            echo '  <tr>
                        <td class="text-center">'.$x.')</td>
                        <td class="text-center">'.$record2['NumeroPrenotazione'].'</td>
                        <td class="text-center">'.$record2['Motivo'].($record['MotivoCustom']!=''?' <br><small>'.$record2['MotivoCustom'].'</small>':'').'</td>
                        <td class="text-center"><small class="text-green">Preventivo</small></td>
                        <td class="text-center">'.gira_data($record2['DataRichiesta']).'</td>
                    </tr>'."\r\n";
                $x++;

        

    }

    echo '</table>';
}
mysqli_close($conn);
?>