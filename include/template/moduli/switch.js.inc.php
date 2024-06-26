<?php
 switch($_SERVER['REQUEST_URI']){
        case"/index/":
        case"/dashboard-index/":
            echo '<!-- knob js -->'."\r\n";
            echo '<script src="'.CDN_URL_SITO.'files/assets/pages/chart/knob/jquery.knob.js"></script>'."\r\n";
            echo '<!-- Custom js -->'."\r\n";
            echo '<script type="text/javascript" src="'.CDN_URL_SITO.'files/assets/pages/chart/knob/knob-custom-chart.js"></script>'."\r\n";
        break;
    case"/crea_proposta/":
    case"/modifica_proposta/edit/".$_REQUEST['param']:
    case"/modifica_proposta/edit/".$_REQUEST['param']."/".$_REQUEST['valore']:
    case"/checkinonline-crea_proposta_esterna/":
    case"/checkinonline-modifica_proposta_esterna/edit/".$_REQUEST['param']:
    case"/checkinonline-modifica_proposta_esterna/edit/".$_REQUEST['param']."/".$_REQUEST['valore']:
            echo'<link rel="stylesheet" type="text/css" href="'.CDN_URL_SITO.'css/animate.min.css" />'."\r\n";
            echo'<script src="'.CDN_URL_SITO.'js/jquery.validate.min.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.CDN_URL_SITO.'js/draggabilly.js"></script>'."\r\n";
            echo'<script src="'.CDN_URL_SITO.'js/jquery.price_format.2.0.js"></script>'."\r\n";
            echo'<script src="'.CDN_URL_SITO.'js/accounting.min.js"></script>'."\r\n";
            echo'<link rel="stylesheet" href="'.CDN_URL_SITO.'plugin/chosen/chosen.css">'."\r\n";
            echo'<script src="'.CDN_URL_SITO.'plugin/chosen/chosen.jquery.js" type="text/javascript"></script>'."\r\n";
            echo'<script src="'.CDN_URL_SITO.'plugin/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>'."\r\n";
            echo'<link href="' .CDN_URL_SITO. 'plugin/imagePicker/image-picker/image-picker.css" rel="stylesheet" type="text/css">'."\r\n";
            echo'<script src="' .CDN_URL_SITO. 'plugin/imagePicker/image-picker/image-picker.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="'.CDN_URL_SITO.'plugin/moment-2.29.1/moment-with-locales.js"></script>'."\r\n"; 
        break;
    case"/templates-grafiche/":
        echo'<link href="'.CDN_URL_SITO.'js/plugins/bootstrap-colorselector-0.2.0/css/bootstrap-colorselector.css" rel="stylesheet" />'."\r\n";
        echo'<script src="'.CDN_URL_SITO.'js/plugins/bootstrap-colorselector-0.2.0/js/bootstrap-colorselector.js"></script>'."\r\n";
    break;
} 
?>
