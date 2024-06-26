<?php 
header('Content-type: application/javascript');
require_once('../include/settings.inc.php');
/**
 * ? FUNZIONI
 */

echo 'function open_notifica(titolo,testo,transition,posizione,icona,time,loadercolor){
    /* 
      transition = "slide", "fade", "plain";
      posizione = "bottom-left", "bottom-right", "top-right", "top-left", "bottom-center", "top-center", "mid-center";
      icona = info,warning,success,error;
      time = 5000;
      loadercolor = "#ff6849";
    */
    
    $.toast({
        heading: titolo,
        text: testo,
        showHideTransition: transition,
        position: posizione,
        loaderBg:loadercolor,
        icon: icona,
        hideAfter: time
      });
    }'."\r\n";

echo '$( document ).ready(function() {'."\r\n";

        /**
         * !ON CLICK PICCOLO LOADING AL POSTO DELLA BUSTA EMAIL VERDE IN PREVENTIVI E CONFERME
         */
  echo '  $(".pul_send").on("click",function(){
            $(this).removeClass("icon-checkmark glyphicon glyphicon-envelope");
            $(this).addClass("fa fa-spinner fa-pulse");
          });'."\r\n";

        /**
         * !ON CLICK PICCOLO LOADING AL POSTO DELLA ICONA INVIO CHEKIN IN PRENOTAZIONI
         */
  echo '  $(".pul_checkin").on("click",function(){
            $(this).removeClass("fa fa-vcard-o");
            $(this).addClass("fa fa-spinner fa-pulse");
          });'."\r\n";

        /**
         * !ON CLICK PICCOLO LOADING AL POSTO DELLA ICONA INVIO QUESTIONARIO IN PRENOTAZIONI
         */
  echo '  $(".pul_cs").on("click",function(){
            $(this).removeClass("fa fa-paper-plane");
            $(this).addClass("fa fa-spinner fa-pulse");
          });'."\r\n";

         
        /**
         * !ON CLICK ADATTA PROFILO USER NELLA SIDEBAR
         */
        echo 'if($("body").hasClass("sidebar-collapse")){           
                  $("#profile-img").attr("style","margin-left:0px!important;text-align:center!important;padding: 45px 0 !important;");
                  $(".half-image").attr("style","max-width:40px!important;")
                  $("#user-name").attr("style","color:transparent!important"); 
                  $("#online").attr("style","float:left!important;margin-left:-30px!important");              
              }
              if($("body").hasClass("sidebar-expanded-on-hover")){
                  $("#profile-img").attr("style","margin-left:30px!important;text-align:left!important;padding: 40px 0 !important;");
                  $(".half-image").attr("style","max-width:50px!important;")
                  $("#user-name").attr("style","color:#FFF!important");
                  $("#online").removeAttr("style");        
              }
              $(".sidebar-toggle").on("click",function(){
                if($("body").hasClass("sidebar-collapse")){
                  $("#profile-img").attr("style","margin-left:30px!important;text-align:left!important;padding: 40px 0 !important;");
                  $(".half-image").attr("style","max-width:50px!important;")
                  $("#user-name").attr("style","color:#FFF!important");
                  $("#online").removeAttr("style");
                }else{
                  $("#profile-img").attr("style","margin-left:0px!important;text-align:center!important;padding: 45px 0 !important;");
                  $(".half-image").attr("style","max-width:40px!important;")
                  $("#user-name").attr("style","color:transparent!important");
                  $("#online").attr("style","float:left!important;margin-left:-30px!important");
                }
              });
              '."\r\n";
        /**
         * !ON CLICK LICENZA NEL FOOTER
         */
  
        echo '$("#licenza").click(function(){
                window.open("'.BASE_URL_SITO.'licenza.html","licenza","toolbar=no,scrollbars=no,resizable=no,top=500,left=500,width=400,height=120");
              });'."\r\n";
  
        /**
         * !ON CLICK VIDEO GUIDA YOUTUBE NEL TOP
         */
  
        echo '$(document).on("click", ".btn_mod", function () {
                var dataIdVideo = $(this).data("idvideo");
                var dataTitolo = $(this).data("titolo");
                $(".modal-header .modal-title").text(dataTitolo);
              $(".modal-body #link").attr("src", "https://www.youtube.com/embed/" + dataIdVideo + "?fs=1&autoplay=1&loop=1");
            });'."\r\n";
  

echo '});'."\r\n";
                
echo '$(document).ajaxComplete(function(){'."\r\n";
          /**
           * !ON CLICK PICCOLO LOADING AL POSTO DELLA BUSTA EMAIL VERDE IN PREVENTIVI E CONFERME
           */
        echo '  $(".pul_send").on("click",function(){
                  $(this).removeClass("icon-checkmark glyphicon glyphicon-envelope");
                  $(this).addClass("fa fa-spinner fa-pulse");
                });'."\r\n";

          /**
           * !ON CLICK PICCOLO LOADING AL POSTO DELLA ICONA INVIO CHEKIN IN PRENOTAZIONI
           */
        echo '  $(".pul_checkin").on("click",function(){
                  $(this).removeClass("fa fa-vcard-o");
                  $(this).addClass("fa fa-spinner fa-pulse");
                });'."\r\n";

                    /**
           * !ON CLICK PICCOLO LOADING AL POSTO DELLA ICONA INVIO QUESTIONARIO IN PRENOTAZIONI
           */
        echo '  $(".pul_cs").on("click",function(){
                  $(this).removeClass("fa fa-paper-plane");
                  $(this).addClass("fa fa-spinner fa-pulse");
                });'."\r\n";

                
echo '});'."\r\n";
?>