<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');

function geocode($address){

// url encode per l'indirizzo
$address = urlencode($address);
// google map geocode api url
$url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCEhD0s4UEJdItPacNMZNLE_aoyLYGAHL8";
// Acquisisce i risultati json
$resp_json = file_get_contents($url);
// decodifica json
$resp = json_decode($resp_json, true);
// Restituiscee 'OK', se c'è un indirizzo geocodificato
    if($resp['status']=='OK'){
        // Raccoglie i dati fondamentali per la visualizzazione della mappa
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? 
        $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? 
        $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? 
        $resp['results'][0]['formatted_address'] : "";
        // Verifica della completezza dei dati
        if($lati && $longi && $formatted_address) {
            // Inserisce i dati in un Array
            $data_arr = array();
            array_push($data_arr, $lati, $longi, $formatted_address);
            return $data_arr;
        } else {
            return false;
        }
    } else {
        echo "<strong>ERRORE: {$resp['status']}</strong>";
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Coordinate Google Map <?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?></title>
    <!-- Nome della Web Application -->
    <meta name="application-name" content="<?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?>">
    <!-- Autore -->
    <meta name="author" content="<?=AUTHOR?>">
    <!-- Proprietario del Software -->
    <meta name="copyright" content="<?=NAME_ADMIN?>">
    <!-- Favicon icon -->
    <link rel="icon" href="<?=BASE_URL_SITO?>favicon/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/custom.css">
    <!-- mio Style.css -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/style.css">
    <!-- Jquery -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>js/jquery-3.5.1.js"></script>

    <script src="<?=BASE_URL_SITO?>plugin/clipboard.js-master/dist/clipboard.min.js"></script>
    <style>
        body{
            background-color:#FFF!important;
        }
        #gmap_canvas{
            width:100%;
            height:260px;
        }
    </style>
    </head>
    <body>

        <div class="container">
                <?php   
                    if($_REQUEST){
                        // Ricevo latitudine e longitudine passandop una stringa indirizzo
                        $data_arr = geocode($_REQUEST['address']);
                        // Se esiste la geocodifica dell'indirizzo
                        if($data_arr){
                            $latitude = $data_arr[0];
                            $longitude = $data_arr[1];
                            $formatted_address = $data_arr[2];
                        }
                    }
                ?>
                    <!-- Visualizza Google Map -->
                    <div id="gmap_canvas">Caricamento della mappa ...</div>
                    <div class="clearfix p-b-20"></div>
                    <div id='map-label'>Mappa completa di indirizzo</div>
                    <!-- JavaScript Mostra Google Map -->
                    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCEhD0s4UEJdItPacNMZNLE_aoyLYGAHL8"></script>
                    <script type="text/javascript">
                    function init_map() {
                        <?php
                            // Se latitudine e longitudine sono vuoti imposto coordinate di Network Service
                            if($latitude == '' || $longitude == ''){
                                $latitude  = '44.0554282'; 
                                $longitude = '12.5441379';
                            }
                        ?>
                        var myOptions = {
                            zoom: 14,
                            center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                        marker = new google.maps.Marker({
                            map: map,
                            position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
                        });
                        infowindow = new google.maps.InfoWindow({
                            content: "<?php echo $formatted_address; ?>"
                        });
                        google.maps.event.addListener(marker, "click", function () {
                            infowindow.open(map, marker);
                        });
                        infowindow.open(map, marker);
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);
                    </script>
                    
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input type="text" name="address" class="form-control" placeholder="Inserisci un Indirizzo" />
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-default btn-sm" type="submit">Ricava coordinate</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="clearfix p-b-20"></div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" name="coordinate" id="coordinate" class="form-control" value="<?=($latitude!='' && $longitude!=''?$latitude.','.$longitude:'')?>"  />
                                    </div>
                                    <div class="col-md-3">
                                    <script> var clipboard = new ClipboardJS('#CL');</script>	
                                        <button class="btn btn-success btn-sm" type="button"  id="CL" data-clipboard-action="copy" data-clipboard-target="#coordinate" title="copia" alt="copia"><i class="fa fa-clone" aria-hidden="true"></i> Copia e Incolla</button>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
       </div> 
        <!-- Required Jquery -->
        <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/popper.js/js/popper.min.js"></script>
        <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>