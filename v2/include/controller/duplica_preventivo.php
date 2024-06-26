<?php
if($_REQUEST['azione']!=''){


        function getlastid($tabella){
           global $db;
            $db->query("SELECT MAX(id) as Id FROM $tabella");
            $dato = $db->row();
            $newid = $dato['Id'];
            return($newid);
       }
        function getnewid($tabella,$campo){
           global $db;
            $db->query("SELECT MAX($campo) as Id FROM $tabella");
            $dato = $db->row();
            $newid = $dato['Id']+1;
            return($newid);
       }

        function new_Npreno($tabella,$id_sito){
           global $db;
            $db->query("SELECT  NumeroPrenotazione FROM $tabella WHERE idsito =".$id_sito." ORDER BY NumeroPrenotazione DESC");
            $dato = $db->row();
            $newN = $dato['NumeroPrenotazione']+1;
            return($newN);
       }

        $select    = "SELECT * FROM hospitality_guest WHERE Id = ".$_REQUEST['azione'];
        $run_query = $db->query($select);
        $row       = $db->row($run_query);

       // dati richiesta
       $DataRichiesta      = $row['DataRichiesta'];
       $id_politiche       = $row['id_politiche'];
       $id_template        = $row['id_template'];
       $acconto_richiesta  = $row['AccontoRichiesta'];
       $AccontoLibero      = $row['AccontoLibero'];
       $Lingua             = $row['Lingua'];
       $TipoRichiesta      = $row['TipoRichiesta'];
       $TipoVacanza        = $row['TipoVacanza'];
       $ChiPrenota         = $row['ChiPrenota'];
       $EmailSegretaria    = $row['EmailSegretaria'];
       $idsito             = $row['idsito'];
       // dati cliente
       $Nome               = $row['Nome'];
       $Cognome            = $row['Cognome'];
       $Email              = $row['Email'];
       $Cellulare          = $row['Cellulare'];
       // dati prenotazione
       $DataArrivo         = $row['DataArrivo'];
       $DataPartenza       = $row['DataPartenza'];
       $NumeroPrenotazione = new_Npreno('hospitality_guest',$idsito);

       $NumeroAdulti       = $row['NumeroAdulti'];
       $NumeroBambini      = $row['NumeroBambini'];
       $EtaBambini1        = $row['EtaBambini1'];
       $EtaBambini2        = $row['EtaBambini2'];
       $EtaBambini3        = $row['EtaBambini3'];
       $EtaBambini4        = $row['EtaBambini4'];
       $EtaBambini5        = $row['EtaBambini5'];
       $EtaBambini6        = $row['EtaBambini6'];
       // dati informativi
       if($row['FontePrenotazione'] != 'Sito Web'){
         $FontePrenotazione = $row['FontePrenotazione'];
       }else{
         $FontePrenotazione = '';
       }

       $TipoPagamento      = $row['TipoPagamento'];

       $DataScadenza       = $row['DataScadenza'];
       $Note               = $row['Note'];
       // ABILITAZIONE A INVIO EMAIL
       $AbilitaInvio       = $row['AbilitaInvio' ];

        // query di inserimento
        $insert = "INSERT INTO hospitality_guest(id_politiche,
                                                id_template,
                                                AccontoRichiesta,
                                                AccontoLibero,
                                                DataRichiesta,
                                                TipoRichiesta,
                                                TipoVacanza,
                                                ChiPrenota,
                                                EmailSegretaria,
                                                idsito,
                                                Nome,
                                                Cognome,
                                                Email,
                                                Cellulare,
                                                DataNascita,
                                                Lingua,
                                                DataArrivo,
                                                DataPartenza,
                                                NumeroPrenotazione,
                                                NumeroAdulti,
                                                NumeroBambini,
                                                EtaBambini1,
                                                EtaBambini2,
                                                EtaBambini3,
                                                EtaBambini4,
                                                EtaBambini5,
                                                EtaBambini6,
                                                FontePrenotazione,
                                                DataScadenza,
                                                Note,
                                                AbilitaInvio
                                                ) VALUES (
                                                '".$id_politiche."',
                                                '".$id_template."',
                                                '".$acconto_richiesta."',
                                                '".$AccontoLibero."',
                                                '".($_REQUEST['param']=='now'?date('Y-m-d'):$DataRichiesta)."',
                                                '".$TipoRichiesta."',
                                                '".$TipoVacanza."',
                                                '".$ChiPrenota."',
                                                '".$EmailSegretaria."',
                                                '".$idsito."',
                                                '".addslashes($Nome)."',
                                                '".addslashes($Cognome)."',
                                                '".$Email."',
                                                '".$Cellulare."',
                                                '".$DataNascita."',
                                                '".$Lingua."',
                                                '".$DataArrivo."',
                                                '".$DataPartenza."',
                                                '".$NumeroPrenotazione."',
                                                '".$NumeroAdulti."',
                                                '".$NumeroBambini."',
                                                '".$EtaBambini1."',
                                                '".$EtaBambini2."',
                                                '".$EtaBambini3."',
                                                '".$EtaBambini4."',
                                                '".$EtaBambini5."',
                                                '".$EtaBambini6."',
                                                '".$FontePrenotazione."',
                                                '".$DataScadenza."',
                                                '".addslashes($Note)."',
                                                '".$AbilitaInvio."')";
      $db->query($insert);

      $IdRichiesta = getlastid('hospitality_guest');

      $ins_template = "INSERT INTO hospitality_template_link_landing(id_richiesta,id_template,idsito) VALUES ('".$IdRichiesta."','".$id_template."','".$idsito."')";
      $db->query($ins_template);

      $selectP = "SELECT * FROM hospitality_rel_pagamenti_preventivi WHERE id_richiesta = ".$_REQUEST['azione'];
      $risP    = $db->query($selectP);
      $value   = $db->row($risP);
      $ins_pag = "INSERT INTO hospitality_rel_pagamenti_preventivi(idsito,id_richiesta,CC,BB,VP,PP,GB,GBVP) VALUES ('".$value['idsito']."','".$IdRichiesta."','".$value['CC']."','".$value['BB']."','".$value['VP']."','".$value['PP']."','".$value['GB']."','".$value['GBVP']."')";
      $db->query($ins_pag);

        $sel = "SELECT * FROM hospitality_proposte WHERE id_richiesta = ".$_REQUEST['azione']." ORDER BY Id ASC";
        $run = $db->query($sel);
        $rws = $db->result($run);

      // se la prima proposta è compilata
    if(sizeof($rws) > 0){
        $IdProposta = '';
        foreach ($rws as $key => $value) {

                 $db->query("INSERT INTO hospitality_proposte(id_richiesta,
                                                      Arrivo,
                                                      Partenza,
                                                      NomeProposta,
                                                      TestoProposta,
                                                      CheckProposta,
                                                      PrezzoL,
                                                      PrezzoP,
                                                      AccontoPercentuale,
                                                      AccontoImporto,
                                                      AccontoTariffa,
                                                      AccontoTesto
                                                      ) VALUES (
                                                      '".$IdRichiesta."',
                                                      '".$value['Arrivo']."',
                                                      '".$value['Partenza']."',
                                                      '".addslashes($value['NomeProposta'])."',
                                                      '".addslashes($value['TestoProposta'])."',
                                                      '".$value['CheckProposta']."',
                                                      '".$value['PrezzoL']."',
                                                      '".$value['PrezzoP']."',
                                                      '".$value['AccontoPercentuale']."',
                                                      '".$value['AccontoImporto']."',
                                                      '".addslashes($value['EtichettaTariffa'])."',
                                                      '".addslashes($value['AccontoTesto'])."')");



            $IdProposta = getlastid('hospitality_proposte');

            $s = "SELECT * FROM hospitality_richiesta WHERE id_richiesta = ".$_REQUEST['azione']." AND id_proposta = ".$value['Id']." ORDER BY Id ASC";
            $r = $db->query($s);
            $w = $db->result($r);
            if(sizeof($w) > 0){

                foreach ($w as $k => $v) {
                     $db->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                          id_proposta,
                                                          TipoSoggiorno,
                                                          NumeroCamere,
                                                          TipoCamere,
                                                          NumAdulti,
                                                          NumBambini,
                                                          EtaB,
                                                          Prezzo
                                                          ) VALUES (
                                                          '".$IdRichiesta."',
                                                          '".$IdProposta."',
                                                          '".$v['TipoSoggiorno']."',
                                                          '".$v['NumeroCamere']."',
                                                          '".$v['TipoCamere']."',
                                                          '".$v['NumAdulti']."',
                                                          '".$v['NumBambini']."',
                                                          '".$v['EtaB']."',
                                                          '".$v['Prezzo']."')");
                }
            }

            $ss = "SELECT * FROM hospitality_relazione_servizi_proposte WHERE id_richiesta = ".$_REQUEST['azione']." AND id_proposta = ".$value['Id']." ORDER BY Id ASC";
            $rs = $db->query($ss);
            $ws = $db->result($rs);
            if(sizeof($ws) > 0){
                foreach($ws as $ky => $val){
                    $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$val['servizio_id']."','".$val['num_persone']."','".$val['num_notti']."')");
                }
            }
            $ssv = "SELECT * FROM hospitality_relazione_visibili_servizi_proposte WHERE id_richiesta = ".$_REQUEST['azione']." AND id_proposta = ".$value['Id']." ORDER BY Id ASC";
            $rsv = $db->query($ssv);
            $wsv = $db->result($rsv);
            if(sizeof($wsv) > 0){
                foreach($wsv as $kyv => $valv){
                    $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$valv['servizio_id']."','".$valv['visibile']."')");
                }
            }
            $sc = "SELECT * FROM hospitality_relazione_sconto_proposte WHERE id_richiesta = ".$_REQUEST['azione']." AND id_proposta = ".$value['Id']." ORDER BY Id ASC";
            $rc = $db->query($sc);
            $wc = $db->row($rc);
            if(is_array($wc)) {
              if($wc > count($wc))
                  $tot = count($wc); 
            }else{
                $tot = 0;
            }
            if($tot>0){
                $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$wc['sconto']."')");
            }
        }

    }

    header('Location:'.BASE_URL_SITO.'preventivi/');
}
