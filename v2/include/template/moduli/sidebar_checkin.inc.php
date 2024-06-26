<?php $permessi = check_permessi();?>
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
          <? if(isset($_SESSION['provenienza'])){ ?>
            <li>
              <div align="center">
                  <form id="fr" name="fr" action="<?=BASE_URL_SUITEWEB?>v2/login.php" method="post">
                      <input type="hidden" name="username" value="<?=USER?>" />
                      <input type="hidden" name="password" value="<?=PASS?>"/>
                       <button type="submit" class="btn btn-xs btn-viola">
                       <!--<span class="fa-stack fa-1x">
                          <i class="fa fa-circle fa-stack-2x text-black"></i>
                          <i class="fa fa-wikipedia-w fa-stack-1x"></i>
                        </span>-->
                           <img src="<?=BASE_URL_SITO?>img/w_new.png">
                          Torna a Suiteweb
                        </button>
                        <?if(IS_NETWORK_SERVICE_USER == 1){?>
                            <br>
                            <small class="text-white"><b>Attenzione:</b> <br>se torni a SuiteWeb da questo bottone,<br>torni a <b>SuiteWeb del Cliente</b>, una<br>volta ri-entrato devi fare il <b>logout</b> per<br>accedere nuovamente come Op. NWS !!</small>
                        <?}?>
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
                    <li>
                    <div align="center">
                    <form id="setup" name="setup" method="post" action="<?=BASE_URL_SITO?>syncro/">
                        <input name="action" id="action" type="hidden" value="syncro_auto_config"/>
                        <button type="submit" class="btn btn-danger" ><i class="fa fa-refresh"></i> Lancia Auto configuratore</button>
                    </form>
                    </div>
                    </li>
                <?}?>
            <?}else{ ?>
                <? $check=check_setup();?>
                   <? if($check== 0){?>
                    <? if(CHECKINONLINE == 1){ ?>
                        <li>
                        <div align="center">
                            <form id="setup" name="setup" method="post" action="<?=BASE_URL_SITO?>syncro/">
                                <input name="action" id="action" type="hidden" value="syncro_auto_config"/>
                                <button type="submit" class="btn btn-danger" ><i class="fa fa-refresh"></i> Lancia Auto configuratore</button>
                            </form>                          
                                <script language="JavaScript">
                                        document.setup.submit();
                                </script>                         
                            </div>
                        </li>
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
                                        <a href="<?=BASE_URL_SITO?>setting-tagmanager/"><i class="fa fa-pie-chart"></i> <span>Setting TagManager</span></a>
                                    </li>
<!--                                     <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-lingue/"><i class="fa fa-language"></i> <span>Abilita Lingue</span></a>
                                    </li> -->
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-dizionario/"><i class="fa fa-font"></i> <span>Dizionario del Software</span></a>
                                    </li>
<!--                                     <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-dizionario_form/"><i class="fa fa-font"></i> <span>Dizionario del Form</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-smtp/"><i class="fa fa-envelope"></i> <span>Setting SMTP</span></a>
                                    </li> -->
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-imap/"><i class="fa fa-cloud-download"></i> <span>Setting IMAP</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                        <a href="<?=BASE_URL_SITO?>setting-pms/"><i class="fa fa-refresh"></i> <span>Setting PMS</span></a>
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
                         <li class="treeview <?=$GLOBALS['ActiveMenu']['accessi']?>">
                                  <a href="#">
                                     <small class="label bg-maroon">0°</small>
                                      <span>Config.Accessi</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                  <li class="<?=$GLOBALS['ActiveMenu']['accessi']?>">
                                        <a href="<?=BASE_URL_SITO?>accessi-operatori"><i class="fa  fa-users"></i>  <span>Operatori</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['accessi']?>">
                                        <a href="<?=BASE_URL_SITO?>accessi-utenti"><i class="fa  fa-check"></i>  <span>Gestione Permessi</span></a>
                                    </li>
                              </ul>
                          </li>
                    <?}?>
                    <?if($permessi['CONFIG1']==1){?>
                         <li class="treeview <?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                  <a href="#" class="no_permessi">
                                     <small class="label bg-red">1°</small>
                                      <span>Config.Impostazioni</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa  fa-user"></i> <span>Completa Anagrafica</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa  fa-euro"></i>  <span>Tipi di Pagamento</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-newspaper-o"></i> <span>Fonti Prenotazione</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-user-secret"></i>  <span>Target Clienti</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-plug"></i>  <span>Configuratore Plugin</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-gavel"></i>  <span>Politiche di Cancellazione</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-lock"></i>  <span>Privacy Policy</span></a>
                                    </li>
                              </ul>
                          </li>
                      <?}?>
                      <?if($permessi['CONFIG2']==1){?>
                         <li class="treeview <?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                  <a href="#" class="no_permessi">
                                      <small class="label bg-yellow">2°</small>
                                      <span>Config.Disponibilità</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-tag"></i>  <span>Motivazioni <br><small style="padding-left:calc(14% - 0px);"><small>variazioni soggiorno</small></small></span></a>
                                    </li>
                                
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-handshake-o"></i>  <span>Condizioni Tariffarie</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa  fa-gift"></i>  <span>Proposte/Pacchetti</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa  fa-suitcase"></i>  <span>Tipo Soggiorni</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa  fa-coffee"></i> <span>Servizi Aggiuntivi</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-euro"></i>  <span>Gestione Listini</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-support"></i> <span>Servizi in Camera</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['disponibilita']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-bed"></i>  <span>Camere</span></a>
                                    </li>
                              </ul>
                          </li>
                        <?}?>
                      <?if($permessi['CONFIG3']==1){?>
                         <li class="treeview <?=$GLOBALS['ActiveMenu']['generiche']?>">
                                  <a href="#" class="no_permessi">
                                      <small class="label bg-green">3°</small>
                                      <span>Config.Generiche</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-picture-o"></i>  <span>Gallery Landing</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-info-circle"></i>  <span>InfoHotel Landing</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                    <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-exclamation-triangle"></i>  <span>Banner Info Landing</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-calendar-o"></i>  <span>Eventi Landing</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['generiche']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-map"></i>  <span>Punti di Interesse Landing</span></a>
                                    </li>

                              </ul>
                          </li>
                          <?}?>
                      <?if($permessi['CONFIG4']==1){?>
                          <li class="treeview <?=$GLOBALS['ActiveMenu']['cs']?>">
                                  <a href="#" class="no_permessi">
                                      <small class="label bg-teal">4°</small>
                                      <span>Config.Questionario</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                     <li class="<?=$GLOBALS['ActiveMenu']['cs']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-send"></i>  <span>Conf. Invio questionario</span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['cs']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-question"></i>  <span>Domande questionario</span></a>
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
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-repeat"></i>  <span>ReCall Email Preventivi</span></a>
                                    </li>
                                     <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-envelope-o"></i>  <span>ReSend Email Conferma</span></a>
                                    </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-send-o"></i>  <span>Welcome Email <small><small>o di ReSelling</small></small></span></a>
                                    </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                         <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-info"></i>  <span>PreCheck-in Email <small><small>per info.</small></small></span></a>
                                    </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                         <a href="<?=BASE_URL_SITO?>autoresponder-configura_checkin/"><i class="fa fa-vcard-o"></i>  <span>Check-in online Email <small></small></span></a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['autoresponder']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-tripadvisor"></i>  <span>Richiesta recensioni Email <small></small></span></a>
                                    </li>
                              </ul>
                          </li>
                      <?}?>
                          <?if($permessi['CONFIG6']==1){?>
                            <li class="treeview <?=$GLOBALS['ActiveMenu']['templates']?>">
                                  <a href="#" class="no_permessi">
                                      <small class="label bg-blue">6°</small>
                                      <span>Contenuti & Template</span>
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-pencil"></i> <span>Contenuti E-mail</span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-paint-brush"></i> <span>Contenuti Landing</span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-map-marker"></i> <span>Abilita/Disabilita <small>GoogleMap</small></span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                        <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-laptop"></i> <span>Scegli e Configura <small>template</small></span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa  fa-envelope"></i> <span>Anteprima E-mail</span></a>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <form class="link-menu" name="temp_default" method="post" action="<?=BASE_URL_SITO?>templates-anteprima_web/">
                                            <input type="hidden" name="temp" value="default" />
                                            <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa  fa-windows"></i> <span>&nbsp;&nbsp;Anteprima <small>Template <span style="color:#f00!important">Default</span></small></span></a>
                                          </form>
                                      </li>
                                      <li class="<?=$GLOBALS['ActiveMenu']['templates']?>">
                                          <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa  fa-windows"></i> <span>Anteprima <small>Template <span style="color:#3c3!important">Smart</span></small></span></a>
                                      </li>
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
                    <a href="#" class="no_permessi">
                       <i class="fa fa-bar-chart"></i>
                        <span>Statistiche</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                          <a hhref="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi">
                              <i class="fa fa-pie-chart"></i> <span>Grafici fatturato per<br><small style="padding-left:calc(14% - 0px);">Fonte, Target, Operatore, Template</small></span>
                          </a>
                      </li>
                    <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                          <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi">
                              <i class="fa fa-facebook"></i> <span>Campagne FaceBook Ads </span>
                          </a>
                      </li>
                      <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                          <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi">
                              <i class="fa fa-google"></i> <span>Campagne Google Ads </span>
                          </a>
                      </li>
                      
                        <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                            <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi">
                                <i class="fa fa-tag"></i> <span>Buoni Voucher <br><small style="padding-left:calc(14% - 0px);">per variazione soggiorni</small></span>
                            </a>
                        </li>
                
                      <li class="<?=$GLOBALS['ActiveMenu']['grafici']?>">
                          <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi">
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
                 <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-edit"></i> <span>Crea Proposta Soggiorno</span> </a>
             </li>
          <?}?>
          <?if($permessi['PREV']==1){?>
            <li class="<?=$GLOBALS['ActiveMenu']['preventivi']?>">
                 <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa fa-table"></i>  <span>Preventivi</span>
                    <?=n_preventivi_send()?>
                 </a>
             </li>
          <?}?>
          <?if($permessi['CONF']==1){?>
               <li class="<?=$GLOBALS['ActiveMenu']['conferme']?>">
                 <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-credit-card"></i>  <span>Conferme in trattativa</span>
                  <?=n_conferme_send()?>
                 </a>
             </li>
          <?}?>
          <?if($permessi['PRENO']==1){?>
               <li class="<?=$GLOBALS['ActiveMenu']['prenotazioni']?>">
                 <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa  fa-h-square"></i>  <span>Prenotazioni confermate<br><small style="padding-left:calc(14% - 0px);">& Invio UpSelling</small></span>
                 </a>
              </li>             
           <?}?>

          <?if($permessi['SCHED']==1){?>
                <li class="treeview <?=$GLOBALS['ActiveMenu']['checkinonline']?> active">
                    <a href="#">
                    <i class="fa fa-vcard"></i>
                        <span>Checkin OnLine</span>
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
                    <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa fa-tag"></i>  <span> Buoni Voucher </span>
                    </a>
                </li>
              
           <?}?>

          <?if($permessi['PROF']==1){?>
             <li class="<?=$GLOBALS['ActiveMenu']['profila']?>">
                 <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-search"></i>  <span>Profila ed Esporta</span>
                  </a>
            </li>
            <li class="<?=$GLOBALS['ActiveMenu']['epaper'] ?>">
                <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><img src="<?=BASE_URL_SITO?>img/emessenger.png" class="ico_emessenger">  <span><?=NOME_CLIENT_EMAIL?></span>
                  </a>
            </li>
          <?}?>
          <?if($permessi['GIUD']==1){?>
             <li class="<?=$GLOBALS['ActiveMenu']['giudizio_finale']?>">
                 <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-line-chart"></i>  <span>Giudizi Finali</span>
                  <?=n_notifiche_cs()?>
                  </a>
            </li>
          <?}?>
          <?if($permessi['ARCH']==1){?>
                <li class="<?=$GLOBALS['ActiveMenu']['archivio_preventivi']?>">
                  <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-archive"></i> <span>Archivio</span> </a>
             </li>
              <li class="<?=$GLOBALS['ActiveMenu']['cestino']?>">
                  <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-trash"></i> <span>Cestino</span>
                  <?=n_cestino()?>
                  </a>
             </li>
           <?}?>

          <?if($permessi['SCREEN']==1){?>
            <li class="header">
                  <strong>SCREENSHOTS</strong>
            </li>
            <li class="<?=$GLOBALS['ActiveMenu']['screenshot']?>">
                <a href="javascript:;" data-toggle="modal" data-target="#info-link" class="no_permessi"><i class="fa fa-laptop"></i> <span>Cosa vede il cliente</span></a>
            </li>
          <?}?>
          <?if($permessi['COMUNIC']==1){?>
            <li class="header">
                  <strong>NETWORK SERVICE</strong>
            </li>
            <li class="<?=$GLOBALS['ActiveMenu']['comunicazioni']?>">
                <a href="<?=BASE_URL_SITO?>partners/"><i class="fa fa-users"></i> <span>I nostri Partners integrati</span></a>
            </li>
            <!--<li class="<?=$GLOBALS['ActiveMenu']['comunicazioni']?>">
                <a href="<?=BASE_URL_SITO?>comunicazioni/"><i class="fa fa-commenting-o"></i> <span>Riepilogo Comunicazioni</span></a>
            </li>
             <li class="<?=$GLOBALS['ActiveMenu']['ticket']?>">
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
        <div class="modal fade" id="info-link"  role="dialog" aria-labelledby="myinfo-link">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myinfo-link">QUOTO!</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                  <img src="<?=BASE_URL_SITO?>img/oops.png">
                </div>
                <div class="text-center"><h3>Il tuo abbonamento non prevede l'utilizzo di <br>tutte le funzionalità che ti permetterebbero di:</h3></div>
                <ul>
                    <li>Inviare Preventivi Emozionali</li>

                    <li> Collegare il form di Quoto! nel tuo sito ufficiale</li>

                    <li> Tracciare tutte le tue campagne con Facebook Ads e Google Ads</li>

                    <li> Chattare con il tuo potenziale ospite grazie alla Chat</li>

                    <li> Transare caparre in ambiente sicuro</li>

                    <li> Inviare E-mail automatiche di Pre Stay, upselling, recall.</li>

                    <li>Visualizzare statistiche avanzate di vendite.</li>
                </ul>
                <div class="text-center"> <h3>Contattaci ora per te un offerta speciale "estate2020"</h3></div>
              <p></p>
              <div class="text-center"><a href="mailto:<?=MAIL_ASSISTENZA?>?subject=Richiesta informazioni in merito al CRM QUOTO!&body=Spett.le Network Service, sono il referente per la struttura <?=NOMEHOTEL?>. Stiamo usufruendo del modulo gratuito del Check-in Online, gradiremmo ricevere maggiori informazioni su QUOTO!" class="btn btn-success">Clicca qui!</a></div>
            </div>
          </div>
        </div>
      </div>
