<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

<link href="<?=BASE_URL_SITO?>css/email_template.css.php?BackgroundEmail=<?=str_replace("#","",$BackgroundEmail)?>&BackgroundCellData=<?=str_replace("#","",$BackgroundCellData)?>&BackgroundCellLink=<?=str_replace("#","",$BackgroundCellLink)?>" rel="stylesheet">

<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>Anteprima E-mail di Preventivo e/o Conferma</h5>                                              

                                            </div>
                                                <div class="card-block">
                                                    <table class="testo" border="0" width="100%"  style="background-color:<?=$BackgroundEmail?>">
                                                        <tr>
                                                        <td colspan="2">
                                                        <br>
                                                            <table class="testo misura_tabella" border="0"  align="center">
                                                                <tr>
                                                                    <td align="left">
                                                                    <?
                                                                        if(AVATAR !=''){
                                                                            echo'<img src="'.BASE_URL_SITO.'uploads/loghi_siti/'.AVATAR.'" class="img-responsive">';
                                                                        }else{
                                                                            echo'<b>[Logo Cliente]</b>';
                                                                        }
                                                                    ?>
                                                                    </td>
                                                                    <td align="right" id="data-richiesta"><b>Data della richiesta</b><br><?=date('d-m-Y')?></td>
                                                                </tr>
                                                            </table>  
                                                            <br>                                                                            
                                                            <table class="testo bgcolor-white misura_tabella" border="0" align="center">
                                                                <tr>
                                                                <td class="paddingXX">
                                                                    <small class="text-muted"><b>Esempio testo di Conferma:</b></small><br>
                                                                    <?=$MessaggioConferma?><br><br>
                                                                    <small class="text-muted"><b>Esempio testo di Preventivo:</b></small><br>
                                                                    <?=$MessaggioPreventivo?><br><br>
                                                                </td>
                                                            </tr>
                                                            </table>                      
                                                            <table class="testo misura_tabella" border="0"  align="center">
                                                                <tr>
                                                                    <td align="left"><b>Date del Soggiorno</b></td>
                                                                </tr>
                                                            </table>                        
                                                                <table class="misura_tabella" border="0"  align="center" >
                                                                <tr>
                                                                    <td>
                                                                        <div class="alert cell-data alert-dismissable">
                                                                            <div class="row">
                                                                                <div class="col-md-4" style="text-align:right!important">
                                                                                    <i class="fa fa-calendar fa-3x"></i> 
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <b>Data Arrivo</b> <br> ....................
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        </td>
                                                                        <td>&nbsp;<td>
                                                                    <td>                          
                                                                        <div class="alert cell-data alert-dismissable">
                                                                            <div class="row">
                                                                                <div class="col-md-4" style="text-align:right!important">
                                                                                    <i class="fa fa-calendar fa-3x"></i> 
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <b>Data Partenza</b> <br> ....................
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                            
                                                            <table class="testo cell-link misura_tabella" border="0"  align="center">
                                                                <tr>
                                                                    <td class="paddingYY"><b class="big_white">Clicca qui per vedere l'offerta a te dedicata...</b><br><b class="small_white">Scopri quel è la nostra migliore offerta per il periodo da te richiesto!</b></td>
                                                                    <td class="paddingYY" align="right"> <i class="fa fa-chevron-right fa-3x"></i></td>
                                                                </tr>                          
                                                            </table>
                                                            <?=$foto?>
                                                            <br>
                                                            <table class="testo bgcolor-white misura_tabella" border="0"  align="center">
                                                            <tr>
                                                                <td class="paddingXX"><span class="testo_big">I nostri migliori saluti.</span><br><br>[Operatore] - <b class="red">[Nome Cliente]</b><br>
                                                                [indirizzo] - [cap] [comune] (prov)<br>
                                                                    Tel. [tel] Fax. [fax] E-mail: [email]</td>
                                                            </tr>                          
                                                        </table>                                             
                                                            <br><br><br>
                                                            <table class="testo_footer misura_tabella" border="0"  align="center">
                                                                <tr>
                                                                    <td align="right">By Network Service s.r.l.</td>
                                                                </tr>                          
                                                            </table>   
                                                            </td>
                                                        </tr>                  
                                                    </table>    
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