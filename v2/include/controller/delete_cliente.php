<?php
#############
# PROCEDURA PER CANCELLARE TUTTO UN ACCOUNT CLIENTE E LIBERARE IL DATABESE E LE DIRECTORY DI TUTTI I DATI E LE IMMAGINI
# UN RESET COMPLETO
# SI DIGITA DAL BROWSER UNA VOLTA LOGGATI CON L'ACCOUNT DA CANCELLARE https://www.quoto.online/delete_cliente/&action=ZGVsZXRlX2lkc2l0bw==
###########################
    if($_REQUEST['action']=='ZGVsZXRlX2lkc2l0bw=='){

        $db->query("DELETE FROM hospitality_lingue WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_breadcrumb WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_dizionario WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_dizionario_lingua WHERE idsito = '".IDSITO."'");  
        // 
        $db->query("DELETE FROM dizionario_form_quoto WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM dizionario_form_quoto_lingue WHERE idsito = '".IDSITO."'");    
        // 
        $db->query("DELETE FROM hospitality_adCost_transactionRevenue WHERE idsito = '".IDSITO."'"); 
        // 
        $db->query("DELETE FROM hospitality_cambio_pagamenti WHERE idsito = '".IDSITO."'"); 
        // 
        $db->query("DELETE FROM hospitality_banner_info WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_banner_info_lang WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_boxinfo_checkin WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_boxinfo_checkin_lang WHERE idsito = '".IDSITO."'");        
        // 
        $db->query("DELETE FROM hospitality_politiche WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_politiche_lingua WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_condizioni_tariffe WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_condizioni_tariffe_lingua WHERE idsito = '".IDSITO."'");  
        // 
        $db->query("DELETE FROM hospitality_fonti_prenotazione WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_fonti_provenienza WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_check_modifica WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_codice_sconto WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_operatori WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_utenti_quoto WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_utenti_password WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_target WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_tipo_pagamenti WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_tipo_pagamenti_lingua WHERE idsito = '".IDSITO."'");   
        $db->query("DELETE FROM hospitality_rel_pagamenti_preventivi WHERE idsito = '".IDSITO."'");                                  
        #
        $db->query("DELETE FROM hospitality_tipo_pacchetto WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_tipo_pacchetto_lingua WHERE idsito = '".IDSITO."'");  
        //
        $db->query("DELETE FROM hospitality_tipo_soggiorno WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_tipo_soggiorno_lingua WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_listino_soggiorni WHERE idsito = '".IDSITO."'");

        $db->query("DELETE FROM hospitality_tipo_servizi_config WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_tipo_servizi WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_tipo_servizi_lingua WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_servizi_camera WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_servizi_camere_lingua WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_tipo_camere WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_camere_testo WHERE idsito = '".IDSITO."'"); 
        $db->query("DELETE FROM hospitality_listino_camere WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_tipo_listino WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_numero_listini WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_gallery_camera WHERE idsito = '".IDSITO."'");  
        // 
        $db->query("DELETE FROM hospitality_domande WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_domande_lingua WHERE idsito = '".IDSITO."'");           
        // 
        $db->query("DELETE FROM hospitality_contenuti_email WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_minigallery WHERE idsito = '".IDSITO."'"); 
        // 
        $db->query("DELETE FROM hospitality_gallery WHERE idsito = '".IDSITO."'"); 
        $db->query("DELETE FROM hospitality_tipo_gallery WHERE idsito = '".IDSITO."'"); 
        $db->query("DELETE FROM hospitality_tipo_gallery_target WHERE idsito = '".IDSITO."'"); 
        // 
        $db->query("DELETE FROM hospitality_contenuti_web WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_contenuti_web_lingua WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_stile_landing WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_template_landing WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_template_background WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_template_link_landing WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_template_colori WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_acconto_pagamenti WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_altri_pagamenti WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_carte_credito WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_chat WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_chat_notify WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_checkin WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_giorni_checkinonline WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_customer_satisfaction WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_recensioni_send WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_recensioni_range WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_tipo_voucher_cancellazione WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_tipo_voucher_cancellazione_lingua WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_data_esport WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_data_syncro WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_data_import WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_data_import_secondo_portale WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_data_import_terzo_portale WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_data_import_quarto_portale WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_data_import_quinto_portale WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_data_import_sesto_portale WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_data_import_settimo_portale WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_data_import_ottavo_portale WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_eventi WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_eventi_lang WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_pdi WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_pdi_lang WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_infohotel WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_infohotel_lang WHERE idsito = '".IDSITO."'");       
        //
        $db->query("DELETE FROM hospitality_info_box WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_info_box_lang WHERE idsito = '".IDSITO."'");      
        // 
        $db->query("DELETE FROM hospitality_giorni_precheckin WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_precheckin WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_precheckin_lingua WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_giorni_cs WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_giorni_recall_conferme WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_giorni_recall_preventivi WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_giorni_reselling WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_imap_email WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_invio_questionario WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_social WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_tracking_ads WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_client_id WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_custom_dimension WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_traccia_email WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_traccia_email_cron WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_tagmanager WHERE idsito = '".IDSITO."'");        
        //
        $db->query("DELETE FROM hospitality_contenuti_web_lingua WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_configurazioni WHERE idsito = '".IDSITO."'");        
        //
        $db->query("DELETE FROM hospitality_setup WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_simplebooking WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_ericsoftbooking WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_bedzzlebooking WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_pms WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_pms_camere WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_pms_cartecredito WHERE idsito = '".IDSITO."'");             
        //
        $db->query("DELETE FROM hospitality_pms_person WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_pms_trattamenti WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_data_syncro_pms WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = '".IDSITO."'");  
        //
        $db->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = '".IDSITO."'");  
        //
        $db->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = '".IDSITO."'");  
        //
        $db->query("DELETE FROM mailing_newsletter WHERE idsito = '".IDSITO."'");  
        //
        $db->query("DELETE FROM mailing_newsletter_nome_liste WHERE idsito = '".IDSITO."'"); 
        //
        $db->query("DELETE FROM mailing_newsletter_spedite WHERE idsito = '".IDSITO."'"); 
        //
        $db->query("DELETE FROM mailing_newsletter_template WHERE idsito = '".IDSITO."'"); 
        // 
        $db->query("DELETE FROM hospitality_log_accessi WHERE idsito = '".IDSITO."'");
        $db->query("DELETE FROM hospitality_log_operations WHERE idsito = '".IDSITO."'");
        // 
        $db->query("DELETE FROM hospitality_minus_plus WHERE idsito = '".IDSITO."'");
        //
        $db->query("DELETE FROM hospitality_transazioniId_bcc WHERE idsito = '".IDSITO."'");
        //
        $select = "SELECT * FROM hospitality_guest WHERE idsito = '".IDSITO."' ORDER BY Id";
        $res = $db->query($select);
        $rec = $db->result($res);
        foreach ($rec as $key => $value) {
            $db->query("DELETE FROM hospitality_proposte WHERE id_richiesta = '".$value['Id']."'");
            $db->query("DELETE FROM hospitality_richiesta WHERE id_richiesta = '".$value['Id']."'");
        }
        $db->query("DELETE FROM hospitality_guest WHERE idsito = '".IDSITO."'");


        // DELETE DIRECTORY IMMAGINI CLIENTE
        $path =  $_SERVER['DOCUMENT_ROOT'].'/v2/uploads/'.IDSITO.'/';  
        function deleteDir($path) {
            if (empty($path)) { 
                return false;
            }
            return is_file($path) ?
                    @unlink($path) :
                    array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
        }
        deleteDir($path);

        //header('Location:'.BASE_URL_SITO.'dashboard-index/');
        $prt->_goto(BASE_URL_SITO.'dashboard-index/');
    }