<div class="boxquoto" id="preno">
    <div class="box6">
        <h3><?=$PRENOTAOFFERTA?></h3>
    </div>
    <?php
        $box     ='preno'; //ID del box contenitore
        $frase1  = $VISUALIZZA.' '.$FORM;
        $frase2  = $NASCONDI.' '.$FORM;
        $bollino ='<i class="fa fa-check"></i>'; //font awesome di riferimento
        $oc      ="1";//1 aperto - 0 chiuso
        include(BASE_PATH_SITO. "smart/include/inc_OC.php");
	?>

        <div class="box6 t14 content">
            <div class="m m-x-4 m-m-6 m-s-12">
                <div class="box6">
                    <?=$proposta_form?>
                    <div class="ca"></div>
                </div>
                <div class="ca"></div>
            </div>
            <div class="m m-x-8 m-m-6 m-s-12 m-s-ha">
                <div class="box6">
                    <!--FORM-->
                    <form onkeyup="return false;" id="form_msg" name="form_msg" method="post">
                        <div class="m m-x-12 boxform">
                            <?=MESSAGGIO?>:
                            <div class="ca"></div>
                            <textarea  rows="2" placeholder="<?=MESSAGGIO?>" name="messaggio" id="messaggio" ><?=$testo_messaggio?></textarea>
                        </div>
                        <div class="m m-x-6 boxform">
                            <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome" value="<?=$Nome?>"  readonly>
                        </div>
                        <div class="m m-x-6 boxform">
                            <input type="text" class="form-control" placeholder="Cognome" name="cognome" id="cognome" value="<?=$Cognome?>"  readonly>
                        </div>
                        <? if($Cellulare ==''){?>
                            <div class="m m-x-12 boxform">
                                <input type="text" class="form-control" placeholder="Cellulare e/o telefono" name="Cellulare" id="Cellulare"  required>
                            </div>
                        <?}?>
                        <div class="m m-x-12 formproposta boxform">
                            <div class="boxform bcolor twhite">
                                <div class="m m-x-12 boxform t14"><?=PROPOSTA?></div>
                                <div class="m m-x-12 boxform w300 t13 scegli">Scegli dallo specchietto laterale la proposta a cui sei interessato....</div>
                                <div class="m m-x-12 boxform w300 conferma t13"></div>
                                <div class="ca"></div>
                            </div>
                        </div>
                        <div class="m m-x-12 boxform">
                            <?=SALUTI?>:
                            <div class="ca"></div>
                            <textarea class="form-control" rows="2" placeholder="<?=SALUTI?>" name="saluti" id="saluti" ><?=$testo_saluti?></textarea>
                        </div>

                             <div class="m m-x-12 boxform t12">
                                <input name="marketing" id="marketing" type="checkbox" value="1"> <?=CONSENSOMARKETING?>
                                <div class="ca"></div>
                                <span id="view_profilazione" style="display:none">
                                    <input name="profilazione" id="profilazione" type="checkbox" value="1"> <?=CONSENSOPROFILAZIONE?>
                                    <div class="ca"></div>
                                </span>
                                <input name="policy_soggiorno" id="policy_soggiorno" type="radio" value="1"  required> <?=ACCONSENTI_PRIVACY_POLICY_SOGGIORNO?></div>
                                  <div id="politiche_soggiorno" style="display:none">
                                    <div class="m m-x-12">
                                      <div class="box5">
                                        <small>
                                        <br>
                                           <? echo InformativaPrivacy(); ?>
                                          <br><br><?=$rw['testo']?>
                                        </small>
                                      </div>
                                    </div>
                                 </div>
                                   <script>
                                      $(document).ready(function() {
                                            $("#sblocca_politiche_soggiorno").click(function(){
                                                $( "#politiche_soggiorno" ).toggle();
                                            });
                                            $("#marketing").on('click',function() {
                                                $("#view_profilazione").toggle();
                                            });
                                        });
                                  </script>

                              <input type="hidden" name="riferimenti" value="<?=$testo_riferimento?>">
                              <input type="hidden" name="email_hotel" value="<?=$EmailCliente?>">
                              <input type="hidden" name="nome_hotel" value="<?=$NomeCliente?>">
                              <input type="hidden" name="email_utente" value="<?=$Email?>">
                              <input type="hidden" name="nome_utente" value="<?=$Cliente?>">
                              <input type="hidden" name="tipo_richiesta" value="<?=$TipoRichiesta?>">
                              <input type="hidden" name="id_richiesta" value="<?=$Id?>">
                              <input type="hidden" name="lang" value="<?=$Lingua?>">
                              <input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR']?>">
                              <input type="hidden" name="agent" value="<?=$_SERVER['HTTP_USER_AGENT']?>">
                              <input type="hidden" name="action" value="send_mail">
                              <div class="ca20"></div>
                              <? if($_REQUEST['result']==''){ ?>
                                <button type="button" class="pulsante" id="send_form"><?=strtoupper(CONFERMA.' '.PROPOSTA)?> <i class="fa fa-angle-double-right"></i></button>
                              <?}?>
                        <!--FINE FORM-->
                    </form>
                </div>
            </div>
            <div class="ca"></div>
        </div>
        <div class="ca"></div>
</div>
<style>
    #preno .titolo {
        font-size: 20px;
        font-weight: 300;
    }

    #preno .fproposta {
        margin-bottom: 1px;
        border-radius: 5px;
        transition: all .8s ease;
        cursor: pointer;
        margin-left: 50px;
        background-color: #999 !important;
        width: calc(100% - 50px) !important;
    }

    #preno .fproposta:hover {
        transition: all .01s ease;
        background-color: #666;
    }

    #preno .fproposta.selected {
        opacity: 1;
        background-color: <?=$colore1?> !important;
    }

    #preno .riga {
        padding: 15px;
    }

    #preno .fproposta .specchietto {
        display: none;
    }

    #preno .specchietto linea {
        background-color: rgba(0, 0, 0, 0.2);
        font-size: 12px;
        font-weight: 700;
        position: relative;
        clear: both;
        display: block;
        margin-bottom: 1px;
        padding: 5px 0px 5px 80px;
        width: 100%;
    }

    #preno .specchietto linea svg {
        position: absolute;
        font-size: 20px;
        left: 25px;
        top: 50%;
        transform: translateY(-50%);
    }

    #preno .specchietto totale {
        display: block;
        font-weight: 300;
        font-size: 18px;
        text-decoration: line-through;
    }

    #preno .specchietto sconto {
        display: block;
        font-weight: 300;
        font-size: 18px;
    }

    #preno .specchietto newtotale {
        display: block;
        font-weight: 700;
        font-size: 28px;
    }

   .smart .fproposta .fa-circle,
    .smart .fproposta .fa-check-circle {

        font-size: 30px;
        position: absolute;
        top: 13px;
        left: -40px;
        color: #999;
    }

    .smart .fproposta .fa-check-circle {
        opacity: 0;
    }

    .smart .fproposta.selected .fa-check-circle {
        opacity: 1;
        color: <?=$colore1?> !important;
    }

    .smart .fproposta.selected .fa-circle {
        opacity: 0;
    }
    .smart .boxform{
        padding: 5px;
        border-radius: 5px;
    }
    .smart .formproposta.choosen .scegli{
        display: none;
    }
    .smart .formproposta.choosen .conferma{
        display: block;

    }
</style>
