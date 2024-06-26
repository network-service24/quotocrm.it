<?php

                 $query = "SELECT siti.idsito, siti.web,siti.nome,siti.data_start_hospitality,siti.data_end_hospitality,siti.no_rinnovo_hospitality,siti.email,siti.tel,siti.cell,
                            utenti.ut_email,utenti.ut_nome,utenti.ut_cognome,pms_progetti.codice_progetto,pms_progetti.commento,pms_progetti.progetto
                            FROM siti
                            INNER JOIN pms_progetti ON pms_progetti.idsito = siti.idsito
                            INNER JOIN utenti ON utenti.matricola = pms_progetti.codice_operatore
                            WHERE siti.hospitality = 1
                            AND siti.data_end_hospitality > '".date('Y-m-d')."'
                            ".($_REQUEST['idsito']!=""?"AND siti.idsito = ".$_REQUEST['idsito']:"")."
                            AND pms_progetti.codice_progetto IN('127','132')
                            GROUP BY siti.idsito
                            ORDER BY siti.data_start_hospitality DESC";
        $rec = $db_suiteweb->query($query);
        $res = $db_suiteweb->result($rec);

        $tot      = '';
        $select   = ''; 

        $descr_nexi .= 'Check per avere la possibilità di pagare tramite NEXI'."\r\n";
        $descr_nexi .= 'Impostando il valore : '."\r\n";
        $descr_nexi .= '0 = il controllo non viene fatto'."\r\n";
        $descr_nexi .= '1 = il controllo è attivo'."\r\n";
        //
        $contenuto_nexi_it = 'Per poter riservare definitivamente la vostra prenotazione, dovete procedere al pagamento tramite Gateway NEXI.<br>
                            Una volta indirizzati al gateway di NEXI, terminare il pagamento e tornare alla vostra landing page dedicata per ottenere conferma di avvenuta operazione.';
        //
        $contenuto_nexi_en = 'To be able to permanently reserve your reservation, you must proceed with payment NEXI.<br>
                            Once you are directed to the NEXI gateway, complete the payment and return to your dedicated landing page to obtain confirmation of the operation.';
        //
        $contenuto_nexi_fr = 'Pour pouvoir réserver votre réservation en permanence, vous devez procéder au paiement NEXI.<br>
                            Une fois que vous êtes dirigé vers la passerelle NEXI, effectuez le paiement et revenez à votre page de destination dédiée pour obtenir la confirmation de l\'opération.';
        //
        $contenuto_nexi_de = 'Um Ihre Reservierung dauerhaft reservieren zu können, müssen Sie die Zahlung über NEXI vornehmen.<br>
                            Wenn Sie zum NEXI-Gateway weitergeleitet werden, führen Sie die Zahlung durch und kehren Sie zu Ihrer Landing-Page zurück, um eine Bestätigung der Operation zu erhalten.';


        foreach($res as $k => $v){

               $select = "SELECT * FROM hospitality_configurazioni WHERE idsito = ".$v['idsito']." AND parametro = 'check_nexi'";
                $sel = $db->query($select);
                $tot = sizeof($db->result($sel));
                if($tot==0){
                //
                    $db->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".$v['idsito']."','check_nexi','".$descr_nexi."','1')");
                }

                //
                $sync_pay5 = $db->query("INSERT INTO hospitality_tipo_pagamenti(idsito,Lingua,TipoPagamento,Abilitato,Ordine) VALUES('".$v['idsito']."','it','Nexi','0','5')");
                $id_sync_pay5 = $db->insert_id($sync_pay5);
                //
                $db->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay5."','".$v['idsito']."','it','Nexi','".addslashes($contenuto_nexi_it)."')");
                $db->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay5."','".$v['idsito']."','en','Nexi','".addslashes($contenuto_nexi_en)."')");
                $db->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay5."','".$v['idsito']."','fr','Nexi','".addslashes($contenuto_nexi_fr)."')");
                $db->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay5."','".$v['idsito']."','de','Nexi','".addslashes($contenuto_nexi_de)."')");

                $diz11_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','PAGA_NEXI')");
                $id_diz11_new = $db->insert_id($diz11_new);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".$v['idsito']."','it','Paga con NEXI')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".$v['idsito']."','en','Pay by NEXI')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".$v['idsito']."','fr','Payer par NEXI')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".$v['idsito']."','de','Zahlen Sie mit NEXI')");
        
                $diz12_new = $db->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".$v['idsito']."','it','MSG_NEXI')");
                $id_diz12_new = $db->insert_id($diz12_new);
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".$v['idsito']."','it','Pagamento salvato con successo, seguirà nostro voucher di conferma')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".$v['idsito']."','en','Payment successfully saved, follow our confirmation voucher')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".$v['idsito']."','fr','Paiement enregistré avec succès, suivre notre bon de confirmation')");
                $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".$v['idsito']."','de','Zahlung erfolgreich gespeichert, beachten Sie bitte folgende Bestätigung Gutschein')");
        
        
       }

?>