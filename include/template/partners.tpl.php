<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                            <div class="card-header">
                                                <h5>I nostri Partners</h5>                                              

                                            </div>
                                                <div class="card-block">
                                                        <h3><b>Software integrati</b></h3>
                                                        <script src="<?=CDN_URL_SITO?>js/jquery.animateNumber.js"></script>
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
                                                                padding-top: 10px;
                                                                padding-bottom: 10px;
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
                                                                },1500);
                                                                $('#PMS').animateNumber({
                                                                    number:3,
                                                                    numberStep: function(now, tween) {
                                                                        var formatted = now.toFixed(2);
                                                                        $(tween.elem).text(number_format(formatted,0,',','.'));
                                                                    }
                                                                },1500);
                                                                $('#Channel').animateNumber({
                                                                    number:1,
                                                                    numberStep: function(now, tween) {
                                                                        var formatted = now.toFixed(2);
                                                                        $(tween.elem).text(number_format(formatted,0,',','.'));
                                                                    }
                                                                },1500);
                                                                $('#Gateway').animateNumber({
                                                                    number:5,
                                                                    numberStep: function(now, tween) {
                                                                        var formatted = now.toFixed(2);
                                                                        $(tween.elem).text(number_format(formatted,0,',','.'));
                                                                    }
                                                                },1500);
                                                                $('#Portali').animateNumber({
                                                                    number:8,
                                                                    numberStep: function(now, tween) {
                                                                        var formatted = now.toFixed(2);
                                                                        $(tween.elem).text(number_format(formatted,0,',','.'));
                                                                    }
                                                                },1500);
                                                                
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

                                                        <div class="clearfix p-b-10"></div>
                                                        <div class="row">
                                                            <div class="col-md-4"><b>CHANNEL MANAGER</b><br> <img src="<?=BASE_URL_SITO?>img/parity_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>BOOKING ENGINE</b><br> <img src="<?=BASE_URL_SITO?>img/simplebooking_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>PMS CLOUD</b><br> <img src="<?=BASE_URL_SITO?>img/5stelle_partners.jpg" class="img-responsive"></div>
                                                        </div>
                                                        <div class="clearfix p-b-10"></div>
                                                        <div class="row">
                                                            <div class="col-md-4"><b>ERICSOFT BOOKING & PMS</b><br> <img src="<?=BASE_URL_SITO?>img/ericsoft_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>BEDZZLE BOOKING & PMS</b><br> <img src="<?=BASE_URL_SITO?>img/bedzzle_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"></div>                         
                                                        </div>
                                                        <div class="clearfix p-b-20"></div>
                                                        <h3><b>Gateway Bancari</b></h3>
                                                        <div class="clearfix p-b-10"></div>
                                                        <div class="row">
                                                            <div class="col-md-4"><b>GATEWAY ON WEB</b><br> <img src="<?=BASE_URL_SITO?>img/paypal_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>GATEWAY BANCARIO IN COLLABORAZIONE CON BCC</b><br> <img src="<?=BASE_URL_SITO?>img/payway_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>GATEWAY BANCARIO CON BANCA MALATESTIANA</b><br> <img src="<?=BASE_URL_SITO?>img/virtualpay_partners.jpg" class="img-responsive"></div>
                                                        </div>
                                                        <div class="clearfix p-b-10"></div>
                                                        <div class="row">
                                                            <div class="col-md-4"><b>GATEWAY STRIPE</b><br> <img src="<?=BASE_URL_SITO?>img/stripe_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>GATEWAY NEXI</b><br> <img src="<?=BASE_URL_SITO?>img/nexi_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"></div>
                                                        </div>
                                                        <div class="clearfix p-b-20"></div>
                                                        <h3><b>Portali Turistici integrati</b></h3>
                                                        <div class="clearfix p-b-10"></div>
                                                        <div class="row">
                                                            <div class="col-md-4"><b>INFO-ALBERGHI.COM</b><br> <img src="<?=BASE_URL_SITO?>img/infoalberghi_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>GABICCEMARE.COM</b><br> <img src="<?=BASE_URL_SITO?>img/gabiccemare_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>ITALYFAMILYHOTELS.IT</b><br> <img src="<?=BASE_URL_SITO?>img/italyfamilyhotels_partners.jpg" class="img-responsive"></div>
                                                        </div> 
                                                        <div class="clearfix p-b-10"></div>
                                                        <div class="row">
                                                            <div class="col-md-4"><b>RICCIONEINHOTEL.COM</b><br> <img src="<?=BASE_URL_SITO?>img/riccioneinhotel_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>CESENATICOBELLAVITA.IT</b><br> <img src="<?=BASE_URL_SITO?>img/cesenatico_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>FAMILYGO.EU</b><br> <img src="<?=BASE_URL_SITO?>img/familygo_partners.jpg" class="img-responsive"></div>
                                                        </div>  
                                                        <div class="clearfix p-b-10"></div>  
                                                        <div class="row">
                                                            <div class="col-md-4"><b>ITALYBIKEHOTELS.IT</b><br> <img src="<?=BASE_URL_SITO?>img/italybikehotels_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"><b>SPAHOTELSCOLLECTION.IT</b><br> <img src="<?=BASE_URL_SITO?>img/spahotelscollection_partners.jpg" class="img-responsive"></div>
                                                            <div class="col-md-4"></div>
                                                        </div>  

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