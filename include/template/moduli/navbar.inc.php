<?=check_data_password_overfade()?>
<nav  class="navbar header-navbar pcoded-header" id="header-nav">
                <div class="navbar-wrapper">

                    <div class="navbar-logo"  id="header-nav-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <div class="text-center" style="width:100%!important">  	
                            <a href="<?=BASE_URL_SITO?>dashboard-index/">
                                <img class="img-fluid" src="<?=BASE_URL_SITO?>class/resize.class.php?src=<?=BASE_PATH_SITO?>img/logo_white_border.png&w=150&h=0&a=c&q=100" alt="<?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?>" title="<?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?>"> 
                            </a>
                        </div>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen text-white"></i>
                                </a>
                            </li>
                            <!--- 
                                * -----------------------------------------------------------------------------------
                                * |  visibile solo per i clienti che hanno QUOTO prima della messa online della V.3  |
                                * -----------------------------------------------------------------------------------
                            -->
                            <?php if(DATA_ATTIVAZIONE < DATA_QUOTO_V3){?>
                            <li>
                                <a href="<?=BASE_URL_SITO?>v2/dashboard-index/" class="text-white f-11" id="change_ui">
                                    <span class="border-nav">  Passa alla vecchia interfaccia QUOTO! 
                                        <i class="fa fa-object-ungroup text-white"></i>
                                    </span>
                                </a>
                                <script>
                                    $(document).ready(function(){
                                        $("#change_ui").on("click",function(){
                                            $.ajax({
                                                url: "<?=BASE_URL_SITO?>ajax/log/cambio_interfaccia.php",
                                                type: "POST",
                                                data: "idsito=<?=IDSITO?>&ui=old",
                                                dataType: "html",
                                                success: function(msg) {
                                                        console.log("Passaggio alla vecchia interfaccia"); 
                                                    }
                                            });
                                            return true;
                                        });
                                    });
                                </script>                             
                            </li>
                            <li>
                                <script>
                                $(function () {
                                    var i = 0;
                                    var speed = 1000;
                                    link = setInterval(function () {
                                        i++;
                                        $(".lampeggiante").css("color", i%2 == 1 ? "#FFFFFF" : "#14b2e7");
                                    }, speed);
                                })
                                </script>
                                <?php
                                    $today = time();
                                    $event = mktime(0,0,0,10,01,2024);
                                    $countdown = round(($event - $today)/86400);
                                    echo '<span class="lampeggiante"><small><b class="p-r-10">&#10230;</b> '.$countdown.' gg. alla chiusura della vecchia UI</small></span>';
                                ?>
                            </li> 
                            <?}?>
                        </ul>
                        <ul class="nav-right">

                        <?php  if($_SERVER['REQUEST_URI']!='/grafici-statistiche_new/'){?>
                            <? 
                                if(($_SERVER['REQUEST_URI']=='/') || ($_SERVER['REQUEST_URI']=='/dashboard-index/') || ($_SERVER['REQUEST_URI']=='/index/')){
                                   // if(CHECKINONLINE!=1){
                                        echo check_comunicazioni();
                                   // }
                                }
                            ?>
                            <?php //echo data_scadenza_software()?>
                            <?php echo scadenza_software()?>
                            <?php echo guida()?>
                            <?php if(($_SERVER['REQUEST_URI']!='/preventivi/') && ($_SERVER['REQUEST_URI']!='/conferme/') && ($_SERVER['REQUEST_URI']!='/prenotazioni/')){ echo video_guida();} ?>
                             <?php if(($_SERVER['REQUEST_URI']!='/crea_proposta/') && ($_SERVER['REQUEST_URI']!='/modifica_proposta/edit/'.$_REQUEST['param'])){  ?>
                                <li class="header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                        <span class="border-nav f-11">Chat in attesa di risposta!  <i class="feather icon-message-square text-white"  data-toggle="tooltip" data-placement="left" title="Chat in attesa di risposta!"></i>
                                            <?php echo count_notify_chat(IDSITO)?></span>
                                        </div>
                                    </div>
                                </li> 
                            <? } ?>
                        <? } ?>
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="border-nav f-11">
                                            <?=(NOMEUTENTEACCESSI!=''?ucwords(NOMEUTENTEACCESSI):ucfirst((strlen(NOMEUTENTE)>2?NOMEUTENTE:USER)))?>
                                        </span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <?//$permessi = check_permessi();?>
                                        <?//if($permessi['UTENTI']==1){?>
                                       <!-- <li>
                                            <a href="<?=BASE_URL_SITO?>dati-profilo/">
                                                <i class="feather icon-user"></i> Profilo
                                            </a>
                                        </li> -->
                                    <?//}?>
                                    <? if(func_check_accessi(IDSITO)==1){?>
                                    <?php $ico = explode("#",ico_operatore(IDSITO,$_SESSION['user_accesso'])); $iconaUtente = $ico[0]; $nomeUtente = $ico[1]?>
                                        <li>
                                             <a href="javascript:;" onclick="vai_logout('<?=BASE_URL_SITO?>logout.php?provenienza=change_user&idsito=<?=IDSITO?>&nome_utente=<?=($nomeUtente!=''?ucwords($nomeUtente):ucfirst((strlen(NOMEUTENTE)>2?NOMEUTENTE:USER)))?>&icona_utente=<?=$iconaUtente?>');"> 
                                                <i class="feather icon-users"></i>  Cambia Utente
                                            </a>
                                        </li> 
                                    <?}?>
                                        <li>
                                            <a href="<?=BASE_URL_SITO?>logout.php">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                      
                    </div>
                </div>
            </nav>
                   <!-- Sidebar chat start -->
            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="card card_main p-fixed users-main">
                        <div class="user-box">
                            <div class="chat-inner-header">
                                <div class="back_chatBox">
                                    <div class="right-icon-control">
                                        Chat in attesa di risposta!
                                    </div>
                                </div>
                            </div>
                            <div class="main-friend-list">
                                <?=ckeck_notify_chat(IDSITO);?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="video"  role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content"  style="width:600px!important">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <iframe width="560" height="315" src=""  id="link" frameborder="0"  allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat start-->
         <!--   <div class="showChat_inner">

                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-chevron-left"></i> Nome Cognome
                    </a>
                </div>
                
                <div class="media chat-messages">
                    <div class="chat"></div>                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="/img/receptionists.png" alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">Conversazione tenuta in chat con il cliente</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="media chat-messages">
                    <div class="media-body chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">Conversazione tenuta in chat con il cliente</p>
                            <p class="chat-time">8:23 a.m.</p>
                        </div>
                    </div>
                    <div class="media-right photo-table">
                        <a href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="/img/avatar5.png" alt="Generic placeholder image">
                        </a>
                    </div>
                </div> 

            </div>-->
            <!-- Sidebar inner chat end-->
