<?php include_module('header.inc.php') ?>
<link href="<?=BASE_URL_SITO?>css/bootstrap-social.min.css" rel="stylesheet">
<!-- <link href="<?=BASE_URL_SITO?>css/hospitality-item.min.css" rel="stylesheet"> -->
<link href="<?=BASE_URL_SITO?>css/voucher.css" rel="stylesheet">
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
<?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
          <section class="content">
            <div class="box radius6"   style="background-color:#EBEBEB!important">
                <div class="box-body">

                    <h2 class="page-header">
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <?=$PulsanteIndietro?>
                            </div>
                            <div class="col-md-10 text-left">                            
                                <i class="fa fa-windows"></i> Anteprima Voucher                          
                            </div>
                        </div>
                    </h2>                                      
                    <div class="container animated zoomIn"   style="background-color:#FFFFFF!important">

            <div id="VoucherPrint">
                    <div class="row invoice-contact" >
                    <div class="col-md-8 col-xs-12 col-sm-12">
                        <div class="invoice-box row">              
                            <div class="col-sm-12  pd50">
                                <table class="table table-responsive invoice-table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td style="border:0px!important"><?=($Logo ==''?'<i class="fa fa-bed fa-5x fa-fw"></i>':'<img src="'.BASE_URL_SUITEWEB.'uploads/loghi_siti/'.$Logo.'" />')?></td>
                                        </tr>
                                        <tr>
                                            <td class="nowrap"><?=$NomeCliente?></b></td>
                                        </tr>
                                        <tr>
                                            <td class="nowrap"><?=$Indirizzo?> <?=$Localita?> - <?=$Cap?> (<?=$Provincia?>)</td>
                                        </tr>
                                        <tr>
                                            <td><?=$SitoWeb?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12 text-center">
                        <h4><?=STAMPA?></h4> 
                        <p><a href="#" onclick="printDiv('VoucherPrint')" class="text-smallgray  no-print" title="Print"><i class="fa fa-print fa-4x"></i></a></p>
                    </div>
                </div>
                <div class="card-block pd50">
                    <div class="row">
                        <div class="col-md-6 col-xs-12 col-sm-12 invoice-client-info">
                        <h3 class="m-0"><?=$Nome.' '.$Cognome?></h3>
                        <table class="table table-responsive invoice-table invoice-order table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="col-md-6 col-xs-12 col-sm-12 nowrap"><?=DATA_ARRIVO?> :</th>
                                        <td class="col-md-6 col-xs-12 col-sm-12"><?=$DataArrivo?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-6 col-xs-12 col-sm-12 nowrap"><?=DATA_PARTENZA?> :</th>
                                        <td class="col-md-6 col-xs-12 col-sm-12"><?=$DataPartenza?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                        <h3 class="m-b-20"><?=OFFERTA?> nr. <?=$NumeroPrenotazione?></span></h6>
                            <table class="table table-responsive invoice-table invoice-order table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="col-md-6 col-xs-12 col-sm-12 nowrap"><?=DEL?> :</th>
                                        <td class="col-md-6 col-xs-12 col-sm-12"><?=$DataRichiesta?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-6 col-xs-12 col-sm-12 nowrap">nr :</th>
                                        <td class="col-md-6 col-xs-12 col-sm-12">
                                            <?=$NumeroPrenotazione?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 t16">
                        <?if(strlen(strip_tags(TESTO_VOUCHER ))> 10){?>
                            <p><?=str_replace("[cliente]",($Nome.' '.$Cognome),TESTO_VOUCHER)?></p>
                        <?}?> 
                            <div class="capad10top"></div>
                            <?php echo (($NomeProposta!='' || $TestoProposta!='')?'<p>'.$NomeProposta.'</p><p>'.nl2br($TestoProposta).'</p><div class="capad10top"></div>':''); ?>
                            <?php echo '<div><p>'.SOGGIORNO_PER_NR_ADULTI.' <b>'.$NumeroAdulti .'</b> - '.($NumeroBambini!='0'?NR_BAMBINI.' <b>'.$NumeroBambini .'</b> - '.($EtaBambini1!='0' && $EtaBambini1!=''?$EtaBambini1.' '.ANNI.' ':'').($EtaBambini2!='0' && $EtaBambini2!=''?$EtaBambini2.' '.ANNI.' ':'').($EtaBambini3!='0' && $EtaBambini3!=''?$EtaBambini3.' '.ANNI.' ':'').($EtaBambini4!='0' && $EtaBambini4!=''?$EtaBambini4.' '.ANNI.' ':'').($EtaBambini5!='' && $EtaBambini5!='0'?$EtaBambini5.' '.ANNI.' ':'').($EtaBambini6!='' && $EtaBambini6!='0'?$EtaBambini6.' '.ANNI.' ':'').' ':'').NOTTI.' <b>'.$Notti.'</b></p></div><div class="capad10top"></div>'; ?>                          
                            <?php echo '<p><b>'.SOLUZIONECONFERMATA.':</b></p>'. $datealternative.' <div class="capad10top"></div> <p>'.$VAUCHERCamere .'</p> <div class="capad10top"></div> <p>'.$SERVIZIAGGIUNTIVI.' </p><div class="capad10top"></div>'; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right pd50r t16">
                        <?php echo '<p>'.(($PrezzoL!='0,00' && $PrezzoL > $PrezzoP)?'Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo&nbsp;&nbsp;&nbsp;<b>€.'.$PrezzoP.' </b></p><div class="capad10top"></div>';?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right pd50r t16">
                                <?                               
                                    if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                                        echo '<p>'.ACCONTO.': '.$AccontoRichiesta.' %  - <b>€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b></p><div class="capad10top"></div>';                                     
                                    }
                                    if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                                        echo '<p>'.ACCONTO.':  <b>€. '.number_format($AccontoLibero,2,',','.').'</b></p><div class="capad10top"></div>';                                     
                                    }  

                                    if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                                        echo '<p>'.ACCONTO.': '.$AccontoPercentuale.' %  - <b>€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b></p><div class="capad10top"></div>';                                     
                                    }

                                    if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                                        if($AccontoImporto >= 1) {
                                            echo '<p>'.ACCONTO.':  <b>€. '.number_format($AccontoImporto,2,',','.').'</b></p><div class="capad10top"></div>';
                                        }else{
                                            echo '<p>'.CARTACREDITOGARANZIA.'</p><div class="capad10top"></div>';
                                        }                                      
                                    } 

                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <?php if($GiaPagatoCC == true || $GiaPagatoPAY == true){?>

                                <div class="alert alert-default alert-dismissable text-center" style="border:solid 1px #CCC!important">
                                    <h3 class="text-red">
                                    <?                               
                                        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                                            echo '<p>€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</p>';                                     
                                        }
                                        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                                            echo '<p>€. '.number_format($AccontoLibero,2,',','.').'</p>';                                     
                                        }  

                                        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                                            echo '<p>€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</p>';                                     
                                        }

                                        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                                            if($AccontoImporto >= 1) {
                                                echo '<p>€. '.number_format($AccontoImporto,2,',','.').'</p>';
                                            }else{
                                                echo '<p>'.CARTACREDITOGARANZIA.'</p>';
                                            }                                      
                                        } 

                                    ?>
                                    </h3>
                                    <?php 
                                        $frase = str_replace("[tipopagamento]",$TipologiaPagamento,FRASE_RECUPERO_CAPARRA);
                                        $frase = str_replace("[datavalidita]",($DataValiditaVoucher!='//'?$DataValiditaVoucher :'...'),$frase);
                                        echo $frase;
                                    ?>
                                
                                </div>

                    <?}else{ ?>

                                <div class="alert alert-default alert-dismissable text-center" style="border:solid 1px #CCC!important">
                                    <?=($DataValiditaVoucher!='//'?'Data validità buon voucher '.$DataValiditaVoucher :'...')?>
                                </div>
    
                    <?}?>       
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="row" style="padding-bottom:20px">
                    <div class="col-md-12 tfooter"><em><b>Legenda:</b> <i class="fa fa-user" style="padding-left:10px;padding-right:10px"></i> Servizio scelto dal cliente in fase di conferma <br><small style="padding-left:100px;">(Service chosen by the customer during the confirmation phase)</small></em></div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="row  pd50bottom">
                        <div class="col-sm-12 tfooter">
                                <h4><?=CONDIZIONI_GENERALI?></h4>
                                <?=$rw['testo']?>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </section><!-- /.content -->
</div><!-- ./wrapper -->
<?php include_module('footer.inc.php'); ?>