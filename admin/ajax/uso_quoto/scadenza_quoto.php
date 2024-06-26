<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$idsito = $_REQUEST['idsito'];

      $select     = "SELECT
                      DATEDIFF(siti.data_end_hospitality,siti.data_start_hospitality) AS DiffDate,
                      siti.data_end_hospitality,
                      siti.hospitality,
                      siti.no_rinnovo_hospitality
                    FROM
                      siti
                    WHERE
                      siti.idsito = ".$idsito."
                    AND
                      (siti.data_start_hospitality IS NOT NULL OR siti.data_start_hospitality  != '0000-00-00')
                    AND
                      (siti.data_end_hospitality IS NOT NULL OR siti.data_end_hospitality  != '0000-00-00')";

      $res        = $dbMysqli->query($select);
      $row        = $res[0];

      $differenza = ($row['DiffDate']);

      $diff_data  = (100-$differenza);

      $d_e_tmp    = explode("-",$row['data_end_hospitality']);
      $data_end   = $d_e_tmp[2].'-'.$d_e_tmp[1].'-'.$d_e_tmp[0];

      if($differenza < 60){
        $TestDemo = '&nbsp; <b class="text-green">TEST DEMO</b>';
      }else{
        $TestDemo = '';
      }
      if($differenza <= 31){
        $box ='&nbsp;&nbsp;&nbsp;<i class="fa fa-trophy '.($TestDemo!=''?'text-green':'').'"></i>&nbsp; Tempo di attivazione '.$differenza.' gg.'.$TestDemo;
      }elseif($differenza <= 180){
        $box ='&nbsp;&nbsp;&nbsp;<i class="fa fa-trophy '.($TestDemo!=''?'text-green':'').'"></i>&nbsp; Tempo di attivazione '.$differenza.' gg.'.$TestDemo;
      }else{
        if($row['data_end_hospitality'] <= date('Y-m-d')){

          if($row['no_rinnovo_hospitality'] == 1){
            $disdetto = '&nbsp; <b class="text-red">DISDETTO</b> ';
          }else{
            $disdetto = '';
          }

          $box = '&nbsp;&nbsp;&nbsp;<i class="fa fa-hourglass '.($disdetto!=''?'text-red':'').'"></i>&nbsp; Il software è stato attivo per '.$differenza.' gg.' .$disdetto;

        }else{

          $sel      = "SELECT
                        DATEDIFF(siti.data_end_hospitality,'".date('Y-m-d')."') AS giorni_mancanti
                      FROM
                        siti
                      WHERE
                        siti.idsito = ".$idsito."
                      AND
                        siti.hospitality = 1";

          $rs       = $dbMysqli->query($sel);
          $rw       = $rs[0];
          $mancanti = $rw['giorni_mancanti'];

          if($mancanti <= '15'){
            $colore_stile = 'text-red';
          }else{
            $colore_stile = '';
          }

          $box = '&nbsp;&nbsp;&nbsp;<i class="fa fa-hourglass-half text-blue"></i>&nbsp; <span class="'.$colore_stile.'">Alla scadenza mancano '.$mancanti.' gg.</span>';
        }

      }


        echo $box;
