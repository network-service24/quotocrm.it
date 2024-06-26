<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$notti         = $_REQUEST['notti'];
	$idsito        = $_REQUEST['idsito'];
    $n_proposta    = $_REQUEST['n_proposta'];
    $id_servizio   = $_REQUEST['id_servizio'];
    $dal           = $_REQUEST['dal'];
    $al            = $_REQUEST['al'];  


    $sql         = "SELECT 
                        *
                    FROM 
                        hospitality_tipo_servizi
                    WHERE 
                        hospitality_tipo_servizi.idsito = ".$idsito." 
                    AND 
                        hospitality_tipo_servizi.Id = ".$id_servizio." 
                    AND 
                        hospitality_tipo_servizi.Abilitato = 1";
    $result      = $dbMysqli->query($sql);
    $ret         = $result[0];

    $TipoServizio   = $ret['TipoServizio'];
    $PrezzoServizio = $ret['PrezzoServizio'];

    $testo = '';

    if($notti!='' && $notti !='undefined'){

        if($ret['CalcoloPrezzo']=='Al giorno'){
            
            $totale_unitaro_servizio = ($PrezzoServizio*$notti);
            if($PrezzoServizio!='' && $PrezzoServizio!='0'){
                $testo = '<div><small>(<b>'.number_format($PrezzoServizio,2,',','.').'</b> <span class="text-primary">X</span> <b>'.$notti.'</b> <span class="text-primary">=</span> <b>'.number_format($totale_unitaro_servizio,2,',','.').'</b>)</small></div>';
            }else{
                $testo = '<div><small>Prezzo non impostato oppure gratuito!</small></div>';
            }

        }elseif($ret['CalcoloPrezzo']=='Una tantum'){

            $totale_unitaro_servizio = $PrezzoServizio;
            if($PrezzoServizio!='' && $PrezzoServizio!='0'){
                $testo = '<div><small>(<b>'.number_format($PrezzoServizio,2,',','.').'</b> <span class="text-primary">X</span> <b>'.$notti.'</b> <span class="text-primary">=</span> <b>'.number_format($totale_unitaro_servizio,2,',','.').'</b>)</small></div>';
            }else{
                $testo = '<div><small>Prezzo non impostato oppure gratuito!</small></div>';
            }

        }elseif($ret['CalcoloPrezzo']=='A persona'){

            $totale_unitaro_servizio = $PrezzoServizio;

            $testo = '<div><button class="btn btn-primary btn-mini" type="button" data-toggle="modal" data-servizio="'.$TipoServizio.'" data-prezzo="'.$PrezzoServizio.'" data-notti="'.$notti.'" data-id_servizio="'.$id_servizio.'"  data-target="#modal_persone_'.$n_proposta.'_'.$id_servizio.'">Calcola</button></div>';


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
                
                        echo '$("#spiegazione_prezzo_servizio_'.$n_proposta.'_'.$id_servizio.'").html(\''.$testo.'\');';

                     }elseif($ret['CalcoloPrezzo']=='Una tantum'){  

                        if($PrezzoServizio!='' && $PrezzoServizio!='0'){

                            echo' $("#Prezzo_Servizio_'.$n_proposta.'_'.$id_servizio.'").html(\'<small>'.($totale_unitaro_servizio!=''?'(<b>'.number_format($totale_unitaro_servizio,2,',','.').'</b>)':'').'</small>\');';
                        }else{
                            echo '$("#spiegazione_prezzo_servizio_'.$n_proposta.'_'.$id_servizio.'").html(\''.$testo.'\');';
                        }
                    }
               
    echo'   });
        </script>';	


?>