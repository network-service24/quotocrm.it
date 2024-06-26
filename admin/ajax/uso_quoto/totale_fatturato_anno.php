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
$inizio = $_REQUEST['inizio'];
$fine = $_REQUEST['fine'];

      $select = "SELECT
                  SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM
                  hospitality_guest
                INNER JOIN
                  hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE
                  1 = 1
                  AND ((hospitality_guest.DataRichiesta >= '$inizio'
                  AND hospitality_guest.DataRichiesta <= '$fine')
                  OR (hospitality_guest.DataChiuso IS NOT NULL
                  AND DATE(hospitality_guest.DataChiuso) >= '$inizio'
                  AND DATE(hospitality_guest.DataChiuso) <= '$fine'))
                AND
                  hospitality_guest.idsito = ".$idsito."
                AND
                  hospitality_guest.NoDisponibilita = 0
                AND
                  hospitality_guest.Disdetta = 0
                AND
                    hospitality_guest.Hidden = 0
                AND
                  hospitality_guest.TipoRichiesta = 'Conferma'";

      $res = $dbMysqli->query($select);
      $rwc = $res[0];

     // if($tipo == 'format'){
         /// echo number_format($rwc['fatturato'],0,'.','');
      //}else{
          echo number_format($rwc['fatturato'],2,',','.');
      //}


