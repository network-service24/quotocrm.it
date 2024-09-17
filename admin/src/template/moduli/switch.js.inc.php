<?php
 switch($_SERVER['REQUEST_URI']){ 
    case "/admin/siti/":
    case "/admin/utenti/":
    case "/admin/utenti/sw/".$_REQUEST['param']:
    case "/admin/comunicazioni/":
    case "/admin/superuser/":
    case "/admin/superuser/sw/".$_REQUEST['param']:
    case "/admin/filtro_quoto/":
    case "/admin/report/index/":
    case "/admin/report/archivio/":
    case "/admin/report/fatturato_telefono_quoto/":

        echo '<!-- Select 2 js -->'."\r\n";
        echo '<script type="text/javascript" src="'.BASE_URL_SITO.'files/bower_components/select2/js/select2.full.min.js"></script>'."\r\n";
        echo '<!-- Multiselect js -->'."\r\n";
        echo '<script type="text/javascript" src="'.BASE_URL_SITO.'files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>'."\r\n";
        echo '<script type="text/javascript" src="'.BASE_URL_SITO.'files/bower_components/multiselect/js/jquery.multi-select.js"></script>'."\r\n";
        echo '<script type="text/javascript" src="'.BASE_URL_SITO.'files/assets/js/jquery.quicksearch.js"></script>'."\r\n";
    break; 
   
    } 
?>
