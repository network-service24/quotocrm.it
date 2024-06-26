<?php
#############
# PROCEDURA PER AUTOCOMPILARE IL DIZIONARIO E NON SOLO CON ITA,ENG,FRA,DEU
###########################
    if($_REQUEST['action']=='syncro_upgrade'){
    	 // syncro dati di tutte le lingue che il cliente ha abilitate sul prprio sito

        $diz1 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'SOGGIORNO'");
        $row1 = $db->row($diz1);
        $id_diz49 = $row1['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','".IDSITO."','fr','Séjour:')");

        $diz56 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'ALLA_CO'");
        $row56 = $db->row($diz56);
        $id_diz56 = $row56['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','".IDSITO."','fr','A c / ou ')");
  

        $diz57 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'CONTENUTO_MSG'");
        $row57 = $db->row($diz57);
        $id_diz57 = $row57['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','".IDSITO."','fr','nous tenons à accepter la proposition du séjour:')");
  
        $diz58 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'CORDIALMENTE'");
        $row58 = $db->row($diz58);
        $id_diz58 = $row58['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','".IDSITO."','fr','Cordialement')");

        //
        $diz51 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'SERVIZI_CAMERA'");
        $row51 = $db->row($diz51);
        $id_diz51 = $row51['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','".IDSITO."','fr','Les services de chambre:')");
   


        $diz = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'ADULTI'");
        $row = $db->row($diz);
        $id_diz = $row['id'];
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Adultes')");

        $diz = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'BAMBINI'");
        $row = $db->row($diz);
        $id_diz = $row['id'];
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Enfants')");


        $diz = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'PROPOSTA'");
        $row = $db->row($diz);
        $id_diz = $row['id'];
        $db->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Proposal')");

      
        $diz44 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'NOTTI'");
        $row44 = $db->row($diz44);
        $id_diz44 = $row44['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','".IDSITO."','fr','N° Nuits')");


        $diz81 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'SCADENZA'");
        $row81 = $db->row($diz81);
        $id_diz81 = $row81['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','".IDSITO."','fr','Date limite')");
   
        $diz98 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'PREZZO_CAMERA'");
        $row98 = $db->row($diz98);
        $id_diz98 = $row98['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','".IDSITO."','fr','Prix de la chambre')");

        $diz59 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'VISUALIZZA_MAPPA'");
        $row59 = $db->row($diz59);
        $id_diz59 = $row59['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','".IDSITO."','fr','Voir sur la carte')");


        $diz85 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'ACCONTO'");
        $row85 = $db->row($diz85);
        $id_diz85 = $row85['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','".IDSITO."','fr','Caution calculée sur le prix du séjour')");
       

        $diz131 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'SCELGO_BONIFICO'");
        $row131 = $db->row($diz131);
        $id_diz131 = $row131['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','".IDSITO."','fr','Je choisis de payer par virement bancaire')");

        $diz79 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'N_CARTA'");
        $row79 = $db->row($diz79);
        $id_diz79 = $row79['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','".IDSITO."','fr','numéro de carte')");

        $diz82 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'CODICE'");
        $row82 = $db->row($diz82);
        $id_diz82 = $row82['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','".IDSITO."','fr','Code CVV2')");

        $diz80 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'INTESTATARIO'");
        $row80 = $db->row($diz80);
        $id_diz80 = $row80['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','".IDSITO."','fr','Candidat')");

        $diz37 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'OFFERTA'");
        $row37 = $db->row($diz37);
        $id_diz37 = $row37['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','".IDSITO."','fr','Offre')");


        $diz77 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'SALVA_CARTA_CREDITO'");
        $row77 = $db->row($diz77);
        $id_diz77 = $row77['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','".IDSITO."','fr','Sauvegarder la carte de crédit')");


        $diz86 = $db->query("SELECT * FROM hospitality_dizionario WHERE idsito = '".IDSITO."' AND etichetta = 'ACCONSENTI_PRIVACY_POLICY'");
        $row86 = $db->row($diz86);
        $id_diz86 = $row86['id'];
        $db->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','".IDSITO."','fr','J\'ai lu la politique de confidentialité et les  <a href=\"javascript:;\" id=\"sblocca_politiche\">conditions d\'annulation</a>')");
       



        //header('Location:'.BASE_URL_SITO.'syncro/');
        $prt->_goto(BASE_URL_SITO.'syncro_fra/');
    }
