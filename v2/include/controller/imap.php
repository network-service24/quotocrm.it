<?php

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_imap_email');
    $xcrud->where('hospitality_imap_email.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->columns('Portale,ServerEmail,UserEmail,PasswordEmail,HotelID,Type,UrlApi', false);

    $array_type = array();
    $array_type = array('','tutte','diretta','multipla');
    $xcrud->change_type('Type','select','tutte',implode(',',$array_type));
    $xcrud->field_tooltip('Type','Seleziona il tipo di email da sincronizzare, solo relativo per il portale Info-Alberghi.com');

    $array_UrlApi = array();
    $array_UrlApi = array('','https://api.info-alberghi.com/api/getEmailAll','https://api.info-alberghi.com/api/getEmail','https://api.info-alberghi.com/api/getEmailToday');
    $xcrud->change_type('UrlApi','select','https://api.info-alberghi.com/api/getEmailAll',implode(',',$array_UrlApi));
    $xcrud->field_tooltip('UrlApi','Seleziona l\'indirizzo dell\'API per sincronizzare le email, solo relativo per il portale Info-Alberghi.com');

    $xcrud->field_tooltip('HotelID','Inserisci  Hotel_ID dato dall\'amministrazione di Info-Alberghi, solo relativo per il portale Info-Alberghi.com');


    $xcrud->fields('Portale,ServerEmail,UserEmail,PasswordEmail,HotelID,Type,UrlApi', false);

    $xcrud->change_type('Portale','select','--','--,info-alberghi.com,gabiccemare.com,italyfamilyhotels.it,riccioneinhotel.com,cesenaticobellavita.it,familygo.eu,italybikehotels.it,bimboinviaggio.com,hotel-facile.it,allinclusivehotels.it');

    $xcrud->condition('Portale','=','info-alberghi.com','disabled','ServerEmail,UserEmail,PasswordEmail');
    $xcrud->condition('Portale','=','gabiccemare.com','disabled','HotelID,Type,UrlApi');
    $xcrud->condition('Portale','=','italyfamilyhotels.it','disabled','HotelID,Type,UrlApi');
    $xcrud->condition('Portale','=','riccioneinhotel.com','disabled','HotelID,Type,UrlApi');
    $xcrud->condition('Portale','=','cesenaticobellavita.it','disabled','HotelID,Type,UrlApi');
    $xcrud->condition('Portale','=','familygo.eu','disabled','HotelID,Type,UrlApi');
    $xcrud->condition('Portale','=','italybikehotels.it','disabled','HotelID,Type,UrlApi');
    $xcrud->condition('Portale','=','bimboinviaggio.com','disabled','HotelID,Type,UrlApi');
    $xcrud->condition('Portale','=','hotel-facile.it','disabled','HotelID,Type,UrlApi');
    $xcrud->condition('Portale','=','allinclusivehotels.it','disabled','HotelID,Type,UrlApi');

    $xcrud->label(array('ServerEmail' => 'Server E-mail','UserEmail' => 'UserName E-mail','PasswordEmail' => 'Password E-mail'));

    $xcrud->create_action('Attiva', 'abilita_imap'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_imap');
    $xcrud->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1'));


    $db->query("SELECT * FROM hospitality_imap_email WHERE idsito = ".IDSITO );
    $r = $db->result();
    $tot = sizeof($r);
    if($tot > 6) {
        $xcrud->unset_add();
    }
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers();
    $xcrud->hide_button('save_new');

    $js_ajax = '
    <script>
        function ajaxdata(){
            $.ajax({
                    url: "'.BASE_URL_SITO.'ajax/insert_ora_import.php",
                    type: "POST",
                    data: "idsito='.IDSITO.'",
                    dataType: "html",
                    success: function(data) {
                            //$("#id_ora_export").html(data);
                        }
                });
                return false; // con false senza refresh della pagina
        }

        $(".btn.btn-success.xcrud-action").click(function(){
            var task = $(this).attr(\'data-task\');
            if (task == \'create\') {
                setInterval(ajaxdata(), 1000);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $(\'#openBtn\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn2\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap2.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo2").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn3\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap3.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo3").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn4\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap4.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo4").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn5\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap5.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo5").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn6\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap6.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo6").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn7\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap7.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo7").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn8\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap8.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo8").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn9\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap9.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo9").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn10\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_imap10.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo10").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
        });
    </script> '."\r\n";
