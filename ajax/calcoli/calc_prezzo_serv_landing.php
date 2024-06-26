<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$notti         = $_REQUEST['notti'];
	$idsito        = $_REQUEST['idsito'];
    $n_proposta    = $_REQUEST['n_proposta'];
    $id_proposta   = $_REQUEST['id_proposta'];
    $id_servizio   = $_REQUEST['id_servizio'];
    $DataA_tmp     = explode("/",$_REQUEST['dal']);
    $dal           = $DataA_tmp[2].'-'.$DataA_tmp[1].'-'.$DataA_tmp[0];
    $DataP_tmp     = explode("/",$_REQUEST['al']);
    $al            = $DataP_tmp[2].'-'.$DataP_tmp[1].'-'.$DataP_tmp[0];  
    $ReCalPrezzo   = $_REQUEST['ReCalPrezzo'];
    $check         = $_REQUEST['check'];
    $RecPrezzo_Ser = $_REQUEST['RecPrezzo_Ser'];
    $ReCalCaparra   = $_REQUEST['ReCalCaparra'];
    $PercentualeCaparra   = $_REQUEST['PercCaparra'];

    $sql         = "SELECT *
                        FROM hospitality_tipo_servizi
                        WHERE hospitality_tipo_servizi.idsito = ".$idsito." 
                        AND hospitality_tipo_servizi.Id = ".$id_servizio." 
                        AND hospitality_tipo_servizi.Abilitato = 1";
    $result      = $dbMysqli->query($sql);
    $ret         = $result[0];

    $PrezzoServizio = $ret['PrezzoServizio'];
    $PercentualeServizio = $ret['PercentualeServizio'];
    $testo = '';

    if($notti!='' && $notti !='undefined'){

        if($ret['CalcoloPrezzo']=='Al giorno'){
            
            $totale_unitaro_servizio = ($PrezzoServizio*$notti);
            if($check == 1){
                $totale_soggiorno = ($ReCalPrezzo+$totale_unitaro_servizio);
            }
            if($check == 0){
                $totale_soggiorno = ($ReCalPrezzo-$totale_unitaro_servizio);
            }
            if($PrezzoServizio!='' && $PrezzoServizio!='0'){
                $testo = '<div><small>(<b>'.number_format($PrezzoServizio,2,',','.').'</b> <span class="text-primary">X</span> <b>'.$notti.'</b> <span class="text-primary">=</span> <b>'.number_format($totale_unitaro_servizio,2,',','.').'</b>)</small></div>';
            }else{
                $testo = '';
            }

        }elseif($ret['CalcoloPrezzo']=='Una tantum'){

            $totale_unitaro_servizio = $PrezzoServizio;
            if($check == 1){
                $totale_soggiorno = ($ReCalPrezzo+$totale_unitaro_servizio);
            }
            if($check == 0){
                $totale_soggiorno = ($ReCalPrezzo-$totale_unitaro_servizio);
            }
            if($PrezzoServizio!='' && $PrezzoServizio!='0'){
                $testo = '<div><small>(<b>'.number_format($PrezzoServizio,2,',','.').'</b> <span class="text-primary">X</span> <b>'.$notti.'</b> <span class="text-primary">=</span> <b>'.number_format($totale_unitaro_servizio,2,',','.').'</b>)</small></div>';
            }else{
                $testo = '';
            }

        }elseif($ret['CalcoloPrezzo']=='A persona'){

            $totale_unitaro_servizio = $PrezzoServizio;
            if($check == 1){
                $totale_soggiorno = $ReCalPrezzo;
            }
            if($check == 0){
                $totale_soggiorno = ($ReCalPrezzo-$RecPrezzo_Ser);
            } 

            $testo = '<div><button class="btn btn-iprimary btn-mini" type="button" data-toggle="modal" data-prezzo="'.$PrezzoServizio.'" data-notti="'.$notti.'" data-id_servizio="'.$id_servizio.'"  data-target="#modal_persone_'.$n_proposta.'_'.$id_servizio.'">Calcola</button></div>';
        
        }elseif($ret['CalcoloPrezzo']=='A percentuale'){

            $totale_unitaro_servizio = $PrezzoServizio;
            
            if($check == 1){
                $aggiungere_perc = (($ReCalPrezzo*$PercentualeServizio)/100);
                $totale_soggiorno = ceil($ReCalPrezzo+$aggiungere_perc);
            }
            if($check == 0){
                $sottrarre_perc = (($ReCalPrezzo*$PercentualeServizio)/100);
                $totale_soggiorno = ceil($ReCalPrezzo-$sottrarre_perc);
            } 
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
                
                        echo' $("#Prezzo_Servizio_'.$n_proposta.'_'.$id_servizio.'").html(\'<span class="nowrap" style="font-size:70%;padding-right:10px">('.number_format($PrezzoServizio,2,',','.').' <span class="text-primary">X</span> '.$notti.')</span> <i class="fa fa-euro"></i>  '.number_format($totale_unitaro_servizio,2,',','.').'\');';                     

                     }elseif($ret['CalcoloPrezzo']=='Una tantum'){  

                        if($PrezzoServizio!='' && $PrezzoServizio!='0'){

                            echo' $("#Prezzo_Servizio_'.$n_proposta.'_'.$id_servizio.'").html(\'<i class="fa fa-euro"></i> '.($totale_unitaro_servizio!=''?''.number_format($totale_unitaro_servizio,2,',','.').'':'').'\');';
   
                        }else{
                            echo '$("#spiegazione_prezzo_servizio_'.$n_proposta.'_'.$id_servizio.'").html(\''.$testo.'\');';
                        }
                    }
                    echo '$("#PrezzoPC'.$n_proposta.'_'.$id_proposta.'").html(\''.number_format($totale_soggiorno,2,',','.').'\');';
                    echo '$("#ReCalPrezzo'.$n_proposta.'_'.$id_proposta.'").val(\''.$totale_soggiorno.'\');';
                    echo '$("#ReCalCaparra'.$n_proposta.'_'.$id_proposta.'").html(\''.number_format(($totale_soggiorno*$PercentualeCaparra/100),2,',','.').'\');';
                    echo '$("#PrezzoTitolo'.$n_proposta.'").html(\''.number_format($totale_soggiorno,2,',','.').'\');';
                    echo '$("#PrezzoSpecchietto'.$n_proposta.'").html(\''.number_format($totale_soggiorno,2,',','.').'\');';
                    echo '$("#PrezzoForm'.$n_proposta.'").html(\''.number_format($totale_soggiorno,2,',','.').'\');';
    echo'   });
        </script>';	


?>