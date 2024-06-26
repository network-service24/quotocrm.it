<?php
  if(substr_count($_REQUEST['template'],'-') > 0) {
    $array_t         = explode('-',$_REQUEST['template']);
    $template_bread  = ucwords(str_replace("_", " ", $array_t[0]));
    $page_bread_html = '<li class = "active">'.ucwords(str_replace("_", " ", $array_t[1])).'</li>';
    $page_bread      = ucwords(str_replace("_", " ", $array_t[1]));
  }else{
    $template_bread  = ucwords(str_replace("_", " ", $_REQUEST['template']));
    $page_bread      = '';
    $page_bread_html = '';
  }
  if($template_bread == ''){
    $template_bread  = $page_bread_html ;
    $page_bread_html = '<li class = "active">'.ucwords(str_replace("_", " ", $_REQUEST['azione'])).'</li>';
    $page_bread      = ucwords(str_replace("_", " ", $_REQUEST['azione']));
  }
  if($page_bread =='Anteprima Web Custom1' || $page_bread =='Anteprima Web Custom2' || $page_bread =='Anteprima Web Custom3'){
    $page_bread = 'Anteprima Web Template Landing Custom';
  }
  if($template_bread =='Checkinonline'){
      $template_bread = 'Check-in Online';
  }
  if($page_bread == 'Add Checkin Online'){
    $page_bread_html = '<li class = "active">Add Check-in Online</li>';
    $page_bread = 'Add Check-in Online';
  }
  if($page_bread == 'Mod Checkin Online'){
    $page_bread_html = '<li class = "active">Mod Check-in Online</li>';
    $page_bread = 'Mod Check-in Online';
  }
  if($page_bread == 'Prenotazioni Esterne'){
    $page_bread_html = '<li class = "active">Prenotazioni Agenzie</li>';
    $page_bread = 'Prenotazioni Agenzie';
  }
?>
<div class="box no-radius">
  <div class="box-body">
    <section class="content-header">
      <h1>
        <?=$template_bread;?>
        <?=($page_bread!=''?'<span>&#10230;</span> '.$page_bread:'')?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=BASE_URL_SITO?>dashboard-index/"><i class="fa fa-check-square-o"></i>
            <?=NOME_AMMINISTRAZIONE?>
            <?=VERSIONE?></a></li>
        <li>
          <?=$template_bread?>
        </li>
        <?=$page_bread_html?>
      </ol>
    </section>
  </div>
</div>