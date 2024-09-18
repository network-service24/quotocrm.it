<? //echo check_data_password_overfade()?>
<header class="main-header">
        <!-- Logo -->
        <a href="<?=BASE_URL_SITO?>dashboard-index/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?=BASE_URL_SITO?>img/q_border.png" style="max-width:100%;"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?=BASE_URL_SITO?>img/logo_white_border.png" class="logoQuoto"></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" >
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
           <ul class="nav navbar-nav">
              <li class="dropdown notifications-menu" >
              <a href="<?=BASE_URL_ROOT?>dashboard-index/" class="f-12" id="change_ui_n">
                  Passa alla nuova interfaccia QUOTO! 
                  <i class="fa fa-object-ungroup" aria-hidden="true"></i>
              </a>
              <script>
                  $(document).ready(function(){
                      $("#change_ui_n").on("click", function(){
                          $.ajax({
                              url: "<?=BASE_URL_ROOT?>ajax/log/cambio_interfaccia.php",
                              type: "POST",
                              data: "idsito=<?=IDSITO?>&ui=new",
                              dataType: "html",
                              success: function(msg) {
                                      console.log("Passaggio alla nuova interfaccia"); 
                                  }
                          });
                          return true;
                      });
                  });
              </script> 
            </li>
            <li class="dropdown notifications-menu" style="margin-left:30px!important;margin-top:15px!important">
              <script>
                $(function () {
                    var i = 0;
                    var speed = 1000;
                    link = setInterval(function () {
                        i++;
                        $(".lampeggiante").css("color", i%2 == 1 ? "#FFFFFF" : "#00acc1");
                    }, speed);
                })
              </script>
              <?php
                  $today = time();
                  $event = mktime(0,0,0,10,15,2024);
                  $countdown = round(($event - $today)/86400);
                  echo '<span class="lampeggiante"><small><b style="margin-right:10px!important">&#10230;</b> '.$countdown.' gg. alla chiusura di questa interfaccia</small></span>';
              ?>
            </li>
          </ul>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

            <li class="dropdown notifications-menu">
                <a href="" class="btn_mod" data-toggle="modal" data-target="#video" data-titolo="Webinar" data-idvideo="m392XCxX2LM">
                      <span class="hidden-xs">Link al webinar registrato</span> <i class="fa fa-video-camera"></i>
                  </a>
              </li>
              <li class="dropdown notifications-menu">
                  <a href="<?=BASE_URL_SITO?>partners/" class="dropdown-toggle">
                      <span class="hidden-xs">Partners integrati </span><i class="fa fa-users" aria-hidden="true"></i>
                  </a>
              </li>
            <? 
              if(($_SERVER['REQUEST_URI']=='/') || ($_SERVER['REQUEST_URI']=='/dashboard-index/') || ($_SERVER['REQUEST_URI']=='/index/')){
                if(CHECKINONLINE!=1){
                  echo check_comunicazioni();
                }
              }
            ?>
            <?php echo data_scadenza_software()?>
            <?php echo scadenza_software()?>
            <?php if(($_SERVER['REQUEST_URI']!='/preventivi/') && ($_SERVER['REQUEST_URI']!='/conferme/') && ($_SERVER['REQUEST_URI']!='/prenotazioni/')){ echo video_guida();} ?>
            <?php //echo guida()?>
              <!-- User Account: style can be found in dropdown.less -->
              <?$ico = explode("#",ico_operatore(IDSITO,$_SESSION['user_accesso'])); $iconaUtente = $ico[0]; $nomeUtente = $ico[1]?>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <?php echo'<img src="'.BASE_URL_SITO.'dist/img/'.$iconaUtente.'" class="user-image" alt="User Image">';?>
                  <span class="hidden-xs"><?=($nomeUtente!=''?ucwords($nomeUtente):'Account')?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                      <?php echo'<img src="'.BASE_URL_SITO.'dist/img/'.$iconaUtente.'" class="img-circle" alt="User Image">';?>
                    <p>
                    <?=($nomeUtente!=''?ucwords($nomeUtente):ucfirst((strlen(NOMEUTENTE)>2?NOMEUTENTE:USER)))?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?$permessi = check_permessi();?>
                      <?if($permessi['UTENTI']==1){?>
                        <a href="<?=BASE_URL_SITO?>profilo/" class="btn btn-default"><i class="fa fa-user"></i> Profile</a>
                      <?}?>
                      <? if(func_check_accessi(IDSITO)==1){?>
                      <span class="text-center pdL8">
                          <a href="javascript:;" onclick="vai_logout('<?=BASE_URL_ROOT?>logout.php?provenienza=change_user&idsito=<?=IDSITO?>&nome_utente=<?=($nomeUtente!=''?ucwords($nomeUtente):ucfirst((strlen(NOMEUTENTE)>2?NOMEUTENTE:USER)))?>&icona_utente=<?=$iconaUtente?>');" class="btn btn-default"><img src="<?=BASE_URL_SITO?>img/change_user.png" style="width:16px;"> Users</a>
                      </span>
                      <?}?>
                    </div>
                    <div class="pull-right">
                      <a href="<?=BASE_URL_SITO?>logout.php"  class="btn btn-default"><i class="fa fa-power-off"></i> Log out</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>

        </nav>
      </header>
     <div class="modal fade" id="video"  role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
            <iframe width="560" height="315" src=""  id="link" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
