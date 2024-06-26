<?php
if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
    // ON LOAD NOTIFICHE TICKET RICEVUTI PER TUTTE LE PAGINE
    echo (tot_ticket_risposta(IDSITO,1)>0?'<script>$( document ).ready(function() {open_notifica("Ciao <b>'.NOMEHOTEL.'</b> hai <b class=\"text16\">'.tot_ticket_risposta(IDSITO,1).'</b> tickets di risposta, controlla!"," ","plain","bottom-right","error",5000,"#00acc1");});</script>':'');
    // ON MOUSEOVER UNA VOLTA SOLA NOTIFICHE PREVENTIVI
    echo (n_preventivi_send(1)>0?'
    <script>
                $( document ).ready(function(){
                    $("#notify_preventivi").one("mouseover",function(){
                        open_notifica("Ciao <b>'.NOMEHOTEL.'</b> ricordati che hai ancora <b class=\"text16\">'.n_preventivi_send(1).'</b> preventivi da inviare"," ","plain","bottom-right","maroon",5000,"#00acc1");
                    });
                });
            </script>':'')."\r\n";
    // ON MOUSEOVER UNA VOLTA SOLA NOTIFICHE CONFERME
    echo (n_conferme_send(1)>0?'
        <script>
            $( document ).ready(function() {
                $("#notify_conferme").one("mouseover",function(){
                    open_notifica("Ciao <b>'.NOMEHOTEL.'</b> ricordati che hai ancora <b class=\"text16\">'.n_conferme_send(1).'</b> conferme da inviare"," ","plain","bottom-right","success",5000,"#ff6849");
                });
            });
        </script>':'')."\r\n";
    // ON MOUSEOVER UNA VOLTA SOLA NOTIFICHE QUESTIONARIO
    echo (n_notifiche_cs(1)>0?'
        <script>
            $( document ).ready(function() {
                $("#notify_cs").one("mouseover",function(){
                    open_notifica("Ciao <b>'.NOMEHOTEL.'</b> oggi sono arrivati <b class=\"text16\">'.n_notifiche_cs(1).'</b> giudizi finali"," ","plain","bottom-right","light-blue",5000,"#ff6849");
                });
            });
        </script>':'')."\r\n";
    // ON MOUSEOVER UNA VOLTA SOLA NOTIFICHE SCHEDINE CHECKIN
    echo (n_checkin(1)>0?'
        <script>
            $( document ).ready(function() {
                $("#notify_schedine").one("mouseover",function(){
                    open_notifica("Ciao <b>'.NOMEHOTEL.'</b> oggi sono stati compilati <b class=\"text16\">'.n_checkin(1).'</b>  checkin online"," ","plain","bottom-right","warning",5000,"#ff6849");
                });
            });
        </script>':'')."\r\n";
    // ON MOUSEOVER UNA VOLTA SOLA NOTIFICHE TICKET
    echo (tot_ticket_risposta(IDSITO,1)>0?'
        <script>
            $( document ).ready(function() {
                $("#notify_ticket").one("mouseover",function(){
                    open_notifica("Ciao <b>'.NOMEHOTEL.'</b> hai <b class=\"text16\">'.tot_ticket_risposta(IDSITO,1).'</b> tickets di risposta"," ","plain","bottom-right","error",5000,"#00acc1");
                });
            });
        </script>':'')."\r\n";
}
echo'<script language=javascript>
        $(document).ready(function() {
            var i = 0;
            var speed = 500;
            link = setInterval(function() {
                i++;
                $(".lampeggiante").css(\'color\', i%2 == 1 ? \'#FFFFFF\' : \'#00acc1\');
            },speed);
        });
    </script>'."\r\n";
switch($_SERVER['REQUEST_URI']){
    case "/v2/dashboard-index/":
    case "/v2/index/":
        echo'<link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">'."\r\n";
        echo'<link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/daterangepicker/daterangepicker-bs3.css">'."\r\n";
        echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>'."\r\n";
        echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>'."\r\n";
        echo'<script src="'.BASE_URL_SITO.'material/assets/plugins/echarts/echarts-all.js"></script>'."\r\n";


    break;

    case "/v2/modulo_hospitality/":
    case "/v2/modulo_simplebooking/":
    case "/v2/modifica_modulo_hospitality/edit/".$_REQUEST['param']:
    case "/v2/modifica_modulo_hospitality/edit/".$_REQUEST['param']."/".$_REQUEST['valore']:

            echo'<link rel="stylesheet" type="text/css" href="'.BASE_URL_SITO.'css/animate.min.css" />'."\r\n";
            echo'<link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/daterangepicker/moment.min.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'js/jquery.validate.min.js" type="text/javascript"></script>'."\r\n";
            echo'<script>
                $().ready(function() {
                    // validate signup form on keyup and submit
                    $("#ctrl_form").validate({
                        rules: {
                            TipoRichiesta:{
                                required: true,
                                minlength: 1
                            },
                            ChiPrenota:{
                                required: true,
                                minlength: 1
                            },
                            Nome: "required",
                            Cognome: "required",
                            Email: "required",
                            DataArrivo: "required",
                            DataPartenza: "required",
                            DataScadenza:{
                                required: true,
                                minlength: 3
                            }


                        },
                        messages: {
                            TipoRichiesta: "",
                            ChiPrenota: "",
                            Nome: "",
                            Cognome: "",
                            Email: "",
                            DataArrivo: "",
                            DataPartenza: "",
                            DataScadenza: ""

                        }
                    });
                    //modulo loading form crea proposta
                    $("#ctrl_form").on("submit",function(){
                        if ($(this).valid()){
                            $("#view_form_loading").html(\'<div class="clearfix">&nbsp;</div><div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.gif" alt="Salvataggio in corso"></div></div><div class="row"><div class="col-md-12 text-center"><small>Salvataggio in corso..., attendere il suo termine!</small></div></div><div class="clearfix"  style="height:10px">&nbsp;</div>\');
                            $("#bottone_salva").hide();
                        }
                    })

                    //modulo per contenuti email
                    $("#ctrl_mail").validate({
                        rules: {
                            \'TipoRichiesta\':{
                                required: true,
                                minlength: 1
                            },
                            Lingua: "required",
                            Oggetto: "required",
                            Messaggio: "required"

                        },
                        messages: {
                                \'TipoRichiesta\': "",
                            Lingua: "",
                            Oggetto: "",
                            Messaggio: ""

                        }
                    });
                });
                </script>'."\r\n";
            echo'<style>
                    div.error { display: none; }
                    input.error { border:2px dashed red !important; }
                    select.error { border:2px dashed red !important; }
                </style>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'js/draggabilly.js"></script>'."\r\n";
            echo'<link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/chosen/chosen.css">'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'js/jquery.price_format.2.0.js"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'js/accounting.min.js"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/chosen/chosen.jquery.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>'."\r\n";
            echo'<link href="'.BASE_URL_SITO.'material/assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'material/assets/plugins/switchery/dist/switchery.min.js"></script>'."\r\n";
            echo'<script>
                            $().ready(function() {
                            var elems = Array.prototype.slice.call(document.querySelectorAll(\'.js-switch\'));
                            $(\'.js-switch\').each(function() {
                                new Switchery($(this)[0], { color: \'#00acc1\'
                                                        , secondaryColor    : \'#dfdfdf\'
                                                        , jackColor         : \'#fff\'
                                                        , jackSecondaryColor: null
                                                        , className         : \'switchery\'
                                                        , disabled          : false
                                                        , disabledOpacity   : 0.5
                                                        , speed             : \'0.1s\'
                                                        , size              : \'small\' });

                            });
                        });
                </script>'."\r\n";
            echo'<script src="' .BASE_URL_SITO. 'material/assets/plugins/typeahead.js-master/dist/typeahead.jquery.min.js"></script>'."\r\n";
        break;

        case "/v2/grafici-statistiche/":
        case "/v2/grafici-statistiche3/":
        case "/v2/grafici-statistiche_new/":
        case "/v2/grafici-facebook/":
        case "/v2/grafici-facebook_ads/":
        case "/v2/grafici-facebook_ads_nws/":
        case "/v2/grafici-facebook_ads_new/":
        case "/v2/grafici-ppc/":
        case "/v2/grafici-ppc_ads/":
        case "/v2/grafici-ppc_ads_nws/":
        case "/v2/grafici-ppc_ads_new/":
        case "/v2/grafici-newsletter_ads_new/":
        case "/v2/grafici-statistiche_voucher/":
            echo'<script src="'.BASE_URL_SITO.'material/assets/plugins/echarts/echarts-all.js"></script>'."\r\n";
            echo'<link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>'."\r\n";
        break;
        case "/v2/giudizio_finale/":

            echo'<link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>'."\r\n";
            echo'<link href="'.BASE_URL_SITO.'js/MDB/css/addons/datatables.css" rel="stylesheet">'."\r\n";
            echo'<script type="text/javascript" src="'.BASE_URL_SITO.'js/MDB/js/addons/datatables.js"></script>'."\r\n";
        break;
        case "/v2/grafici-anagrafiche_clienti/":
        case "/v2/grafici-anagrafiche_clienti/op/":
        case "/v2/grafici-timeline_cliente/":
        case "/v2/grafici-fatturato_telefono/":
            echo'<link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>'."\r\n";
            echo'<link href="'.BASE_URL_SITO.'js/MDB/css/addons/datatables.css" rel="stylesheet">'."\r\n";
            echo'<script type="text/javascript" src="'.BASE_URL_SITO.'js/MDB/js/addons/datatables.js"></script>'."\r\n";
        break;
        case "/v2/newsletter/".URL_CLIENT_EMAIL."-index/":
        case "/v2/newsletter/".URL_CLIENT_EMAIL."-visualizza_modelli/":
        case "/v2/newsletter/".URL_CLIENT_EMAIL."-stats_newsletter/":

            echo'<link href="'.BASE_URL_SITO.'js/MDB/css/addons/datatables.css" rel="stylesheet">'."\r\n";
            echo'<script type="text/javascript" src="'.BASE_URL_SITO.'js/MDB/js/addons/datatables.js"></script>'."\r\n";

            echo'<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">'."\r\n";
            echo'<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>'."\r\n";

            echo'<link href="'.BASE_URL_SITO.'js/MDB/css/addons/datatables-select.css" rel="stylesheet">'."\r\n";
            echo'<script type="text/javascript" src="'.BASE_URL_SITO.'js/MDB/js/addons/datatables-select.js"></script>'."\r\n";

            echo'<link href="'.BASE_URL_SITO.'material/assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'material/assets/plugins/switchery/dist/switchery.min.js"></script>'."\r\n";
            echo'<script>
                            $().ready(function() {
                            var elems = Array.prototype.slice.call(document.querySelectorAll(\'.js-switch\'));
                            $(\'.js-switch\').each(function() {
                                new Switchery($(this)[0], { color: \'#00acc1\'
                                                        , secondaryColor    : \'#dfdfdf\'
                                                        , jackColor         : \'#fff\'
                                                        , jackSecondaryColor: null
                                                        , className         : \'switchery\'
                                                        , disabled          : false
                                                        , disabledOpacity   : 0.5
                                                        , speed             : \'0.1s\'
                                                        , size              : \'small\' });

                            });
                        });
                </script>'."\r\n";
        break;
        case "/v2/newsletter/".URL_CLIENT_EMAIL."-crea/":
                echo'<script src="'.BASE_URL_SITO.'js/jquery.validate.min.js" type="text/javascript"></script>'."\r\n";
                echo'<script>
                    $().ready(function() {
                        // validate signup form on keyup and submit
                        $("#form_mail").validate({
                            rules: {
                                oggetto:{
                                    required: true,
                                    minlength: 3
                                }
                            },
                            messages: {
                                oggetto: ""
                            }
                        });
                    });
                    </script>'."\r\n";
                echo'<style>
                        div.error { display: none; }
                        input.error { border:2px dashed red !important; }
                        select.error { border:2px dashed red !important; }
                    </style>'."\r\n";
        break;
        case "/v2/accessi-utenti/add/":
        case "/v2/accessi-utenti/edit/".$_REQUEST['param']:
            echo'<link href="'.BASE_URL_SITO.'material/assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'material/assets/plugins/switchery/dist/switchery.min.js"></script>'."\r\n";
            echo'<script>
                     $().ready(function() {
                        var elems = Array.prototype.slice.call(document.querySelectorAll(\'.js-switch\'));
                        $(\'.js-switch\').each(function() {
                            new Switchery($(this)[0], { color: \'#00acc1\'
                                                    , secondaryColor    : \'#dfdfdf\'
                                                    , jackColor         : \'#fff\'
                                                    , jackSecondaryColor: null
                                                    , className         : \'switchery\'
                                                    , disabled          : false
                                                    , disabledOpacity   : 0.5
                                                    , speed             : \'0.1s\'
                                                    , size              : \'small\' });

                        });
                    });
            </script>'."\r\n";
        break;

        case "/v2/anteprima_email/":
        case "/v2/templates-anteprima_email/":
            echo'<link rel="stylesheet" type="text/css" href="'.BASE_URL_SITO.'css/animate.min.css" />'."\r\n";
        break;

        case "/v2/templates-grafiche/":
            echo'<link href="'.BASE_URL_SITO.'lib/bootstrap-colorselector-0.2.0/css/bootstrap-colorselector.css" rel="stylesheet" />'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'lib/bootstrap-colorselector-0.2.0/js/bootstrap-colorselector.js"></script>'."\r\n";
        break;

        case "/v2/generiche-punti_interesse/":

               echo'<style>.xcrud-list-container{overflow-x: visible!important;}</style>'."\r\n";
        break;
        case "/v2/disponibilita-camere/":
            if(check_pms(IDSITO)!='0'){
             echo'<style>.xcrud-list-container {
                        overflow-x: visible!important;
                </style>'."\r\n"; 
            }
        break;
        case "/v2/preventivi/":
        case "/v2/prenotazioni/":
        case "/v2/archivio/":
        case "/v2/cestino/":
        case "/v2/buoni_voucher/":
            echo"<script>
                    $( document ).ready(function() {
                    $('#checkAll').on('click', function () {
                        if($(\"input[name='Id']\").prop('checked')==false) {
                                $(\"input[name='Id']\").prop('checked', true);
                                $('#checkAll').html('<small><i class=\"fa fa-square-o\"></i> Togli selezione a tutti</small>');
                        }else{
                                $(\"input[name='Id']\").prop('checked', false);
                                $('#checkAll').html('<small><i class=\"fa fa-check-square-o\"></i> Seleziona tutti</small>');
                        }

                    });

                        $('#checkAllOp').on('click', function () {
                            if($(\"input[name='IdPrev']\").prop('checked')==false) {
                                $(\"input[name='IdPrev']\").prop('checked', true);
                                $('#checkAllOp').html('<small><i class=\"fa fa-square-o\"></i> Togli selezione a tutti per assegnare operatore</small>');
                            }else{
                                $(\"input[name='IdPrev']\").prop('checked', false);
                                $('#checkAllOp').html('<small><i class=\"fa fa-check-square-o\"></i> Seleziona tutti per assegnare operatore</small>');
                            }

                        });
                    });
                </script>"."\r\n";
            echo"<style>
                    th.xcrud-column{
                        font-size:90%!important;
                    }
                </style>"."\r\n";
        break;
        case "/v2/checkinonline-add_checkin_online/":
        case "/v2/checkinonline-mod_checkin_online/edit/".$_REQUEST['param']:
            echo'<link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.BASE_URL_SITO.'js/jquery.validate.min.js" type="text/javascript"></script>'."\r\n";
            echo'<script>
                    $(document).ready(function() {
                        // validate signup form on keyup and submit
                        $("#checkin_form").validate({
                            rules: {
                                Prefisso: "required",
                                ChiPrenota:{
                                    required: true,
                                    minlength: 1
                                },
                                Nome: "required",
                                Cognome: "required",
                                TipoVacanza: "required",
                                DataArrivo: "required",
                                DataPartenza: "required",
                                NumeroAdulti: "required",
                                FontePrenotazione: "required"
                            },
                            messages: {
                                Prefisso: " ",
                                ChiPrenota: " ",
                                Nome: " ",
                                Cognome: " ",
                                TipoVacanza: " ",
                                DataArrivo: " ",
                                DataPartenza: " ",
                                NumeroAdulti: " ",
                                FontePrenotazione: " "
                            }
                        });
                        //modulo loading form crea proposta
                        $("#checkin_form").on("submit",function(){
                            if ($(this).valid()){
                                $("#view_form_loading").html(\'<div class="clearfix">&nbsp;</div><div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.gif" alt="Salvataggio in corso"></div></div><div class="row"><div class="col-md-12 text-center"><small>Salvataggio in corso..., attendere il suo termine!</small></div></div><div class="clearfix"  style="height:10px">&nbsp;</div>\');
                                $("#bottone_salva").hide();
                            }
                        })
                    })
                </script>'."\r\n";
        break;
        case "/v2/setting-form/":
            echo'<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">'."\r\n";
            echo'<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>'."\r\n";
        break;
}
if(stripos($_SERVER['HTTP_USER_AGENT'],"Firefox")!==false) {
    echo '<style>
                .h-w-input-mozilla {
                height: auto!important;
                // width: auto!important;
                line-height:12px!important;
                }
            </style>';
    }
?>
