<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");

	$username   = DB_USER;
	$password   = DB_PASSWORD;
	$host       = HOST;
	$dbname     = DATABASE;

    $conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
    mysqli_set_charset($conn, 'utf8');

$proporzione_monte_oreR       = '';
$proporzione_monte_oreR_plus  = '';
$proporzione_monte_ore        = '';
$residuo                      = '';
$step                         = '';
$datanodo_                    = '';
$DataNodo                     = '';
$DataNodoMese                 = '';
$idprogetto                   = $_REQUEST['idprogetto'];
$n                            = 2;

$select = " SELECT  * FROM  pms_progetti  WHERE pms_progetti.id = ".$idprogetto."";
$result = mysqli_query($conn,$select);
$record = mysqli_fetch_assoc($result);

switch($record['codice_progetto']){
    case '125':
        $monte_ore_progetto = '110';
    break;
    case'126':
        $monte_ore_progetto = '160';
    break;
    case'130':
        $monte_ore_progetto = '160';
    break;
    case'131':
        $monte_ore_progetto = '320';
    break;
    case'138':
        $monte_ore_progetto = '220';
    break;
    default:
        $monte_ore_progetto = '';
    break;
}
$dataI_tmp   = explode("-",$record['data_inizio']);
$dataI_I_tmp = explode(" ",$dataI_tmp[2]);
$dataI       = $dataI_I_tmp[0].'-'.$dataI_tmp[1].'-'.$dataI_tmp[0];

$dataF_tmp   = explode("-",$record['data_fine']);
$dataF_F_tmp = explode(" ",$dataI_tmp[2]);
$dataF       = $dataF_F_tmp[0].'-'.$dataF_tmp[1].'-'.$dataF_tmp[0];

$datetime1   = new       DateTime($record['data_inizio']);
$datetime2   = new       DateTime($record['data_fine']);
$interval    = $datetime1->diff($datetime2);

if($interval->format('%a')>=365 && $interval->format('%a')<=500){
    $step = 12;
    $moltiplicatore = 7;
}
if($interval->format('%a')>=730 && $interval->format('%a')<=800){
    $step = 24;
    $moltiplicatore = 4;
}

$proporzione_monte_oreI = ($monte_ore_progetto/$step);


$select2 = "SELECT SUM(pms_attivita.monte_ore) as tot_monte_ore
            FROM pms_attivita
            INNER JOIN pms_progetti ON pms_progetti.id = pms_attivita.id_progetto
            WHERE pms_progetti.id = ".$record['id']." AND pms_attivita.parent_id = 0 ";
$result2 = mysqli_query($conn,$select2);
$rec     = mysqli_fetch_assoc($result2);


$select3 = "SELECT SUM(pms_timer.tempo_impiegato) as tot_timer
                FROM pms_attivita
                INNER JOIN pms_progetti ON pms_progetti.id = pms_attivita.id_progetto
                INNER JOIN pms_timer ON pms_timer.id_attivita = pms_attivita.id
                WHERE pms_progetti.id = ".$record['id']." ";
$result3 = mysqli_query($conn,$select3);
$recs    = mysqli_fetch_assoc($result3);


$monteR = $rec['tot_monte_ore'];
$tempoR = $recs['tot_timer'];


if($monteR > $tempoR){
  $residuo  = (($monteR - $tempoR)/60);
}
if($tempoR > $monteR){
    $residuo = (($tempoR-$monteR)/60);
}
if($monteR == 0 && $tempoR ==0){
    $residuo   = 0;
}

$select1 = "SELECT pms_attivita.euro,pms_attivita.data_prevista_attivita,pms_attivita.id_stato,pms_attivita.attivita FROM pms_attivita
            INNER JOIN pms_progetti ON pms_progetti.id = pms_attivita.id_progetto
            INNER JOIN pms_stati ON pms_stati.id = pms_attivita.id_stato
            WHERE  pms_progetti.id = ".$idprogetto."
            AND pms_attivita.euro != 0 
            AND pms_attivita.euro IS NOT NULL
            AND pms_stati.id != 4 AND pms_stati.id != 5 AND pms_stati.id != 3 AND pms_stati.id != 6 ";

$result1       = mysqli_query($conn,$select1);
while($record1 = mysqli_fetch_assoc($result1)){
    $dataA_tmp     = explode("-",$record1['data_prevista_attivita']);
    $DataFattuMese = $dataA_tmp[1].'-'.$dataA_tmp[0];

    $array_data_fatturato[] = array('DATAFATT' => $DataFattuMese, 'EURO' => $record1['euro'], 'STATO' => $record1['id_stato'], 'ATTIVITA' => $record1['attivita']);
}



 echo'{
    "nodes": ['."\r\n";
    echo'{
            "nodeId": "node_1",
            "title": "Inizio progetto",
            "date": "'.$dataI.'",
            "percent": 0,
            "description": "1° Mese '.$dataI.'"
        },'."\r\n";

    $incrementale = 1;

    for($n==2; $n<=($step+1); $n++){  


        $datanodo_                  = mktime(0,0,0,($dataI_I_tmp[0]+$incrementale),$dataI_tmp[1],$dataI_tmp[0]);
        $DataNodoMese               = date('m-Y',$datanodo_);

        $proporzione_monte_ore       = ($monte_ore_progetto/$step);
        $proporzione_monte_oreR      = (($monte_ore_progetto-$residuo)/$step);
        $proporzione_monte_oreR_plus = (($proporzione_monte_ore+$monte_ore_progettoR+$residuo/$step));

        foreach($array_data_fatturato as $key => $value){

                if($DataNodoMese == $value['DATAFATT']){

                            echo'    {
                                "nodeId": "node_'.($n*$moltiplicatore).'",
                                "title": "Step Mese '.($n-1).'",
                                "date": "'.$DataNodoMese.'",
                                "percent": '.($n*$moltiplicatore).',
                                "description": "'.($n-1).'° Mese '.$DataFattuMese.' '.$value['ATTIVITA'].' '.number_format($value['EURO'],2,',','.').'",'."\r\n";

                            
                                    echo' "nodes": [{
                                                    "nodeId": "node_'.(($n*$moltiplicatore).ceil($residuo)).'_'.(($n*$moltiplicatore).ceil($residuo)+1).'",
                                                    "title": "Step Mese '.($n-1).'",
                                                    "date": "'.$DataFattuMese.'",
                                                    "offsetY": "'.($value['STATO']==2?'up':'down').'",
                                                    "percent": '.($n*$moltiplicatore).',
                                                    "description": "'.($n-1).'° Mese '.$DataFattuMese.' '.$value['ATTIVITA'].' '.($value['STATO']==2?'<b class=\'text-green\'>FATTURATO</b>':'<b class=\'text-red\'>NON FATTURATO</b>').' '.number_format($value['EURO'],2,',','.').'"    
                                            }]'."\r\n";
                            


                    echo'          },'."\r\n";
                }
        }


            $incrementale++;
            }

    echo'   {
                    "nodeId": "node_'.($step==12?91:100).'",
                    "title": "Fine progetto",
                    "date": "'.$dataF.'",
                    "percent": '.($step==12?91:100).',
                    "description": "Fine progetto '.$dataF.'"
                }
            ]
        } '."\r\n";
        
    

?>