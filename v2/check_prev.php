<?php
 //error_reporting(0);
$username   = 'www10483';
$password   = 'aJEYNx5zzayQKPd';
$host       = 'nws-db02';
$dbname     = 'www10483';

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database of QUOTO");

// $IDSITO = 257; //www.hotelroxy.net
// $IDSITO = 1740; //test.suiteweb.it
// $IDSITO = 1987; //www.quoto.travel
// $IDSITO = 1664; //www.bucaneve.it
// $IDSITO = 138; //www.hotelestate.it
// $IDSITO = 660; //www.hotelcrozzon.com
// $IDSITO = 826; //www.miraspiaggia.it
// $IDSITO = 1264; //www.hotelcoronariccione.it
// $IDSITO = 1240; //www.hotel-raffaello.com
// $IDSITO = 269; //www.hotelnobel.it
// $IDSITO = 647; //www.hparadiso.info
// $IDSITO = 1993; //www.cristallosanmartino.com
// $IDSITO = 1994; //www.orsinghersanmartino.com
// $IDSITO = 30; //www.hotellequerce.com
// $IDSITO = 2024; //www.baitadeipini.com
// $IDSITO = 837; //www.hotelgianna.it
// $IDSITO = 2030; //www.garganomizarhotel.com
// $IDSITO = 102; //www.touringhotelrimini.com
// $IDSITO = 534; //www.hoteldamarco.it
// $IDSITO = 2044; //www.ulivihotel.it
// $IDSITO = 215; //www.hotelamedeo.it
// $IDSITO = 2059; //www.hotelsanmarcosestola.it
// $IDSITO = 2063; //www.residencecimarimini.it
// $IDSITO = 1658; //www.hotelcabianca.it
// $IDSITO = 2028; //www.vallechiarahotel.it
// $IDSITO = 2071; //www.alpigolf.it
// $IDSITO = 2053; //www.locandabellevue.com
// $IDSITO = 661; //www.hotelsantoli.com

// $IDSITO = 2088; //www.residencebolognamima.it
// $IDSITO = 2092; //www.hotelcentralemilanomarittima.com
// $IDSITO = 2091; //www.albergogranduca.it
// $IDSITO = 1985; //www.hotelvillaricci.it
// $IDSITO = 2141; //www.badiagriturismo.it
// $IDSITO = 319; //www.albergodarita.it
// $IDSITO = 1625; //www.miramare.ws
// $IDSITO = 2054; //www.hotelvagabondriccione.com
// $IDSITO = 2122; //www.hotel-rendezvous.com
// $IDSITO = 117; //www.hotelcorinna.com
// $IDSITO = 1286; //www.sostioalevante.com
// $IDSITO = 2133; //www.beblabouledeneige.com
// $IDSITO = 228; //www.hotelcannes.it
// $IDSITO = 2214; //www.hotelennarimini.it
// $IDSITO = 2202; //www.hotelportopiccolo.it
// $IDSITO = 2199; //www.hotelcarmenriccione.it
// $IDSITO = 2209; //www.cortedanese.com
// $IDSITO = 515; //www.hotelmartino.net
// $IDSITO = 171; //www.hotelzeus.net
// $IDSITO = 2237; //www.hoteltettuccio.it
// $IDSITO = 2251; //www.hotelorchideablu.it
// $IDSITO = 1545; //www.hotelpiccadilly.it
// $IDSITO = 2259; //www.hoteljunior.it
// $IDSITO = 2224; //www.hotellogonovo.it
// $IDSITO = 1653; //www.hoteltrettenero.it
// $IDSITO = 2233; //www.hotelcostazzurra.it
// $IDSITO = 17; //www.hoteldelondres.it
// $IDSITO = 2228; //www.parcodeicastagni.it
// $IDSITO = 2265; //www.relilax.it


      $sql = "SELECT hospitality_guest.id,
                      hospitality_guest.FontePrenotazione,
                      hospitality_guest.idsito,
                      hospitality_fonti_provenienza.NumeroPrenotazione,
                      hospitality_fonti_provenienza.Provenienza,
                      hospitality_fonti_provenienza.Timeline
              FROM hospitality_guest
              INNER JOIN hospitality_fonti_provenienza ON hospitality_fonti_provenienza.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
              WHERE hospitality_guest.FontePrenotazione = 'Sito Web'
              AND hospitality_guest.idsito = ".$IDSITO."
              AND hospitality_fonti_provenienza.Provenienza = ''
              AND hospitality_fonti_provenienza.Timeline = ''
              ORDER BY hospitality_guest.idsito DESC,hospitality_guest.NumeroPrenotazione ASC";
      $result = mysqli_query($conn,$sql) or die('Error, connesione'.$sql);
      $listID = array();
      while($ret = mysqli_fetch_assoc($result)){

        if($ret['Provenienza']=='' && $ret['Timeline']== ''){
          //echo $ret['FontePrenotazione']. ' - '.$ret['idsito'].' -> '.$ret['NumeroPrenotazione'].' - '.$ret['Provenienza'].' - '.$ret['Timeline'].'<br />';

            $listID[$ret['id']] = $ret['NumeroPrenotazione'];
        }
      }

      foreach ($listID as $key => $value) {
        $update = "UPDATE hospitality_guest SET FontePrenotazione = 'Altro' WHERE id = ".$key;
        mysqli_query($conn,$update);
      }
      //print_r($listID);
      echo 'Numero di preventivi con referal vuoto aggiornati '.count($listID).' aggionati!';
      echo '<br /><br />';

      $sql = "SELECT hospitality_guest.id,
                      hospitality_guest.FontePrenotazione,
                      hospitality_guest.idsito,
                      hospitality_guest.NumeroPrenotazione,
                      hospitality_fonti_provenienza.Provenienza,
                      hospitality_fonti_provenienza.Timeline
              FROM hospitality_guest
              INNER JOIN hospitality_fonti_provenienza ON hospitality_fonti_provenienza.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
              WHERE hospitality_guest.FontePrenotazione = 'Sito Web'
              AND hospitality_guest.idsito = ".$IDSITO."
              ORDER BY hospitality_guest.idsito DESC,hospitality_guest.NumeroPrenotazione ASC";
      $result = mysqli_query($conn,$sql) or die('Error, connesione'.$sql);
      $listNumPreno = array();
      while($record = mysqli_fetch_assoc($result)){

        $listNumPreno[$record['id']] = $record['NumeroPrenotazione'].'#'.$record['idsito'];

      }

      $n = 0;
      foreach ($listNumPreno as $ky => $val) {

        $vl_tmp  = explode("#",$val);
        $NumP    = $vl_tmp[0];
        $idS     = $vl_tmp[1];

        $select2 = "SELECT * FROM hospitality_fonti_provenienza WHERE NumeroPrenotazione = ".$NumP." AND idsito = ".$idS;
        $res2    = mysqli_query($conn,$select2);
        $tot     = mysqli_num_rows($res2);

        if($tot  == 0){
          $update2 = "UPDATE hospitality_guest SET FontePrenotazione = 'Altro' WHERE id = ".$ky;
          $result2 = mysqli_query($conn,$update2);
          $tot2    = mysqli_num_rows($result2);
          $n++;
        }

      }

      echo 'Numero totale di preventivi target Sito Web SENZA nessun referal '.$n.' aggionati!';


mysqli_close($conn);

?>
