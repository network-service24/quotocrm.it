<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

	$notti         = $_REQUEST['notti'];
	$idsito        = $_REQUEST['idsito'];
    $n_proposta    = $_REQUEST['n_proposta'];
    $id_servizio   = $_REQUEST['id_servizio'];
    $DataA_tmp     = explode("/",$_REQUEST['dal']);
    $dal           = $DataA_tmp[2].'-'.$DataA_tmp[1].'-'.$DataA_tmp[0];
    $DataP_tmp     = explode("/",$_REQUEST['al']);
    $al            = $DataP_tmp[2].'-'.$DataP_tmp[1].'-'.$DataP_tmp[0];  
    $PrezzoPC      = $_REQUEST['PrezzoPC'];

    $sql         = "SELECT *
                        FROM hospitality_tipo_servizi
                        WHERE hospitality_tipo_servizi.idsito = ".$idsito." 
                        AND hospitality_tipo_servizi.Id = ".$id_servizio." 
                        AND hospitality_tipo_servizi.Abilitato = 1";
    $result      = mysqli_query($conn,$sql) or die();
    $ret         = mysqli_fetch_assoc($result);

    $PrezzoServizio = $ret['PrezzoServizio'];
    $testo = '';

    if($notti!='' && $notti !='undefined'){

        if($ret['CalcoloPrezzo']=='Al giorno'){
            
            $totale_unitaro_servizio = ($PrezzoServizio*$notti);
            if($PrezzoServizio!='' && $PrezzoServizio!='0'){
                $testo = '<div><small>(<b>'.number_format($PrezzoServizio,2,',','.').'</b> <span class="text-red">X</span> <b>'.$notti.'</b> <span class="text-red">=</span> <b>'.number_format($totale_unitaro_servizio,2,',','.').'</b>)</small></div>';
            }else{
                $testo = '';
            }

        }elseif($ret['CalcoloPrezzo']=='Una tantum'){

            $totale_unitaro_servizio = $PrezzoServizio;
            if($PrezzoServizio!='' && $PrezzoServizio!='0'){
                $testo = '<div><small>(<b>'.number_format($PrezzoServizio,2,',','.').'</b> <span class="text-red">X</span> <b>'.$notti.'</b> <span class="text-red">=</span> <b>'.number_format($totale_unitaro_servizio,2,',','.').'</b>)</small></div>';
            }else{
                $testo = '';
            }

        }elseif($ret['CalcoloPrezzo']=='A persona'){

            $totale_unitaro_servizio = $PrezzoServizio;
            $testo = '<div><button class="btn btn-info btn-xs" type="button" data-toggle="modal" data-prezzo="'.$PrezzoServizio.'" data-notti="'.$notti.'" data-id_servizio="'.$id_servizio.'"  data-target="#modal_persone_'.$n_proposta.'_'.$id_servizio.'">Calcola</button></div>';

        }
    
    }else{
        $testo = '';
        $totale_unitaro_servizio = '';
    }
    echo'<script type="text/javascript">
            $(document).ready(function() {';
                
                    
                    if($ret['CalcoloPrezzo']=='A persona'){

                        echo '$("#pulsante_calcola_'.$n_proposta.'_'.$id_servizio.'").html(\''.$testo.'\');';

                     }elseif($ret['CalcoloPrezzo']=='Al giorno'){
                
                        echo' $("#Prezzo_Servizio_'.$n_proposta.'_'.$id_servizio.'").html(\'<span class="nowrap" style="font-size:70%;padding-right:10px">('.number_format($PrezzoServizio,2,',','.').' <span class="text-red">X</span> '.$notti.')</span> <i class="fa fa-euro"></i>  '.number_format($totale_unitaro_servizio,2,',','.').'\');';
                        echo '$("#PrezzoPC").html(\''.number_format(($PrezzoPC-$totale_unitaro_servizio),2,',','.').'\');';

                     }elseif($ret['CalcoloPrezzo']=='Una tantum'){  

                        if($PrezzoServizio!='' && $PrezzoServizio!='0'){

                            echo' $("#Prezzo_Servizio_'.$n_proposta.'_'.$id_servizio.'").html(\'<i class="fa fa-euro"></i> '.($totale_unitaro_servizio!=''?''.number_format($totale_unitaro_servizio,2,',','.').'':'').'\');';
                            echo '$("#PrezzoPC").html(\''.number_format(($PrezzoPC-$totale_unitaro_servizio),2,',','.').'\');';
                        }else{
                            echo '$("#spiegazione_prezzo_servizio_'.$n_proposta.'_'.$id_servizio.'").html(\''.$testo.'\');';
                        }
                    }
               
    echo'   });
        </script>';	


	mysqli_close($conn);
?>