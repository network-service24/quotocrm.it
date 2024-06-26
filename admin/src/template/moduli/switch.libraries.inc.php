<?php
 switch($_SERVER['REQUEST_URI']){

        case"/admin/siti/":
        case"/admin/siti/cl/".$_REQUEST['param']:
        case"/admin/utenti/cl/".$_REQUEST['param']:
        case"/admin/utenti/":
        case"/admin/utenti/sw/".$_REQUEST['param']:
        case"/admin/superuser/cl/".$_REQUEST['param']:
        case"/admin/superuser/":
        case"/admin/superuser/sw/".$_REQUEST['param']:
        case"/admin/clienti/":
        case"/admin/clienti/ut/".$_REQUEST['param']:
        case"/admin/clienti/sw/".$_REQUEST['param']:
        case"/admin/siti/ut/".$_REQUEST['param']:
        case"/admin/filtro_conferme_quoto/":
        case"/admin/file_log_quoto/":
        case"/admin/confronti_fatturato/":
        case"/admin/comunicazioni/":
        case"/admin/report/index/":
        case"/admin/report/index/".$_REQUEST['azione']."/":
        case"/admin/report/archivio/":
        case"/admin/report/archivio/".$_REQUEST['azione']."/".$_REQUEST['param']."/":

            echo '<!-- Data Table Css -->'."\r\n";
            echo '<link rel="stylesheet" type="text/css" href="'.BASE_URL_SITO.'css/dataTables.bootstrap4.min.css">'."\r\n";
            echo '<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">'."\r\n";
            echo '<link href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css" rel="stylesheet">'."\r\n";
            echo '<link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet"> '."\r\n";  
            echo '<!-- data-table js -->'."\r\n";
            echo '<script type="text/javascript" src="'.BASE_URL_SITO.'plugin/moment-2.29.1/moment-with-locales.js"></script>'."\r\n"; 
            echo '<script type="text/javascript" src="'.BASE_URL_SITO.'js/jquery.dataTables.min.js"></script>   '."\r\n";        
            echo '<script type="text/javascript" src="'.BASE_URL_SITO.'js/dataTables.bootstrap4.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.flash.min.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.html5.min.js"></script> '."\r\n";
            echo '<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.print.min.js"></script>  '."\r\n";
            echo '<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.11.4/sorting/formatted-numbers.js"></script>'."\r\n";
            echo '<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.13.6/sorting/currency.js"></script>'."\r\n";
            echo '<script src="'.BASE_URL_SITO.'files/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min.js"></script>'."\r\n";   
            
        break;


} 
?>
