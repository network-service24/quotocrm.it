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
$ips_network_service = $_REQUEST['ips_network_service'];


      $select = 'SELECT
                    hospitality_log_accessi.*
                  FROM
                    hospitality_log_accessi
                  WHERE
                    hospitality_log_accessi.idsito = '.$idsito.'
                  ORDER BY
                    data_ora DESC
                  LIMIT
                    5';
      $arr = $dbMysqli->query($select);

      if(sizeof($arr)>0){
        $etichettaNWS = '';
        $opacity = '';
        foreach($arr as $key => $rwc){

          if($rwc['remote'] == '5.89.51.153'){
            $etichettaNWS = '<b>Accesso effettuato da Network Service</b>';
            $opacity = 'opacity: 0.5;';
          }else{
            $etichettaNWS = '';
            $opacity = '';
          }
          $accessi .= ' <div class="card card-body" style="border:1px solid #E1E1E1; padding:10px; border-radius: 5px;'. $opacity.'">
                          <p class="nowrap f12"><i class="fa fa-vcard-o text-green" data-toogle="tooltip" title="Cliente" aria-hidden="true"></i> '.$rwc['utente'].'</p>
                          <p class="nowrap f12"><i class="fa fa-user text-info" data-toogle="tooltip" title="Utente" aria-hidden="true"></i> '.($rwc['nome_utente']!=''?$rwc['nome_utente']:' Operatore di default').' '.($etichettaNWS!=''?'<small>('.$etichettaNWS.')</small>':'').'</p>
                          <p class="nowrap f12"><i class="fa fa-server text-orange" data-toogle="tooltip" title="Ip Provenienza" aria-hidden="true"></i> '.$rwc['remote'].'</p>
                          <p class="nowrap f12"><i class="fa fa-laptop text-red" data-toogle="tooltip" title="User-Agent" aria-hidden="true"></i> <small>'.$rwc['user_agent'].'</small></p>
                          <p class="nowrap f12"><i class="fa fa-clock-o text-purple" data-toogle="tooltip" title="Data e Ora" aria-hidden="true"></i> '.date('d-m-Y H:i:s',$rwc['data_ora']).'</p>
                        </div><br />'."\r\n";
      }
      }else{
        $accessi = 'Accesso non ancora registrato!!';
      }
      echo $accessi;

