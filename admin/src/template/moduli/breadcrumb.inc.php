<?php
  if(substr_count($_REQUEST['template'],'-') > 0) {
    $array_t         = explode('-',$_REQUEST['template']);
    $template_bread  = ucwords(str_replace("_", " ", $array_t[0]));
    $page_bread_html = ''.ucwords(str_replace("_", " ", $array_t[1])).'';
    $page_bread      = ucwords(str_replace("_", " ", $array_t[1]));
  }else{
    $template_bread  = ucwords(str_replace("_", " ", $_REQUEST['template']));
    $page_bread      = '';
    $page_bread_html = '';
  }
  if($template_bread == ''){
    $template_bread  = $page_bread_html ;
    $page_bread_html = ''.ucwords(str_replace("_", " ", $_REQUEST['azione'])).'';
    $page_bread      = ucwords(str_replace("_", " ", $_REQUEST['azione']));
  }

?>
 <!-- Page-header start -->
  <div class="page-header">
      <div class="row align-items-end">
          <div class="col-lg-8">
              <div class="page-header-title">
                  <div class="d-inline">
                      <h4><?=$template_bread;?></h4>
                      <span><?=($page_bread!=''?' &#10230; '.$page_bread:'')?></span>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="page-header-breadcrumb">
                  <ul class="breadcrumb-title">
                      <li class="breadcrumb-item">
                          <a href="<?=BASE_URL_SITO?>dashboard-index/"> <i class="feather icon-home"></i> </a>
                      </li>
                      <li class="breadcrumb-item"><a href="<?=$_SERVER['REQUEST_URI']?>"><?=$template_bread?></a>
                      </li>
                      <li class="breadcrumb-item"><a href="<?=$_SERVER['REQUEST_URI']?>"><?=$page_bread_html?></a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>