<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
  <div class="box radius6">
      <div class="box-body">
        <h2> <i class="fa fa-users"></i> I nostri partners
          <?=NOME_AMMINISTRAZIONE?>
          <?=VERSIONE?>
          <span>&#10230;</span> <small>
            Software e  Gateway Bancari integrati</small></h2>
      </div>
    </div>
    <div class="box radius6">
      <div class="box-body">
      <h3><b>Software integrati</b></h3>
      <script src="<?=BASE_URL_SITO?>js/jquery.animateNumber.js"></script>
      <style>
          .dark-bg {
              background-color: #333231;
              color: #fff;
          }
          .dark-bg .section-title h2 {
              color: #fff;
          }
          .short-section {
              border-top: 1px solid #5D5D5F;
              border-bottom: 1px solid #5D5D5F;
              padding-top: 20px;
              padding-bottom: 20px;
          }
          .counter-item h2 {
              color: #fff;
              font-size: 60px;
              font-weight: 900;
              display:inline-block;
          }
          .euro h2 {
              color: #fff;
              font-size: 60px;
              font-weight: 900;
              position:relative;
              margin-left:10px;
          }
          .counter-item h6 {
              color: #FFF;
              font-size: 16px;
              font-weight: 700;
              margin: 10px 0 0 0;
              text-transform: uppercase;
          }
      </style>
      <script>
          function number_format(number,decimals,dec_point,thousands_sep) {
              number  = number*1;//makes sure `number` is numeric value
              var str = number.toFixed(decimals?decimals:0).toString().split('.');
              var parts = [];
              for ( var i=str[0].length; i>0; i-=3 ) {
                  parts.unshift(str[0].substring(Math.max(0,i-3),i));
              }
              str[0] = parts.join(thousands_sep?thousands_sep:',');
              return str.join(dec_point?dec_point:'.');
          }

      $(document).ready(function () {

              $('#Booking').animateNumber({
                  number:3,
                  numberStep: function(now, tween) {
                      var formatted = now.toFixed(2);
                      $(tween.elem).text(number_format(formatted,0,',','.'));
                  }
              },1000);
              $('#PMS').animateNumber({
                  number:3,
                  numberStep: function(now, tween) {
                      var formatted = now.toFixed(2);
                      $(tween.elem).text(number_format(formatted,0,',','.'));
                  }
              },1000);
              $('#Channel').animateNumber({
                  number:1,
                  numberStep: function(now, tween) {
                      var formatted = now.toFixed(2);
                      $(tween.elem).text(number_format(formatted,0,',','.'));
                  }
              },1000);
              $('#Gateway').animateNumber({
                  number:5,
                  numberStep: function(now, tween) {
                      var formatted = now.toFixed(2);
                      $(tween.elem).text(number_format(formatted,0,',','.'));
                  }
              },1000);
              $('#Portali').animateNumber({
                  number:7,
                  numberStep: function(now, tween) {
                      var formatted = now.toFixed(2);
                      $(tween.elem).text(number_format(formatted,0,',','.'));
                  }
              },1000);
              
      });
      </script>
      <section class="dark-bg short-section stats-bar">
              <div class="container text-center">
                  <div class="row">
                  
                      <div class="col-md-2 p-30">
                          <div class="counter-item nowrap">
                              <h2 class="stat-number"><span id="Booking">0</span></h2>
                              <h6>Booking Engine</h6>
                          </div>
                      </div>
                      <div class="col-md-2 p-30">
                          <div class="counter-item nowrap">
                              <h2 class="stat-number"><span id="PMS">0</span></h2>
                              <h6>PMS</h6>
                          </div>
                      </div>
                      <div class="col-md-3 p-30">
                          <div class="counter-item nowrap">
                              <h2 class="stat-number"><span id="Channel">0</span></h2>
                              <h6>Channel Manager</h6>
                          </div>
                      </div>
                      <div class="col-md-2 p-30">
                          <div class="counter-item nowrap">
                              <h2 class="stat-number"><span id="Gateway">0</span></h2>
                              <h6>Gateway Bancari</h6>
                          </div>
                      </div>
                      <div class="col-md-2 p-30">
                          <div class="counter-item nowrap">
                              <h2 class="stat-number"><span id="Portali">0</span></h2>
                              <h6>Portali Turistici</h6>
                          </div>
                      </div>
                      
                  </div>
              </div>
          </section>
      <div class="row">
        <div class="col-md-4"><b>CHANNEL MANAGER</b> <img src="<?=BASE_URL_SITO?>img/parity_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>BOOKING ENGINE</b> <img src="<?=BASE_URL_SITO?>img/simplebooking_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>PMS CLOUD</b> <img src="<?=BASE_URL_SITO?>img/5stelle_partners.jpg" class="img-responsive"></div>
      </div>
      <div class="row">
        <div class="col-md-4"><b>ERICSOFT BOOKING & PMS</b> <img src="<?=BASE_URL_SITO?>img/ericsoft_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>BEDZZLE BOOKING & PMS</b> <img src="<?=BASE_URL_SITO?>img/bedzzle_partners.jpg" class="img-responsive"></div>
      </div>
      <h3><b>Gateway Bancari</b></h3>
      <div class="row">
        <div class="col-md-4"><b>GATEWAY ON WEB</b> <img src="<?=BASE_URL_SITO?>img/paypal_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>GATEWAY BANCARIO IN COLLABORAZIONE CON BCC</b> <img src="<?=BASE_URL_SITO?>img/payway_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>GATEWAY BANCARIO CON BANCA MALATESTIANA</b> <img src="<?=BASE_URL_SITO?>img/virtualpay_partners.jpg" class="img-responsive"></div>
      </div>
      <div class="row">
        <div class="col-md-4"><b>GATEWAY STRIPE</b> <img src="<?=BASE_URL_SITO?>img/stripe_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>GATEWAY NEXI</b> <img src="<?=BASE_URL_SITO?>img/nexi_partners.jpg" class="img-responsive"></div>
      </div>

      <h3><b>Portali Turistici integrati</b></h3>
      <div class="row">
        <div class="col-md-4"><b>INFO-ALBERGHI.COM</b> <img src="<?=BASE_URL_SITO?>img/infoalberghi_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>GABICCEMARE.COM</b> <img src="<?=BASE_URL_SITO?>img/gabiccemare_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>ITALYFAMILYHOTELS.IT</b> <img src="<?=BASE_URL_SITO?>img/italyfamilyhotels_partners.jpg" class="img-responsive"></div>
      </div> 
      <div class="row">
        <div class="col-md-4"><b>RICCIONEINHOTEL.COM</b> <img src="<?=BASE_URL_SITO?>img/riccioneinhotel_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>CESENATICOBELLAVITA.IT</b> <img src="<?=BASE_URL_SITO?>img/cesenatico_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>FAMILYGO.EU</b> <img src="<?=BASE_URL_SITO?>img/familygo_partners.jpg" class="img-responsive"></div>
      </div>    
      <div class="row">
        <div class="col-md-4"><b>ITALYBIKEHOTELS.IT</b> <img src="<?=BASE_URL_SITO?>img/italybikehotels_partners.jpg" class="img-responsive"></div>
        <div class="col-md-4"><b>BIMBOINVIAGGIO.COM (COMING SOON</b>)<img src="<?=BASE_URL_SITO?>img/bimboinviaggio_partners.jpg" class="img-responsive" style="opacity:0.2!important"></div>
      </div>  
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>