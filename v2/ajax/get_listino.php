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
    $idsoggiorno   = $_REQUEST['idsoggiorno'];
    $idcamera      = $_REQUEST['idcamera'];
    $numero_camera = $_REQUEST['numero_camera'];
    $numero_adulti = $_REQUEST['numero_adulti'];
    if($numero_camera=='')$numero_camera=1;
    $n_proposta    = $_REQUEST['n_proposta'];
    $n_riga        = $_REQUEST['n_riga'];
    $DataA_tmp     = explode("/",$_REQUEST['dal']);
    $dal           = $DataA_tmp[2].'-'.$DataA_tmp[1].'-'.$DataA_tmp[0];
    $DataP_tmp     = explode("/",$_REQUEST['al']);
    $al            = $DataP_tmp[2].'-'.$DataP_tmp[1].'-'.$DataP_tmp[0];
    $data_arrivo   = strtotime($dal);
    $data_partenza = strtotime($al);

    $datediff = ($data_partenza - $data_arrivo);

    $giorni_totali = round($datediff / (60 * 60 * 24));

    $n=0;

    for($n=0; $n<$giorni_totali; $n++){

        $giorno = mktime (0,0,0,$DataA_tmp[1],($DataA_tmp[0]+$n),$DataA_tmp[2]);
        $data   = date('Y-m-d',$giorno);

        $sql    = "SELECT hospitality_listino_camere.PrezzoCamera
                        FROM hospitality_listino_camere
                        INNER JOIN hospitality_tipo_listino ON hospitality_tipo_listino.idsito = hospitality_listino_camere.idsito
                        INNER JOIN hospitality_numero_listini ON hospitality_numero_listini.Id = hospitality_listino_camere.IdNumeroListino
                        WHERE hospitality_listino_camere.idsito = ".$idsito."
                        AND hospitality_numero_listini.Abilitato = 1
                        AND hospitality_listino_camere.IdSoggiorno = ".$idsoggiorno."
                        AND hospitality_listino_camere.IdCamera = ".$idcamera."
                        AND hospitality_listino_camere.PeriodoDal <= '".$data."'
                        AND hospitality_listino_camere.PeriodoAl >= '".$data."'
                        AND hospitality_listino_camere.Abilitato = 1";
                $result      = mysqli_query($conn,$sql) or die();
                $ret         = mysqli_fetch_assoc($result);
                $PrezzoCamera_[]  = $ret['PrezzoCamera']; 

     $sql_s         = "SELECT hospitality_listino_soggiorni.Prezzo
                        FROM hospitality_listino_soggiorni
                        WHERE hospitality_listino_soggiorni.idsito = ".$idsito."
                        AND hospitality_listino_soggiorni.Abilitato = 1
                        AND hospitality_listino_soggiorni.IdSoggiorno = ".$idsoggiorno."
                        AND hospitality_listino_soggiorni.PeriodoDal <= '".$data."'
                        AND hospitality_listino_soggiorni.PeriodoAl >= '".$data."'";
    $result_s      = mysqli_query($conn,$sql_s) or die();
    $ret_s         = mysqli_fetch_assoc($result_s);
    $PrezzoSoggiorno_[] = $ret_s['Prezzo'];

}

    $PrezzoSoggiorno = array_sum($PrezzoSoggiorno_);
    $PrezzoCamera    = array_sum($PrezzoCamera_);

    $sql2         = "SELECT hospitality_tipo_listino.TipoListino
                      FROM hospitality_listino_camere
                      INNER JOIN hospitality_tipo_listino ON hospitality_tipo_listino.idsito = hospitality_listino_camere.idsito
                      INNER JOIN hospitality_numero_listini ON hospitality_numero_listini.Id = hospitality_listino_camere.IdNumeroListino
                      WHERE hospitality_listino_camere.idsito = ".$idsito."
                      AND hospitality_numero_listini.Abilitato = 1
                      AND hospitality_listino_camere.IdSoggiorno = ".$idsoggiorno."
                      AND hospitality_listino_camere.IdCamera = ".$idcamera."
                      AND hospitality_listino_camere.Abilitato = 1";
    $result2      = mysqli_query($conn,$sql2) or die();
    $ret2         = mysqli_fetch_assoc($result2);

    $TipoListino  = $ret2['TipoListino'];


    if($TipoListino==0){
      $totale_soggiorno = ($PrezzoSoggiorno*$numero_camera);
      $testo_s = '<div data-toggle="tooltip" title="Dettaglio prezzi"><i style="cursor:pointer" class="fa fa-tags" data-toggle="modal" data-target="#sogg_prez'.$n_proposta.'_'.$n_riga.'" ></i> <small>dettaglio</small></div><div class="modal fade" id="sogg_prez'.$n_proposta.'_'.$n_riga.'"  tabindex="-1" role="dialog" aria-hidden="true">  <div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body"><small>Prezzo trattamento €: <b>'.implode(",",$PrezzoSoggiorno_).'</b><br> <span class="text-red">X</span> n° camere: <b>'.$numero_camera.'</b> <span class="text-red">X</span> n* di notti: <b>'.$notti.'</b></small></div></div></div>';
      $totale_unitaro_camera = (($PrezzoCamera*$numero_camera)+$totale_soggiorno);
      $testo = '<div data-toggle="tooltip" title="Dettaglio prezzi"><i style="cursor:pointer" class="fa fa-tags" data-toggle="modal" data-target="#cam_prez'.$n_proposta.'_'.$n_riga.'" ></i> <small>dettaglio</small></div><div id="cam_prez'.$n_proposta.'_'.$n_riga.'" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body"><small>Prezzo a camera €: <b>'.implode(",",$PrezzoCamera_).'</b><br> <span class="text-red">X</span> n° camere: <b>'.$numero_camera.'</b> <span class="text-red">X</span> n* di notti: <b>'.$notti.'</b></small></div></div></div>';
    }else{
      $totale_soggiorno = ($PrezzoSoggiorno*$numero_adulti);
      $testo_s = '<div data-toggle="tooltip" title="Dettaglio prezzi"><i style="cursor:pointer" class="fa fa-tags" data-toggle="modal" data-target="#sogg_prez'.$n_proposta.'_'.$n_riga.'" ></i> <small>dettaglio</small></div><div class="modal fade" id="sogg_prez'.$n_proposta.'_'.$n_riga.'"  tabindex="-1" role="dialog" aria-hidden="true">  <div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body"><small>Prezzo trattamento €: <b>'.implode(",",$PrezzoSoggiorno_).'</b><br> <span class="text-red">X</span> n° adulti: <b>'.$numero_adulti.'</b> <span class="text-red">X</span> n* di notti: <b>'.$notti.'</b></small></div></div></div>';
      $totale_unitaro_camera = (($PrezzoCamera*$numero_adulti)+$totale_soggiorno);
      $testo = '<div data-toggle="tooltip" title="Dettaglio prezzi"><i style="cursor:pointer" class="fa fa-tags" data-toggle="modal" data-target="#cam_prez'.$n_proposta.'_'.$n_riga.'" ></i> <small>dettaglio</small></div><div id="cam_prez'.$n_proposta.'_'.$n_riga.'" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body"><small>Prezzo a persona €: <b>'.implode(",",$PrezzoCamera_).'</b> <br><span class="text-red">X</span> n° adulti: <b>'.$numero_adulti.'</b> <span class="text-red">X</span> n* di notti: <b>'.$notti.'</b></small></div></div></div>';
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

	mysqli_close($conn);
?>
