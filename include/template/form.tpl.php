<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5> Gestione Form per il vostro sito e/o landing page dedicate</h5>                                              

                                            </div>
                                            <div class="card-block">
                                                <div class="card-block accordion-block">
                                                    <?if(IS_NETWORK_SERVICE_USER == 1){?>  
                                                        <p>
                                                            <?if(check_form_exists(IDSITO)==0){?>
                                                            
                                                                <span class="f-14"><b>STEP per creare il FORM</b> </span>
                                                                <ul class="f-14">
                                                                    <li><span class="f-14">Inserire prima le lingue che sono presenti nel sito del cliente</span></li>
                                                                    <li><span class="f-14">Cliccare sul pulsante <b>"Crea Form"</b></span></li>
                                                                    <li><span class="f-14">Tornando in quest'area <b>"Form Sito/Landing"</b> si ha la piena gestione autonoma del form</span></li>
                                                                </ul>
                                                            
                                                            <?}else{?>
                                                                <div class="text-right">Form [ID] <span class="f-18 f-w-600"><?=getIdForm(IDSITO)?></span></div>
                                                            <?}?>
                                                        </p>
                                                    <?}?>
                                                        <?php if(check_form_exists(IDSITO)==1){?>
                                                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                                                <div class="accordion-panel">
                                                                    <div class="accordion-heading" role="tab" id="headingZero">
                                                                        <h4 class="card-title accordion-title">
                                                                            <a class="p-t-30 p-l-0 p-b-30 accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseZero" aria-expanded="false" aria-controls="collapseZero">
                                                                                <i class="fa fa-link"></i>&nbsp;&nbsp;<span class="text-black" style="font-weight:normal!important">CheckBox utile per abilitare l'uso delle voci di soggiorno e camere nel form del proprio sito tramite API
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseZero" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                                                                    <div class="row">
                                                                        <div class="col-md-4"></div>
                                                                        <div class="col-md-4">
                                                                            <form name="abilita_api" id="abilita_api">
                                                                                <div class="form-group">  
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 text-right">
                                                                                            <label>Abilita API</label>
                                                                                        </div>
                                                                                        <div class="col-md-1 text-left">                                            	                                                     
                                                                                            <input type="checkbox" class="form-control" id="API_hospitality" name="API_hospitality" value="<?=$ChekAPI?>" <?=($ChekAPI==1?'checked="checked"':'')?> />                                                             
                                                                                        </div>
                                                                                        <div class="col-md-5 text-left">                                            	                                                     
                                                                                            <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                            </form>
                                                                            <div id="result_api"></div>
                                                                            <script>
                                                                                $(document).ready(function(){ 
                                                                                    $("#API_hospitality").click(function() {
                                                                                        if($("#API_hospitality").is(":checked")){
                                                                                            $("#API_hospitality").attr("value","1");
                                                                                        }else{
                                                                                            $("#API_hospitality").attr("value",false);
                                                                                            $("#API_hospitality").attr("checked",false);
                                                                                        }
                                                                                    });
                                                                                    $("#abilita_api").submit(function(){   
                                                                                        var api = $("#API_hospitality").val();                                                                                    
                                                                                        $.ajax({
                                                                                            url: "<?=BASE_URL_SITO?>ajax/form/switch_api.php",
                                                                                            type: "POST",
                                                                                            data: "action=switch_api&idsito=<?=IDSITO?>&api="+api,
                                                                                            dataType: "html",
                                                                                            success: function(data) {
                                                                                                $("#result_api").html('<div class="alert alert-info text-black text-center f-11">Dati salvati con successo!</div>');    
                                                                                                setTimeout(function() { 
                                                                                                    $("#result_api").hide();
                                                                                                }, 2000);
                                                                                            }
                                                                                        });
                                                                                        return false;
                                                                                    });
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                        <div class="col-md-4"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="accordion-panel">
                                                                    <div class="accordion-heading" role="tab" id="headingOne">
                                                                        <h4 class="card-title accordion-title">
                                                                        <a class="p-t-30 p-l-0 accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                                            <i class="fa fa-link"></i>&nbsp;&nbsp;<span class="text-black" style="font-weight:normal!important">Codice utile per inserire il form nel sito
                                                                        </a>
                                                                    </h4>
                                                                    </div>
                                                                    <div id="collapseOne" class="p-t-20 panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                                                                        <div class="accordion-content accordion-desc">
                                                                             <b>FUNZIONE PHP</b><br>
                                                                            <span class="text-info">Con questa FUNZIONE PHP è possibile avere il tracciamento delle campagne ADS (facebook, Google, Newsletter) con Analytics integrato in QUOTO</span><br>
                                                                            Il sito e/o landing che include questo codice neccessità del framework <b>BootStrap 5 </b><br>
                                                                            <script src="<?=BASE_URL_SITO?>apiForm/js/clipboard.js"></script>
                                                                            <script> var clipboard = new ClipboardJS('#FQ2fa');</script>	
                                                                                                <i class="fa fa-code"></i>&nbsp;<b>Codice per includere il FORM di QUOTO nel sito e/o nelle landing page</b>&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>&nbsp;&nbsp;
                                                                            <p>Copia ed incolla il codice nella pagina dove vuoi il form&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
                                                                                                &nbsp;&nbsp;<a href="javascript:;" id="FQ2fa" data-clipboard-action="copy" data-clipboard-target="#FQ2" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copia ed incolla</a>
                                                                                    </p>
                                                                                    <pre id="FQ2" style="background-color:#F7FBF5!important;">&lt;?php
                                                                                    /** 
                                                                                    * $urlback statico 
                                                                                    * $urlback      = '<?=HTTPHEADER.SITOWEB?>/pagina_di_atterraggio';
                                                                                    */
                                                                                    /** Calcolo del $urlback dinamico */
                                                                                    $provenienza_ = explode("?",$_SERVER['REQUEST_URI']);
                                                                                    $provenienza  = $provenienza_[0];
                                                                                    $urlback      = '<?=HTTPHEADER.SITOWEB?>'.$provenienza;
                                                                                    $id_form      = <?=$id_form?>; 
                                                                                    $idsito       = <?=IDSITO?>;
                                                                                    $language     = 'it';
                                                                                    $captcha      = 0;  
                                                                                    $jquery       = 1;
                                                                                    $fontawesome  = 1; 
                                                                                    $bootstrap    = 0;

                                                                                    function print_form($api,$id_form,$idsito,$language,$captcha,$jquery,$fontawesome,$bootstrap,$urlback,$res,$tracking,$_ga,$NumeroPrenotazione,$testo_form){

                                                                                        $campi = array(
                                                                                                'id_form'            => $id_form,       
                                                                                                'idsito'             => $idsito,         
                                                                                                'language'           => $language,                  
                                                                                                'captcha'            => $captcha,  
                                                                                                'jquery'             => $jquery,                 
                                                                                                'fontawesome'        => $fontawesome,
                                                                                                'bootstrap'          => $bootstrap,
                                                                                             'urlback'            => $urlback, 
                                                                                                'res'                => $res,
                                                                                                'tracking'           => urlencode($_SERVER['REQUEST_URI']),
                                                                                                '_ga'                => urlencode($_COOKIE['_ga']),
                                                                                                'NumeroPrenotazione' => $_REQUEST['NumeroPrenotazione'],
                                                                                                'testo_form'         => $_REQUEST['testo_form'],	
                                                                                                'tracking'           => urlencode($_SERVER['REQUEST_URI'])	  
                                                                                                );

                                                                                        $variabili = '';
                                                                                        foreach ($campi as $k => $v) {
                                                                                            $variabili .= $k . '=' . urlencode($v) . '&';
                                                                                        }
                                                                                        rtrim($variabili, '&');

                                                                                        $ch = curl_init();
                                                                                        curl_setopt($ch, CURLOPT_URL, $api);
                                                                                        curl_setopt($ch, CURLOPT_HEADER, 0);
                                                                                        curl_setopt($ch, CURLOPT_POST, true );
                                                                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $variabili );
                                                                                        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                                                                                        curl_setopt($ch, CURLOPT_REFERER,(json_encode($_SESSION['navigation'])));
                                                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                                        $output = curl_exec($ch);
                                                                                        curl_close($ch);
                                                                                        if ($output) echo $output;
                                                                                            else echo FALSE;
                                                                                    }

                                                                                    print_form('<?=BASE_URL_SITO?>apiForm/get_form.php',$id_form,$idsito,$language,$captcha,$jquery,$fontawesome,$bootstrap,$urlback,$_REQUEST['res'],$tracking,$_REQUEST['_ga'],$_REQUEST['NumeroPrenotazione'],$_REQUEST['testo_form']);
                                                                                    ?&gt;</pre>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <h5><b>LEGENDA:</b> valore e posizione di ogni variabile impostabile nella chiamata della funzione <b>print_form();</b></h5>
                                                                                            <ul>
                                                                                                <ol>1)  'Indirizzo della API'</ol>
                                                                                                <ol>2)  'Id del Form', che viene rilasciato dal software in automatico</ol>
                                                                                                <ol>3)  'Id del sito', che viene rilasciato dal software in automatico</ol> 
                                                                                                <ol>4)  'Lingua' <small class="text-info">(Italiano = 'it', Inglese = 'en', Francese = 'fr', Tedesco = 'de', Spagnolo = 'es', Russo = 'ru', Olandese = 'nl', Polacco = 'pl, Ungherese = 'hu', Portoghese = 'pt', Arabo = 'ae', Ceco = 'cz', Cinese = 'cn', Brasiliano = 'br', Giapponese = 'jp')</small></ol>
                                                                                                <ol>5)  'Captcha' <small class="text-info">(1 attivo 0 non attivo)</small></ol>
                                                                                                <ol>6)  'Jquery' <small class="text-info">(1 attivo 0 non attivo)</small></ol>
                                                                                                <ol>7)  'Fontawesome' <small class="text-info">(1 attivo 0 non attivo)</small></ol>
                                                                                                <ol>8)  'Bootstrap' <small class="text-info">(1 attivo 0 non attivo) per includere le librerie bootstrap 5</small></ol>
                                                                                                <ol>9)  'Url di ritorno post invio form' <small class="text-info">(potrebbe essere anche la stessa nella quale si stampa a video il form)</small></ol>
                                                                                                <ol>10)  'questo campo è utile alla funzione <small class="text-danger">(NON MODIFICARLO)</small></ol>
                                                                                                <ol>11) 'questo campo è utile per il tracciamento ads con il sistema nativo di QUOTO <small class="text-danger">(NON MODIFICARLO)</small></ol>
                                                                                                <ol>12) 'questo campo è il COOKIE _GA di Google Analytics utile per il tracciamento delle campagne ADS e la sincronia API tra Analytics e QUOTO <small class="text-danger">(NON MODIFICARLO)</small></ol>
                                                                                                <ol>13) 'questo campo è l'assegnazione automatica post invio form del Numero di Prenotazione di QUOTO <small class="text-danger">(NON MODIFICARLO)</small></ol>
                                                                                                <ol>14) 'questo campo è utile alla funzione <small class="text-danger">(NON MODIFICARLO)</small></ol>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br />
                                                                                    <b>FUNZIONE E SETTING DEL PLUGIN IUBENDA PER WP</b> (screenshots)
                                                                                    <br />
                                                                                    <img src="<?=BASE_URL_SITO?>apiForm/img/setting_plugin_iubenda.png">
                                                                                    <br />
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <h5><b>LEGENDA:</b> </h5>
                                                                                            <ul>
                                                                                                <ol>1)  'LANGUAGE', sostituire con la lingua <small class="text-info">(it, en, fr, de, ecc)</small></ol>
                                                                                                <ol>2)  'SITE_ID_IUBENDA', sostituire con il <small class="text-info">SITE ID di iubenda</small></ol>
                                                                                                <ol>3)  'COOKIE_ID_IUBENDA', sostituire con il <small class="text-info">COOKIE ID di iubenda</small></ol> 
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br />
                                                                                    <script> var clipboard = new ClipboardJS('#FQ3fa');</script>
                                                                                    <p>Copia ed incolla il codice di Iubenda nel setting del plugin in WP&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
                                                                                    &nbsp;&nbsp;<a href="javascript:;" id="FQ3fa" data-clipboard-action="copy" data-clipboard-target="#FQ3" title="copia" alt="copia" class="text-red"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Copia ed incolla</a>	
                                                                                    </p>

                                                                                    <pre id="FQ3" style="background-color:#F7FBF5!important;">
                                                                                    &lt;script type="text/javascript"&gt;
                                                                                        var _iub = _iub || [];
                                                                                        _iub.csConfiguration = {
                                                                                            "consentOnContinuedBrowsing":false,
                                                                                        "whitelabel":false,
                                                                                        "lang": "LANGUAGE",
                                                                                            "siteId": SITE_ID_IUBENDA,
                                                                                        "perPurposeConsent":true,
                                                                                            "cookiePolicyId": COOKIE_ID_IUBENDA, 
                                                                                            "banner":{
                                                                                        "position": "float-top-center",
                                                                                        "acceptButtonDisplay":true,
                                                                                        "customizeButtonDisplay":true,
                                                                                        "rejectButtonDisplay":true
                                                                                        },
                                                                                            callback: {
                                                                                                onPreferenceExpressedOrNotNeeded: function(preference) {
                                                                                                    dataLayer.push({
                                                                                                        iubenda_ccpa_opted_out: _iub.cs.api.isCcpaOptedOut()
                                                                                                    });
                                                                                                    if (!preference) {
                                                                                                        dataLayer.push({
                                                                                                            event: "iubenda_preference_not_needed"
                                                                                                        });
                                                                                                        write_client_id();
                                                                                                    } else {
                                                                                                        if (preference.consent === true) {
                                                                                                            dataLayer.push({
                                                                                                                event: "iubenda_consent_given"
                                                                                                            });
                                                                                                            write_client_id();
                                                                                                        } else if (preference.consent === false) {
                                                                                                            dataLayer.push({
                                                                                                                event: "iubenda_consent_rejected"
                                                                                                            });
                                                                                                        } else if (preference.purposes) {
                                                                                                            for (var purposeId in preference.purposes) {
                                                                                                                if (preference.purposes[purposeId]) {
                                                                                                                    dataLayer.push({
                                                                                                                        event: "iubenda_consent_given_purpose_" + purposeId
                                                                                                                    });
                                                                                                                    write_client_id();
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        };
                                                                                        &lt;/script&gt;
                                                                                        &lt;script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async&gt;&lt;/script&gt;
                                                                                    </pre>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <?}?>
                                               

                    


                                                    <?php
                                                        if(check_form_exists(IDSITO)==1){
                                                            echo $content_setting;
                                                            echo $content_js;
                                                            echo $content;
                                                        }
                                                    ?>                                                     
                                                    <? include_module('backtop.inc.php'); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>