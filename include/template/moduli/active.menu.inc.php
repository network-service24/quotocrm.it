 <?php
    if( $GLOBALS['ActiveMenu']['simplebooking'] == 'active'||
        $GLOBALS['ActiveMenu']['ericsoftbooking'] == 'active'||
        $GLOBALS['ActiveMenu']['bedzzlebooking'] == 'active' ||
        $GLOBALS['ActiveMenu']['pms'] == 'active' ||
        $GLOBALS['ActiveMenu']['parityrate'] == 'active' ||
        $GLOBALS['ActiveMenu']['dizionario'] == 'active' ||
        $GLOBALS['ActiveMenu']['add_mod_dizionario'] == 'active' ||
        $GLOBALS['ActiveMenu']['smtp'] == 'active' ||
        $GLOBALS['ActiveMenu']['paginazione'] == 'active' ||
        $GLOBALS['ActiveMenu']['configurazioni'] == 'active' ||
        $GLOBALS['ActiveMenu']['limita'] == 'active' ||
        $GLOBALS['ActiveMenu']['panel_ext'] == 'active' ||
        $GLOBALS['ActiveMenu']['delete_cliente'] == 'active' ||
        $GLOBALS['ActiveMenu']['setting-form/crea_form'] == 'active' ||
        $GLOBALS['ActiveMenu']['setting-form/delete_form'] == 'active' ||
        $GLOBALS['ActiveMenu']['imap'] == 'active'){
        $attivo_setting = 'pcoded-trigger';
    }
    if( $GLOBALS['ActiveMenu']['dizionario_form'] == 'active' ||
        $GLOBALS['ActiveMenu']['add_mod_dizionario_form'] == 'active' ||
        $GLOBALS['ActiveMenu']['lingue'] == 'active' ||
        $GLOBALS['ActiveMenu']['setting-form/crea_form'] == 'active' ||
        $GLOBALS['ActiveMenu']['form'] == 'active' ||
        $GLOBALS['ActiveMenu']['setting-form'] == 'active'){
        $attivo_form = 'pcoded-trigger';
    }
    if( $GLOBALS['ActiveMenu']['logs_accessi'] == 'active'||
        $GLOBALS['ActiveMenu']['logs'] == 'active' || 
        $GLOBALS['ActiveMenu']['logs_server'] == 'active'){
        $attivo_server = 'pcoded-trigger';
    }
    if( $GLOBALS['ActiveMenu']['operatori'] == 'active'||
        $GLOBALS['ActiveMenu']['utenti'] == 'active'){
        $attivo_accessi = 'pcoded-trigger';
    }

    if( $GLOBALS['ActiveMenu']['anagrafica_cliente'] == 'active'||
        $GLOBALS['ActiveMenu']['social_cliente'] == 'active'||
        $GLOBALS['ActiveMenu']['pagamenti'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_contenuti_pagamenti'] == 'active'||
        $GLOBALS['ActiveMenu']['fonti_prenotazione'] == 'active'||
        $GLOBALS['ActiveMenu']['target'] == 'active'||
        $GLOBALS['ActiveMenu']['configurazioni_client'] == 'active'||
        $GLOBALS['ActiveMenu']['limita_client'] == 'active'||
        $GLOBALS['ActiveMenu']['policy'] == 'active'||
        $GLOBALS['ActiveMenu']['add_policy'] == 'active'||
        $GLOBALS['ActiveMenu']['privacy_policy'] == 'active'){
        $attivo_configurazioni = 'pcoded-trigger';
    }

    if( $GLOBALS['ActiveMenu']['motivazioni'] == 'active'||
        $GLOBALS['ActiveMenu']['add_motivazioni'] == 'active'||
        $GLOBALS['ActiveMenu']['tariffe'] == 'active'||
        $GLOBALS['ActiveMenu']['add_tariffe'] == 'active'||
        $GLOBALS['ActiveMenu']['pacchetti'] == 'active'||
        $GLOBALS['ActiveMenu']['add_pacchetti'] == 'active'||
        $GLOBALS['ActiveMenu']['soggiorni'] == 'active'||
        $GLOBALS['ActiveMenu']['soggiorni'] == 'active'||
        $GLOBALS['ActiveMenu']['soggiorno_testi'] == 'active'||
        $GLOBALS['ActiveMenu']['soggiorno_listino'] == 'active'||
        $GLOBALS['ActiveMenu']['servizi_aggiuntivi'] == 'active'||
        $GLOBALS['ActiveMenu']['add_servizi_aggiuntivi'] == 'active'||
        $GLOBALS['ActiveMenu']['tipo_listino'] == 'active'||
        $GLOBALS['ActiveMenu']['listino_tabella'] == 'active'||
        $GLOBALS['ActiveMenu']['servizi_camera'] == 'active' ||
        $GLOBALS['ActiveMenu']['camere'] == 'active' ||
        $GLOBALS['ActiveMenu']['camere_testi'] == 'active'||
        $GLOBALS['ActiveMenu']['camere_listino'] == 'active'||
        $GLOBALS['ActiveMenu']['camere_gallery'] == 'active'){
        $attivo_disponibilita = 'pcoded-trigger';
    }

    if( $GLOBALS['ActiveMenu']['gallery'] == 'active'||
        $GLOBALS['ActiveMenu']['gallery_target'] == 'active'||
        $GLOBALS['ActiveMenu']['infohotel'] == 'active'||
        $GLOBALS['ActiveMenu']['add_infohotel'] == 'active'||
        $GLOBALS['ActiveMenu']['banner_info'] == 'active'||
        $GLOBALS['ActiveMenu']['add_banner_info'] == 'active'||
        $GLOBALS['ActiveMenu']['info_box'] == 'active'||
        $GLOBALS['ActiveMenu']['add_info_box'] == 'active'||
        $GLOBALS['ActiveMenu']['eventi'] == 'active'||
        $GLOBALS['ActiveMenu']['eventi_testi'] == 'active'||
        $GLOBALS['ActiveMenu']['punti_interesse'] == 'active'||
        $GLOBALS['ActiveMenu']['punti_interesse_testi'] == 'active'||
        $GLOBALS['ActiveMenu']['sconti'] == 'active'){
        $attivo_generiche = 'pcoded-trigger';
    } 

    if( $GLOBALS['ActiveMenu']['configura_cs'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_oggetto_cs'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_mail_cs'] == 'active'||
        $GLOBALS['ActiveMenu']['domande'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_recensioni_punteggio'] == 'active' ||
        $GLOBALS['ActiveMenu']['configura_oggetto_recensioni_punteggio'] == 'active' ||
        $GLOBALS['ActiveMenu']['configura_mail_recensioni_punteggio'] == 'active'){
        $attivo_cs = 'pcoded-trigger';
    }

    if( $GLOBALS['ActiveMenu']['configura_recall'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_oggetto_recall'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_mail_recall'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_resend'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_oggetto_resend'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_mail_resend'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_info_utili'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_contenuti_info_utili'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_email_benvenuto'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_contenuti_benvenuto'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_checkin'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_oggetto_checkin'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_mail_checkin'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_recensioni'] == 'active' ||
        $GLOBALS['ActiveMenu']['configura_oggetto_recensioni'] == 'active'||
        $GLOBALS['ActiveMenu']['configura_mail_recensioni'] == 'active'){
        $attivo_autoresponder = 'pcoded-trigger';
    }

    if( $GLOBALS['ActiveMenu']['contenuti_email'] == 'active'||
        $GLOBALS['ActiveMenu']['altri_contenuti_email'] == 'active'||
        $GLOBALS['ActiveMenu']['contenuti_template'] == 'active'||
        $GLOBALS['ActiveMenu']['altri_contenuti_template'] == 'active'||
        $GLOBALS['ActiveMenu']['googlemap_template'] == 'active'||
        $GLOBALS['ActiveMenu']['grafiche'] == 'active'||
        $GLOBALS['ActiveMenu']['anteprima_email'] == 'active'||
        $GLOBALS['ActiveMenu']['anteprima_default'] == 'active' ||
        $GLOBALS['ActiveMenu']['anteprima_smart'] == 'active' ||
        $GLOBALS['ActiveMenu']['anteprima_custom1'] == 'active' ||
        $GLOBALS['ActiveMenu']['anteprima_custom2'] == 'active' ||
        $GLOBALS['ActiveMenu']['anteprima_custom3'] == 'active' ){
        $attivo_templates = 'pcoded-trigger';
    }

    $network_menu_attivi = $attivo_setting.'
                        '.$attivo_form.' 
                        '.$attivo_server.'
                        '.$attivo_accessi.' 
                        '.$attivo_configurazioni.' 
                        '.$attivo_disponibilita.' 
                        '.$attivo_generiche.' 
                        '.$attivo_cs.'
                        '.$attivo_autoresponder.'
                        '.$attivo_templates; 

    if( $GLOBALS['ActiveMenu']['statistiche_new'] == 'active'||
        $GLOBALS['ActiveMenu']['statistiche_new_detail'] == 'active'||        
        $GLOBALS['ActiveMenu']['statistiche_new_campaign'] == 'active'||       
        $GLOBALS['ActiveMenu']['statistiche_voucher'] == 'active' ||
        $GLOBALS['ActiveMenu']['performance'] == 'active'||
        $GLOBALS['ActiveMenu']['anagrafiche_clienti'] == 'active'){
        $attivo_stats = 'pcoded-trigger';
    }

    if( $GLOBALS['ActiveMenu']['statistiche3']     == 'active'||
        $GLOBALS['ActiveMenu']['facebook_ads_new'] == 'active' ||
        $GLOBALS['ActiveMenu']['ppc_ads_new'] == 'active' ||
        $GLOBALS['ActiveMenu']['newsletter_ads_new'] == 'active'){
        $attivo_graph = 'pcoded-trigger';
    }
    if( $GLOBALS['ActiveMenu']['statistiche_GA4']     == 'active'||
        $GLOBALS['ActiveMenu']['facebook_ads_GA4'] == 'active' ||
        $GLOBALS['ActiveMenu']['ppc_ads_GA4'] == 'active' ||
        $GLOBALS['ActiveMenu']['newsletter_ads_GA4'] == 'active'){
        $attivo_graphGA4 = 'pcoded-trigger';
    }
    if( $GLOBALS['ActiveMenu']['statistiche_utm']     == 'active'||
        $GLOBALS['ActiveMenu']['facebook_ads_utm'] == 'active' ||
        $GLOBALS['ActiveMenu']['ppc_ads_utm'] == 'active' ||
        $GLOBALS['ActiveMenu']['newsletter_ads_utm'] == 'active'){
        $attivo_graphUTM = 'pcoded-trigger';
    }
    if( $GLOBALS['ActiveMenu']['facebook_ads_nws'] == 'active' ||
        $GLOBALS['ActiveMenu']['ppc_ads_nws'] == 'active' || 
        $GLOBALS['ActiveMenu']['newsletter_ads_nws'] == 'active'){
        $attivo_camp = 'pcoded-trigger';
    }

    $statistic_menu_attivi = $attivo_stats.'
                            '.$attivo_graphGA4.'
                            '.$attivo_graphUTM.'
                            '.$attivo_graph.'
                            '.$attivo_camp;

    if( $GLOBALS['ActiveMenu']['crea_proposta_esterna'] == 'active'||
        $GLOBALS['ActiveMenu']['prenotazioni_esterne']     == 'active'||
        $GLOBALS['ActiveMenu']['schedine_alloggiati'] == 'active' ||
        $GLOBALS['ActiveMenu']['mod_schedine_alloggiati'] == 'active' ||
        $GLOBALS['ActiveMenu']['box_info'] == 'active' ||
        $GLOBALS['ActiveMenu']['add_box_info'] == 'active'){
        $attivo_checkin = 'pcoded-trigger';
    } 
  
    if( $GLOBALS['ActiveMenu']['profila_per_anno'] == 'active'){
        $profila_perAnno = 'pcoded-trigger';
       
    } 
    if( $GLOBALS['ActiveMenu']['archivio_per_anno'] == 'active' ){
        $archivio_perAnno = 'pcoded-trigger';
    }                  
?>