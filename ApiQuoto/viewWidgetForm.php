<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
    include_once($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

    if($_GET['idsito']){
		$ID_SITO = $_GET['idsito'];
	}else{
		$ID_SITO = 1740;
	}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>test</title>
    <!--JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        label{
            font-weight:bold;
            white-space:nowrap;
        }
        #setting_widget{
            font-size:12px;
        }
        .p-b-10{
            padding-bottom:10px;
        }
        .p-b-30{
            padding-bottom:30px;
        }
        input::placeholder {
            font-size: 11px;
            opacity: 0.5;
        }
        .errorInput{
            border:1px solid red!important;
        }
        #viewErrorAlloggi{
            color:red;
        }
    </style>
</head>
    <body>
    <?php if(!$_REQUEST['res']){?>
        <div class="row">
            <div class="col-md-12 text-center"><h2>ESEMPIO DI WIDGET FORM CUSTOMIZZATO <span style="font-size:11px;color:gray;"> &#10230; <?=$fun::getSitoById($ID_SITO)?></span></h2>Attenzione: se inviate la richiesta verrà spedita e salvata nel CRM del cliente!</div>
        </div>
        <div class="clearfix p-b-10"></div>
        <div class="row">
            <div class="col-md-12 text-center"><h4>Prova a personalizzare il form!</h4></div>
        </div>
        <div class="clearfix p-b-30"></div>
        <div class="row">
            <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form name="setting_widget" id="setting_widget" method="post" action="<?=BASE_URL_SITO?>ApiQuoto/viewWidgetForm.php?idsito=<?=$ID_SITO?>" enctype="multipart/form-data">
                        <input type="hidden" name="azione" id="azione" value="set">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Sigla della lingua</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="lingua" id="lingua" class="form-control">
                                                <option value="it" <?=($_POST['lingua']=='it'?'selected="selected"':'')?>>it</option>
                                                <option value="en" <?=($_POST['lingua']=='en'?'selected="selected"':'')?>>en</option>
                                                <option value="fr" <?=($_POST['lingua']=='fr'?'selected="selected"':'')?>>fr</option>
                                                <option value="de" <?=($_POST['lingua']=='de'?'selected="selected"':'')?>>de</option>
                                                <option value="es" <?=($_POST['lingua']=='es'?'selected="selected"':'')?>>es</option>
                                                <option value="ru" <?=($_POST['lingua']=='ru'?'selected="selected"':'')?>>ru</option>
                                                <option value="nl" <?=($_POST['lingua']=='nl'?'selected="selected"':'')?>>nl</option>
                                                <option value="pl" <?=($_POST['lingua']=='pl'?'selected="selected"':'')?>>pl</option>
                                                <option value="hu" <?=($_POST['lingua']=='hu'?'selected="selected"':'')?>>hu</option>
                                                <option value="pt" <?=($_POST['lingua']=='pt'?'selected="selected"':'')?>>pt</option>
                                                <option value="ae" <?=($_POST['lingua']=='ae'?'selected="selected"':'')?>>ae</option>
                                                <option value="cz" <?=($_POST['lingua']=='cz'?'selected="selected"':'')?>>cz</option>
                                                <option value="cn" <?=($_POST['lingua']=='cn'?'selected="selected"':'')?>>cn</option>
                                                <option value="br" <?=($_POST['lingua']=='br'?'selected="selected"':'')?>>br</option>
                                                <option value="jp" <?=($_POST['lingua']=='jp'?'selected="selected"':'')?>>jp</option>
                                            </select>                                       
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Usa le FontAwesome (Si/No)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="view_fontawesome" id="view_fontawesome" class="form-control">
                                                <option value="0" <?=($_POST['view_fontawesome']==0?'selected="selected"':'')?>>No</option>
                                                <option value="1" <?=(($_POST['view_fontawesome']==1 || $_POST['view_fontawesome']=='')?'selected="selected"':'')?>>Si</option>
                                            </select>                                   
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="clearfix p-b-10"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Usa Bootstrap (Si/No)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="view_bootstrap" id="view_bootstrap" class="form-control" disabled>
                                                <option value="1" selected="selected">Si</option>
                                                <option value="0" >No</option>
                                            </select>                                      
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Usa il Captcha (Si/No)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="view_captcha" id="view_captcha" class="form-control">
                                                <option value="0" <?=($_POST['view_captcha']==0?'selected="selected"':'')?>>No</option>
                                                <option value="1" <?=(($_POST['view_captcha']==1 || $_POST['view_captcha']=='')?'selected="selected"':'')?>>Si</option>
                                            </select>                                   
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                        </div>
                        <div class="clearfix p-b-10"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Visualizza select Bambini (Si/No)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="view_bambini" id="view_bambini" class="form-control">
                                                <option value="0" <?=($_POST['view_bambini']==0?'selected="selected"':'')?>>No</option>
                                                <option value="1" <?=(($_POST['view_bambini']==1  || $_POST['view_bambini']=='')?'selected="selected"':'')?>>Si</option>
                                            </select>                                     
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Usa il campo Codice Sconto (Si/No)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="view_sconto" id="view_sconto" class="form-control">                                              
                                                <option value="1" <?=(($_POST['view_sconto']==1  || $_POST['view_sconto']=='')?'selected="selected"':'')?>>Si</option>
                                                <option value="0" <?=($_POST['view_sconto']==0?'selected="selected"':'')?>>No</option>
                                            </select>                                   
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                        </div>
                        <div class="clearfix p-b-10"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Usa la select Tipo Alloggi (Si/No)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="view_alloggi" id="view_alloggi" class="form-control">                                               
                                                <option value="1" <?=($_POST['view_alloggi']==1?'selected="selected"':'')?>>Si</option>
                                                <option value="0" <?=($_POST['view_alloggi']==0?'selected="selected"':'')?>>No</option>
                                            </select>                                   
                                        </div>
                                    </div>
                                </div>                          
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Usa select v.. con animali (Si/No)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="view_animali" id="view_animali" class="form-control">     
                                                <option value="1" <?=(($_POST['view_animali']==1  || $_POST['view_animali']=='')?'selected="selected"':'')?>>Si</option>
                                                <option value="0" <?=($_POST['view_animali']==0?'selected="selected"':'')?>>No</option>
                                            </select>                                     
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                        </div> 
                        <div class="clearfix p-b-10"></div>                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Compila la lista Alloggi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="lista_alloggi" id="lista_alloggi" value="<?=($_POST['lista_alloggi']!=''?$_POST['lista_alloggi']:'')?>" placeholder="inserire lista alloggi con i 5 cancelletti separatori per 6 lingue"  class="form-control" />                                 
                                            <div id="viewErrorAlloggi" style="display:none">E' obbligatorio compilare la lista degli Alloggi</div>
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Usa Iubenda privacy (Si/No)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="view_iubenda" id="view_iubenda" class="form-control">     
                                                <option value="1" <?=($_POST['view_iubenda']==1?'selected="selected"':'')?>>Si</option>
                                                <option value="0" <?=($_POST['view_iubenda']==0?'selected="selected"':'')?>>No</option>
                                            </select>                                     
                                        </div>
                                    </div>
                                </div>                         
                            </div>
                        </div> 
                        <div class="clearfix p-b-10"></div>                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Compila la lista Soggiorni</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="lista_soggiorni" id="lista_soggiorni" value="<?=($_POST['lista_soggiorni']!=''?$_POST['lista_soggiorni']:'')?>" placeholder="inserire lista soggiorni con i 5 cancelletti separatori per 6 lingue"  class="form-control" />                                 
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Compila la iubendacode</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="lista_iubendacode" id="lista_iubendacode" value="<?=($_POST['lista_iubendacode']!=''?$_POST['lista_iubendacode']:'')?>" placeholder="inserire lista dei Iubenda Code con i 5 cancelletti separatori per 6 lingue"  class="form-control" />                                 
                                            <span style="font-size:10px">(Code IT#Code EN#Code FR#Code DE#Code ES#Code RU)</span>
                                        </div>
                                    </div>
                                </div>                           
                            </div>                           
                        </div>     
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <label>Imponi una Età Max per i Bambini</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select type="numeric" name="maxEta_bambini" id="maxEta_bambini" class="form-control" > 
                                                <?php for ($i==1; $i<=16;  $i++){?>
                                                    <option value="<?=$i?>" <?=($_REQUEST['maxEta_bambini']==$i?'selected="selected"':'')?>><?=$i?></option>  
                                                <?}?>
                                            </select>                              
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                            <div class="col-md-6">
                           
                        </div>                         
                        <div class="clearfix p-b-10"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8 text-right">
                                            <label>Abilita script <small>(customizzabile)</small> per modificare etichette da "+ aggiungi camera - rimuovi camera" a "+ aggiungi unità abitativa - rimuovi unità abitativa" <br><a href="javascript:;" id="view_tips_tricks3"><span style="font-size:10px; font-weight:normal;">view script</span></a></label>
<pre style="display:none" id="tips_tricks3"> 
    &lt;!--
    /**
    ** Se per esempio il widget form di quoto viene installato su un sito di un campeggio (quindi un camping non ha camere), 
    ** e si desidera sostituire le frasi "+ aggiungi camere" e "- rimuovi camera", (perchè richiesto dal cliente), questo script d'esempio fa per voi!
    ** Naturalmente le etichette possono essere personalizzate su necessità!
    */
    --&gt;
    &lt;script&gt;
        // compilare language con la variabile statica della lingua, con una variabile php oppure con la globale di wordpress
        var language      = '&lt;?=$language?&gt;';
        var etichetta_add = '';
        var etichetta_rem = '';
        switch(language){
            case"it":
                etichetta_add = 'aggiungi unità abitativa';
                etichetta_rem = 'rimuovi unità abitativa';
                break;
            case"en":
                etichetta_add = 'add housing unit';
                etichetta_rem = 'remove housing unit';
                break;
            case"fr":
                etichetta_add = 'ajouter un logement';
                etichetta_rem = 'retirer l\'unité d\'habitation';
                break;
            case"de":
                etichetta_add = 'Wohneinheit hinzufügen';
                etichetta_rem = 'Gehäuseeinheit entfernen';
                break;
            case"es":
                etichetta_add = 'añadir unidad de vivienda';
                etichetta_rem = 'quitar unidad de vivienda';
                break;
            case"ru":
                etichetta_add = 'добавить единицу жилья';
                etichetta_rem = 'снять жилой блок';
                break;
            default:
                etichetta_add = 'add housing unit';
                etichetta_rem = 'remove housing unit';
                break;
        }
        jQuery(document).ready(function(){
            setTimeout(function(){
                jQuery("a#add").html("&lt;i class=\"fa fa-plus fa-w-14 fa-fw\"&gt;&lt;/i&gt; " + etichetta_add + "");
                jQuery("a#add").on("click",function(){
                    jQuery("a#re").html("&lt;i class=\"fa fa-minus fa-w-14 fa-fw\"&gt;&lt;/i&gt; " + etichetta_rem + "");
                })
            }, 1000);
        })
    &lt;/script&gt;                                            
</pre>
                                            <script>
                                                jQuery(document).ready(function(){			
                                                    jQuery("#view_tips_tricks3").click(function() {
                                                        jQuery("#tips_tricks3").slideToggle("slow");
                                                    });
                                                })
                                            </script>
                                        </div>
                                        <div class="col-md-4">
                                        <select name="script" id="script" class="form-control">     
                                                <option value="1" <?=($_POST['script']==1?'selected="selected"':'')?>>Si</option>
                                                <option value="0" <?=($_POST['script']==0?'selected="selected"':'')?>>No</option>
                                            </select>   
                                        </div>
                                    </div>
                                </div>                          
                            </div>                       
                        </div>                         
                        <div class="clearfix p-b-10"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8 text-right">
                                            <label>Abilita script <small>(customizzabile)</small> per inserire una legenda testuale sopra il campo messaggio <a href="javascript:;" id="view_tips_tricks2"><span style="font-size:10px; font-weight:normal;padding-left:20px">view script</span></a></label>
<pre style="display:none" id="tips_tricks2">
    &lt;!--
    /**
    ** Se avete necessità d'inserire un testo descrittivo per agevolare la compilazione del form,  questo script d'esempio fa per voi!
    ** Il testo apparirà subito sopra la textarea del messaggio
    */
    --&gt;
    &lt;div id="legenda" style="font-size:14px;line-height:1.1em;padding-left: 6px;"&gt;
        &lt;strong&gt;Attenzione!&lt;/strong&gt;
        &lt;br&gt;Indicaci più dettagli possibili nel campo del messaggio.&lt;br&gt; Così potremo ospitarti al  meglio!
    &lt;/div&gt;
    &lt;script&gt;
    jQuery(document).ready(function(){
        // CALCOLO DELLA VARIABILE res=sent
        var request_uri_      = window.location.pathname + window.location.search;
        // STAMPA A VIDEO LA LEGENDA SOLO SE NON ESITE LA VARIABILE DI RISPOSTA res=sent
        if (request_uri_.indexOf('?') == -1) {
            jQuery("#legenda").show();
            setTimeout(function(){
                jQuery("#legenda").insertBefore("#messaggio");	
            }, 1000);
        }else{
            jQuery("#legenda").hide();
        }
    })
    &lt;/script&gt;
</pre>
                                            <script>
                                                jQuery(document).ready(function(){			
                                                    jQuery("#view_tips_tricks2").click(function() {
                                                        jQuery("#tips_tricks2").slideToggle("slow");
                                                    });
                                                })
                                            </script>
                                        </div>
                                        <div class="col-md-4">
                                        <select name="script2" id="script2" class="form-control">     
                                                <option value="1" <?=($_POST['script2']==1?'selected="selected"':'')?>>Si</option>
                                                <option value="0" <?=($_POST['script2']==0?'selected="selected"':'')?>>No</option>
                                            </select>   
                                        </div>
                                    </div>
                                </div>                          
                            </div>                       
                        </div> 
                        <div class="clearfix p-b-10"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8 text-right">
                                            <label>Abilita script per rendere il campo "telefono" obbligatorio <a href="javascript:;" id="view_tips_tricks"><span style="font-size:10px; font-weight:normal;padding-left:20px">view script</span></a></label>
<pre style="display:none" id="tips_tricks">
    &lt;!--
    /**
    ** Se avete necessità di rendere obbligatorio anche il campo telefono!
    ** Ecco un piccolo script già pronto!
    */
    --&gt;
    &lt;script&gt;
    jQuery(document).ready(function(){
        jQuery("#telefono").attr("required",true);
        jQuery("#telefono").addClass("CheckChange");
        jQuery("#telefono").attr("placeholder", "Telefono *");
        jQuery("#form_quoto").mousemove(function () {
            if(jQuery("#telefono").val()!=''){
                jQuery("#telefono").removeClass('error');
            }
        })
        jQuery(".submit").on('click', function () {
            if(jQuery("#telefono").val()==''){
                jQuery("#telefono").addClass('error');
                jQuery("#telefono").attr('title','');
            }else{
                jQuery("#telefono").removeClass('error');
            }
        })
    })
    &lt;/script&gt;
</pre>
                                            <script>
                                                jQuery(document).ready(function(){			
                                                    jQuery("#view_tips_tricks").click(function() {
                                                        jQuery("#tips_tricks").slideToggle("slow");
                                                    });
                                                })
                                            </script>
                                        </div>
                                        <div class="col-md-4">
                                        <select name="script3" id="script3" class="form-control">     
                                                <option value="1" <?=($_POST['script3']==1?'selected="selected"':'')?>>Si</option>
                                                <option value="0" <?=($_POST['script3']==0?'selected="selected"':'')?>>No</option>
                                            </select>   
                                        </div>
                                    </div>
                                </div>                          
                            </div>                       
                        </div>                        
                        <div class="clearfix p-b-10"></div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning" id="salvaSet">Cambia setting</button>
                                </div>                          
                            </div>
                        </div>                     
                    </form>
                    <div class="clearfix p-b-30"></div>
                </div>
            <div class="col-md-2"></div>
        </div>
        <script>
             jQuery(document).ready(function(){ 
                jQuery("#view_alloggi").on("change",function(){
                    var val = jQuery("#view_alloggi").val();
                    if(val==1){
                        jQuery("#lista_alloggi").addClass('errorInput');
                        jQuery("#viewErrorAlloggi").show();
                    }else{
                        jQuery("#lista_alloggi").removeClass('errorInput');
                        jQuery("#viewErrorAlloggi").hide();
                    }
                })  
/*                 $("#setting_widget").submit(function(){   
                    var dati =  $("#setting_widget").serialize();  
                    $.ajax({
                        url: "<?=BASE_URL_SITO?>ApiQuoto/viewWidgetForm.php?idsito=<?=$ID_SITO?>",
                        type: "POST",
                        data: dati,
                        dataType: "html",
                        success: function(data) {
                             $("#WidgetformQuoto").load(" #WidgetformQuoto > *"); 
                        }
                    })
                    return false;
                }) */
            }) 
        </script>
    <?}else{?>
        <div class="clearfix p-b-30"></div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="btn btn-warning" href="<?=BASE_URL_SITO?>ApiQuoto/viewWidgetForm.php?idsito=<?=$ID_SITO?>">Torna al Widget Form</a>
            </div>
        </div>
        <div class="clearfix p-b-30"></div>
    <?}?>

            <!-- QUOTO! form -->
            <script type="text/javascript">           
                if(typeof window.quoto_form == 'undefined'){
                    var quoto_form = jQuery.makeArray({
                                            'idsito'              : <?=$ID_SITO?> ,                                      
                                            'language'            : '<?=($_POST['lingua']!=''?$_POST['lingua']:'it')?>',
                                            'bootstrap'       	  : <?=($_POST['view_bootstrap']!=''?$_POST['view_bootstrap']:1)?>,  
                                            'captcha'         	  : <?=($_POST['view_captcha']!=''?$_POST['view_captcha']:1)?>, 
                                            'ChiaveSitoReCaptcha' : '6Lfz-L8lAAAAANE-yvkAOp1qqWIQjWoXUGE9GJwZ',
                                            'iubendapolicy'   	  : <?=($_POST['view_iubenda']!=''?$_POST['view_iubenda']:0)?>, 
                                            'iubendacode'         : '<?=($_POST['lista_iubendacode']!=''?$_POST['lista_iubendacode']:'')?>',
                                            'selBambini'   	      : <?=($_POST['view_bambini']!=''?$_POST['view_bambini']:1)?>,
                                            'maxEtaBambini'   	  : <?=($_POST['maxEta_bambini']!=''?$_POST['maxEta_bambini']:16)?>,
                                            'tipoSoggiorni'       : '<?=($_POST['lista_soggiorni']!=''?$_POST['lista_soggiorni']:'')?>',
                                            'fontawesome'     	  : <?=($_POST['view_fontawesome']!=''?$_POST['view_fontawesome']:1)?>,
                                            'campoSconto'     	  : <?=($_POST['view_sconto']!=''?$_POST['view_sconto']:0)?>, 
                                            'selectAnimali'   	  : <?=($_POST['view_animali']!=''?$_POST['view_animali']:0)?>,
                                            'selectAlloggi'       : <?=($_POST['view_alloggi']!=''?$_POST['view_alloggi']:0)?>,
                                            'tipoAlloggi'         : '<?=($_POST['lista_alloggi']!=''?$_POST['lista_alloggi']:'')?>',
                                            'multiStruttura'      :'Test Widget Form QUOTO'
                                        });  
                }                             
            </script>
            <div id="WidgetformQuoto"></div>
            <?php  
                if(($_POST['view_alloggi']== 0)){ 
                    echo'<div class="clearfix p-b-10"></div><div class="row"><div class="col-md-12 text-center"><span class="text-danger">ATTENZIONE: se inviate la richiesta verrà spedita e salvata nel CRM del cliente!<br>In questa schermata di prova, se il captcha è attivo l\'invio del form è bloccato!</span></div></div>';
                }
            ?>
            <script type="text/javascript" src="https://www.quotocrm.it/apiForm/js/form_widget_quoto.js" async defer></script>
            <!-- QUOTO! end form -->
            <?php if($_POST['script3']!=0){?>
                <script>
					jQuery(document).ready(function(){
					
							jQuery("#telefono").attr("required",true);
							jQuery("#telefono").addClass("CheckChange");
							jQuery("#telefono").attr("placeholder", "Telefono *");
							jQuery("#form_quoto").mousemove(function () {
								if(jQuery("#telefono").val()!=''){
									jQuery("#telefono").removeClass('error');
								}
							})
							jQuery(".submit").on('click', function () {
								if(jQuery("#telefono").val()==''){
									jQuery("#telefono").addClass('error');
									jQuery("#telefono").attr('title','');
								}else{
									jQuery("#telefono").removeClass('error');
								}
							})
                })
            </script>
        <?}?>
        <?php if($_POST['script2']!=0){?>
            <div id="legenda" style="font-size:14px;line-height:1.1em;padding-left: 6px;">
                <strong>Attenzione!</strong>
                <br>Indicaci più dettagli possibili nel campo del messaggio.<br> Così potremo ospitarti al  meglio!
            </div>
            <script>
                jQuery(document).ready(function(){
                    setTimeout(function(){
                        jQuery("#legenda").insertBefore("#messaggio");
                    }, 1000);
                })
            </script>
        <?}?>
        <?php if($_POST['script']!=0){?>
            <script>
                    var language      = '<?=($_POST['lingua']!=''?$_POST['lingua']:'it')?>'; // compilare il campo con la variabile statica della lingua oppure con la globale di wordpress
                    var etichetta_add = '';
                    var etichetta_rem = '';
                    switch(language){
                        case"it":
                            etichetta_add = 'aggiungi unità abitativa';
                            etichetta_rem = 'rimuovi unità abitativa';
                            break;
                        case"en":
                            etichetta_add = 'add housing unit';
                            etichetta_rem = 'remove housing unit';
                            break;
                        case"fr":
                            etichetta_add = 'ajouter un logement';
                            etichetta_rem = 'retirer l\'unité d\'habitation';
                            break;
                        case"de":
                            etichetta_add = 'Wohneinheit hinzufügen';
                            etichetta_rem = 'Gehäuseeinheit entfernen';
                            break;
                        case"es":
                            etichetta_add = 'añadir unidad de vivienda';
                            etichetta_rem = 'quitar unidad de vivienda';
                            break;
                        case"ru":
                            etichetta_add = 'добавить единицу жилья';
                            etichetta_rem = 'снять жилой блок';
                            break;
                        default:
                            etichetta_add = 'add housing unit';
                            etichetta_rem = 'remove housing unit';
                            break;
                    }
                    jQuery(document).ready(function(){
                        setTimeout(function(){
                            jQuery("a#add").html("<i class=\"fa fa-plus fa-w-14 fa-fw\"></i> " + etichetta_add + "");
                            jQuery("a#add").on("click",function(){
                                jQuery("a#re").html("<i class=\"fa fa-minus fa-w-14 fa-fw\"></i> " + etichetta_rem + "");
                            })
                        }, 1000);
                    })
            </script>
        <?}?>

        <?php echo (($_POST['view_alloggi']==1 && $_POST['lista_alloggi'] == '')?'<div class="clearfix p-b-10"></div><div class="row"><div class="col-md-12 text-center"><span class="text-red">E\' necessario compilare il campo "Lista Alloggi" <br> ESEMPIO: valori o vuoto per l\'italiano # valori o vuoto per il inglese # valori o vuoto per il francese # valori o vuoto per il tedesco # valori o vuoto per lo spagnolo # valori o vuoto per il russo</span></div></div>':''); ?>
        <div class="clearfix" style="padding:20px!important"></div>
    </body>
</html>