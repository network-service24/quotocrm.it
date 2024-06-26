<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

        /**
         * VARIABILI ACQUISITE DAL REQUEST
         */
        $idsito  = $_REQUEST['idsito'];
        $Lingua  = $_REQUEST['lang'];
        if( $Lingua != 'it' && $Lingua != 'en' && $Lingua != 'fr' && $Lingua != 'de'){
            $Lingua = 'en';    
        }
        /**
         * QUERY PER ESTRAPOLARE LA RIHCIESTA INTERESSATA
         */
        $select  = "SELECT 
                        hospitality_dizionario.etichetta,
                        hospitality_dizionario_lingua.*	
                    FROM 
                        hospitality_dizionario 
                    INNER JOIN 
                        hospitality_dizionario_lingua
                    ON
                        hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                    WHERE 
                        hospitality_dizionario.idsito = ".$idsito." 
                    AND
                        hospitality_dizionario_lingua.idsito = ".$idsito." 
                    AND
                        hospitality_dizionario_lingua.Lingua = '".$Lingua."' 
                    AND
                        hospitality_dizionario.etichetta = 'INFORMATIVA_PRIVACY'";

        $res   = $dbMysqli->query($select);
        $row   = $res[0];

        $txt_informativa = $row['testo'];
        /**
         * QUERY PER DATI ANAGRAFICI HOTEL
         */
        $query2 ="SELECT siti.*,
                        anagrafica.rag_soc,
                        anagrafica.indirizzo,
                        anagrafica.cap,
                        anagrafica.p_iva,
                        comuni.nome_comune,
                        province.sigla_provincia,
                        regioni.nome_regione
                    FROM
                        siti
                    left join utenti on utenti.idsito = siti.idsito
                    left join anagrafica on anagrafica.idanagra = utenti.idanagra
                    left join comuni on comuni.codice_comune = siti.codice_comune
                    left join province on province.codice_provincia = siti.codice_provincia
                    left join regioni on regioni.codice_regione = siti.codice_regione
                    WHERE 
                        siti.idsito = ".$idsito."";

        $res2   = $dbMysqli->query($query2);
        $rw     = $res2[0];

        $sito_tmp         = str_replace("http://","",$rw['web']);
        $sito_tmp         = str_replace("www.","",$sito_tmp);
        $http             = ($rw['https']==1?'https://':'http://');
        $sitoweb          = $http.'www.'.$sito_tmp; 

        $txt_informativa = str_replace('{!rag_soc!}','<b>'.$rw['rag_soc'].'</b>',$txt_informativa);
        $txt_informativa = str_replace('{!indirizzo!}','<b>'.$rw['indirizzo'].'</b>',$txt_informativa);
        $txt_informativa = str_replace('{!cap!}','<b>'.$rw['cap'].'</b>',$txt_informativa);
        $txt_informativa = str_replace('{!citta!}','<b>'.$rw['nome_comune'].'</b>',$txt_informativa);
        $txt_informativa = str_replace('{!provincia!}','<b>'.$rw['sigla_provincia'].'</b>',$txt_informativa);
        $txt_informativa = str_replace('{!p_iva!}','<b>'.$rw['p_iva'].'</b>',$txt_informativa);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>PRIVACY POLICY</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="<?=BASE_URL_SITO?>files/bower_components/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <script src="https://use.fontawesome.com/da6d3ea52f.js"></script>
        <!-- jquery -->
        <script src="https://www.quotocrm.it/apiForm/js/jquery-3.1.1.min.js"></script>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">         
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?=$txt_informativa;?>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    &nbsp;
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <small><b>QUOTO!</b> powered by <em>Network Service s.r.l.</em></small>
                </div> 
            </div>
        </div>
    </body>
</html>
