<?php 
$permessi = check_permessi();
$diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
$anniprima = (date('Y')-$diff_anni);
?>
<?php include(INC_PATH_MODULI.'active.menu.inc.php'); ?> 
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar" id="navbarQuoto">
                        <div class="pcoded-inner-navbar main-menu">
                                <div class="col-xl-12 col-md-12 text-center">
                                <div class="clearfix p-t-10"></div>
                                    <img src="<?=BASE_URL_SITO?>img/<?=ICONAUTENTE?>" class="img-circle-small" data-toogle="tooltip" title="<?=ucwords(NOMEUTENTEACCESSI)?>">
                                </div>
                                <div class="col-xl-12 col-md-12 text-center">
                                    <p class="text-white"><?=(NOMEUTENTEACCESSI!=''?ucwords(NOMEUTENTEACCESSI):ucfirst((strlen(NOMEUTENTE)>2?NOMEUTENTE:USER)))?></p>
                                    <a role="button" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="useronline"><i class="fa fa-circle text-success"></i> <span class="text-white">Utente Online</span></a>                           
                                </div>

                                <?php echo menu_pannelli(IDSITO);?>
                                <? if(isset($_SESSION['user_admin'])){?>
                                        <ul class="pcoded-item pcoded-left-item p-t-10">
                                            <li class="text-center">
                                                <form action="<?=BASE_URL_SITO?>jlogout.php" method="post">
                                                        <input type="hidden" name="username" value="<?=$_SESSION['super_user']?>" />
                                                        <input type="hidden" name="password" value="<?=$_SESSION['super_pass']?>"/>
                                                        <button type="submit" class="btn btn-mini btn-default" data-toogle="tooltip" title="Torna al Super Admin"><img src="<?=BASE_URL_SITO?>img/q.png" style="width:20px"> Torna a <?=NOME_AMMINISTRAZIONE?> Manager</button>
                                                </form>
                                            </li>
                                        </ul>
                                <?}?>
                               
                                <?if(IS_NETWORK_SERVICE_USER == 1){ ?>
                                    <?php  

                                            $check=check_setup();
                                            if($check== 0){
                                                echo' <div class="clearfix p-t-10"></div><ul class="pcoded-item pcoded-left-item">
                                                        <li>
                                                        <div align="center">
                                                            <form id="setup" name="setup" method="post" action="'.BASE_URL_SITO.'syncro/">
                                                                <input name="action" id="action" type="hidden" value="syncro_auto_config"/>
                                                                <button type="submit" class="btn btn-danger btn-sm" ><i class="fa fa-refresh"></i> Lancia Auto configuratore</button>
                                                            </form>
                                                        </div>
                                                        </li>
                                                    </ul>'."\r\n";
                                            }
                                        
                                    ?>
                                <?}?>
                               
                            <?php $check=check_setup();
                                 if($check > 0){ ?>
                                   <div class="pcoded-navigatio-lavel" id="Cruscotto">Cruscotto <?=NOME_AMMINISTRAZIONE?></div>
                                        <ul class="pcoded-item pcoded-left-item">
                                                <li class="<?=$GLOBALS['ActiveMenu']['index']?>">
                                                    <a href="<?=BASE_URL_SITO?>dashboard-index/">
                                                        <span class="pcoded-micon"><i class="fa fa-dashboard text-white"></i></span>
                                                        <span class="pcoded-mtext">Dashboard</span>
                                                    </a>
                                                </li>

                                            <div class="pcoded-navigatio-lavel" id="UsoGiornaliero">Uso giornaliero <?=NOME_AMMINISTRAZIONE?></div>
                                                <?if($permessi['PROP']==1){?>
                                                    <li class="<?=$GLOBALS['ActiveMenu']['crea_proposta']?> btn btn-mini btn-crea buttonCreaPorposta">
                                                        <a href="<?=BASE_URL_SITO?>crea_proposta/"  class="padLinkCreaPorposta">
                                                            <span class="pcoded-micon"><i class="fa fa-edit text-white"></i></span>
                                                            <span class="pcoded-mtext">Crea Proposta Soggiorno</span>
                                                        </a>
                                                    </li>
                                                <?}?>
                                                <?if($permessi['PREV']==1){?> 
                                                    <li class="<?=$GLOBALS['ActiveMenu']['preventivi']?>">
                                                        <a href="<?=BASE_URL_SITO?>preventivi/">
                                                        <span class="pcoded-micon"><i class="ti-layout-media-right-alt text-white"></i></span>
                                                        <span class="pcoded-mtext">Preventivi</span>
                                                            <?php 
                                                                //if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
                                                                    echo n_preventivi_send();
                                                                //}
                                                            ?>
                                                         </a>
                                                    </li>
                                                <?}?>
                                                <?if($permessi['CONF']==1){?>
                                                    <li class="<?=$GLOBALS['ActiveMenu']['conferme']?>">
                                                        <a href="<?=BASE_URL_SITO?>conferme/">
                                                            <span class="pcoded-micon"><i class="fa fa-credit-card text-white"></i></span>
                                                            <span class="pcoded-mtext">...... in Trattativa</span>
                                                                <?php 
                                                                    //if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
                                                                        echo n_conferme_send();
                                                                    //}
                                                                ?>
                                                        </a>
                                                    </li> 
                                                <?}?>
                                                <?if($permessi['PRENO']==1){?> 
                                                    <li class="<?=$GLOBALS['ActiveMenu']['prenotazioni']?>">
                                                        <a href="<?=BASE_URL_SITO?>prenotazioni/">
                                                            <span class="pcoded-micon"><i class="fa fa-h-square text-white"></i></span>
                                                            <span class="pcoded-mtext">Prenotazioni</span>
                                                        </a>
                                                    </li> 
                                                    <li class="<?=$GLOBALS['ActiveMenu']['disdette']?>">
                                                        <a href="<?=BASE_URL_SITO?>disdette/">
                                                            <span class="pcoded-micon"><i class="fa fa-ban text-white"></i></span>
                                                            <span class="pcoded-mtext">Disdette</span>
                                                        </a>
                                                    </li> 
                                                <?}?>
                                                <?if($permessi['CONF']==1){?>
                                                    <li class="<?=$GLOBALS['ActiveMenu']['annullate']?>">
                                                        <a href="<?=BASE_URL_SITO?>annullate/">
                                                            <span class="pcoded-micon"><i class="fa fa-minus-circle text-white"></i></span>
                                                            <span class="pcoded-mtext">Annullate <small class="fw-lighter"> &#10230; <em>No disponibilità</em></small></span>
                                                        </a>
                                                    </li>
                                                <?}?>
                                                <?if($permessi['ARCH']==1){?>
                                                        
                                                    <?php if(ANNO_ATTIVAZIONE != date('Y')){?>
                                                        <li class="pcoded-hasmenu <?=$archivio_perAnno?>">
                                                            <a href="javascript:void(0)">
                                                                <span class="pcoded-micon"><i class="fa fa-database text-white"></i></span>
                                                                <span class="pcoded-mtext">Archiviate per anno</span>                                                       
                                                            </a>
                                                            <ul class="pcoded-submenu">
                                                        <?php for($i=$anniprima; $i<=date('Y'); $i++){ ?>
                                                                    <li class="<?=$GLOBALS['ActiveMenu']['archivio_per_anno/'.$i.'/']?> <?=($_SERVER['REQUEST_URI']=='/archivio_per_anno/'.$i.'/'?'active':'')?>">
                                                                        <a href="<?=BASE_URL_SITO?>archivio_per_anno/<?=$i?>/">
                                                                            <span class="pcoded-micon"><i class="fa fa-search text-white"></i></span>
                                                                            <span class="pcoded-mtext"><?=$i?></span>
                                                                            <?=n_archivio('',$i)?>
                                                                        </a>
                                                                    </li>    
                                                                <?}?>
                                                                </ul>
                                                            </li>
                                                        <?}else{?> 
                                                                <li class="<?=$GLOBALS['ActiveMenu']['archivio']?>">
                                                                    <a href="<?=BASE_URL_SITO?>archivio/">
                                                                        <span class="pcoded-micon"><i class="fa fa-database text-white"></i></span>
                                                                        <span class="pcoded-mtext">Archiviate</span>
                                                                        <?=n_archivio()?>
                                                                    </a>
                                                                </li>
                                                        <?}?>                                                   

                                                <?}?> 
                                                    <li class="<?=$GLOBALS['ActiveMenu']['cestino']?>">
                                                        <a href="<?=BASE_URL_SITO?>cestino/">
                                                            <span class="pcoded-micon"><i class="fa fa-trash text-white"></i></span>
                                                            <span class="pcoded-mtext">Cestinate</span>
                                                            <?=n_cestino()?>
                                                        </a>
                                                    </li>
                                                <?if($permessi['PRENO']==1){?> 
                                                    <li class="<?=$GLOBALS['ActiveMenu']['buoni_voucher']?>">
                                                        <a href="<?=BASE_URL_SITO?>buoni_voucher/">
                                                            <span class="pcoded-micon"><i class="fa fa-tag text-white"></i></span>
                                                            <span class="pcoded-mtext">Buoni Voucher</span>
                                                            <?=n_buoni_voucher()?>
                                                        </a>
                                                    </li>
                                                <?}?> 
                                                <?if($permessi['GIUD']==1){?>
                                                    <li class="<?=$GLOBALS['ActiveMenu']['giudizio_finale']?>">
                                                        <a href="<?=BASE_URL_SITO?>giudizio_finale/">
                                                            <span class="pcoded-micon"><i class="fa fa-smile-o text-white"></i></span>
                                                            <span class="pcoded-mtext">Giudizi Finali Ospiti</span>
                                                            <?=n_notifiche_cs()?>
                                                        </a>
                                                    </li>
                                                <?}?> 

                                                <?php if(ANNO_ATTIVAZIONE != date('Y')){?>
                                                <li class="pcoded-hasmenu <?=$profila_perAnno?>">
                                                    <a href="javascript:void(0)">
                                                        <span class="pcoded-micon"><i class="fa fa-archive text-white"></i></span>
                                                        <span class="pcoded-mtext">Profila per anno</span>
                                                    </a>
                                                    <ul class="pcoded-submenu">
                                                <?php for($i=$anniprima; $i<=date('Y'); $i++){ ?>
                                                        <li class="<?=$GLOBALS['ActiveMenu']['profila_per_anno/'.$i.'/']?> <?=($_SERVER['REQUEST_URI']=='/profila_per_anno/'.$i.'/'?'active':'')?>">
                                                            <a href="<?=BASE_URL_SITO?>profila_per_anno/<?=$i?>/">
                                                                <span class="pcoded-micon"><i class="fa fa-search text-white"></i></span>
                                                                <span class="pcoded-mtext"><?=$i?></span>
                                                                <?=num_profila_anno($i)?>
                                                            </a>
                                                        </li>    
                                                    <?}?>
                                                    </ul>
                                                </li>
                                            <?}else{?> 
                                                    <?if($permessi['PROF']==1){?>
                                                        <li class="<?=$GLOBALS['ActiveMenu']['profila']?>">
                                                            <a href="<?=BASE_URL_SITO?>profila/">
                                                                <span class="pcoded-micon"><i class="fa fa-search text-white"></i></span>
                                                                <span class="pcoded-mtext">Profila ed Esporta</span>
                                                            </a>
                                                        </li>
                                                    <?}?>
                                            <?}?>

                                                <?if($permessi['STAT']==1){?>   
                                                    <div class="pcoded-navigatio-lavel" id="Statistiche">Statistiche <?=NOME_AMMINISTRAZIONE?></div>
                                 
                                                    <li class="pcoded-hasmenu <?=$statistic_menu_attivi?>">
                                                        <a href="javascript:void(0)">
                                                            <span class="pcoded-micon"><i class="fa fa-bar-chart text-white"></i></span>
                                                            <span class="pcoded-mtext">Statistiche</span>
                                                        </a>
                                                        <ul class="pcoded-submenu">
                                                        <? //if(IS_NETWORK_SERVICE_USER == 1){ ?>
                                                        <!-- 
                                                            <li class="<?=$GLOBALS['ActiveMenu']['statistiche_new']?>  <?php $attivo_stats?>">
                                                                <a href="<?=BASE_URL_SITO?>grafici-statistiche_new/">
                                                                    <span class="pcoded-micon"><i class="fa fa-chart text-white"></i></span>
                                                                    <span class="pcoded-mtext"> Statistiche & Ads <small>v.Alpha</small></span>
                                                                </a>
                                                            </li> 
                                                        -->
                                                        <?//}?>
                                                            <li class="pcoded-hasmenu <?=$attivo_graphUTM?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"><i class="fa fa-laptop text-white"></i></span>
                                                                        <span class="pcoded-mtext">Statistiche & Ads <small>UTM</small></span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">

                                                                            <li class="<?=$GLOBALS['ActiveMenu']['statistiche_utm']?>">
                                                                                <a href="<?=BASE_URL_SITO?>grafici-statistiche_utm/">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Analisi Fatturato <span class="f-10">(UTM)</span></span>
                                                                                </a>
                                                                            </li>                                                                     
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['facebook_ads_utm']?>">
                                                                                <a href="<?=BASE_URL_SITO?>grafici-facebook_ads_utm/">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Facebook Ads <span class="f-10">(UTM)</span></span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['ppc_ads_utm']?>">       
                                                                                <a href="<?=BASE_URL_SITO?>grafici-ppc_ads_utm/">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Google Ads <span class="f-10">(UTM)</span></span>
                                                                                </a>
                                                                            </li> 
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['newsletter_ads_utm']?>">       
                                                                                <a href="<?=BASE_URL_SITO?>grafici-newsletter_ads_utm/">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Newsletter Ads <span class="f-10">(UTM)</span></span>
                                                                                </a>
                                                                            </li> 
                                                                    </ul>
                                                            </li>
                                                           <!-- <li class="pcoded-hasmenu <?=$attivo_graphGA4?>">
                                                                <a href="javascript:void(0)">
                                                                    <span class="pcoded-micon"><i class="fa fa-laptop text-white"></i></span>
                                                                    <span class="pcoded-mtext">Statistiche & Ads <small>GA4</small></span>
                                                                </a>
                                                                <ul class="pcoded-submenu">
                                                                <?if(check_propertyId()==true){?> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['statistiche_GA4']?>">
                                                                            <a href="<?=BASE_URL_SITO?>grafici-statistiche_GA4/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Analisi Fatturato <span class="f-10">(GA4)</span></span>
                                                                            </a>
                                                                        </li>                                                                     
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['facebook_ads_GA4']?>">
                                                                            <a href="<?=BASE_URL_SITO?>grafici-facebook_ads_GA4/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Facebook Ads <span class="f-10">(GA4)</span></span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['ppc_ads_GA4']?>">       
                                                                            <a href="<?=BASE_URL_SITO?>grafici-ppc_ads_GA4/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Google Ads <span class="f-10">(GA4)</span></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['newsletter_ads_GA4']?>">       
                                                                            <a href="<?=BASE_URL_SITO?>grafici-newsletter_ads_GA4/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Newsletter Ads <span class="f-10">(GA4)</span></span>
                                                                            </a>
                                                                        </li> 
                                                                    <?}else{?>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['statistiche_GA4']?>">
                                                                        <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads GA4, Google Ads GA4 e Newsletter Ads GA4 non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in <?=NOME_AMMINISTRAZIONE?> tramite Analytics GA4\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Analisi Fatturato <span class="f-10">(GA4)</span></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['facebook_ads_GA4']?>">
                                                                            <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads GA4, Google Ads GA4 e Newsletter Ads GA4 non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in <?=NOME_AMMINISTRAZIONE?> tramite Analytics GA4\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Facebook Ads <span class="f-10">(GA4)</span></span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['ppc_ads_GA4']?>">       
                                                                            <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads GA4, Google Ads GA4 e Newsletter Ads GA4 non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in <?=NOME_AMMINISTRAZIONE?> tramite Analytics GA4\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Google Ads <span class="f-10">(GA4)</span></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['newsletter_ads_GA4']?>">       
                                                                            <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads GA4, Google Ads GA4 e Newsletter Ads GA4 non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in Q<?=NOME_AMMINISTRAZIONE?> tramite Analytics GA4\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Newsletter Ads <span class="f-10">(GA4)</span></span>
                                                                            </a>
                                                                        </li> 
                                                                    <?}?>
                                                                </ul>
                                                            </li>
                                                                    -->
                                                            <? if(IS_NETWORK_SERVICE_USER == 1){ ?>
<!--                                                             <span class="f-10 text-info p-l-30">UNIVERSAL visibile solo operatore network</span>
                                                            <li class="pcoded-hasmenu <?=$attivo_graph?>">
                                                                <a href="javascript:void(0)">
                                                                    <span class="pcoded-micon"><i class="fa fa-laptop text-white"></i></span>
                                                                    <span class="pcoded-mtext">Statistiche & Ads <small><small>UNIVERSAL</small></small></span>
                                                                </a>
                                                                <ul class="pcoded-submenu">
                                                                    <li class="<?=$GLOBALS['ActiveMenu']['statistiche3']?>">
                                                                        <a href="<?=BASE_URL_SITO?>grafici-statistiche3/">
                                                                            <span class="pcoded-micon"></span>
                                                                            <span class="pcoded-mtext">Fatturato & Grafici</span>
                                                                        </a>
                                                                    </li> 
                                                                    <?if(check_vista()==true){?> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['facebook_ads_new']?>">
                                                                            <a href="<?=BASE_URL_SITO?>grafici-facebook_ads_new/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Facebook Ads <span class="f-10">(Analytics)</span></span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['ppc_ads_new']?>">       
                                                                            <a href="<?=BASE_URL_SITO?>grafici-ppc_ads_new/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Google Ads <span class="f-10">(Analytics)</span></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['newsletter_ads_new']?>">       
                                                                            <a href="<?=BASE_URL_SITO?>grafici-newsletter_ads_new/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Newsletter Ads <span class="f-10">(Analytics)</span></span>
                                                                            </a>
                                                                        </li>
                                                                    <?}else{?>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['facebook_ads_new']?>">
                                                                            <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads, Google Ads e Newsletter Ads non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in <?=NOME_AMMINISTRAZIONE?>\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Facebook Ads <span class="f-10">(Analytics)</span></span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['ppc_ads_new']?>">       
                                                                            <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads, Google Ads e Newsletter Ads non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in <?=NOME_AMMINISTRAZIONE?>\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Google Ads <span class="f-10">(Analytics)</span></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['newsletter_ads_new']?>">       
                                                                            <a href="javascript:;" onclick="_alert('<div style=\'width:100%!important;text-align:center!important;font-weight:bold!important;color:#363636!important;\'>Statistiche avanzate per tracciamento<br /> delle campagne Facebook Ads, Google Ads e Newsletter Ads non abilitato!</div>','<div style=\'width:100%!important;text-align:center!important;color:#363636!important;\'>Contatta <a href=\'mailto:support@quoto.travel?subject=Vorrei avere informazioni riguardo il tracciamento delle campagne Ads in <?=NOME_AMMINISTRAZIONE?>\'>support@quoto.travel</a> per maggiori informazioni</div>');" class="no_permessi">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Newsletter Ads <span class="f-10">(Analytics)</span></span>
                                                                            </a>
                                                                        </li>
                                                                    <?}?> 
                                                                </ul>
                                                            </li> -->
                                                        <?}?> 
                                                        <? if(IS_NETWORK_SERVICE_USER == 1){ ?>
<!--                                                             <span class="f-10 text-info p-l-30">v.1.2 visibile solo operatore network</span>
                                                            <li class="pcoded-hasmenu <?=$attivo_camp?>">
                                                                <a href="javascript:void(0)">
                                                                    <span class="pcoded-micon"><i class="fa fa-laptop text-white"></i></span>
                                                                    <span class="pcoded-mtext">Statistiche Ads <small>v.1.2</small></span>
                                                                </a>
                                                                <ul class="pcoded-submenu">
                                                                    <li class="<?=$GLOBALS['ActiveMenu']['facebook_ads_nws']?>">
                                                                        <a href="<?=BASE_URL_SITO?>grafici-facebook_ads_nws/">
                                                                            <span class="pcoded-micon"></span>
                                                                            <span class="pcoded-mtext">Facebook Ads <span class="f-10">(Tracking)</span></span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="<?=$GLOBALS['ActiveMenu']['ppc_ads_nws']?>">       
                                                                        <a href="<?=BASE_URL_SITO?>grafici-ppc_ads_nws/">
                                                                            <span class="pcoded-micon"></span>
                                                                            <span class="pcoded-mtext">Google Ads <span class="f-10">(Tracking)</span></span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="<?=$GLOBALS['ActiveMenu']['newsletter_ads_nws']?>">       
                                                                        <a href="<?=BASE_URL_SITO?>grafici-newsletter_ads_nws/">
                                                                            <span class="pcoded-micon"></span>
                                                                            <span class="pcoded-mtext">Newsletter Ads <span class="f-10">(Tracking)</span></span>
                                                                        </a>
                                                                    </li> 
                                                                </ul>
                                                            </li> -->
                                                        <?}?>
                                                            <li class="<?=$GLOBALS['ActiveMenu']['statistiche_voucher']?>">
                                                                <a href="<?=BASE_URL_SITO?>grafici-statistiche_voucher/">
                                                                    <span class="pcoded-micon"></span>
                                                                    <span class="pcoded-mtext">Buoni Voucher <br><small style="padding-left:calc(14% - 0px);">Lista variazione soggiorni</small></span>
                                                                </a>
                                                            </li>
                                                            <li class="<?=$GLOBALS['ActiveMenu']['anagrafiche_clienti']?>">
                                                                <a href="<?=BASE_URL_SITO?>grafici-anagrafiche_clienti/">
                                                                    <span class="pcoded-micon"></span>
                                                                    <span class="pcoded-mtext">Fatturato e Timeline <br><small style="padding-left:calc(14% - 0px);">per Cliente</small></span>
                                                                </a>
                                                            </li>
                                                            <li class="<?=$GLOBALS['ActiveMenu']['performance']?>">
                                                                <a href="<?=BASE_URL_SITO?>performance/">
                                                                    <span class="pcoded-micon"></span>
                                                                    <span class="pcoded-mtext">Performance Struttura <br><small style="padding-left:calc(14% - 0px);">per Anno</small></span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                <?}?>

                                        <div class="pcoded-navigatio-lavel" id="Configurazioni">Settings <?=NOME_AMMINISTRAZIONE?></div>
                                         <ul class="pcoded-item pcoded-left-item">
                                                    <li class="pcoded-hasmenu <?=$network_menu_attivi?>">
                                                        <a href="javascript:void(0)">
                                                            <span class="pcoded-micon"><i class="fa fa-wrench text-white"></i></span>
                                                            <span class="pcoded-mtext">Configurazioni</span>
                                                        </a> 
                                                        <? if(IS_NETWORK_SERVICE_USER == 1){ ?>                                                     
                                                            <ul class="pcoded-submenu">
                                                                <li class="pcoded-hasmenu <?=$attivo_setting?> <?=$attivo_form?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"></span>
                                                                        <span class="pcoded-mtext text-white f-13"><label class="label bg-purple"><img  src="<?=BASE_URL_SITO?>class/resize.class.php?src=<?=BASE_PATH_SITO?>img/logo-nws-ico.png&w=16&h=0&a=c&q=100"></label> Network Service</span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['dizionario']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-dizionario/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Dizionario del software</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['dizionario_form']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-dizionario_form/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Dizionario del Form</span>
                                                                            </a>
                                                                        </li>  
                                                                        <!--<li class="pcoded-hasmenu <?=$attivo_form?>">
                                                                            <a href="javascript:void(0)">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Gestione Form</span>
                                                                            </a>
                                                                            <ul class="pcoded-submenu">
                                                                                <li class="<?=$GLOBALS['ActiveMenu']['dizionario_form']?>">
                                                                                    <a href="<?=BASE_URL_SITO?>setting-dizionario_form/">
                                                                                        <span class="pcoded-micon"></span>
                                                                                        <span class="pcoded-mtext">Dizionario del Form</span>
                                                                                    </a>
                                                                                </li>  
                                                                                <li class="<?=$GLOBALS['ActiveMenu']['lingue']?>">
                                                                                    <a href="<?=BASE_URL_SITO?>setting-lingue/">
                                                                                        <span class="pcoded-micon"></span>
                                                                                        <span class="pcoded-mtext">Gestione Lingue Form</span>
                                                                                    </a>
                                                                                </li> 
                                                                                <li class="<?=$GLOBALS['ActiveMenu']['form']?>">
                                                                                    <a href="<?=BASE_URL_SITO?>setting-form/">
                                                                                        <span class="pcoded-micon"></span>
                                                                                        <span class="pcoded-mtext">Form Sito/Landing</span>
                                                                                    </a>
                                                                                </li> 
                                                                                <?if(check_form_exists(IDSITO)==0){?>
                                                                                    <?if(check_lang_form_exists(IDSITO)==0){?>
                                                                                        <li class="<?=$GLOBALS['ActiveMenu']['setting']?>">
                                                                                            <a href="javascript:alert('Prima di creare il form inserire le lingue!')"  class="no_permessi"><i class="fa fa-html5 text-gray"></i> 
                                                                                                <span class="pcoded-micon"></span>
                                                                                                <span class="pcoded-mtext">Crea Form</span>
                                                                                            </a>
                                                                                        </li>
                                                                                    <?}else{?>
                                                                                        <li class="<?=$GLOBALS['ActiveMenu']['setting-form/crea_form']?>">
                                                                                            <a href="<?=BASE_URL_SITO?>setting-form/crea_form">
                                                                                                <span class="pcoded-micon"></span>
                                                                                                <span class="pcoded-mtext">Crea Form</span>
                                                                                            </a>
                                                                                        </li>
                                                                                    <?}?>
                                                                                <?}else{?>
                                                                                    <li class="<?=$GLOBALS['ActiveMenu']['setting-form/delete_form']?>">
                                                                                        <a href="javascript:;" onclick="validator('<?=BASE_URL_SITO?>setting-form/delete_form/<?=getIdForm(IDSITO)?>');">
                                                                                            <span class="pcoded-micon"></span>
                                                                                            <span class="pcoded-mtext text-red f-w-600">Elimina Form</span>
                                                                                        </a>
                                                                                    </li>
                                                                                <?}?>
                                                                            </ul>
                                                                        </li>-->
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['simplebooking']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-simplebooking/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Simple Booking</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['ericsoftbooking']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-ericsoftbooking/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Ericsoft Booking/PMS</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['bedzzlebooking']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-bedzzlebooking/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Bedzzle Booking/PMS</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['pms']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-pms/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Hotel Cinque Stelle/PMS</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['parityrate']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-parityrate/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Channel Man. ParityRate</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['smtp']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-smtp/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Setting SMTP</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['imap']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-imap/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Setting IMAP</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configurazioni']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-configurazioni/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Configuratore plugins</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['paginazione']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-paginazione/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Configura paginazione</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['panel_ext']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-panel_ext/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Pannelli esterni</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['delete_cliente']?>">
                                                                            <a href="<?=BASE_URL_SITO?>setting-delete_cliente/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Elimina questo cliente</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configcronurazioni']?>">
                                                                                <a href="javascript:;" onclick="if(window.confirm('ATTENZIONE: Sicuro di voler aprire la gestione dei CRON?')){window.open('<?=BASE_URL_SITO?>cron/Clogout.php');}">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Gestione CRON</span>
                                                                            </a>
                                                                        </li> 
                                                                    </ul>
                                                                </li> 
                                                            </ul> 
                                                        <?}?>  
                                                        <?if($permessi['UTENTI']==1){?>  
                                                            <ul class="pcoded-submenu">
                                                                <li class="pcoded-hasmenu <?=$attivo_server?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"></span>
                                                                        <span class="pcoded-mtext text-white f-13"><label class="label bg-black f-10">0° step</label> Logs</span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['logs_accessi']?>">
                                                                            <a href="<?=BASE_URL_SITO?>server-logs_accessi/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Logs accessi</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['logs']?>">
                                                                            <a href="<?=BASE_URL_SITO?>server-logs/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Logs per operatore</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['logs_server']?>">
                                                                            <a href="<?=BASE_URL_SITO?>server-logs_server/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Logs lato server</span>
                                                                            </a>
                                                                        </li> 
                                                                    </ul>
                                                                </li> 
                                                            </ul>                                                
                                                            <ul class="pcoded-submenu">
                                                                <li class="pcoded-hasmenu <?=$attivo_accessi?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"></span>
                                                                        <span class="pcoded-mtext text-white f-13"><label class="label bg-red f-10">1° step</label> Accessi</span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['operatori']?>">
                                                                            <a href="<?=BASE_URL_SITO?>accessi-operatori/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Operatori</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['utenti']?>">
                                                                            <a href="<?=BASE_URL_SITO?>accessi-utenti/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Gestione Permessi</span>
                                                                            </a>
                                                                        </li> 
                                                                    </ul>
                                                                </li> 
                                                            </ul>
                                                        <?}?>
                                                        <?if($permessi['CONFIG1']==1){?>
                                                            <ul class="pcoded-submenu">
                                                                <li class="pcoded-hasmenu <?=$attivo_configurazioni?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"></span>
                                                                        <span class="pcoded-mtext text-white f-13"><label class="label bg-orange f-10">2° step</label> Impostazioni</span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['anagrafica_cliente']?>">
                                                                            <a href="<?=BASE_URL_SITO?>impostazioni-anagrafica_cliente/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Anagrafica e Mappa</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['social_cliente']?>">
                                                                            <a href="<?=BASE_URL_SITO?>impostazioni-social_cliente/<?=IDSITO?>/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Collegamenti Social</span>
                                                                            </a>
                                                                        </li>  
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['pagamenti']?>">
                                                                            <a href="<?=BASE_URL_SITO?>impostazioni-pagamenti/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Tipi di Pagamento</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['fonti_prenotazione']?>">
                                                                            <a href="<?=BASE_URL_SITO?>impostazioni-fonti_prenotazione/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Fonti Prenotazioni</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['target']?>">
                                                                            <a href="<?=BASE_URL_SITO?>impostazioni-target/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Target Clienti</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configurazioni_client']?>">
                                                                            <a href="<?=BASE_URL_SITO?>impostazioni-configurazioni_client/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Configuratore Plugins</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['policy']?>">
                                                                            <a href="<?=BASE_URL_SITO?>impostazioni-policy/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Condizioni Generali</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['privacy_policy']?>">
                                                                            <a href="<?=BASE_URL_SITO?>impostazioni-privacy_policy/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Privacy Policy</span>
                                                                            </a>
                                                                        </li> 
                                                                    </ul>
                                                                </li> 
                                                            </ul>
                                                        <?}?>
                                                        <?if($permessi['CONFIG2']==1){?>
                                                            <ul class="pcoded-submenu">
                                                                <li class="pcoded-hasmenu <?=$attivo_disponibilita?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"></span>
                                                                        <span class="pcoded-mtext text-white f-13"><label class="label bg-yellow f-10">3° step</label> Disponibilità</span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['motivazioni']?>">
                                                                            <a href="<?=BASE_URL_SITO?>disponibilita-motivazioni/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">TAG Motivazioni<br><small style="padding-left:calc(14% - 0px);"><small>utili all'invio buoni voucher</small></small></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['tariffe']?>">
                                                                            <a href="<?=BASE_URL_SITO?>disponibilita-tariffe/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Condizioni <small><small>e politiche tariffarie</small></small></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['pacchetti']?>">
                                                                            <a href="<?=BASE_URL_SITO?>disponibilita-pacchetti/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Proposte e Pacchetti</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['soggiorni']?>">
                                                                            <a href="<?=BASE_URL_SITO?>disponibilita-soggiorni/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Tipo Soggiorni</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['servizi_aggiuntivi']?>">
                                                                            <a href="<?=BASE_URL_SITO?>disponibilita-servizi_aggiuntivi/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Servizi Aggiuntivi</span>
                                                                            </a>
                                                                        </li>
                                                                        <?php 
                                                                            $etichetta = '';
                                                                            if (check_simplebooking(IDSITO)==1){
                                                                                $etichetta = 'SimpleBooking';
                                                                            }
                                                                            if(check_ericsoftbooking(IDSITO)==1){
                                                                                $etichetta = 'EricSoftBooking';
                                                                            }
                                                                            if(check_bedzzlebooking(IDSITO)==1){
                                                                                $etichetta = 'BedzzleBooking';
                                                                            }
                                                                            if(check_parity(IDSITO)==1){
                                                                                $etichetta = 'Channel ParityRate';
                                                                            }
                                                                            if($etichetta!=''){
                                                                                echo'   <li class="'.$GLOBALS['ActiveMenu']['tipo_listino'].'">
                                                                                            <a href="javascript:alert(\'Gestione Listini non attivo, attivo il modulo di '.$etichetta.'\')" class="text-gray">
                                                                                                <span class="pcoded-micon"></span>
                                                                                                <span class="pcoded-mtext">Gestione Listini</span>
                                                                                            </a>
                                                                                        </li> ';
                                                                            }else{
                                                                                echo'   <li class="'.$GLOBALS['ActiveMenu']['tipo_listino'].'">
                                                                                            <a href="'.BASE_URL_SITO.'disponibilita-tipo_listino/">
                                                                                                <span class="pcoded-micon"></span>
                                                                                                <span class="pcoded-mtext">Gestione Listini</span>
                                                                                            </a>
                                                                                        </li> ';
                                                                            }
                                                                        ?>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['servizi_camera']?>">
                                                                            <a href="<?=BASE_URL_SITO?>disponibilita-servizi_camera/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Servizi in Camera</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['camere']?>">
                                                                            <a href="<?=BASE_URL_SITO?>disponibilita-camere/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Camere</span>
                                                                            </a>
                                                                        </li> 
                                                                    </ul>
                                                                </li> 
                                                            </ul>
                                                        <?}?>
                                                        <?if($permessi['CONFIG3']==1){?>
                                                            <ul class="pcoded-submenu">
                                                                <li class="pcoded-hasmenu <?=$attivo_generiche?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"></span>
                                                                        <span class="pcoded-mtext text-white f-13"><label class="label bg-green f-10">4° step</label> Generiche</span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['gallery']?>">
                                                                            <a href="<?=BASE_URL_SITO?>generiche-gallery/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Gallery Templates</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['infohotel']?>">
                                                                            <a href="<?=BASE_URL_SITO?>generiche-infohotel/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Info Hotel Templates</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['banner_info']?>">
                                                                            <a href="<?=BASE_URL_SITO?>generiche-banner_info/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Banner Info Templates</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['info_box']?>">
                                                                            <a href="<?=BASE_URL_SITO?>generiche-info_box/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">InfoBox Tag <small class="f-10">Templates</small> <small class="text-white">(New)</small></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['eventi']?>">
                                                                            <a href="<?=BASE_URL_SITO?>generiche-eventi/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Eventi Templates</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['punti_interesse']?>">
                                                                            <a href="<?=BASE_URL_SITO?>generiche-punti_interesse/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Punti Interesse <small>Templates</small></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['sconti']?>">
                                                                            <a href="<?=BASE_URL_SITO?>generiche-sconti/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Generatore <small>Codici Sconto</small></span>
                                                                            </a>
                                                                        </li> 
                                                                    </ul>
                                                                </li> 
                                                            </ul>
                                                        <?}?>
                                                         <?if($permessi['CONFIG4']==1){?>
                                                            <ul class="pcoded-submenu">
                                                                <li class="pcoded-hasmenu <?=$attivo_cs?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"></span>
                                                                        <span class="pcoded-mtext text-white f-13"><label class="label bg-info f-10">5° step</label> Questionario</span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configura_cs']?>">
                                                                            <a href="<?=BASE_URL_SITO?>questionario-configura_cs/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Conf.invio questionario</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['domande']?>">
                                                                            <a href="<?=BASE_URL_SITO?>questionario-domande/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Domande questionario</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configura_recensioni_punteggio']?>">
                                                                            <a href="<?=BASE_URL_SITO?>questionario-configura_recensioni_punteggio/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Invio Recensioni <br><small style="padding-left:calc(14% - 0px);">automatico per punteggio</small></span>
                                                                            </a>
                                                                        </li> 
 
                                                                    </ul>
                                                                </li> 
                                                            </ul>
                                                        <?}?>
                                                        <?if($permessi['CONFIG5']==1){?>
                                                            <ul class="pcoded-submenu">
                                                                <li class="pcoded-hasmenu <?=$attivo_autoresponder?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"></span>
                                                                        <span class="pcoded-mtext text-white f-13"><label class="label bg-fuchsia f-10">6° step</label> Autoresponder</span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configura_recall']?>">
                                                                            <a href="<?=BASE_URL_SITO?>autoresponder-configura_recall/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">ReCall Email Preventivi</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configura_resend']?>">
                                                                            <a href="<?=BASE_URL_SITO?>autoresponder-configura_resend/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">ReCall Email Caparra</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configura_info_utili']?>">
                                                                            <a href="<?=BASE_URL_SITO?>autoresponder-configura_info_utili/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Email Info Utili</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configura_email_benvenuto']?>">
                                                                            <a href="<?=BASE_URL_SITO?>autoresponder-configura_email_benvenuto/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Email di Benvenuto</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configura_checkin']?>">
                                                                            <a href="<?=BASE_URL_SITO?>autoresponder-configura_checkin/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Modulo Check-in</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['configura_recensioni']?>">
                                                                            <a href="<?=BASE_URL_SITO?>autoresponder-configura_recensioni/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Richiesta <small>recensioni Email</small></span>
                                                                            </a>
                                                                        </li>  
                                                                    </ul>
                                                                </li> 
                                                            </ul>
                                                        <?}?>
                                                        <?if($permessi['CONFIG6']==1){?>
                                                            <ul class="pcoded-submenu">
                                                                <li class="pcoded-hasmenu <?=$attivo_templates?>">
                                                                    <a href="javascript:void(0)">
                                                                        <span class="pcoded-micon"></span>
                                                                        <span class="pcoded-mtext text-white f-12"><label class="label bg-light-blue f-10">7° step</label>Contenuti <small>& Template</small></span>
                                                                    </a>
                                                                    <ul class="pcoded-submenu">
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['contenuti_email']?>">
                                                                            <a href="<?=BASE_URL_SITO?>templates-contenuti_email/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Contenuti E-mail</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['contenuti_template']?>">
                                                                            <a href="<?=BASE_URL_SITO?>templates-contenuti_template/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Contenuti Templates</span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['grafiche']?>">
                                                                            <a href="<?=BASE_URL_SITO?>templates-grafiche/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Scegli  <small>e Configura Template</small></span>
                                                                            </a>
                                                                        </li> 
                                                                        <li class="<?=$GLOBALS['ActiveMenu']['anteprima_email']?>">
                                                                            <a href="<?=BASE_URL_SITO?>templates-anteprima_email/">
                                                                                <span class="pcoded-micon"></span>
                                                                                <span class="pcoded-mtext">Anteprima E-mail</span>
                                                                            </a>
                                                                        </li> 
                                                                        <?php
                                                                            $directory    = getDirectorySito(IDSITO);
                                                                            $id_richiesta = getLastPreventivo(IDSITO);
                                                                            $v = base64_encode($id_richiesta.'_'.IDSITO.'_p');
                                                                        ?>
                                                                        <?php if(check_view_by_name_template(IDSITO,'default')==true){?> 
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_default']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima  <small>T.</small> <small class="text-white">Default</small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>
                                                                        <?php if(check_view_by_name_template(IDSITO,'smart')==true){?> 
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_smart']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'smart/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white">Smart</small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?> 
                                                                        <?php if(check_view_template(IDSITO,'custom1')==true){?> 
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_custom1']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'custom1/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white"><?=ucfirst(get_name_template(IDSITO,'custom1'))?></small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>
                                                                        <?php if(check_view_template(IDSITO,'custom2')==true){?> 
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_custom2']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'custom2/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white"><?=ucfirst(get_name_template(IDSITO,'custom2'))?></small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>
                                                                        <?php if(check_view_template(IDSITO,'custom3')==true){?>  
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_custom3']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'custom3/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white"><?=ucfirst(get_name_template(IDSITO,'custom3'))?></small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>
                                                                        <?php if(check_view_template(IDSITO,'custom4')==true){?>  
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_custom4']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'custom4/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white"><?=ucfirst(get_name_template(IDSITO,'custom4'))?></small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>
                                                                        <?php if(check_view_template(IDSITO,'custom5')==true){?> 
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_custom5']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'custom5/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white"><?=ucfirst(get_name_template(IDSITO,'custom5'))?></small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>
                                                                        <?php if(check_view_template(IDSITO,'custom6')==true){?>  
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_custom6']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'custom6/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white"><?=ucfirst(get_name_template(IDSITO,'custom6'))?></small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>
                                                                        <?php if(check_view_template(IDSITO,'custom7')==true){?>   
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_custom7']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'custom7/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white"><?=ucfirst(get_name_template(IDSITO,'custom7'))?></small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>
                                                                        <?php if(check_view_template(IDSITO,'custom8')==true){?>   
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_custom8']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'custom8/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white"><?=ucfirst(get_name_template(IDSITO,'custom8'))?></small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>
                                                                        <?php if(check_view_template(IDSITO,'custom9')==true){?>   
                                                                            <li class="<?=$GLOBALS['ActiveMenu']['anteprima_custom9']?> nowrap">
                                                                                <a href="<?=BASE_URL_LANDING.'custom9/'.$directory.'/'.$v.'/index/'?>" target="_blank">
                                                                                    <span class="pcoded-micon"></span>
                                                                                    <span class="pcoded-mtext">Anteprima <small>T.</small> <small class="text-white"><?=ucfirst(get_name_template(IDSITO,'custom9'))?></small></span>
                                                                                </a>
                                                                            </li>
                                                                        <?}?>     
                                                                    </ul>
                                                                </li> 
                                                            </ul>
                                                        <?}?>



                                                    </li>   
                                        </ul>                                                


                                                <div class="pcoded-navigatio-lavel" id="Risorse">Risorse <?=NOME_AMMINISTRAZIONE?></div>
                                                     <li class="<?=$GLOBALS['ActiveMenu']['anagrafiche']?>">
                                                        <a href="<?=BASE_URL_SITO?>anagrafiche/">
                                                            <span class="pcoded-micon"><i class="fa fa-users text-white"></i></span>
                                                            <span class="pcoded-mtext">Rubrica Anagrafiche</span>
                                                        </a>
                                                    </li>
                                                <?if($permessi['SCHED']==1){?> 
                                                    <li class="pcoded-hasmenu <?=$attivo_checkin?>">
                                                        <a href="javascript:void(0)">
                                                            <span class="pcoded-micon"><i class="fa fa-vcard text-white"></i></span>
                                                            <span class="pcoded-mtext">Check-in OnLine <?=n_checkin()?></span>
                                                        </a>
                                                        <ul class="pcoded-submenu">
                                                            <li class="<?=$GLOBALS['ActiveMenu']['crea_proposta_esterna']?>">
                                                                <a href="<?=BASE_URL_SITO?>checkinonline-crea_proposta_esterna/">
                                                                    <span class="pcoded-micon"></span>
                                                                    <span class="pcoded-mtext">Aggiungi Pren.Esterne</span>
                                                                </a>
                                                            </li>  
                                                            <li class="<?=$GLOBALS['ActiveMenu']['prenotazioni_esterne']?>">
                                                                <a href="<?=BASE_URL_SITO?>checkinonline-prenotazioni_esterne/">
                                                                    <span class="pcoded-micon"></span>
                                                                    <span class="pcoded-mtext">Check-in Pren.Esterne</small></span>
                                                                </a>
                                                            </li>
                                                            <li class="<?=$GLOBALS['ActiveMenu']['schedine_alloggiati']?>">       
                                                                <a href="<?=BASE_URL_SITO?>checkinonline-schedine_alloggiati/">
                                                                    <span class="pcoded-micon"></span>
                                                                    <span class="pcoded-mtext">P.S.Schedine Alloggiati</span>
                                                                    <?=n_checkin()?>
                                                                </a>
                                                            </li> 
                                                            <li class="<?=$GLOBALS['ActiveMenu']['box_info']?>">       
                                                                <a href="<?=BASE_URL_SITO?>checkinonline-box_info/">
                                                                    <span class="pcoded-micon"></span>
                                                                    <span class="pcoded-mtext">Gestione Box Info Check-in</span>
                                                                </a>
                                                            </li> 
                                                        </ul>
                                                    </li>
                                                <?}?>
                                            <li class="<?=$GLOBALS['ActiveMenu']['newsletter/emessenger-index']?>">
                                                <a href="<?=BASE_URL_SITO?>newsletter/<?=URL_CLIENT_EMAIL?>-index/">
                                                    <span class="pcoded-micon"><img src="<?=BASE_URL_SITO?>img/emessenger.png" style="width:20px"></span>
                                                    <span class="pcoded-mtext"><?=NOME_CLIENT_EMAIL?> <span class="f-10">(Email Marketing)</span></span>
                                                </a>
                                            </li>
                                            <li class="<?=$GLOBALS['ActiveMenu']['prenotazioni']?>">
                                                <a data-toggle="tooltip" title="Editor per ridimensionare, croppare, tagliare le immagini" href="javascript: window.open('https://fengyuanchen.github.io/photo-editor','PhotoEditor','left=500,top=200,width=1024,height=768');">
                                                    <span class="pcoded-micon"><i class="fa fa-photo text-white"></i></span>
                                                    <span class="pcoded-mtext">Free Photo Editor</span>
                                                </a>
                                            </li>  
                                            <li class="<?=$GLOBALS['ActiveMenu']['prenotazioni']?>">
                                                <a data-toggle="tooltip" title="Editor per ripulire un testo word in html" href="javascript: window.open('https://www.wordhtml.com/','WordHtml','left=500,top=200,width=1024,height=768');">
                                                    <span class="pcoded-micon"><i class="fa fa-file-word-o text-white"></i></span>
                                                    <span class="pcoded-mtext">Free Editor <span class="f-10">for Clean Word/Html</span></span>
                                                </a>
                                            </li>                                            

                                                                         
                                                <?if($permessi['SCREEN']==1){?>
                                                    <div class="pcoded-navigatio-lavel" id="Screenshots">Screenshots <?=NOME_AMMINISTRAZIONE?></div>
                                                    <li class="<?=$GLOBALS['ActiveMenu']['screenshot']?>">
                                                        <a href="<?=BASE_URL_SITO?>screenshot/">
                                                            <span class="pcoded-micon"><i class="fa fa-laptop text-white"></i></span>
                                                            <span class="pcoded-mtext">Cosa vede il Cliente <small>(Fac simile)</small></span>
                                                        </a>
                                                    </li>
                                                <?}?>
                                                <?if($permessi['COMUNIC']==1){?>
                                                    <div class="pcoded-navigatio-lavel" id="NetworkService">Network Service</div>
                                                    <li class="<?=$GLOBALS['ActiveMenu']['partners']?>">
                                                        <a href="<?=BASE_URL_SITO?>partners/">
                                                            <span class="pcoded-micon"><i class="fa fa-users text-white"></i></span>
                                                            <span class="pcoded-mtext">I nostri partners integrati</span>
                                                        </a>
                                                    </li>
                                                    <li class="<?=$GLOBALS['ActiveMenu']['comunicazioni']?>">
                                                        <a href="<?=BASE_URL_SITO?>comunicazioni/">
                                                            <span class="pcoded-micon"><i class="fa fa-commenting-o text-white"></i></span>
                                                            <span class="pcoded-mtext">Riepilogo comunicazioni</span>
                                                        </a>
                                                    </li> 
                                                <?}?>                                    
                                                    <li class="<?=$GLOBALS['ActiveMenu']['privacy']?>">
                                                            <a href="https://www.iubenda.com/privacy-policy/173284/legal" class="iubenda-nostyle iubenda-embed" title="Privacy Policy">
                                                            <span class="pcoded-micon"><i class="fa fa-legal"></i></span>
                                                            <span class="pcoded-mtext">Privacy Policy</span>
                                                            </a>
                                                        <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
                                                    </li>
                                        </ul>
                                <?}?>
                        </div>
                    </nav>
