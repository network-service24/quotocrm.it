<?require($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manutenzione <?=NOME_AMMINISTRAZIONE?> | Network Service</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=BASE_HTTPS_SITO?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=BASE_HTTPS_SITO?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=BASE_HTTPS_SITO?>plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
       html, body {
            margin: 0;
            padding: 0;
        }
        input.error, input.error:focus { 
            border: 2px solid #97BF0D !important;
            box-shadow: none;           
        }
        #login_container .radio label.error, 
        #login_container .checkbox label.error { 
            position:absolute;
            left:   100px;
            z-index: 999;
            display:    inline-block !important;
            width:      200px !important;
            color:      red;
            font-size:  11px;   
        }
        label.error { 
            display:none !important;        
        }
        .form-box {
            margin-top: 0px !important;
            position:fixed;
            z-index:100;
            border-radius:0px !important;
            max-width:300px;
            left:50% !important;
            margin-left:-150px !important;
            bottom:-500px;
            height:auto;
            background-color:rgba(255,255,255.8);
            transition:all 1s cubic-bezier(0.68, -0.55, 0.265, 1.55); ;
            opacity:0;
        }

        .logo {
            margin-left:    auto;
            margin-right:   auto;
            margin-top:     20px;
            margin-bottom:  20px;
        }
        .form-box .header {
            background-color: #605CA8 !important;
            border-radius:0px !important;
            font-size:20px !important;
            text-align:center !important;
        }
        .form-box .body {
            background-color:transparent !important;
        }  
        .form-box .footer {
            border-radius:0px !important;
            background-color:transparent !important;
        }
        .form-box .slogan1{
            position:absolute;
            left:-200px;
            top:-100px;
            font-size:50px;
            white-space:nowrap;
            color:#FFF;
            font-family: 'Questrial', sans-serif;
            text-shadow:
            -1px -1px 0 #333,  
            1px -1px 0 #333,
            -1px 1px 0 #333,
            1px 1px 0 #333;
            opacity:0;
            transition:all 1s ease;

        }
        .form-box .slogan2{
            position:absolute;
            right:-200px;
            top:-50px;
            font-size:30px;
            white-space:nowrap;
            color:#FFF;
            font-family: 'Questrial', sans-serif;
            text-shadow:
            -1px -1px 0 #333,  
            1px -1px 0 #333,
            -1px 1px 0 #333,
            1px 1px 0 #333;
            opacity:0;
            transition:all 1s ease;
        }     
        .footer {
          background: #EAEAEC !important;
        }
        input {background-color:#FFF !important;} {
        #feedback {
            padding: 10px 0 !important;
        }
        </style>   
  </head>
  <?php
      $frase_manutenzione_default = 'Il CRM è temporaneamente in manutenzione per aggiornamenti.<br />Torneremo online il prima possibile!';
      $frase_manutenzione_doc     = 'Il CRM è temporaneamente in manutenzione per importanti novità ed aggiornamenti.<br />Torneremo online entro 30 minuti circa!';
  ?>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <img class="logo img-responsive" src="<?=BASE_HTTPS_SITO?>img/logo.png" />
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Quoto Engagement & Customer Satisfaction</p>

                <div class="body">
 

                <div class="alert alert-warning"><?=$frase_manutenzione_doc?><br />Per maggiori informazioni o interventi sul tuo sito contatta lo staff Network Service.<br /><a href="mailto:aggiornamenti@network-service.it">aggiornamenti@network-service.it</a></div>




      </div><!-- /.login-box-body -->
      <small><strong>Copyright <span id="licenza">&copy;</span> <?=date('Y')?> <a href="https://www.network-service.it">Network Service s.r.l.</a></strong></small>  
    </div><!-- /.login-box -->
   
    <!-- jQuery 2.1.4 -->
    <script src="<?=BASE_HTTPS_SITO?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=BASE_HTTPS_SITO?>bootstrap/js/bootstrap.min.js"></script>
    <script>
          $( document ).ready(function() {
            $("#licenza").click(function(){
              window.open('<?=BASE_HTTPS_SITO?>licenza.html','licenza','toolbar=no,scrollbars=no,resizable=no,top=500,left=500,width=400,height=120');
            });
          });
    </script>   
  </body>
</html>