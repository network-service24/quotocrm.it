<?php $permessi = check_permessi();?>
<?php if(CHECKINONLINE==1){?>
    <?include_module('sidebar_checkin.inc.php');?> 
<?}else{?>
 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-profile" style="background: url(<?=BASE_URL_SITO?>material/assets/images/background/reception.jpg) no-repeat;width:230px;height:166px;">
                <!-- User profile image -->
                <div class="profile-img" id="profile-img">
                  <img src="<?=BASE_URL_SITO?>dist/img/<?=ICONAUTENTE?>" class="img-circle half-image pulsing ombra-sfocata" alt="User Image" data-toogle="tooltip" title="<?=ucwords(NOMEUTENTEACCESSI)?>">
                  </div>
                <!-- User profile text-->
                <div class="profile-text  info">
                  <a href="#"><span id="user-name"><?=(NOMEUTENTEACCESSI!=''?ucwords(NOMEUTENTEACCESSI):ucfirst((strlen(NOMEUTENTE)>2?NOMEUTENTE:USER)))?></span><span class="float-right" id="online"><small><i class="fa fa-circle text-ottanio"></i> Online</small></span></a>
                </div>
            </div>
            <div class="clearfix"></div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
          <?php echo menu_pannelli(IDSITO);?>
          <? if(isset($_SESSION['user_admin'])){ ?>
            <style>
                .btn-mini {
                    padding: 5px 10px;
                    line-height: 14px;
                    font-size: 10px;
                }
            </style>
            <li>
              <div align="center">
                  <form id="fr" name="fr" action="<?=BASE_URL_ROOT?>jlogout.php" method="post">
                        <input type="hidden" name="username" value="<?=$_SESSION['super_user']?>" />
                        <input type="hidden" name="password" value="<?=$_SESSION['super_pass']?>"/>
                        <button type="submit" class="btn btn-mini btn-default">
                            <img src="<?=BASE_URL_ROOT?>img/q.png" style="width:20px"> Torna a <?=NOME_AMMINISTRAZIONE?> Manager
                        </button>
                  </form>
                </div>
            </li>
          <?}?>
            <li class="header">
                <b>CONFIGURAZIONI</b>
            </li>
            <? if(IS_NETWORK_SERVICE_USER == 1){ ?>

                  <? $check=check_setup();

                      if($check== 0){?>
                    <!--<li>
                      <div align="center">
                        <form id="setup" name="setup" method="post" action="<?=BASE_URL_SITO?>syncro/">
                            <input name="action" id="action" type="hidden" value="syncro_auto_config"/>
                            <button type="submit" class="btn btn-danger" ><i class="fa fa-refresh"></i> Lancia Auto configuratore</button>
                        </form>
                      </div>
                    </li>-->
                <?}?>
            <?}else{ ?>
                <? $check=check_setup();?>
                   <? if($check== 0){?>
                    <? if(CHECKINONLINE == 1){ ?>
                       <!-- <li>
                        <div align="center">
                            <form id="setup" name="setup" method="post" action="<?=BASE_URL_SITO?>syncro/">
                                <input name="action" id="action" type="hidden" value="syncro_auto_config"/>
                                <button type="submit" class="btn btn-danger" ><i class="fa fa-refresh"></i> Lancia Auto configuratore</button>
                            </form>                          
                                <script language="JavaScript">
                                        document.setup.submit();
                                </script>                         
                            </div>
                        </li>-->
                    <?}?>
                <?}?>
            <?}?>
            <?php
              if($GLOBALS['ActiveMenu']['accessi'] == 'active'||
                  $GLOBALS['ActiveMenu']['configurazioni'] == 'active'||
                  $GLOBALS['ActiveMenu']['setting'] == 'active'||
                  $GLOBALS['ActiveMenu']['disponibilita'] == 'active' ||
                  $GLOBALS['ActiveMenu']['generiche'] == 'active' ||
                  $GLOBALS['ActiveMenu']['templates'] == 'active' ||
                  $GLOBALS['ActiveMenu']['cs'] == 'active' ||
                  $GLOBALS['ActiveMenu']['autoresponder'] == 'active'){
                $attivo = 'active';
              }
            ?>
     
            <li class="treeview <?=$attivo?>">
                    <a href="#">
                       <i class="fa fa-wrench"></i>
                        <span>Configurazioni</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <? if(IS_NETWORK_SERVICE_USER == 1){ ?>
                         <li class="treeview <?=$GLOBALS['ActiveMenu']['setting']?>">
                                  <a href="#">
                                     <small class="label bg-purple"><img src="<?=BASE_URL_SITO?>img/w_new.png" style="width:16px;heigth:16px"></small>
                                      <span>Setting Network Service</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-simplebooking/"><i class="fa fa-bell"></i> <span>SimpleBooking</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-ericsoftbooking/"><i class="fa fa-bell"></i> <span>EricSoft Booking/PMS</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-bedzzlebooking/"><i class="fa fa-bell"></i> <span>Bedzzle Booking/PMS</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-tagmanager/"><i class="fa fa-pie-chart"></i> <span>Setting TagManager</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-dizionario/"><i class="fa fa-font"></i> <span>Dizionario del Software</span></a>
                                    </li> 
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                            <a href="<?=BASE_URL_SITO?>setting-dizionario_form/"><i class="fa fa-font"></i> <span>Dizionario del Form</span></a>
                                    </li>                                 
                                    <!--<li class="treeview <?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="#">
                                        <i class="fa fa-html5"></i>
                                            <span>Gestione Form</span>
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                                <a href="<?=BASE_URL_SITO?>setting-dizionario_form/"><i class="fa fa-font"></i> <span>Dizionario del Form</span></a>
                                            </li>
                                            <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                                <a href="<?=BASE_URL_SITO?>setting-lingue/"><i class="fa fa-flag"></i> <span>Gestione Lingue Form</span></a>
                                            </li>
                                            <?if(check_form_exists(IDSITO)==0){?>
                                                <?if(check_lang_form_exists(IDSITO)==0){?>
                                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                                        <a href="javascript:alert('Prima di creare il form inserire le lingue!')"  class="no_permessi"><i class="fa fa-html5 text-gray"></i> <span>Crea Form </span></a>
                                                    </li>
                                                <?}else{?>
                                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                                        <a href="<?=BASE_URL_SITO?>setting-form/crea_form"><i class="fa fa-html5 text-green"></i> <span>Crea Form </span></a>
                                                    </li>
                                                <?}?>
                                            <?}else{?>
                                                <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                                    <a href="javascript:;" onclick="validator('<?=BASE_URL_SITO?>setting-form/delete_form/<?=getIdForm(IDSITO)?>');"><i class="fa fa-html5 text-red"></i> <span>Elimina Form</span></a>
                                                </li>
                                            <?}?>
                                            <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                                <a href="<?=BASE_URL_SITO?>setting-form/"><i class="fa fa-html5"></i>  <span>Form <small>Sito Web/Landing</small></span></a>
                                            </li>
                                        </ul>
                                    </li>-->
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-smtp/"><i class="fa fa-envelope"></i> <span>Setting SMTP</span></a>
                                    </li> 
                                   
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-imap/"><i class="fa fa-cloud-download"></i> <span>Setting IMAP</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-pms/"><i class="fa fa-refresh"></i> <span>Setting PMS 5Stelle</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-parityrate/"><img src="<?=BASE_URL_SITO?>img/ParityRate.png" width="16px" /> <span>Setting ParityRate</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-breadcrumb/"><i class="fa fa-list-ol"></i> <span>Setting Paginazione</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-configurazioni/"><i class="fa fa-plug"></i> <span>Configuratore <small>plugin software</small></span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-panel_ext/"><i class="fa fa-sign-in"></i> <span>Pannelli  Esterni</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-delete_cliente/"><i class="fa fa-times"></i> <span>Elimina questo Cliente</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" onclick="if(window.confirm('ATTENZIONE: Sicuro di voler aprire la gestione dei CRON?')){window.open('<?=BASE_URL_SITO?>cron/Clogout.php');}"><i class="fa fa-power-off"></i> <span>Gestione CRON</span></a>
                                    </li>
                              </ul>
                          </li>
                        <?}?>
                      <?if($permessi['UTENTI']==1){?>
<!--                          <li class="treeview <?=$GLOBALS['ActiveMenu']['accessi']?>">
                                  <a href="#">
                                     <small class="label bg-maroon">0°</small>
                                      <span>Config.Accessi</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                  <li class="<?=$GLOBALS['ActiveMenu']['accessi']?>">
                                        <a href="<?=BASE_URL_SITO?>accessi-operatori/"><i class="fa  fa-users"></i>  <span>Operatori</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['accessi']?>">
                                        <a href="<?=BASE_URL_SITO?>accessi-utenti/"><i class="fa  fa-check"></i>  <span>Gestione Permessi</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                         <a href="<?=BASE_URL_SITO?>accessi-logs/"><i class="fa fa-history"></i>  <span>Logs per operatore <small class="text-red pull-right">new</small></span></a>
                                    </li>
                              </ul>
                          </li> -->
                    <?}?>
                    <?if($permessi['CONFIG1']==1){?>
                         <li class="treeview <?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                  <a href="#">
                                     <small class="label bg-red">1°</small>
                                      <span>Config.Impostazioni</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                        <a href="<?=BASE_URL_SITO?>configurazioni-anagrafica_cliente/<?=IDSITO?>/"><i class="fa  fa-user"></i> <span>Completa Anagrafica</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                        <a href="<?=BASE_URL_SITO?>configurazioni-pagamenti/"><i class="fa  fa-euro"></i>  <span>Tipi di Pagamento</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                        <a href="<?=BASE_URL_SITO?>configurazioni-fonti_prenotazione/"><i class="fa fa-newspaper-o"></i> <span>Fonti Prenotazione</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                         <a href="<?=BASE_URL_SITO?>configurazioni-target/"><i class="fa fa-user-secret"></i>  <span>Target Clienti</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                         <a href="<?=BASE_URL_SITO?>configurazioni-configurazioni_client/"><i class="fa fa-plug"></i>  <span>Configuratore Plugin</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                         <a href="<?=BASE_URL_SITO?>configurazioni-policy/"><i class="fa fa-gavel"></i>  <span>Condizioni Generali</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                         <a href="<?=BASE_URL_SITO?>configurazioni-privacy_policy/"><i class="fa fa-lock"></i>  <span>Privacy Policy</span></a>
                                    </li>
                              </ul>
                          </li>
                      <?}?>
                      <?if($permessi['CONFIG2']==1){?>
                         <li class="treeview <?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                  <a href="#">
                                      <small class="label bg-yellow">2°</small>
                                      <span>Config.Disponibilità</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="<?=BASE_URL_SITO?>disponibilita-motivazioni/"><i class="fa fa-tag"></i>  <span>TAG Motivazioni<br><small style="padding-left:calc(14% - 0px);"><small>utili all'invio buoni voucher</small></small></span></a>
                                    </li>
                                
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                         <a href="<?=BASE_URL_SITO?>disponibilita-tariffe/"><i class="fa fa-handshake-o"></i>  <span>Condizioni <small>e politiche Tariffarie</small></span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="<?=BASE_URL_SITO?>disponibilita-pacchetti/"><i class="fa  fa-gift"></i>  <span>Proposte/Pacchetti</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="<?=BASE_URL_SITO?>disponibilita-soggiorni/"><i class="fa  fa-suitcase"></i>  <span>Tipo Soggiorni</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="<?=BASE_URL_SITO?>disponibilita-servizi_aggiuntivi/"><i class="fa  fa-coffee"></i> <span>Servizi Aggiuntivi</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="<?=BASE_URL_SITO?>disponibilita-tipo_listino/"><i class="fa fa-euro"></i>  <span>Gestione Listini</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="<?=BASE_URL_SITO?>disponibilita-servizi_camera/"><i class="fa fa-support"></i> <span>Servizi in Camera</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="<?=BASE_URL_SITO?>disponibilita-camere/"><i class="fa fa-bed"></i>  <span>Camere</span></a>
                                    </li>
                              </ul>
                          </li>
                        <?}?>
                      <?if($permessi['CONFIG3']==1){?>
                         <li class="treeview <?=$GLOBALS['ActiveMenu']['generiche']?>">
                                  <a href="#">
                                      <small class="label bg-green">3°</small>
                                      <span>Config.Generiche</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="<?=BASE_URL_SITO?>generiche-gallery/"><i class="fa fa-picture-o"></i>  <span>Gallery Templates</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="<?=BASE_URL_SITO?>generiche-infohotel/"><i class="fa fa-info-circle"></i>  <span>InfoHotel Templates</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="<?=BASE_URL_SITO?>generiche-banner_info/"><i class="fa fa-exclamation-triangle"></i>  <span>Banner Info Templates</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="<?=BASE_URL_SITO?>generiche-eventi/"><i class="fa fa-calendar-o"></i>  <span>Eventi Templates</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="<?=BASE_URL_SITO?>generiche-punti_interesse/"><i class="fa fa-map"></i>  <span>Punti di Interesse <small>Templates</small></span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="<?=BASE_URL_SITO?>generiche-sconti/"><i class="fa fa-percent"></i>  <span>Generatore <small>Codici Sconto</small><small class="text-red pull-right">new</small></span></a>
                                    </li>
                              </ul>
                          </li>
                          <?}?>
                      <?if($permessi['CONFIG4']==1){?>
                          <li class="treeview <?=$GLOBALS['ActiveMenu']['cs']?>">
                                  <a href="#">
                                      <small class="label bg-teal">4°</small>
                                      <span>Config.Questionario</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                     <li class="<?=$GLOBALS['ActiveMenu']['cs']?>">
                                         <a href="<?=BASE_URL_SITO?>cs-configura_cs/"><i class="fa fa-send"></i>  <span>Conf. Invio questionario</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['cs']?>">
                                         <a href="<?=BASE_URL_SITO?>cs-domande/"><i class="fa fa-question"></i>  <span>Domande questionario</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['cs']?>">
                                        <a href="<?=BASE_URL_SITO?>cs-configura_recensioni_punteggio/"><i class="fa fa-star-half-o"></i>  <span>Invio Recensioni automatico <br><small style="padding-left:calc(14% - 0px);">per punteggio</small><small class="text-red pull-right">new</small></span></a>
                                    </li>
                              </ul>
                          </li>
                       <?}?>
                      <?if($permessi['CONFIG5']==1){?>
                         <li class="treeview <?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                  <a href="#">
                                      <small class="label bg-fuchsia">5°</small>
                                      <span>Config.Autoresponder</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                     <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                         <a href="<?=BASE_URL_SITO?>autoresponder-configura_recall/"><i class="fa fa-repeat"></i>  <span>ReCall Email Preventivi</span></a>
                                    </li>
                                     <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                         <a href="<?=BASE_URL_SITO?>autoresponder-configura_resend/"><i class="fa fa-envelope-o"></i>  <span>ReCall Email Caparra</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                         <a href="<?=BASE_URL_SITO?>autoresponder-configura_precheckin/"><i class="fa fa-info"></i>  <span>Email Info Utili</span></a>
                                    </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                         <a href="<?=BASE_URL_SITO?>autoresponder-configura_reselling/"><i class="fa fa-send-o"></i>  <span>Email di Benvenuto</span></a>
                                    </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                         <a href="<?=BASE_URL_SITO?>autoresponder-configura_checkin/"><i class="fa fa-vcard-o"></i>  <span>Modulo Check-in<small></small></span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                        <a href="<?=BASE_URL_SITO?>autoresponder-configura_recensioni/"><i class="fa fa-tripadvisor"></i>  <span>Richiesta recensioni Email <small></small></span></a>
                                    </li>
                              </ul>
                          </li>
                      <?}?>
                          <?if($permessi['CONFIG6']==1){?>
                            <li class="treeview <?=$GLOBALS['ActiveMenu']['templates']?>">
                                  <a href="#">
                                      <small class="label bg-blue">6°</small>
                                      <span>Contenuti & Template</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="<?=BASE_URL_SITO?>templates-contenuti_email/"><i class="fa fa-pencil"></i> <span>Contenuti E-mail</span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="<?=BASE_URL_SITO?>templates-contenuti_web/"><i class="fa fa-paint-brush"></i> <span>Contenuti Templates</span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="<?=BASE_URL_SITO?>templates-mappa_landing/"><i class="fa fa-map-marker"></i> <span>Abilita/Disabilita <small>GoogleMap</small></span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                        <a href="<?=BASE_URL_SITO?>templates-grafiche/"><i class="fa fa-laptop"></i> <span>Scegli e Configura <small>template</small></span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="<?=BASE_URL_SITO?>templates-anteprima_email/"><i class="fa  fa-envelope"></i> <span>Anteprima E-mail</span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <form class="link-menu" name="temp_default" method="post" action="<?=BASE_URL_SITO?>templates-anteprima_web/">
                                            <input type="hidden" name="temp" value="default" />
                                            <a href="javascript:;" onclick="temp_default.submit();"><i class="fa  fa-windows"></i> <span>&nbsp;&nbsp;Anteprima <small>Template <span style="color:#f00!important">Default</span></small></span></a>
                                          </form>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="<?=BASE_URL_SITO?>templates-anteprima_web_smart/"><i class="fa  fa-windows"></i> <span>Anteprima <small>Template <span style="color:#3c3!important">Smart</span></small></span></a>
                                      </li>
                                      <?=get_listmenu_template(IDSITO)?>
                              </ul>
                          </li>
                       <?}?>
                </ul>
            </li>
             
    <?
    $check=check_setup();

      if($check > 0){
    ?>

           <li class="header">
                <b>CRUSCOTTO <?=strtoupper(NOME_AMMINISTRAZIONE)?></b>
             </li>
            <li class="<?=$GLOBALS['ActiveMenu']['dashboard']?>">
                <a href="<?=BASE_URL_SITO?>dashboard-index/">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <?if($permessi['STAT']==1){?>
            <li class="header">
                <b>STATISTICHE <?=strtoupper(NOME_AMMINISTRAZIONE)?></b>
             </li>
            <li class="treeview <?=$GLOBALS['ActiveMenu']['grafici']?>">
                    <a href="#">
                       <i class="fa fa-bar-chart"></i>
                        <span>Statistiche</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                    <? if(IDSITO == 2265 || IS_NETWORK_SERVICE_USER == 1){ ?>
                        <!--
                            <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                <a href="<?=BASE_URL_SITO?>grafici-statistiche_new/">
                                    <i class="fa fa-line-chart"></i> <span>Statistiche & Ads <small style="font-size:80%" class="pull-right">v.Alpha</small></span>
                                </a>
                            </li> 
                        -->
                    <?}?>

                    <? if(IDSITO == 2265 || IDSITO == 2277 || IS_NETWORK_SERVICE_USER == 1){ ?>
                            <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                <a href="<?php echo (check_fatturato_telefono(IDSITO) ==1 ? BASE_URL_SITO.'grafici-fatturato_telefono/' : 'javascript:;')?>" <?php echo (check_fatturato_telefono(IDSITO) ==0 ? 'onclick="_alert(\'Helpdesk\',\'Il cliente non ha dati da visualizzare\');" class="no_permessi"' : '')?> >
                                    <i class="fa fa-line-chart"></i> <span>Fatturato Telefono</span>
                                </a>
                            </li>
                    <?}?>

                            <li class="treeview <?=$GLOBALS['ActiveMenu']['grafici']?>">
                                <a href="#">
                                <i class="fa fa-line-chart"></i>
                                    <span>Statistiche & Ads &nbsp;&nbsp;<small style="font-size:80%;padding-left:10px">UTM</small></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
        
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="<?=BASE_URL_SITO?>grafici-statistiche_utm/">
                                                <i class="fa fa-pie-chart"></i> <span>Analisi Fatturato <small class="text-orange">(UTM)</small></span>
                                            </a>
                                        </li>                                   
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="<?=BASE_URL_SITO?>grafici-facebook_ads_utm/">
                                                <i class="fa fa-facebook"></i> <span>Facebook Ads <small class="text-orange">(UTM)</small></span>
                                            </a>
                                        </li>
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="<?=BASE_URL_SITO?>grafici-ppc_ads_utm/">
                                                <i class="fa fa-google"></i> <span>Google Ads <small class="text-orange">(UTM)</small></span>
                                            </a>
                                        </li>
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="<?=BASE_URL_SITO?>grafici-newsletter_ads_utm/">
                                                <i class="fa fa-envelope-o"></i> <span>Newletter Ads <small class="text-orange">(UTM)</small></span>
                                            </a>
                                        </li>
                                </ul>
                            </li>
                       <li class="treeview <?=$GLOBALS['ActiveMenu']['grafici']?>">
                                <a href="#">
                                <i class="fa fa-line-chart"></i>
                                    <span>Statistiche & Ads &nbsp;&nbsp;<small style="font-size:80%;padding-left:10px">GA4</small></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                        <a href="<?=BASE_URL_SITO?>grafici-statistiche_GA4/">
                                            <i class="fa fa-pie-chart"></i> <span>Analisi Fatturato <small class="text-orange">(GA4)</small></span>
                                        </a>
                                    </li>
                                    <?if(check_propertyId()==true){?>
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="<?=BASE_URL_SITO?>grafici-facebook_ads_GA4/">
                                                <i class="fa fa-facebook"></i> <span>Facebook Ads <small class="text-orange">(GA4)</small></span>
                                            </a>
                                        </li>
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="<?=BASE_URL_SITO?>grafici-ppc_ads_GA4/">
                                                <i class="fa fa-google"></i> <span>Google Ads <small class="text-orange">(GA4)</small></span>
                                            </a>
                                        </li>
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="<?=BASE_URL_SITO?>grafici-newsletter_ads_GA4/">
                                                <i class="fa fa-envelope-o"></i> <span>Newletter Ads <small class="text-orange">(GA4)</small></span>
                                            </a>
                                        </li>
                                    <?}else{?>
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads GA4, Google Ads GA4 e Newsletter Ads GA4 non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in QUOTO tramite Analytics GA4\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                <i class="fa fa-facebook"></i> <span>Facebook Ads <small class="text-orange">(GA4)</small></span>
                                            </a>
                                        </li>
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads GA4, Google Ads GA4 e Newsletter Ads GA4 non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in QUOTO tramite Analytics GA4\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                <i class="fa fa-google"></i> <span>Google Ads <small class="text-orange">(GA4)</small></span>
                                            </a>
                                        </li>
                                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                            <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads GA4, Google Ads GA4 e Newsletter Ads GA4 non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in QUOTO tramite Analytics GA4\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                <i class="fa fa-envelope-o"></i> <span>Newletter Ads <small class="text-orange">(GA4)</small></span>
                                            </a>
                                        </li>

                                    <?}?>
                                </ul>
                            </li>

                        <? if(IS_NETWORK_SERVICE_USER == 1){ ?>
<!--                             <small class="text-green" style="padding-left:20px">UNIVERSAL visibile solo Op. Network</small>
                            <li class="treeview <?=$GLOBALS['ActiveMenu']['grafici']?>">
                                <a href="#">
                                <i class="fa fa-line-chart"></i>
                                    <span>Statistiche & Ads &nbsp;&nbsp;<small style="font-size:60%;padding-left:10px">UNIVERSAL</small></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                            <ul class="treeview-menu">
                                <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                    <a href="<?=BASE_URL_SITO?>grafici-statistiche3/">
                                        <i class="fa fa-pie-chart"></i> <span>Fatturato  & Grafici</span>
                                    </a>
                                </li>
                                <?if(check_vista()==true){?>
                                    <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                        <a href="<?=BASE_URL_SITO?>grafici-facebook_ads_new/">
                                            <i class="fa fa-facebook"></i> <span>Facebook Ads <small class="text-orange">(Analytics)</small></span>
                                        </a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                        <a href="<?=BASE_URL_SITO?>grafici-ppc_ads_new/">
                                            <i class="fa fa-google"></i> <span>Google Ads <small class="text-orange">(Analytics)</small></span>
                                        </a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                        <a href="<?=BASE_URL_SITO?>grafici-newsletter_ads_new/">
                                            <i class="fa fa-envelope-o"></i> <span>Newletter Ads <small class="text-orange">(Analytics)</small></span>
                                        </a>
                                    </li>
                                <?}else{?>
                                    <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                        <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads, Google Ads e Newsletter Ads non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in QUOTO\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                            <i class="fa fa-facebook"></i> <span>Facebook Ads <small class="text-orange">(Analytics)</small></span>
                                        </a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                        <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads, Google Ads e Newsletter Ads non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in QUOTO\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                            <i class="fa fa-google"></i> <span>Google Ads <small class="text-orange">(Analytics)</small></span>
                                        </a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                        <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads, Google Ads e Newsletter Ads non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in QUOTO\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                            <i class="fa fa-envelope-o"></i> <span>Newletter Ads <small class="text-orange">(Analytics)</small></span>
                                        </a>
                                    </li>
                                <?}?>
                            </ul>
                        </li> -->
                    <?}?>
                    <? if(IS_NETWORK_SERVICE_USER == 1){ ?>
<!--                         <small class="text-green" style="padding-left:20px">v.1.2 visibile solo Operatore Network</small>
                        <li class="treeview <?=$GLOBALS['ActiveMenu']['grafici']?>">
                            <a href="#">
                                <i class="fa fa-line-chart"></i>
                                    <span>Statistiche Ads &nbsp;&nbsp;<small style="font-size:80%;padding-left:10px">v.1.2</small></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                    <a href="<?=BASE_URL_SITO?>grafici-facebook_ads_nws/">
                                        <i class="fa fa-facebook"></i> <span>FaceBook Ads <small><small class="text-green">(Tradizionale)</small></small></span>
                                    </a>
                                </li>
                                <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                                    <a href="<?=BASE_URL_SITO?>grafici-ppc_ads_nws/">
                                        <i class="fa fa-google"></i> <span>Google Ads <small><small class="text-green">(Tradizionale)</small></small></span>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                    <?}?>
                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                            <a href="<?=BASE_URL_SITO?>grafici-statistiche_voucher/">
                                <i class="fa fa-bar-chart"></i> <span>Buoni Voucher<br><small style="padding-left:calc(14% - 0px);">lista variazione soggiorni</small></span>
                            </a>
                        </li>     
                      <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                          <a href="<?=BASE_URL_SITO?>grafici-anagrafiche_clienti/">
                              <i class="fa fa-area-chart"></i> <span>Dati statistici per Cliente</span>
                          </a>
                      </li>

                    </ul>
              </li> 
              <?}?>
 

            <li class="header">
                  <strong>USO DI <?=strtoupper(NOME_AMMINISTRAZIONE)?> GIORNALIERO</strong>
             </li>
          <?if($permessi['PROP']==1){?>
            <li class="<?=$GLOBALS['ActiveMenu']['modulo_hospitality']?>">
                 <a href="<?=BASE_URL_SITO?>modulo_hospitality/"><i class="fa fa-edit"></i> <span>Crea Proposta Soggiorno</span> </a>
             </li>
          <?}?>
          <?if($permessi['PREV']==1){?>
            <li class="<?=$GLOBALS['ActiveMenu']['preventivi']?>">
                 <a href="<?=BASE_URL_SITO?>preventivi/"><i class="fa fa fa-table"></i>  <span>Preventivi</span>
                    <?=n_preventivi_send()?>
                 </a>
             </li>
          <?}?>
          <?if($permessi['CONF']==1){?>
               <li class="<?=$GLOBALS['ActiveMenu']['conferme']?>">
                 <a href="<?=BASE_URL_SITO?>conferme/"><i class="fa fa-credit-card"></i>  <span>Conferme in trattativa</span>
                  <?=n_conferme_send()?>
                 </a>
             </li>
          <?}?>
          <?if($permessi['PRENO']==1){?>
               <li class="<?=$GLOBALS['ActiveMenu']['prenotazioni']?>">
                 <a href="<?=BASE_URL_SITO?>prenotazioni/"><i class="fa  fa-h-square"></i>  <span>Prenotazioni confermate</span>
                 </a>
              </li>             
           <?}?>
           <?if($permessi['CONF']==1){?>

            <li class="<?=$GLOBALS['ActiveMenu']['conferme_annullate']?>">
                    <a href="<?=BASE_URL_SITO?>conferme_annullate/"><i class="fa fa-minus-circle"></i>  <span>Preventivi/Conferme<br/><small style="padding-left:calc(14% - 0px);">Annullate!</small></span>
                    <?=n_annullate()?>
                    </a>
                </li>

            <?}?>
           <?if($permessi['SCHED']==1){?>
                <li class="treeview <?=$GLOBALS['ActiveMenu']['checkinonline']?>">
                    <a href="#">
                    <i class="fa fa-vcard"></i>
                        <span>Check-in OnLine &nbsp;&nbsp;&nbsp;<?=n_checkin()?></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                <ul class="treeview-menu">
                    <li class="<?=$GLOBALS['ActiveMenu']['checkinonline']?>">
                        <a href="<?=BASE_URL_SITO?>checkinonline-add_checkin_online/"><i class="fa fa-plus" aria-hidden="true"></i> <span>Aggiungi Pren. Esterne</span>
                        </a>
                    </li>
                    <li class="<?=$GLOBALS['ActiveMenu']['checkinonline']?>">
                        <a href="<?=BASE_URL_SITO?>checkinonline-prenotazioni_esterne/"><i class="fa  fa-h-square"></i>  <span>Invia Check-in Pren. Esterne</span>
                        </a>
                    </li>
                    <li class="<?=$GLOBALS['ActiveMenu']['checkinonline']?>">
                        <a href="<?=BASE_URL_SITO?>checkinonline-schedine_alloggiati/"><i class="fa fa-vcard-o" aria-hidden="true"></i> <span>P.S. Schedine Alloggiati</span>
                            <?=n_checkin()?>
                        </a>
                    </li>
                    <li class="<?=$GLOBALS['ActiveMenu']['checkinonline']?>">
                        <a href="<?=BASE_URL_SITO?>checkinonline-box_info/"><i class="fa fa-info-circle"></i>  <span>Gestione Box Info Checkin</span>
                        </a>
                    </li>
                </ul>
             </li>
          <?}?>
          <?if($permessi['PRENO']==1){?>
                <li class="<?=$GLOBALS['ActiveMenu']['buoni_voucher']?>">
                    <a href="<?=BASE_URL_SITO?>buoni_voucher/"><i class="fa fa fa-tag"></i>  <span> Buoni Voucher</span>
                    </a>
                </li>              
           <?}?>
          <?if($permessi['PROF']==1){?>
             <li class="<?=$GLOBALS['ActiveMenu']['profila']?>">
                 <a href="<?=BASE_URL_SITO?>profila/"><i class="fa fa-search"></i>  <span>Profila ed Esporta</span>
                  </a>
            </li>
            <li class="<?=$GLOBALS['ActiveMenu']['epaper'] ?>">
                <a href="<?=BASE_URL_SITO?>newsletter/<?=URL_CLIENT_EMAIL?>-index/"><img src="<?=BASE_URL_SITO?>img/emessenger.png" class="ico_emessenger">  <span><?=NOME_CLIENT_EMAIL?></span>
                  </a>
            </li>
          <?}?>
          <?if($permessi['GIUD']==1){?>
             <li class="<?=$GLOBALS['ActiveMenu']['giudizio_finale']?>">
                 <a href="<?=BASE_URL_SITO?>giudizio_finale/"><i class="fa fa-line-chart"></i>  <span>Giudizi Finali</span>
                  <?=n_notifiche_cs()?>
                  </a>
            </li>
          <?}?>
          <?if($permessi['ARCH']==1){?>
                <li class="<?=$GLOBALS['ActiveMenu']['archivio_preventivi']?>">
                  <a href="<?=BASE_URL_SITO?>archivio/"><i class="fa fa-archive"></i> <span>Archivio</span> 
                  <?=n_archivio()?>
                  </a>
             </li>
              <li class="<?=$GLOBALS['ActiveMenu']['cestino']?>">
                  <a href="<?=BASE_URL_SITO?>cestino/"><i class="fa fa-trash"></i> <span>Cestino</span>
                  <?=n_cestino()?>
                  </a>
             </li>
           <?}?>
           <?php if(ANNO_ATTIVAZIONE != date('Y')){?>
            <?php 
                    $annoPassato = (date('Y')-1);
                    $numP        = check_non_archiviate(IDSITO,$annoPassato);
                    if($numP > 0){?>
                         <li class="header">
                            <strong>RISORSE QUOTO</strong>
                        </li>
                        <li>
                            <a onClick="if(window.confirm('Sicuro di voler archiviare <?=$numP?> preventivi/prenotazioni delll\'anno <?=$annoPassato?>?')){ location.replace('<?=BASE_URL_SITO?>archivia_anno/&action=archiviaAnno&idsito=<?=IDSITO?>&anno=<?=$annoPassato?>&nP=<?=$numP?>');}" href="javascript:;"><i class="fa fa-database"></i> <span>Archivia tutto il <?=$annoPassato;?></span></a>
                        </li> 
                    <?}?> 
            <?}?> 
          <?if($permessi['SCREEN']==1){?>
            <li class="header">
                  <strong>SCREENSHOTS</strong>
            </li>
            <li class="<?=$GLOBALS['ActiveMenu']['screenshot']?>">
                <a href="<?=BASE_URL_SITO?>screenshot/"><i class="fa fa-laptop"></i> <span>Cosa vede il cliente</span></a>
            </li>
          <?}?>
          <?if($permessi['COMUNIC']==1){?>
            <li class="header">
                  <strong>NETWORK SERVICE</strong>
            </li>
            <li class="<?=$GLOBALS['ActiveMenu']['comunicazioni']?>">
                <a href="<?=BASE_URL_SITO?>partners/"><i class="fa fa-users"></i> <span>I nostri Partners integrati</span></a>
            </li>
            <li class="<?=$GLOBALS['ActiveMenu']['comunicazioni']?>">
                <a href="<?=BASE_URL_SITO?>comunicazioni/"><i class="fa fa-commenting-o"></i> <span>Riepilogo Comunicazioni</span></a>
            </li>
<!--              <li class="<?=$GLOBALS['ActiveMenu']['ticket']?>">
                <a href="<?=BASE_URL_SITO?>ticket/"><i class="fa fa-ticket"></i> <span>Tickets Assistenza</span>
                  <?=tot_ticket_risposta(IDSITO)?>
                </a>
            </li>  --> 

          <?}?>
            <li class="<?=$GLOBALS['ActiveMenu']['comunicazioni']?>">
                    <a href="https://www.iubenda.com/privacy-policy/173284/legal" class="iubenda-nostyle iubenda-embed">
                        <i class="fa fa-legal"></i>
                         <span>Privacy Policy</span>
                        </a>
                <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
            </li>
            <li class="">
              <a href="javascript:;"><span>&nbsp;</span></a>
            </li>
<?}?>
          </ul>
        </section>
        <!-- /.sidebar -->

      </aside>
      <?
            $data_oggi = date('d-m-Y');
            if($data_oggi <= DATA_GDPR){
             if(IS_NETWORK_SERVICE_USER != 1){
                echo check_consenso_gdpr(IDUTENTE,IDSITO);
             }
            }
      ?>
<?}?>
