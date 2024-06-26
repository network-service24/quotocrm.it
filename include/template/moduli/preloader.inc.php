<style>
    .loading {
    position: fixed !important;
    left: 0px !important;
    top: 0px !important;
    width: 100% !important;
    height: 100% !important;
    z-index: 99999999;
    background: rgba(255, 255, 255, 0.7) url(<?=BASE_URL_SITO?>img/body-loader.gif) no-repeat center center !important;
    text-align: center !important;
    color: #999 !important;
    }        
</style>
 <script type="text/javascript">
    $(window).load(function() {
        $("#loading").fadeOut();
    });
</script> 
<div id="loading" class="loading"></div>