<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	  $notti         = $_REQUEST['notti'];
	  $idsito        = $_REQUEST['idsito'];
    $idsoggiorno   = $_REQUEST['idsoggiorno'];
    $idcamera      = $_REQUEST['idcamera'];
    $numero_camera = $_REQUEST['numero_camera'];
    $numero_adulti = $_REQUEST['numero_adulti'];
    if($numero_camera=='')$numero_camera=1;
    $n_proposta    = $_REQUEST['n_proposta'];
    $n_riga        = $_REQUEST['n_riga'];
    $dal           = $_REQUEST['dal'];
    $al            = $_REQUEST['al'];

    $sql_s         = "SELECT hospitality_listino_soggiorni.Prezzo
                        FROM hospitality_listino_soggiorni
                        WHERE hospitality_listino_soggiorni.idsito = ".$idsito."
                        AND hospitality_listino_soggiorni.Abilitato = 1
                        AND hospitality_listino_soggiorni.IdSoggiorno = ".$idsoggiorno."
                        AND hospitality_listino_soggiorni.PeriodoDal <= '".$al."'
                        AND hospitality_listino_soggiorni.PeriodoAl >= '".$dal."'";
    $result_s      = $dbMysqli->query($sql_s);
    $ret_s         = $result_s[0];

    $sql         = "SELECT SUM(hospitality_listino_camere.PrezzoCamera) as PrezzoCamera,hospitality_tipo_listino.TipoListino
                        FROM hospitality_listino_camere
                        INNER JOIN hospitality_tipo_listino ON hospitality_tipo_listino.idsito = hospitality_listino_camere.idsito
                        INNER JOIN hospitality_numero_listini ON hospitality_numero_listini.Id = hospitality_listino_camere.IdNumeroListino
                        WHERE hospitality_listino_camere.idsito = ".$idsito."
                        AND hospitality_numero_listini.Abilitato = 1
                        AND hospitality_listino_camere.IdSoggiorno = ".$idsoggiorno."
                        AND hospitality_listino_camere.IdCamera = ".$idcamera."
                        AND hospitality_listino_camere.PeriodoDal BETWEEN '".$dal."'AND '".$al."'
                        AND hospitality_listino_camere.Abilitato = 1";
    $result      = $dbMysqli->query($sql);
    $ret         = $result[0];


    $PrezzoSoggiorno = $ret_s['Prezzo'];
    $PrezzoCamera    = $ret['PrezzoCamera'];
    $TipoListino     = $ret['TipoListino'];

    if($TipoListino==0){
        $totale_soggiorno = ($PrezzoSoggiorno*$numero_camera*$notti);
        $testo_s = '<div class="nowrap"><small>Prezzo trattamento €: <b>'.number_format($PrezzoSoggiorno,2,',','.').'</b> <span class="text-primary">X</span> n° camere: <b>'.$numero_camera.'</b> <span class="text-primary">X</span> n* di notti: <b>'.$notti.'</b></small></div>';
        $totale_unitaro_camera = (($PrezzoCamera*$numero_camera)+$totale_soggiorno);
        $testo = '<div class="nowrap"><small>Somma Prezzo camera €: <b>'.number_format($PrezzoCamera,2,',','.').'</b> <span class="text-primary">X</span> n° camere: <b>'.$numero_camera.'</b> <span class="text-primary">X</span> n* di notti: <b>'.$notti.'</b></small></div>';
    }else{
        $totale_soggiorno = ($PrezzoSoggiorno*$numero_adulti);
        $testo_s = '<div class="nowrap"><small>Prezzo trattamento €: <b>'.number_format($PrezzoSoggiorno,2,',','.').'</b> <span class="text-primary">X</span> n° adulti: <b>'.$numero_adulti.'</b> <span class="text-primary">X</span> n* di notti: <b>'.$notti.'</b></small></div>';
        $totale_unitaro_camera = (($PrezzoCamera*$numero_adulti)+$totale_soggiorno);
        $testo = '<div class="nowrap"><small>Prezzo a persona €: <b>'.number_format($PrezzoCamera,2,',','.').'</b> <span class="text-primary">X</span> n° adulti: <b>'.$numero_adulti.'</b> <span class="text-primary">X</span> n* di notti: <b>'.$notti.'</b></small></div>';
    }


    echo'<script type="text/javascript">
            $(document).ready(function() {';
                    if($PrezzoSoggiorno!='' || $PrezzoSoggiorno!=0){
                      echo '$("#spiegazione_prezzo_soggiorno_'.$n_proposta.'_'.$n_riga.'").html(\''.$testo_s.'\');';
                    }
                    if($PrezzoCamera!='' || $PrezzoCamera!=0){
                      echo '$("#spiegazione_prezzo_'.$n_proposta.'_'.$n_riga.'").html(\''.$testo.'\');';
                    }
                    if($idcamera){
                      echo' $("#Prezzo_'.$n_proposta.'_'.$n_riga.'").val(\''.$totale_unitaro_camera.'\');';
                    }
    echo'   });
        </script>';


?>
