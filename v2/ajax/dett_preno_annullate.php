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

    echo '  <div class="row">
                <div class="col-md-1"> &nbsp;<b>Nr.</b></div>
                <div class="col-md-3"><b>Motivo</b></div>
                <div class="col-md-2">Tipo</div>
                <div class="col-md-3"><b>Data Conf/Data Prev</b></div>
                <div class="col-md-3"><b>Prezzo Soggiorno</b></div>
            </div>
            <br/>'."\r\n";
    $n = 1;
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


    echo '  <div class="row">
                <div class="col-md-1" style="white-space:nowrap"><small>'.$n.')</small> &nbsp;'.$record['NumeroPrenotazione'].'</div>
                <div class="col-md-3">'.$record['Motivo'].($record['MotivoCustom']!=''?' <br><small>'.$record['MotivoCustom'].'</small>':'').'</div>
                <div class="col-md-2">'.($record['TipoRichiesta']=='Preventivo'?'<small class="text-green">Preventivo</small>':'<small class="text-orange">Conferma</small>').'</div>
                <div class="col-md-3">'.gira_data($record['DataRichiesta']).'</div>
                <div class="col-md-3">'.($record['TipoRichiesta']=='Conferma'?'<i class="fa fa-euro"></i> '.number_format($rec['fatturato'],2,',','.'):'').'</div>
            </div>'."\r\n";
        $n++;

    }
    echo '  <br/>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3"></div>
                <div class="col-md-2"></div>
                <div class="col-md-3"><b>Totale</b></div>
                <div class="col-md-3"><i class="fa fa-euro"></i> '.number_format($totale_fatturatoD,2,',','.').'</div>
            </div>'."\r\n";
}


mysqli_close($conn);
?>