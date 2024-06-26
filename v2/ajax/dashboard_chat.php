<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");

$user_accesso=$_SESSION['user_accesso'];
close_session();

$username           = DB_USER;
$password           = DB_PASSWORD;
$host               = HOST;
$dbname             = DATABASE;

$form_data_scadenza = '';
$Operatori          = '';
$text               = '';
$title              = '';
$command            = '';

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

function DifferenzaDate($data1,$data2,$formato) {
  $datetime1 = new DateTime($data1);
  $datetime2 = new DateTime($data2);
  $interval = $datetime1->diff($datetime2);
  return $interval->format($formato);
}

function riepilogo($id,$idsito){

  global $host, $username, $password,$dbname;

  $connection = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
  mysqli_set_charset($connection,'utf8');

  $sistemazione = '';


  $select = "SELECT
              hospitality_proposte.Id AS IdProposta,
              hospitality_proposte.NomeProposta,
              hospitality_proposte.PrezzoL,
              hospitality_proposte.PrezzoP,
              hospitality_guest.TipoRichiesta,
              hospitality_guest.idsito,
              hospitality_guest.AccontoRichiesta,
              hospitality_guest.Nome,
              hospitality_guest.Cognome,
              hospitality_guest.AccontoLibero,
              hospitality_proposte.AccontoPercentuale,
              hospitality_proposte.AccontoImporto,
              hospitality_proposte.AccontoTesto,
              hospitality_guest.Email,
              hospitality_guest.DataArrivo,
              hospitality_guest.DataPartenza,
              hospitality_guest.Chiuso 
            FROM
              hospitality_proposte
              INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta 
            WHERE
              hospitality_guest.NumeroPrenotazione = ".$id." 
            AND 
              hospitality_guest.idsito = ".$idsito." 
            ORDER BY
              hospitality_proposte.Id ASC";

  $result = mysqli_query($connection,$select) or die('Error, connesione'.$connection);
  $tot    = mysqli_num_rows($result);

  if($tot > 0){
      $Camere          = '';
      $sistemazioneP   = '';
      $sistemazioneC   = '';
      $n               = 1;
      $data_alernativa = '';
      $saldo           = '';
      $etichetta_saldo = '';
      $DPartenza       = '';
      $DArrivo         = '';
      $DNotti          = '';
    while($value = mysqli_fetch_assoc($result)) {

          $PrezzoL            = number_format($value['PrezzoL'],2,',','.');
          $PrezzoP            = number_format($value['PrezzoP'],2,',','.');
          $IdProposta         = $value['IdProposta'];
          $PrezzoPC           = $value['PrezzoP'];
          $idsito             = $value['idsito'];
          $AccontoRichiesta   = $value['AccontoRichiesta'];
          $AccontoLibero      = $value['AccontoLibero'];
          $NomeProposta       = $value['NomeProposta'];
          $Nome               = stripslashes($value['Nome']);
          $Cognome            = stripslashes($value['Cognome']);
          $Email              = $value['Email'];
          $Arrivo_tmp         = explode("-",$value['DataArrivo']);
          $Arrivo             = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
          $Partenza_tmp       = explode("-",$value['DataPartenza']);
          $Partenza           = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
          $start              = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
          $end                = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
          $formato            ="%a";
          $Notti              = DifferenzaDate($value['DataArrivo'],$value['DataPartenza'],$formato);
          $AccontoPercentuale = $value['AccontoPercentuale'];
          $AccontoImporto     = $value['AccontoImporto'];
          $AccontoTesto       = stripslashes($value['AccontoTesto']);
          // date alternative
          $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
          $re = mysqli_query($connection,$se);
          $rc = mysqli_fetch_assoc($re);
          $tt = mysqli_num_rows($re);

          if($tt>0){
              $DArrivo_tmp    = explode("-",$rc['Arrivo']);
              $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
              $DPartenza_tmp  = explode("-",$rc['Partenza']);
              $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
              $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
              $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));
              $formato="%a";
              $DNotti = DifferenzaDate($rc['Arrivo'],$rc['Partenza'],$formato);
          }

          if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
              $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
              $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
          }
          if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
              $saldo   = ($PrezzoPC-$AccontoLibero);
              $acconto = number_format($AccontoLibero,2,',','.');
          }

          if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
              $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
              $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
          }
          if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
              if($AccontoImporto >= 1) {
                  $etichetta_caparra  = '';
              }else{
                  $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
              }
              $saldo   = ($PrezzoPC-$AccontoImporto);
              $acconto = number_format($AccontoImporto,2,',','.');
          }
          if($PrezzoPC==$saldo){
              $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
          }else{
              $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.'.number_format(floatval($saldo),2,',','.');
          }


          $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                      FROM hospitality_richiesta
                      INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                      INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                      WHERE hospitality_richiesta.id_proposta = ".$IdProposta ;

          $result2 = mysqli_query($connection,$select2);

          $Camere = '';
          if($rc['Arrivo'] != '' && $rc['Partenza'] != ''){
              if($value['TipoRichiesta']=='Preventivo'){
                  if($Arrivo != $DArrivo || $Partenza != $DPartenza){
                      $data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$DArrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$DPartenza.' - per notti: '.$DNotti.'<br>';
                  }
              }elseif($value['TipoRichiesta']=='Conferma'){
                  if($rc['Arrivo']!= $value['DataArrivo']){
                      $Arrivo   = $DArrivo;
                  }
                  if($rc['Partenza']!= $value['DataPartenza']){
                      $Partenza   = $DPartenza;
                  }
              }
          }
          while($val = mysqli_fetch_assoc($result2)) {
              $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].($val['NumAdulti']!=0?' <i class=\'fa fa-angle-right\'></i> A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
          }

          if($value['TipoRichiesta'] == 'Preventivo'){

              $sistemazioneP .= '<b>'.$n.') PROPOSTA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.'<br>'.$data_alernativa.$Camere.'  <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>  '.($PrezzoL!='0,00'?'Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br />';

          }else{

              $sistemazioneC .= '<b>SOLUZIONE CONFERMATA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.'<br> '.$data_alernativa.$Camere.' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  '.($PrezzoL!='0,00'?' Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br /> '.($acconto!=''?'<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.'.$acconto.'':'').'<br>'.$etichetta_saldo.'<br>';

          }

       $n++;
       $data_alernativa = '';
       $DPartenza       = '';
       $DArrivo         = '';
       $DNotti          = '';
      }

      if($sistemazioneP!=''){
          $sistemazione = '<div class="col-md-6"><h4>Preventivo:</h4>'.$sistemazioneP.'</div>';
      }
      if($sistemazioneC!=''){
          $sistemazione = '<div class="col-md-6"><h4>'.($value['Chiuso']==1?'Prenotazione':'Conferma').':</h4>'.$sistemazioneC.'</div>';
      }

      return '<div class="row">'.$sistemazione.'</div>';

  }else{
      return '<small class="text-maroon" style=" white-space: nowrap;">Da Completare</small>';
  }

}





    $select = " SELECT 
                  hospitality_guest.* 
                FROM 
                  hospitality_guest 
                WHERE 
                  hospitality_guest.idsito = ".$_REQUEST['idsito']."  
                AND 
                  hospitality_guest.NumeroPrenotazione = ".$_REQUEST['NumeroPrenotazione']."
                ORDER BY
                  hospitality_guest.Id DESC";

    $result = mysqli_query($conn,$select) or die('Error, connesione'.$conn);
    $row    = mysqli_fetch_assoc($result);

    $query  = "SELECT * FROM hospitality_operatori WHERE Abilitato = 1 AND idsito = ".$_REQUEST['idsito']." AND NomeOperatore != '".$row['ChiPrenota']."' ORDER BY Id ASC";
    $resu   = mysqli_query($conn,$query) or die('Error, connesione'.$conn);
    $Operatori .='<option value="">scegli</option>';
    while($valore = mysqli_fetch_assoc($resu)){
        $Operatori .='<option value="'.$valore['NomeOperatore'].'" >'.$valore['NomeOperatore'].'</option>';
    }

    if($row['DataScadenza']< date("Y-m-d")){
        $text = '<small class="text-primary">La <b>Data di Scadenza</b> della proposta è passata oppure non impostata, per <b>rispondere alla chat</b> è necessario <b>modificarla</b>!</small><br> <small style="color:#999!important">Perchè al cliente arriva email di avviso che lo rimanda alla landing page per la lettura della chat, che quindi non può essere scaduta!</small>';
        $title = 'Data di Scadenza passata, modificarla!';
       // $command = 'disabled="disabled"';
   
        $dataS__ = explode("-",$row['DataScadenza']);
        $dataSC = $dataS__[2].'-'.$dataS__[1].'-'.$dataS__[0];
        $form_data_scadenza .= '<small>
                                <div id="ResultDataScadenza"></div>
                                <form  method="POST" id="form_change" name="form_change">
                                    <div class="row">
                                        <div class="col-md-3" text-center">
                                            <label  class="control-label">Data Scadenza</label>
                                            <input type="text" id="DataScadenza" autocomplete="off"  class="date-picker form-control" name="DataScadenza" value="'.$dataSC.'">
                                        </div>
                                        <div class="col-md-1 text-left">
                                            <div class="clearfix" style="height:22px!important"></div>
                                            <input type="hidden" name="action" value="change">
                                            <input type="hidden" name="id_richiesta" value="'.$row['Id'].'">
                                            <input type="hidden" name="idsito" value="'.$_REQUEST['idsito'].'">
                                            <button type="submit" class="btn btn-primary" id="bottone">Modifica</button>
                                        </div>
                                        <div class="col-md-8 text-right">
                                            <div class="clearfix" style="height:22px!important"></div>
                                            '.$text.'
                                        </div>
                                    </div>
                                </form>
                                <div class="clearfix" style="height:40px!important"></div>
                                </small>'."\r\n";
        $form_data_scadenza .= '  <link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">'."\r\n";
        $form_data_scadenza .= '  <script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>'."\r\n";
        $form_data_scadenza .= '  <script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>'."\r\n";
        $form_data_scadenza .=' <script>
                                    $(document).ready(function() {

                                        $( "#DataScadenza" ).datepicker({
                                            numberOfMonths: 1,
                                            language:\'it\',
                                            showButtonPanel: true
                                        });
                                        
                                        $("#form_change").submit(function(){
                                            
                                            var dati = $("#form_change").serialize();                                                            
                                                $.ajax({
                                                    url: "'.BASE_URL_SITO.'ajax/modifica_data_scadenza.php",
                                                    type: "POST",
                                                    data: dati,
                                                        success: function(data) {                                                                                                          
                                                            $("#ResultDataScadenza").html(\'<div class="alert alert-success">Data salvata con successo! Attendi il reload della pagina!</div>\'); 
                                                            setTimeout(function(){ 
                                                                document.location.reload();  
                                                            }, 500);
                                                                                                            
                                                        }                                                                    
                                                    });                                                               
                                                return false; // con false senza refresh della pagina
                                        });                                                                                                                                                                                                                                                                                                  
                                    });
                                </script>'."\r\n";
    }  
    $js_chat ='<script>
                    $(document).ready(function() {
                        $("#form_chat").submit(function(){
                            
                            var dati = $("#form_chat").serialize();                                                            
                                $.ajax({
                                    url: "'.BASE_URL_SITO.'ajax/aggiungi_chat.php",
                                    type: "POST",
                                    data: dati,
                                        success: function(data) {                                                                                                          
                                            $("#chat").val(""); 
                                            $("#balloon").load("'.BASE_URL_SITO.'ajax/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                                                            
                                        }                                                                    
                                    });                                                               
                                return false; // con false senza refresh della pagina
                        });                                                                                                                                                                                                                                                                    

                        $("#balloon").load("'.BASE_URL_SITO.'ajax/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                               
                    });
                </script>'."\r\n";
    $js_chat_load ='<script>
                        $(document).ready(function() {
                            $("#balloon").load("'.BASE_URL_SITO.'ajax/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                               
                        });
                    </script>'."\r\n";
mysqli_close($conn);    
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?> | <?=NAME_ADMIN?></title>
    <meta name="description" content="CRM pensato per gli HOTEL: <?=NOME_AMMINISTRAZIONE?> <?=VERSIONE?> | <?=NAME_ADMIN?>">
    <meta name="author" content="<?=NAME_ADMIN?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon"  href="<?=BASE_URL_SITO?>favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/da6d3ea52f.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=BASE_URL_SITO?>dist/css/skins/skin-green.min.css">

    <link rel="stylesheet" href="<?=BASE_URL_SITO?>css/custom.css.php">


    <script src="<?=BASE_URL_SITO?>js/functions.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="<?=BASE_URL_SITO?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toogle="tooltip"]').tooltip();
        });
      </script>
    </head>
  <body class="scroll">
  <section class="content">
        <div class="row">
          <div class="col-md-2 text-right">              
            <a href="javascript:;" id="ChiudiChat<?=$_REQUEST['id_notify']?>" data-dismiss="modal" aria-label="Close">Chiudi la Chat <i class="fa fa-chain-broken"></i></a>
              <script>
                  $(document).ready(function(){
                      $("#ChiudiChat<?=$_REQUEST['id_notify']?>").on("click",function(){
                          if (window.confirm("ATTENZIONE: Sicuro di voler chiudere la chat N° <?=$row['NumeroPrenotazione']?>?")){
                              $.ajax({
                                  url: "<?=BASE_URL_SITO?>ajax/close_chat.php",
                                  type: "POST",
                                  data: "id=<?=$_REQUEST['id_notify']?>&idsito=<?=$row['idsito']?>&NumeroPrenotazione=<?=$row['NumeroPrenotazione']?>&id_guest=<?=$row['Id']?>&user=<?=$user_accesso?>",
                                  dataType: "html",
                                  success: function(data) {
                                    //$("#view_form").hide();
                                    $("#view_form").html('<div class="alert alert-dismiss alert-success text-center">La conversazione è stata chiusa con successo!<br>Ora clicca sul pulsante "chiudi" in alto a destra!</div>');
                                  }
                              });
                              return false;
                          }
                      });
                  });
              </script>
          </div>
          <div class="col-md-8" id="view_form">
            <div class="row">
              <div class="col-md-10">
                <h4>N° <b class="text-red"><?=$row['NumeroPrenotazione']?></b> 
                    Nome: <b class="text-green"><?=stripslashes($row['Nome'])?></b> 
                    Cognome: <b class="text-green"><?=stripslashes($row['Cognome'])?></b></h4>
                  <div class="clearfix"></div>
                <?=riepilogo($row['NumeroPrenotazione'],$row['idsito'])?> <br>
              </div>
              <div class="col-md-2"></div>
            </div>
            <? //echo $form_data_scadenza?>
            <div class="row">
              <div class="col-md-12">
                <form id="form_chat" name="form_chat" method="post">
                  <div class="form-group">
                  <label for="op">Cambia operatore <a href="javascript:;" id="attiva_legenda_info_fonti" data-toogle="tooltip" data-html="true" title="<div class=\'text-left\'>Se sei un operatore diverso da chi ha creato il preventivo e/o la conferma,puoi cambiare!</div>"><i class="fa fa-life-ring text-info"></i></a></label>
                    <select class="form-control"name="operatore" id="operatore" >
                      <?=$Operatori?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Messaggio">Hotel Chat</label>
                    <textarea class="form-control" rows="10" name="chat" id="chat" required></textarea>
                  </div>
                  <input type="hidden" name="id_guest" value="<?=$row['Id']?>">
                  <input type="hidden" name="NumeroPrenotazione" value="<?=$row['NumeroPrenotazione']?>">
                  <input type="hidden" name="user" value="<?=$row['ChiPrenota']?>">
                  <input type="hidden" name="lang" value="<?=$row['Lingua']?>">
                  <input type="hidden" name="idsito" value="<?=$row['idsito']?>">
                  <input type="hidden" name="action" value="add_chat">
                  <button id="bottone_invio_chat" type="submit" class="btn btn-primary" style="float:right!important;" title="<?=$title?>" <?=$command?> >Invia</button>
                </form>
                <?=$js_chat?>
                <?=$js_chat_load?>
                <br><br><br>
                <div id="balloon"></div>
              </div>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>
    </section>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=BASE_URL_SITO?>bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>