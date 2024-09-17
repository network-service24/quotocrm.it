<?php
    //$attivo = 'pcoded-trigger';
    if( $GLOBALS['ActiveMenu']['clienti'] == 'active' ||
        $GLOBALS['ActiveMenu']['siti']    == 'active' ||
        $GLOBALS['ActiveMenu']['utenti']  == 'active'){
        $attivo = 'pcoded-trigger';
    }
    if( $GLOBALS['ActiveMenu']['report/index']                    == 'active'||
        $GLOBALS['ActiveMenu']['report/dashboard_report']         == 'active'||
        $GLOBALS['ActiveMenu']['report/archivio']                 == 'active'||
        $GLOBALS['ActiveMenu']['report/fatturato_telefono_quoto'] == 'active' ){
        $attivo_report = 'pcoded-trigger';
    }
?>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="pcoded-inner-navbar main-menu">
                    <div class="col-xl-12 col-md-12 text-center">
                    <div class="clearfix p-t-10"></div>
                    <?php if(AVATAR!=''){?>
                            <img src="<?=BASE_URL_SITO?>uploads/loghi_superuser/<?=AVATAR?>" class="img-circle-small" data-toogle="tooltip" title="<?=ucwords(NOMEUTENTE)?>">
                        <?}else{?>
                            <img src="<?=BASE_URL_SITO?>img/avatar5.png" class="img-circle-small" data-toogle="tooltip" title="<?=ucwords(NOMEUTENTE)?>">
                        <?}?>
                    </div>
                    <div class="col-xl-12 col-md-12 text-center">
                        <p class="text-white"><?=NOMEUTENTE?></p>
                        <a role="button" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="useronline"><i class="fa fa-circle text-success"></i> <span class="text-white">Utente Online</span></a>                           
                    </div>

                    <div class="pcoded-navigatio-lavel" id="GestioneQuoto">Gestione <?=NOME_AMMINISTRAZIONE?></div>
                        
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="<?=$GLOBALS['ActiveMenu']['index']?>">
                                <a href="<?=BASE_URL_ADMIN?>index/">
                                    <span class="pcoded-micon"><i class="fa fa-dashboard text-white"></i></span>
                                    <span class="pcoded-mtext">Dashboard</span>
                                </a>
                            </li> 
                            <li class="pcoded-hasmenu pcoded-trigger">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="fa fa-slack text-white"></i></span>
                                    <span class="pcoded-mtext">Anagrafiche</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="<?=$GLOBALS['ActiveMenu']['clienti']?>">
                                        <a href="<?=BASE_URL_ADMIN?>clienti/">
                                            <span class="pcoded-micon"><i class="fa fa-user text-white"></i></span>
                                            <span class="pcoded-mtext">Ragioni Sociali</span>
                                        </a>
                                    </li>  
                                    <li class="<?=$GLOBALS['ActiveMenu']['siti']?>">
                                        <a href="<?=BASE_URL_ADMIN?>siti/">
                                            <span class="pcoded-micon"><i class="fa fa-desktop text-white"></i></span>
                                            <span class="pcoded-mtext">Siti Web</span>
                                        </a>
                                    </li>
                                    <li class="<?=$GLOBALS['ActiveMenu']['utenti']?>">
                                        <a href="<?=BASE_URL_ADMIN?>utenti/">
                                            <span class="pcoded-micon"><i class="fa fa-users text-white"></i></span>
                                            <span class="pcoded-mtext">Utenti <?=NOME_AMMINISTRAZIONE?></span>
                                        </a>
                                    </li>  
                                </ul> 
                            </li>   
                            <li class="pcoded-hasmenu <?=$attivo_report?>">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-bar-chart text-primary"></i></span>
                                        <span class="pcoded-mtext">Report Clienti</span>
                                    </a>
                                <ul class="pcoded-submenu">
                                    <li class="<?=$GLOBALS['ActiveMenu']['report/index']?>">
                                        <a href="<?=BASE_URL_ADMIN?>report/index/">
                                            <span class="pcoded-micon"><i class="fa fa-bar-chart text-orange"></i></span>
                                            <span class="pcoded-mtext">Report</span>
                                        </a>
                                    </li>   
                                    <li class="<?=$GLOBALS['ActiveMenu']['report/archivio']?>">
                                        <a href="<?=BASE_URL_ADMIN?>report/archivio/">
                                        <span class="pcoded-micon"><i class="fa fa-line-chart text-info"></i> </span>
                                            <span class="pcoded-mtext">Archivio</small></span>
                                        </a>
                                    </li> 
                                    <li class="<?=$GLOBALS['ActiveMenu']['report/fatturato_telefono_quoto']?>">
                                        <a href="<?=BASE_URL_ADMIN?>report/fatturato_telefono_quoto/">
                                        <span class="pcoded-micon"><i class="fa fa-line-chart text-info"></i> </span>
                                            <span class="pcoded-mtext">Rel.Campagne Telefono</small></span>
                                        </a>
                                    </li> 
                                </ul>
                            </li>              
                            <li class="<?=$GLOBALS['ActiveMenu']['uso_quoto']?>">
                                <a href="<?=BASE_URL_ADMIN?>uso_quoto/">
                                    <span class="pcoded-micon"><i class="fa fa-quora text-white"></i></span>
                                    <span class="pcoded-mtext">Analisi Uso</span>
                                </a>
                            </li>
                            <li class="<?=$GLOBALS['ActiveMenu']['confronti_fatturato']?>">
                                <a href="<?=BASE_URL_ADMIN?>confronti_fatturato/">
                                    <span class="pcoded-micon"><i class="fa fa-euro text-white"></i></span>
                                    <span class="pcoded-mtext">Confronti Fatturato</span>
                                </a>
                            </li>
                            <!--
                            <li class="<?=$GLOBALS['ActiveMenu']['filtro_conferme_quoto']?>">
                                <a href="<?=BASE_URL_ADMIN?>filtro_conferme_quoto/">
                                    <span class="pcoded-micon"><i class="fa fa-search text-white"></i></span>
                                    <span class="pcoded-mtext">Filtro <small>Conferme/Prenotazioni</small></span>
                                </a>
                            </li>
                            -->
                            <li class="<?=$GLOBALS['ActiveMenu']['filtro_quoto']?>">
                                <a href="<?=BASE_URL_ADMIN?>filtro_quoto/">
                                    <span class="pcoded-micon"><i class="fa fa-file-excel-o text-white"></i></span>
                                    <span class="pcoded-mtext">Profila Esporta</span>
                                </a>
                            </li>
                            <li class="<?=$GLOBALS['ActiveMenu']['filtro_quoto_emessenger']?>">
                                <a href="<?=BASE_URL_ADMIN?>filtro_quoto_emessenger/">
                                    <span class="pcoded-micon"><i class="fa fa-file-excel-o text-white"></i></span>
                                    <span class="pcoded-mtext">Esport <?=NOME_CLIENT_EMAIL?></span>
                                </a>
                            </li>
                            <li class="<?=$GLOBALS['ActiveMenu']['file_log_quoto']?>">
                                <a href="<?=BASE_URL_ADMIN?>file_log_quoto/">
                                    <span class="pcoded-micon"><i class="fa fa-code text-white"></i></span>
                                    <span class="pcoded-mtext">Log Accessi</span>
                                </a>
                            </li>
                            <li></li>
                            <li class="<?=$GLOBALS['ActiveMenu']['comunicazioni']?>">
                                <a href="<?=BASE_URL_ADMIN?>comunicazioni/">
                                    <span class="pcoded-micon"><i class="fa fa-comments text-white"></i></span>
                                    <span class="pcoded-mtext">Comunicazioni ai clienti</span>
                                </a>
                            </li>
                        </ul>
                        <div class="pcoded-navigatio-lavel" id="Administrator">Administrator</div>
                         <ul class="pcoded-item pcoded-left-item">
                            <li class="<?=$GLOBALS['ActiveMenu']['superuser']?>">
                                <a href="<?=BASE_URL_ADMIN?>superuser/">
                                    <span class="pcoded-micon"><i class="fa fa-users text-white"></i></span>
                                    <span class="pcoded-mtext">Super User</span>
                                </a>
                            </li> 
                        </ul>
            </div>
        </nav>