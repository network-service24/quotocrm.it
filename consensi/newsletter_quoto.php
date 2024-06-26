
<?
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");
        /**
         * VARIABILI ACQUISITE DAL REQUEST
         */
        $val       = base64_decode($_REQUEST['val']);
        $valori    = explode('#',$val);
        $id_utente = $valori[0];
        $idsito    = $valori[1];    

        /**
         * QUERY PER ESTRAPOLARE LA RIHCIESTA INTERESSATA
         */
        $query ='SELECT 
                    mailing_newsletter.*,
                    mailing_newsletter_nome_liste.nome_lista 
                FROM 
                    mailing_newsletter 
                INNER JOIN 
                    mailing_newsletter_nome_liste ON mailing_newsletter_nome_liste.id = mailing_newsletter.id_lista 
                WHERE 
                    mailing_newsletter.id = '.$id_utente.'
                AND
                    mailing_newsletter.idsito ='.$idsito.'';
        $res   = $dbMysqli->query($query);
        $r     = $res[0];

        $nome_iscritto    = $r['nome'];
        $cognome_iscritto = $r['cognome'];
        $email_iscritto   = $r['email'];
        $Ip               = $r['ip'];   
        $browser          = $r['agent'];    
        $modulo_inviato   = 'Newsletter inviata a :  '.$nome_iscritto .' '.$cognome_iscritto; 
        $flag_consenso    = ($r['CheckConsensoPrivacy']   == 1?'<i class = "fa fa-check-circle text-success"></i>': '<i class = "fa fa-times-circle text-danger"></i>');         
        $flag_marketing   = ($r['CheckConsensoMarketing'] == 1?'<i class = "fa fa-check-circle text-success"></i>': '<i class = "fa fa-times-circle text-danger"></i>');
        $check_marketing  = ($r['CheckConsensoMarketing'] == 1?1         : 0);
        $flag_profilazione= ($r['CheckConsensoProfilazione'] == 1?'<i class = "fa fa-check-circle text-success"></i>': '<i class = "fa fa-times-circle text-danger"></i>');
        $check_profilazione  = ($r['CheckConsensoProfilazione'] == 1?1         : 0);
        $data_tmp         = explode("-",$r['data']);
        $Data             = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0];

        $nome_lista       = $r['nome_lista'];

        //$lingua          = ($r['lingua']==''?'it':$r['lingua']);
        $lingua          = $r['lingua'];


        /**
         * QUERY PER DATI ANAGRAFICI HOTEL
         */
        $query2 ='SELECT siti.*,
                        anagrafica.rag_soc,
                            anagrafica.indirizzo,
                            anagrafica.cap,
                            anagrafica.p_iva,
                            comuni.nome_comune,
                            province.sigla_provincia,
                            regioni.nome_regione
                FROM
                    siti
                left join utenti on utenti.idsito = siti.idsito
                left join anagrafica on anagrafica.idanagra = utenti.idanagra
                left join comuni on comuni.codice_comune = siti.codice_comune
                left join province on province.codice_provincia = siti.codice_provincia
                left join regioni on regioni.codice_regione = siti.codice_regione
                WHERE siti.idsito = '.$idsito.' LIMIT 1';

        $res2   = $dbMysqli->query($query2);
        $rw     = $res2[0];

        $sito_tmp         = str_replace("http://","",$rw['web']);
        $sito_tmp         = str_replace("www.","",$sito_tmp);
        $http             = ($r['https']==1?'https://':'http://');
        $sitoweb          = $http.'www.'.$sito_tmp;   
        $emailhotel       =    $rw['email'];
        $nomehotel        =    $rw['nome'];

        /**
         * data creazione sito
         */
        $data_inizio_quoto_tmp = explode("-",$rw['data_start_hospitality']);
        $data_inizio_quoto     = $data_inizio_quoto_tmp[2].'-'.$data_inizio_quoto_tmp[1].'-'.$data_inizio_quoto_tmp[0];


        /**
         * DIZIONARIO PER TRADURRE IN ITALIANO LE ETICHETTE E I TITOLI
         */
        $text['title']['it']        = 'GDPR - Gestione consensi';
        $text['informativa']['it']  = 'Informativa ed esercizio dei tuoi diritti <small>(Art. dal 13 al 23 GDPR)</small> per il software CRM QUOTO!';
        $text['soggetto']['it']     = 'Soggetto interessato';       
        $text['titolare']['it']     = 'Titolare del trattamento dati'; 
        $text['consensi']['it']     = 'I tuoi consensi';
        $text['data']['it']         = 'Data';  
        $text['modulo']['it']       = 'Nominativo';  
        $text['accettati']['it']    = 'Consensi accettati';  
        $text['info_attuale']['it'] = 'Leggi informativa attuale su QUOTO di '.$nomehotel; 
        $text['esercita']['it']     = 'Esercita i tuoi diritti'; 
        $text['cancellate']['it']   = 'Cancellate questa mia iscrizione o richiesta archiviata dal software di Email Marketing che utilizzate <small><em>(diritto di cancellazione)</em></small>'; 
        $text['profilato']['it']    = 'Vorrei modificare il consenso per la profilazione marketing <small><em>(diritto di opposizione al processo decisionale automatizzato)</em></small>'; 
        $text['export']['it']       = 'Vorrei ottenere i miei dati <small><em>(diritto alla portabilità)</em></small>'; 
        $text['note']['it']         = 'Eventuali annotazioni e/o modifiche';
        $text['tempo']['it']        = '<small><i class="fa fa-check"></i> Il gestore dei dati ha 30 giorni di tempo per effetttuare le modifiche richieste (cancellazione, modifica, cambio consensi, ecc.).</small>'; 
        $text['versione']['it']     = 'Versione Informativa'; 
        $text['generica']['it']     = 'Informativa generica del'; 
        $text['dedicata']['it']     = 'Informativa dedicata del';           
        $text['pulsante']['it']     = 'Salva le tue preferenze';
        $text['privacy']['it']      = 'Consenso trattamento dati';  
        $text['marketing']['it']    = 'Consenso invio materiale marketing';
        $text['profilazione']['it'] = 'Consenso alla profilazione';
        $text['dati']['it']         = 'I tuoi dati';
        $text['nome']['it']         = 'Nome';
        $text['cognome']['it']      = 'Cognome';
        $text['cellulare']['it']    = 'Cellulare/telefono';
        $text['arrivo']['it']       = 'Data di Arrivo';
        $text['partenza']['it']     = 'Data di Partenza';
        $text['adulti']['it']       = 'Numero Adulti';
        $text['bambini']['it']      = 'Numero bambini';
        $text['eta']['it']          = ' di età ';
        /**
         * DIZIONARIO PER TRADURRE IN INGLESE LE ETICHETTE E I TITOLI
         */  
        $text['title']['en']        = 'GDPR - Consent management';
        $text['informativa']['en']  = 'Disclosure and exercise of your rights <small>(Art. dal 13 al 23 GDPR)</small> for CRM QUOTO software!';
        $text['soggetto']['en']     = 'Interested subject';       
        $text['titolare']['en']     = 'Data controller'; 
        $text['consensi']['en']     = 'Your consent';
        $text['data']['en']         = 'Date';  
        $text['modulo']['en']       = 'Nominative';  
        $text['accettati']['en']    = 'Consensus accepted';  
        $text['info_attuale']['en'] = 'Read current information on QUOTO of '.$nomehotel; 
        $text['esercita']['en']     = 'Exercise your rights'; 
        $text['cancellate']['en']   = 'Cancel my registration or archived request <small><em>(right of cancellation)</em></small>'; 
        $text['profilato']['en']    = 'I would like to change the consent for marketing profiling <small><em>(right to oppose the automated decision-making process)</em></small>'; 
        $text['export']['en']       = 'I would like to get my data <small><em>(right to portability)</em></small>';
        $text['note']['en']         = 'Possible annotations and / or modifications';
        $text['tempo']['en']        = '<small><i class="fa fa-check"></i> The data manager has 30 days to perform the requested changes (cancellation, modification, change of consent, etc.).</small>'; 
        $text['versione']['en']     = 'Information Version';
        $text['generica']['en']     = 'Generic disclosure of the'; 
        $text['dedicata']['en']     = 'Dedicated information of the';              
        $text['pulsante']['en']     = 'Save your preferences';
        $text['privacy']['en']      = 'Consent data processing';  
        $text['marketing']['en']    = 'Consent sending marketing material';
        $text['profilazione']['en'] = 'Consent to profiling';
        $text['dati']['en']         = 'Your data';
        $text['nome']['en']         = 'First name';
        $text['cognome']['en']      = 'Surname';
        $text['cellulare']['en']    = 'Mobile/Phone';
        $text['arrivo']['en']       = 'Check-in date';
        $text['partenza']['en']     = 'Departure date';
        $text['adulti']['en']       = 'Number of adults';
        $text['bambini']['en']      = 'Number of Children';
        $text['eta']['en']          = ' of age ';         
        /**
         * DIZIONARIO PER TRADURRE IN FRANCESE LE ETICHETTE E I TITOLI
         */
        $text['title']['fr']        = 'GDPR - Gestion du consentement';
        $text['informativa']['fr']  = 'Divulgation et exercice de vos droits <small>(Art. dal 13 al 23 GDPR)</small> pour le logiciel CRM QUOTO!';
        $text['soggetto']['fr']     = 'Sujet intéressé';       
        $text['titolare']['fr']     = 'Contrôleur de données'; 
        $text['consensi']['fr']     = 'Votre consentement';
        $text['data']['fr']         = 'Date';  
        $text['modulo']['fr']       = 'Nominatif';  
        $text['accettati']['fr']    = 'Consensus accepté';  
        $text['info_attuale']['fr'] = 'Lire les informations actuelles sur QUOTO de '.$nomehotel; 
        $text['esercita']['fr']     = 'Exercez vos droits'; 
        $text['cancellate']['fr']   = 'Annuler mon inscription ou demande archivée <small><em>(annulation)</em></small>'; 
        $text['profilato']['fr']    = 'Je voudrais changer le consentement pour le profilage marketing <small><em>(droit de s\'opposer au processus de décision automatisé)</em></small>'; 
        $text['export']['fr']       = 'Je voudrais obtenir mes données <small><em>(droit à la portabilité)</em></small>';
        $text['note']['fr']         = 'Annotations et / ou modifications possibles';
        $text['tempo']['fr']        = '<small><i class="fa fa-check"></i> Le gestionnaire des données dispose de 30 jours pour effectuer les modifications demandées (annulation, modification, changement de consentement, etc.).</small>'; 
        $text['versione']['fr']     = 'Version de l\'information'; 
        $text['generica']['fr']     = 'Divulgation générique de'; 
        $text['dedicata']['fr']     = 'Informations dédiées de';              
        $text['pulsante']['fr']     = 'Sauvegardez vos préférences'; 
        $text['privacy']['fr']      = 'Traitement des données de consentement';  
        $text['marketing']['fr']    = 'Consentement d\'envoi de matériel de marketing';
        $text['profilazione']['fr'] = 'Consentement au profilage';
        $text['dati']['fr']         = 'Vos données';
        $text['nome']['fr']         = 'Prenom';
        $text['cognome']['fr']      = 'Nom de famille';
        $text['cellulare']['fr']    = 'Mobile/Phone';
        $text['arrivo']['fr']       = 'Date d\'arrivée';
        $text['partenza']['fr']     = 'Date de départ';
        $text['adulti']['fr']       = 'Nombre d\'adultes';
        $text['bambini']['fr']      = 'Nombre d\'enfants';
        $text['eta']['fr']          = ' d\'âge ';        
        /**
         * DIZIONARIO PER TRADURRE IN TEDESCO LE ETICHETTE E I TITOLI
         */
        $text['title']['de']        = 'GDPR - Zustimmungsmanagement';
        $text['informativa']['de']  = 'Offenlegung und Ausübung Ihrer Rechte <small>(Art. dal 13 al 23 GDPR)</small> für CRM QUOTO Software!';
        $text['soggetto']['de']     = 'Interessiertes Thema';       
        $text['titolare']['de']     = 'Datencontroller'; 
        $text['consensi']['de']     = 'Ihre Zustimmung';
        $text['data']['de']         = 'Datum';  
        $text['modulo']['de']       = 'Nominativ';  
        $text['accettati']['de']    = 'Konsens akzeptiert';  
        $text['info_attuale']['de'] = 'Lesen Sie aktuelle Informationen auf QUOTO von '.$nomehotel; 
        $text['esercita']['de']     = 'Üben Sie Ihre Rechte aus'; 
        $text['cancellate']['de']   = 'Storniere meine Registrierung oder archivierte Anfrage <small><em>(Widerrufsrecht)</em></small>'; 
        $text['profilato']['de']    = 'Ich möchte die Zustimmung zum Marketing-Profiling ändern <small><em>(Recht, sich dem automatisierten Entscheidungsprozess zu widersetzen)</em></small>'; 
        $text['export']['de']       = 'Ich möchte meine Daten erhalten <small><em>(Recht auf Portabilität)</em></small>'; 
        $text['note']['de']         = 'Mögliche Anmerkungen und / oder Änderungen'; 
        $text['tempo']['de']        = '<small><i class="fa fa-check"></i> Der Datenmanager hat 30 Tage Zeit, um die gewünschten Änderungen vorzunehmen (Löschung, Änderung, Änderung der Zustimmung usw.).</small>';
        $text['versione']['de']     = 'Informationsversion';  
        $text['generica']['de']     = 'Allgemeine Offenlegung der'; 
        $text['dedicata']['de']     = 'Spezielle Informationen der';           
        $text['pulsante']['de']     = 'Speichern Sie Ihre Einstellungen';  
        $text['privacy']['de']      = 'Einwilligung Datenverarbeitung';  
        $text['marketing']['de']    = 'Zustimmung, die Marketingmaterial sendet';
        $text['profilazione']['de'] = 'Zustimmung zum Profiling';
        $text['dati']['de']         = 'Ihre Daten';
        $text['nome']['de']         = 'Name';
        $text['cognome']['de']      = 'Nachname';
        $text['cellulare']['de']    = 'Mobile/Phone';
        $text['arrivo']['de']       = 'Ankunftsdatum';
        $text['partenza']['de']     = 'Abreisedatum';
        $text['adulti']['de']       = 'Anzahl der Erwachsenen';
        $text['bambini']['de']      = 'Anzahl der Kinder';
        $text['eta']['de']          = ' von Alter '; 




        $select          = "SELECT 
                                hospitality_dizionario_lingua.testo,
                                hospitality_dizionario_lingua.data_modifica 
                            FROM 
                                hospitality_dizionario
                            INNER JOIN 
                                hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                            WHERE 
                                hospitality_dizionario.etichetta = 'INFORMATIVA_PRIVACY'
                            AND 
                                hospitality_dizionario_lingua.Lingua = '".$lingua."' 
                            AND 
                                hospitality_dizionario_lingua.idsito = ".$idsito;

                        $con          = $dbMysqli->query($select);
                        $consenso     = $con[0];


                    $txt_consenso = $consenso['testo'];
                    $txt_consenso = str_replace('{!rag_soc!}','<b>'.$rw['rag_soc'].'</b>',$txt_consenso);
                    $txt_consenso = str_replace('{!indirizzo!}','<b>'.$rw['indirizzo'].'</b>',$txt_consenso);
                    $txt_consenso = str_replace('{!cap!}','<b>'.$rw['cap'].'</b>',$txt_consenso);
                    $txt_consenso = str_replace('{!citta!}','<b>'.$rw['nome_comune'].'</b>',$txt_consenso);
                    $txt_consenso = str_replace('{!provincia!}','<b>'.$rw['sigla_provincia'].'</b>',$txt_consenso);
                    $txt_consenso = str_replace('{!p_iva!}','<b>'.$rw['p_iva'].'</b>',$txt_consenso);  

                    $informativa = '<a href="javascript:;" data-toggle="modal" data-target="#modale_informativa">'.$text['info_attuale'][$lingua].'</a>';

                    $privacy     = '<div class="modal fade" id="modale_informativa"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header" style="border-bottom:0px!important">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                '.$txt_consenso.'
                            </div>
                            </div>
                        </div>
                        </div>';
                    /**
                    * data modifica privacy
                    */
                    $data_modifica_    = explode("-",$consenso['data_modifica']);
                    $data_modifica     = $data_modifica_[2].'-'.$data_modifica_[1].'-'.$data_modifica_[0];
                    /**
                    * switch per determinare la versione informativa privacy
                    */
                    switch($consenso['data_modifica']){
                        case  ($consenso['data_modifica'] == ''):
                        case  ($consenso['data_modifica'] == '0000-00-00'):
                        $versione_informativa = $text['generica'][$lingua].' '.$data_inizio_quoto;
                        break;
                        case  ($consenso['data_modifica'] >= date('Y-m-d',$r['data_invio'])):
                        $versione_informativa = $text['dedicata'][$lingua].' '.$data_modifica;
                        break;
                        case  ($consenso['data_modifica'] <= date('Y-m-d',$r['data_invio'])):
                        $versione_informativa = $text['dedicata'][$lingua].' '.$data_modifica;
                        break; 


                    }


        /**
         * INVIO DELL'EMAIL DOPO ESERCITATO I DIRITTI DEL CLIENTE, VERSO IL TITOLARE DEI DATI (HOTEL)
         */
        if($_REQUEST['action']=='send_email_hotel'){
            if($_REQUEST['email_destinatario']!='' && $_REQUEST['email_mittente']!='' && $_REQUEST['id_utente']!=''){

                $msg .= 'Gentile '.$_REQUEST['hotel']."\r\n";
                $msg .= 'L\'utente '.$_REQUEST['email_mittente'].' ha risposto all\'email sull\'Informativa ed esercizio dei diritti GDPR, dando le sue preferenze'."\r\n";
                $msg .= "\r\n";
                $msg .=  $_REQUEST['oggetto_notifica']."\r\n";
                $msg .= 'Identificativo notifica: '.$_REQUEST['id_utente']."\r\n";
                $msg .= 'Lista: '.$_REQUEST['nome_lista']."\r\n";
                $msg .= "\r\n";
            if($_REQUEST['delete']==0 && $_REQUEST['export']==0 && $_REQUEST['marketing']==$check_marketing){
                $msg .= 'L\'utente non ha effettuato nessuna scelta e non ha richiesto nessun cambiamento!'."\r\n";
            }else{
                $msg .= 'Richieste dell\'utente:'."\r\n";
                $msg .= ($_REQUEST['delete']==1? ' - Vorrebbe cancellare la sua iscrizione o richiesta archiviata':'')."\r\n";
                $msg .= ($_REQUEST['marketing']!=$check_marketing?' - Vorrebbe modificare il consenso per la profilazione marketing:'."\r\n".' - Consenso invio materiale marketing: '.($_REQUEST['marketing']==1?'SI':'NO')."\r\n":'');
                $msg .= ($_REQUEST['export']==1?' - Vorrebbe ottenere i suoi dati':'')."\r\n";
                $msg .= ($_REQUEST['note']!=''?' - Annotazione e/ modifiche:':'')."\r\n";
                $msg .= ($_REQUEST['note']!=''?    $_REQUEST['note']:'')."\r\n";                
            }
                $msg .= "\r\n";
                $msg .= 'Dalla vostra area dedicata in QUOTO "E-PAPER", avete max 30 giorni di tempo  per poter apportare le modifiche richieste dall\'utente!';
                $msg .= "\r\n";
                $msg .= "\r\n";
                $msg .= 'Questa e-mail e\' stata inviata da un utente presente nella vostra raccolta dati del software QUOTO - By Network Service s.r.l';                

                    $to      = $_REQUEST['email_destinatario'];
                    $subject = 'Modifiche consensi in E-PAPER di QUOTO per utente: '.$_REQUEST['email_destinatario'];
                    $message = $msg;
                    $headers = 'From: '.$_REQUEST['email_mittente'] . "\r\n" .
                        'Reply-To: '.$_REQUEST['email_mittente'] . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    mail($to, $subject, $message, $headers);
                    header('Location:'.BASE_URL_SITO.'consensi/newsletter_quoto.php?val='.$_REQUEST['val'].'&res=sent');
            }
        }
        


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?=$text['title'][$lingua]?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="<?=BASE_URL_SITO?>files/bower_components/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <script src="https://use.fontawesome.com/da6d3ea52f.js"></script>
        <!-- Ionicons -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?=BASE_URL_SITO?>files/bower_components/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>               
    </head>
    <body>
    <div class="container">
        <?if($_REQUEST['res']=='sent'){?>
            <div id="risposta">
            <p></p>
                <div class="alert alert-success alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                         <h3>Email con le tue preferenze inviata con successo!</h3>
                  </div>
            </div>
             <script type="text/javascript">
                $(document).ready(function(){
                    setTimeout(function(){
                      $("#risposta").fadeOut();
                    }, 5000);
                });
            </script>
        <?}?>
        <div class="row">
            <div class="col-md-12">
                <h2><?=$text['informativa'][$lingua]?></h2>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                       <tr>
                        <td class="col-md-6"><i class="fa fa-user"></i> <?=$text['soggetto'][$lingua]?></td>
                        <td class="col-md-6"><b><?=$r['Email']?></b> (<?=$lingua?>)</td>
                       </tr>
                       <tr>
                        <td class="col-md-6"><i class="fa fa-book"></i> <?=$text['titolare'][$lingua]?></td>
                        <td class="col-md-6">
                            <b><?=$rw['nome']?></b>
                            <div>
                                <small>
                                    <?=$rw['indirizzo']?> <?=$rw['nome_comune']?> <?=$rw['cap']?> (<?=$rw['sigla_provincia']?>)<br>
                                    <?=$rw['nome_regione']?><br>
                                    <a href="mailto:<?=$rw['email']?>"><?=$rw['email']?></a> - Tel. +39 <?=$rw['tel']?><br>
                                   <?=$informativa?> 
                                   <?=$privacy?>                                   
                                </small>
                            </div>
                        </td>
                       </tr>
                </table>
            </div>                    
            <div class="col-md-12">
                <h3><i class="fa fa-legal"></i> <?=$text['consensi'][$lingua]?></h3>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                       <tr>
                           <th class="col-md-2"><?=$text['data'][$lingua]?></th>
                            <th class="col-md-5">IP/Agent</th>
                            <th class="col-md-2"><?=$text['modulo'][$lingua]?></th>
                            <th class="col-md-2"><?=$text['versione'][$lingua]?></th> 
                            <th class="col-md-3"><?=$text['accettati'][$lingua]?></th>
                                
                        </tr>
                        
                         <tr>
                            <td style="white-space: nowrap;"><small><?=$Data?></small></td>
                                <td>
                                    <small><?=$Ip?></small><br>
                                    <small><?=$browser?></small>                                   
                                </td>
                                <td style="white-space: nowrap;">
                                   <small id="contenuto" style="cursor:pointer;" class="text-info"><?=$modulo_inviato?></small>                                    
                                </td>
                                <td style="white-space: nowrap;">
                                   <small><?=$versione_informativa?></small>  
                                </td>                                                               
                                <td style="white-space: nowrap;">
                                    <?=($flag_consenso!=''?'<small>'.$text['privacy'][$lingua].'</small>: '.$flag_consenso:'');?>
                                    <?=($flag_marketing!=''?'<br><small>'.$text['marketing'][$lingua].'</small>: '.$flag_marketing:'');?>
                                    <?=($flag_profilazione!=''?'<br><small>'.$text['profilazione'][$lingua].'</small>: '.$flag_profilazione:'');?>
                                </td>                                                          
                            </tr>                                                
                </table>
            </div>
            <div class="row" id="view_contenuto" style="display:none">
                <div style="clear:both;height:50px"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h3><?=$text['dati'][$lingua]?></h3>
                        <table class="table table-striped">
                           <tr>
                               <th class="col-md-2"><?=$text['nome'][$lingua]?></th>  
                               <th class="col-md-2"><?=$text['cognome'][$lingua]?></th>                              
                            </tr>
                            <tr>
                                <td style="white-space: nowrap;"><small><?=($r['nome']!=''?$r['nome']:'')?></small></td>  
                                 <td style="white-space: nowrap;"><small><?=($r['cognome']!=''?$r['cognome']:'')?></small></td>                                                       
                            </tr>
                           <tr>
                               <th class="col-md-2">Email</th> 
                               <th class="col-md-2">Lingua</th>                                
                            </tr>
                            <tr>
                                <td style="white-space: nowrap;"><small><?=($r['email']!=''?$r['email']:'')?></small></td> 
                                <td style="white-space: nowrap;"><small><?=($r['lingua']!=''?$r['lingua']:'')?></small></td>                                                         
                            </tr> 
                            <tr>
                               <th class="col-md-2">Mailing List</th> 
                               <th class="col-md-2"></th>                                
                            </tr>
                            <tr>
                                <td style="white-space: nowrap;"><small><?=($r['nome_lista']!=''?$r['nome_lista']:'')?></small></td> 
                                <td style="white-space: nowrap;"></td>                                                         
                            </tr>                                                                                       
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                <div style="clear:both;height:50px"></div>
            </div>            
            <div class="col-md-12">                
                <h3><i class="fa fa-list-alt"></i> <?=$text['esercita'][$lingua]?></h3>
            </div>
            <div class="col-md-12">
                <form action="<?=BASE_URL_SITO.'consensi/newsletter_quoto.php?val='.$_REQUEST['val']?>" id="change_diritti" method="POST"> 
                    <table class="table">
                           <tr>
                               <td>                                                    
                                   <div class="checkbox">
                                      <label>
                                        <input type="checkbox" name="delete" value="1">
                                            <?=$text['cancellate'][$lingua]?>
                                      </label>
                                    </div>
                                    
                                    <p><?=$text['profilato'][$lingua]?></p>
                                    <div class="form-group">
                                      <label><?=$text['marketing'][$lingua]?></label>&nbsp;&nbsp;&nbsp; 
                                        <input type="radio" name="marketing" <?=($check_marketing==1?'checked="checked"':'')?>  value="1" > SI
                                        &nbsp;&nbsp;
                                        <input type="radio" name="marketing" <?=($check_marketing==0?'checked="checked"':'')?>  value="0" > NO                                                 
                                    </div> 
                                    <hr>                 
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" name="export" value="1">
                                            <?=$text['export'][$lingua]?>
                                      </label>
                                    </div>
                                    <div class="form-group">
                                          <label>
                                           <?=$text['note'][$lingua]?> 
                                          </label>
                                          <textarea class="form-control" name="note" rows="3"></textarea>
                                    </div>                                    
                                    <input type="hidden" name="action" value="send_email_hotel">
                                    <input type="hidden" name="email_destinatario" value="<?=$emailhotel?>">
                                    <input type="hidden" name="hotel" value="<?=$rw['nome']?>">
                                    <input type="hidden" name="email_mittente" value="<?=$r['email']?>">
                                    <input type="hidden" name="id_utente" value="<?=$id_utente?>">
                                    <input type="hidden" name="oggetto_notifica" value="<?=$modulo_inviato?>">
                                    <input type="hidden" name="sitoweb" value="<?=$sitoweb?>">     
                                    <input type="hidden" name="nome_lista" value="<?=$nome_lista?>">          
                                  <button type="submit" class="btn btn-default"><?=$text['pulsante'][$lingua]?></button>
                            </td>
                        </tr>
                    </table> 
               </form> 
               <div class="row">
                   <div class="col-md-12 text-center">
                       <?=$text['tempo'][$lingua]?>
                   </div>
               </div> 
               <div class="clear" style="height:10px"></div>            
            </div>            
        </div>  
    </div>
    <script>
        $(document).ready(function() {    
            $('#contenuto').click(function() {
                $('#view_contenuto').toggle();
            });        
        });        
    </script>
</body>
</html>
